<script>
    $(document).ready(function (){

        //add product into cart
        $('.shopping-cart-form').on('submit', function (e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                data: formData,
                url:"{{route('add-to-cart')}}",
                success: function (data){
                    if(data.status == 'success') {
                        getCartCount();
                        fetchSidebarCartProducts();
                        $('.mini_cart_actions').removeClass("d-none");
                        toastr.success(data.message,);
                    }else if(data.status == 'error'){
                        toastr.error(data.message,);
                    }
                },
                error: function (data){

                }
            })
        })

        //add products in sidebar cart
        function fetchSidebarCartProducts(){
            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

                url:"{{route('cart-products')}}",
                success: function (data){
                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for(let item in data) {
                        let product = data[item];
                        html +=`<li id="mini_cart_${product.rowId}">
                                    <div class="wsus__cart_img">
                                        <a href="#"><img src="{{asset('/')}}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                        <a class="wsis__del_icon remove_sidebar_product" data-rowId="${product.rowId}" href=""><i class="fas fa-minus-circle"></i></a>

                                    </div>
                                    <div class="wsus__cart_text">
                                        <a class="wsus__cart_title" href="{{ route('product-detail', '') }}/${product.options.slug}">${product.name}</a>
                                        <p>{{$settings->currency_icon}}${product.price}</p>
                                        <small>Variants total: {{$settings->currency_icon}} ${product.options.variants_total}</small>
                                        <br>
                                        <small>Qty: ${product.qty}</small>
                                    </div>
                                    </li>`

                    }

                    $('.mini_cart_wrapper').html(html);

                    getSidebarSubtotal();


                },
                error: function (data){

                }
            })

        }

        //count
        function getCartCount(){
            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:"{{route('cart-count')}}",
                success: function (data){
                    $('#cart-count').text(data);
                },
                error: function (data){

                }
            })


        }


        //remove items from sidebar cart
        $('body').on('click', '.remove_sidebar_product', function (e){
            e.preventDefault();
            let rowId = $(this).data('rowid');
            $.ajax({
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:"{{route('cart.remove-sidebar-product')}}",
                data:{
                    rowId: rowId
                },
                success: function (data){
                    let productId = '#mini_cart_'+rowId;
                    $(productId).remove();
                    getSidebarSubtotal();
                    if($('.mini_cart_wrapper').find('li').length == 0){
                        $('.mini_cart_actions').addClass("d-none");
                        $('.mini_cart_wrapper').html('<li class="text-center">Cart Is Empty</li>')
                    }
                    getCartCount();

                    toastr.success(data.message);
                },
                error: function (data){
                    console.log(data);
                }
            })
        })


        //get sidebar cart sub total fo
        function getSidebarSubtotal(){
            $.ajax({
                method: 'GET',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url:"{{route('cart.sidebar-product-total')}}",
                success: function (data){
                    $('#mini_cart_subtotal').text("{{$settings->currency_icon}}"+data);
                },
                error: function (data){

                }
            })


        }

    })

</script>
