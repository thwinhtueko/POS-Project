@extends('admin.layouts.master')

@section('title', 'Create Product')

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
                                <div class="row">
                                    <div class="col-3 offset-8">
                                        <a href="{{ route('product#list') }}"><button
                                                class="btn bg-dark text-white my-3">List</button></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 offset-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Add Product</h3>
                                            </div>
                                            <hr>
                                            <form action="{{ route('product#createPage') }}" method="post"
                                                enctype="multipart/form-data" novalidate="novalidate">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="" class="control-label mb-1">Name</label>
                                                    <input type="text" name="name"
                                                        class="form-control @error('name')is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('name') }}" placeholder="Enter Product Name">

                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="control-label mb-1">Category</label>
                                                    <select name="category"
                                                        class="form-control @error('category')is-invalid @enderror">
                                                        <option value="">Choose Category...</option>

                                                        @foreach ($category as $c)
                                                            <option value="{{ $c->id }}">
                                                                {{ $c->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="control-label mb-1">Description</label>
                                                    <textarea name="description" class="form-control @error('description')is-invalid @enderror" cols="30"
                                                        rows="5" placeholder="Write somethings your product description..." style="resize: none">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="control-label mb-1">Image</label>
                                                    <input type="file" name="image"
                                                        class="form-control @error('image')is-invalid @enderror">
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="control-label mb-1">Price</label>
                                                    <input type="number" name="price" value="{{ old('price') }}"
                                                        class="form-control @error('price') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Ener product price">
                                                    @error('price')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="waitingTime" class="control-label mb-1">Waiting Time</label>
                                                    <input type="number"
                                                        class="form-control @error('waitingTime')is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        value="{{ old('waitingTime') }}" name="waitingTime"
                                                        placeholder="Product release time">

                                                    @error('waitingTime')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit"
                                                        class="btn btn-lg btn-primary btn-block">
                                                        <span id="payment-button-amount">Create</span>
                                                        <i class="fa-solid fa-circle-right"></i>
                                                    </button>
                                                </div>
                                            </form>
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
