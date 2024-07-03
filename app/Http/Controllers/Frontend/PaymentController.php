<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PaypalSetting;
use App\Models\Product;
use App\Models\StripeSetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Cart;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function index()
    {

        if (!Session::has('address')) {
            return redirect()->route('user.checkout');
        }

        if (!Session::has('shipping_method')) {
            return redirect()->route('user.checkout');
        }

        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');

    }


    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {

        $setting = GeneralSetting::first();

        //store order
        $order = new Order();
        $order->invoice_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->subtotal = getMainCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->shipping_method = json_encode(Session::get('shipping_method'));
        $order->coupon = json_encode(Session::get('coupon'));
        $order->order_status = 0;

        $order->save();


        //store order product
        foreach (Cart::content() as $cartItem) {
            $product = Product::find($cartItem->id);

            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->vendor_id = $product->id;
            $orderProduct->product_name = $product->name;
            $orderProduct->variants = json_encode($cartItem->options->variants);
            $orderProduct->variant_total = json_encode($cartItem->options->variants_total);
            $orderProduct->unit_price = $cartItem->price;
            $orderProduct->qty = $cartItem->qty;

            $orderProduct->save();

        }


        //store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->amount_real_currency = $paidAmount;
        $transaction->amount_real_currency_name = $paidCurrencyName;

        $transaction->save();
    }


    public function clearSession(){
        Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');

    }

    public function paypalConfig()
    {

        $paypalSetting = PaypalSetting::first();

        $config =
            ['mode' => $paypalSetting->mode == 1 ? 'live' : 'sandbox',
                'sandbox' => [
                    'client_id' => $paypalSetting->client_id,
                    'client_secret' => $paypalSetting->secret_key,
                    'app_id' => '',
                ],
                'live' => [
                    'client_id' => $paypalSetting->client_id,
                    'client_secret' => $paypalSetting->secret_key,
                    'app_id' => '',
                ],

                'payment_action' => 'Sale',
                'currency' => $paypalSetting->currency_name,
                'notify_url' => '',
                'locale' => 'en_US',
                'validate_ssl' => true

            ];

        return $config;

    }


    public function calcFinalAmount(): float
    {
        $paypalSetting = PaypalSetting::first();
        return round(getFinalPayableAmount() * $paypalSetting->currency_rate, 2);

    }

    /*Paypal redirect*/
    /**
     * @throws \Throwable
     */
    public function payWithPaypal()
    {

        $config = $this->paypalConfig();


        $provider = new PayPalClient($config);
        $provider->getAccessToken();


        //calculate total payable amount depending on currency rate
        $total = $this->calcFinalAmount();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                ["amount" => [
                    "currency_code" => $config['currency'],
                    "value" => $total
                ]
                ]
            ]

        ]);

        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $link) {

                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }

            }
        } else {
            return redirect()->route('paypal.cancel');
        }

    }


    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            //store order in database
            $this->storeOrder('paypal', 1, $response['id'], $this->calcFinalAmount(), PaypalSetting::first()->currency_name);

            //delete all session and clear cart
            $this->clearSession();


            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');

    }


    public function paypalCancel()
    {
        toastr('Something went wrong try again later!', 'error');
        return redirect()->route('user.payment');
    }


   /* stipe payment*/
    /**
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function payWithStripe(Request $request){

        $stripeSetting = StripeSetting::first();
        $total = getFinalPayableAmount();
        $payableAmount = round($total * $stripeSetting->currency_rate, 2);



        Stripe::setApiKey($stripeSetting->secret_key);
        Charge::create([
            "amount" => $payableAmount * 100,
            "currency" => $stripeSetting->currency_name,
            "source" => $request->stripe_token,
            "description" => "Product purchase!"
        ]);

        dd('Success');
    }


    public function stripeSuccess(Request $request){

    }

    public function stripeCancel(){

    }

}
