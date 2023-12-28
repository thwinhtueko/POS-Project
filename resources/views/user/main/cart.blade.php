@extends('user.layouts.master')

@section('title', 'Cart')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartList as $List)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('storage/' . $List->pizza_image) }}" alt=""
                                        style="width: 50px;">
                                    <input type="hidden" class="orderId" value="{{ $List->id }}">
                                    <input type="hidden" class="userId" value="{{ $List->user_id }}">
                                    <input type="hidden" class="productId" value="{{ $List->product_id }}">
                                </td>
                                <td class="align-middle col-2">{{ $List->pizza_name }}</td>
                                <td class="align-middle col-2" id="pizzaPrice"> {{ $List->pizza_price }} MMK </td>
                                <td class="align-middle col-2">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus fs-5"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm px-2 bg-secondary border-0 text-center"
                                            id="qty" value="{{ $List->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus fs-5"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-2" id="total">
                                    {{ $List->pizza_price * $List->qty }} MMK
                                </td>
                                <td class="align-middle col-2"><button class="btn btn-sm btn-danger removeBtn"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Total</h6>
                            <h6 id="subPrice">{{ $subTotal }} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery Fee</h6>
                            <h6 class="font-weight-medium"> 3500 MMK </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice"> {{ $subTotal + 3500 }} MMK</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 orderBtn">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3 clearCart">
                            <i class="fa-solid fa-cart-arrow-down me-1"></i> Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('AjaxSource')
    <script>
        $(document).ready(function() {

            //when plus button increase
            $('.btn-plus').click(function() {
                $parent = $(this).parents('tr');

                $price = Number($parent.find('#pizzaPrice').html().replace('MMK', ''));
                $qty = Number($parent.find('#qty').val());

                $totalPrice = $price * $qty;
                $parent.find('#total').html($totalPrice + " MMK");

                summaryCaculate();

            })

            //when minus button decrease
            $('.btn-minus').click(function() {
                $parent = $(this).parents('tr');
                $price = Number($parent.find('#pizzaPrice').html().replace('MMK', ""));
                $qty = Number($parent.find('#qty').val());

                $totalPrice = $price * $qty;
                $parent.find('#total').html($totalPrice + " MMK")

                summaryCaculate();

            })

            //when delete button
            $('.removeBtn').click(function() {
                $parent = $(this).parents('tr');
                $productId = $parent.find('.productId').val();
                $orderId = $parent.find('.orderId').val();

                $.ajax({
                    type: 'get',
                    url: '/ajax/current/clear',
                    data: {
                        'productId': $productId,
                        'orderId': $orderId
                    },
                    dataType: 'json',
                })

                $parent.remove();
                summaryCaculate();
            })


            //total summary
            function summaryCaculate() {
                $subTotal = 0;

                $('#dataTable tr').each(function(index, row) {
                    $subTotal += Number($(row).find('#total').text().replace('MMK', ""));

                    $('#subPrice').html($subTotal + " MMK");
                    $('#finalPrice').html($subTotal + 3500 + " MMK");
                })

            }


            //Order Checkout
            $orderList = [];

            $radmom = Math.floor(Math.random() * 10101) + 100;

            $('.orderBtn').click(function() {

                $('tbody tr').each(function(index, row) {

                    $orderList.push({
                        'user_id': $(row).find('.userId').val(),
                        'product_id': $(row).find('.productId').val(),
                        'qty': $(row).find('#qty').val(),
                        'total': Number($(row).find('#total').html().replace('MMK', "")),
                        'order_code': 'abc' + $radmom,
                    });

                });
                $.ajax({

                    'type': 'get',
                    'data': Object.assign({}, $orderList),
                    'url': '/ajax/checkout',
                    'dataType': 'json',
                    'success': function(response) {
                        if (response.status == 'true') {
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }

                })

            });

            //when clear btn click to clean cart
            $('.clearCart').click(function() {
                $.ajax({
                    type: 'get',
                    url: '/ajax/clear/cart',
                    dataType: 'json',
                })

                $('#dataTable tbody tr').remove();
                $('#subPrice').text('0');
                $('#finalPrice').text('3500 MMK');
            })


        });
    </script>
@endsection
