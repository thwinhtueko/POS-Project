@extends('user.layouts.master')

@section('title', 'Pizza Bakery')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                        by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 p-1">
                            <label for="price-all">Product Category</label>
                            <span class="badge border text-dark font-weight-normal">{{ count($category) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}" class="text-decoration-none text-dark">
                                All View
                            </a>
                        </div>
                        @foreach ($category as $c)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $c->id) }}" class="text-decoration-none text-dark">
                                    {{ $c->name }}
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                <a href="{{ route('cart#List') }}">
                    <button class="btn btn btn-warning w-100">Order Now</button>
                </a>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div>
                                    <a href="{{ route('cart#List') }}">
                                        <button type="button" class="btn btn-primary position-relative"><i
                                                class="fa-solid fa-cart-arrow-down text-dark"></i>
                                            <span
                                                class="position-absolute top-0 fs- start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($cart) }}
                                            </span>
                                        </button>
                                    </a>
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('order#history') }}">
                                        <button type="button" class="btn btn-primary position-relative"><i
                                                class="fa-solid fa-cart-plus me-1"></i>History
                                            <span
                                                class="position-absolute top-0 fs- start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($history) }}
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Sorting Product ...</option>
                                        <option value="asc">Z to A</option>
                                        <option value="desc">A to Z</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dataList">
                        @if (count($product) != 0)
                            @foreach ($product as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="sotingId">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 240px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="#">
                                                    {{ $p->view_count }}
                                                </a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#details', $p->id) }}"><i
                                                        class="fa-solid fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-capitalize" href="">
                                                {{ $p->name }} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }} MMK</h5>
                                                <h6 class="text-muted ml-2"><del></del></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center mt-5 mb-2">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <h5 class="text-center mt-2">Oops! Sorry for this product... <h4>
                        @endif
                    </div>
                </div>
                {{ $product->appends(request()->query())->links() }}
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

<!--AJax Coe --->
@section('AjaxSource')
    <script>
        $(document).ready(function() {
            $('#sortingOption').change(function() {

                $eventOption = $('#sortingOption').val();

                if ($eventOption == 'asc') {

                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/pizza',
                        data: {
                            'status': 'asc'
                        },
                        contentType: "application/json",
                        datatype: 'json',
                        success: function(response) {

                            $pizzaList = "";
                            for ($i = 0; $i < response.length; $i++) {
                                $pizzaList += ` <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="sotingId">
                                   <a href="/pizza/details/${response[$i].id}">
                                          <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 240px"
                                                src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-capitalize" href="">
                                                ${response[$i].name} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} MMK</h5>
                                                <h6 class="text-muted ml-2"><del></del></h6>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>`;
                            }
                            $('#dataList').html($pizzaList);
                        }
                    })

                } else if ($eventOption == 'desc') {

                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/ajax/pizza',
                        data: {
                            'status': 'desc'
                        },
                        contentType: "application/json",
                        datatype: 'json',
                        success: function(response) {
                            $pizzaList = "";
                            for ($i = 0; $i < response.length; $i++) {
                                $pizzaList += ` <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="sotingId">
                                    <a href="/pizza/details/${response[$i].id}">
                                          <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 240px"
                                                src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate text-capitalize" href="">
                                                ${response[$i].name} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} MMK</h5>
                                                <h6 class="text-muted ml-2"><del></del></h6>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>`;
                            }
                            $('#dataList').html($pizzaList);
                        }
                    })

                }
            });

        });
    </script>
@endsection
