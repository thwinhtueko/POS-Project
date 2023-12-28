@extends('admin.layouts.master')

@section('title', 'Update Product')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- MAIN CONTENT-->
                    <div class="main-content">
                        <div class="section__content section__content--p30">
                            @error('terms')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="container-fluid ">
                                <div class="col-lg-8 offset-2">
                                    <div class="card">
                                        <div class="d-flex m-3 justify-content-between">
                                            <a href="#">
                                                <button>
                                                    <button class="btn btn-outline-light btn-sm text-dark rounded"
                                                        onclick="history.back()"><i
                                                            class="fa-solid fa-arrow-left me-1"></i>Back</button>
                                                </button>
                                            </a>

                                            <a href="{{ route('product#edit', $upProduct->id) }}" class="float-right">
                                                <button class="btn btn-outline-light btn-sm text-dark rounded">Preview<i
                                                        class="fa-solid fa-ellipsis-vertical ms-1"></i></button>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('product#update') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-4 offset-1">

                                                        <div>
                                                            <input type="hidden" name="pizzaId"
                                                                value='{{ $upProduct->id }}'>
                                                            <img src="{{ asset('storage/' . $upProduct->image) }}" />
                                                        </div>

                                                        <input type="file" name="image"
                                                            class="form-control my-2 @error('image')is-invalid @enderror">

                                                        @error('image')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                        <button class="btn btn-dark offset-1 p-2 col-10 text-white">
                                                            <i class="fa-regular fa-pen-to-square me-2"></i>Update
                                                            Product
                                                        </button>

                                                    </div>
                                                    <div class="col-6 offset-1">
                                                        <div class="my-3">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" name="name" id="name"
                                                                value="{{ old('name', $upProduct->name) }}"
                                                                placeholder="Update Product Name"
                                                                class="form-control text-muted @error('name') is-invalid @enderror">

                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="my-3">
                                                            <label for="category ">Category</label>
                                                            <select name="category" id="category"
                                                                class="form-control @error('category')is-invalid @enderror">
                                                                <option value="">Choose Categoy...</option>
                                                                @foreach ($category as $c)
                                                                    <option value="{{ $c->id }}"
                                                                        @if ($upProduct->category_id == $c->id) selected @endif>
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

                                                        <div class="my-3">
                                                            <label for="email">Product Price</label>
                                                            <input type="price" name="price" id="price"
                                                                value="{{ old('price', $upProduct->price) }}"
                                                                placeholder="Update Product Price"
                                                                class="form-control text-muted @error('price') is-invalid @enderror">

                                                            @error('price')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="h6 my-3">
                                                            <label for="waitingTime">Waiting Time</label>
                                                            <input type="number" name="waitingTime" id="waitingTime"
                                                                value="{{ old('waitingTime', $upProduct->waiting_time) }}"
                                                                placeholder="Update Waiting Time"
                                                                class="form-control text-muted @error('waitingTime') is-invalid @enderror">

                                                            @error('waitingTime')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="h6 my-3">
                                                            <label for="description">Product Description</label>
                                                            <textarea name="description" id="description" cols="30"
                                                                rows="4"class="form-control @error('description') is-invalid @enderror">{{ old('description', $upProduct->description) }} </textarea>

                                                            @error('description')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>

                                                        <div class="my-3">
                                                            <label for="viewCount">View Count</label>
                                                            <input type="number" name="viewCount" id="viewCount"
                                                                class="form-control"
                                                                value="{{ old('viewCount', $upProduct->view_count) }}"
                                                                readonly>
                                                        </div>

                                                        <div class="my-3">
                                                            <label for="createdDate">Created Date</label>
                                                            <input type="text" name="createdDate" id="createdDate"
                                                                class="form-control"
                                                                value="{{ $upProduct->created_at->format('j F Y') }}"
                                                                readonly>
                                                        </div>
                                                    </div>
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
