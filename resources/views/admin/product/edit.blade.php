@extends('admin.layouts.master')

@section('title', 'Product Details')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- MAIN CONTENT-->
                    <div class="main-content">
                        <div class="section__content section__content--p30">
                            <div class="container-fluid">
                                <div class="col-lg-8 offset-2">
                                    <div class="card-body">
                                        <div class="card shadow-sm">
                                            <div class="d-flex m-3 justify-content-between bg-white">
                                                <a href="{{ route('product#list') }}">
                                                    <button>
                                                        <button class="btn btn-outline-light btn-sm text-dark rounded"><i
                                                                class="fa-solid fa-arrow-left me-1"></i>Back</button>
                                                    </button>
                                                </a>

                                                <div>
                                                    <h4 class="text-center text-muted">{{ $product->category_name }}</h4>
                                                </div>

                                                <a href="{{ route('product#updatePage', $product->id) }}"
                                                    class="float-right">
                                                    <button class="btn btn-outline-light btn-sm text-dark rounded">Edit<i
                                                            class="fa-solid fa-plus ms-1"></i></button>
                                                </a>
                                            </div>

                                            @if (session('successMessage'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <i
                                                        class="fa-solid fa-triangle-exclamation me-2 text-success"></i><strong>
                                                        {{ session('successMessage') }} </strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-4 offset-1">
                                                    <div>
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                            class="rounded img-thumbnail" />
                                                    </div>
                                                </div>

                                                <div class="col-6 offset-1">
                                                    <div class="my-3">
                                                        <i class="fa-solid fa-pizza-slice fs-6 me-3"></i>
                                                        <span>{{ $product->name }}</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-solid fa-sack-dollar fs-6 me-3"></i>
                                                        <span>{{ $product->price }} Kyats</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-solid fa-clock-rotate-left fs-6 me-3"></i>
                                                        <span>{{ $product->waiting_time }} mins</span>
                                                    </div>

                                                    <div class="my-3">
                                                        <i class="fa-regular fa-calendar-days fs-6 me-3"></i>
                                                        <span>{{ $product->created_at->format('j F Y') }}</span>
                                                    </div>
                                                </div>

                                                <div class="mt-2 mb-4 offset-1 col-10 text-muted fa-1x">
                                                    <span>{{ $product->description }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MAIN CONTENT-->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
