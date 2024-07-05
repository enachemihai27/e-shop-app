<div class="tab-pane fade show" id="v-pills-card-payment" role="tabpanel"
     aria-labelledby="v-pills-home-tab">
    <div class="row">
        {{-- <div class="col-xl-12 m-auto">
             <div class="wsus__payment_area">
                 <form>
                     <div class="wsus__pay_caed_header">
                         <h5>credit or debit card</h5>
                         <img src="images/payment5.png" alt="payment" class="img-=fluid">
                     </div>
                     <div class="row">
                         <div class="col-12">
                             <input class="input" type="text"
                                    placeholder="MD. MAHAMUDUL HASSAN SAZAL">
                         </div>
                         <div class="col-12">
                             <input class="input" type="text"
                                    placeholder="2540 4587 **** 3215">
                         </div>
                         <div class="col-4">
                             <input class="input" type="text" placeholder="MM/YY">
                         </div>
                         <div class="col-4 ms-auto">
                             <input class="input" type="text" placeholder="1234">
                         </div>
                     </div>
                     <div class="wsus__save_payment">
                         <h6><i class="fas fa-user-lock"></i> 100% secure payment with :</h6>
                         <img src="images/payment1.png" alt="payment" class="img-fluid">
                         <img src="images/payment2.png" alt="payment" class="img-fluid">
                         <img src="images/payment3.png" alt="payment" class="img-fluid">
                     </div>
                     <div class="wsus__save_card">
                         <div class="form-check form-switch">
                             <input class="form-check-input" type="checkbox"
                                    id="flexSwitchCheckDefault">
                             <label class="form-check-label"
                                    for="flexSwitchCheckDefault">save thid Card</label>
                         </div>
                     </div>
                     <button type="submit" class="common_btn">confirm</button>
                 </form>
             </div>
         </div>--}}

        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{route('user.stripe.payment')}}" method="POST" id="checkout-form">
                    @csrf
                    <input type="hidden" name="stripe_token" id="stripe-token-id">
                    <div style="padding: 18px;" class="border border-4" id="card-element"></div>
                    <br>
                    <button class="nav-link common_btn" id="pay-btn" onclick="createToken()" type="button">Pay with Stripe</button>
                </form>
            </div>
        </div>
    </div>
</div>

@php
    $stripeSetting = \App\Models\StripeSetting::first();
@endphp
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe("{{$stripeSetting->client_id}}");
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        function createToken(){
            document.getElementById("pay-btn").disabled = true;
            stripe.createToken(cardElement).then(function (result) {

                if(typeof result.error != 'undefined') {
                    document.getElementById("pay-btn").disabled = false;
                    alert(result.error.message);

                }

                //creating token success
                if(typeof result.token != 'undefined') {
                    document.getElementById("stripe-token-id").value = result.token.id;
                    document.getElementById("checkout-form").submit();
                }
            });
        }

    </script>
@endpush
