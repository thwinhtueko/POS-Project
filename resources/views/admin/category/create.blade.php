@extends('admin.layouts.master')

@section('title', 'Add Category')

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
                                        <a href="{{ route('category#list') }}"><button
                                                class="btn bg-dark text-white my-3">List</button></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 offset-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h3 class="text-center title-2">Add Category</h3>
                                            </div>
                                            <hr>
                                            <form action="{{ route('category#create') }}" method="post"
                                                novalidate="novalidate">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="addCategory" class="control-label mb-1">Name</label>
                                                    <input id="addCategory" value="{{ old('categoryName') }}"
                                                        name="categoryName" type="text"
                                                        class="form-control @error('categoryName') is-invalid @enderror"
                                                        aria-required="true" aria-invalid="false"
                                                        placeholder="Pizza Name...">

                                                    @error('categoryName')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <button id="payment-button" type="submit"
                                                        class="btn btn-lg btn-info btn-block">
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
