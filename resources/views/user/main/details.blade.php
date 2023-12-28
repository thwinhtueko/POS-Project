@extends('user.layouts.master')

@section('title', 'Pizza details')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#home') }}">
                    <button type="button" class="btn btn-secondary rounded mb-3"><i
                            class="fa-solid fa-arrow-left me-1"></i>Back</button>
                </a>
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active" style="height: 520px">
                            <img class="w-100 h-100 rounded " src="{{ asset('storage/' . $data->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30 mt-5">
                    <input type="hidden" value=" {{ Auth::user()->id }} " id="userId">
                    <input type="hidden" value=" {{ $data->id }} " id="pizzaId">
                    <h3> {{ $data->name }} </h3>
                    <div class="d-flex mb-3">
                        <small class="pt-1"><i class="fa fa-eye me-2"></i>{{ $data->view_count + 1 }}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $data->price }} MMK</h3>
                    <p class="mb-4"> {{ $data->description }} </p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control px-2 bg-secondary border-0 text-center" id="count"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3" id="cartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">

                    @foreach ($pizza as $a)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $a->image) }}" style="height:250px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('user#details', $a->id) }}">
                                        <i class="fa fa-eye" title="view"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> {{ $a->name }} </a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $a->price }} MMK</h5>
                                    {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                                <div class="mt-2">
                                    <small><i class="fa fa-eye me-1" title="view"></i> {{ $a->view_count }} </small>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

<!---Ajax item--->
@section('AjaxSource')

    <script>
        $(document).ready(function() {

            //view count
            $productId = $('#pizzaId').val();

            $.ajax({
                type: 'get',
                url: '/ajax/view',
                data: {
                    'productId': $productId
                },
                dataType: 'json',
            });

            //add to cart
            $('#cartBtn').click(function() {

                $source = {
                    'user': $('#userId').val(),
                    'pizza': $('#pizzaId').val(),
                    'count': $('#count').val()
                };

                $.ajax({
                    type: 'get',
                    url: '/ajax/cart',
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = '/user/home';
                        }

                    }

                })


            })

        })
    </script>

@endsection
