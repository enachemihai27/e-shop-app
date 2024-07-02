<?php


use Illuminate\Support\Facades\Session;

if (!function_exists('setActive')) {
    function setActive(array $route): string
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        }
        return ''; // Return an empty string if no route matches
    }
}

if (!function_exists('checkDiscount')) {
    function checkDiscount($product): bool {
        $currentDate = date('Y-m-d');

        if ($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
            return true;
        }
        return false;
    }
}

function calculateDiscountPercent($originalPrice, $discountPrice): int
{
    $discountAmount = $originalPrice - $discountPrice;
    return ($discountAmount / $originalPrice) * 100;
}

function productType(string $type) : string
{
    return match ($type) {
        'new_arrival' => "New",
        'featured' => "Featured",
        'top_product' => "Top",
        'best_product' => "Best",
        default => ""
    };
}
/*Get total total*/
function cartTotal()
{
    $total = 0;
    foreach (Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }

    return $total;
}

function getMainCartTotal(){

    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subtotal = cartTotal();
        if($coupon['discount_type'] == 'amount'){
            $total =  $subtotal - $coupon['discount'];
            return $total;
        }elseif($coupon['discount_type'] == 'percent'){
            $discount =$subtotal - ($subtotal * $coupon['discount'] / 100);
            $total = $subtotal - $discount;
            return $total;
        }
    }else{
        return cartTotal();
    }
}

function getCartDiscount(){

    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subtotal = cartTotal();
        if($coupon['discount_type'] == 'amount'){
            return $coupon['discount'];
        }elseif($coupon['discount_type'] == 'percent'){
            $discount =$subtotal - ($subtotal * $coupon['discount'] / 100);
            return $discount;
        }
    }else{
        return 0;
    }
}

/*get selected shipping fee*/
function getShippingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else{
        return  0;
    }
}


/*get payable amount*/
function getFinalPayableAmount(){
    return getMainCartTotal() + getShippingFee();
}
