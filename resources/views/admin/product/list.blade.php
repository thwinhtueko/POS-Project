@extends('admin.layouts.master')

@section('title', 'Product List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>
                            </div>
                            
                            @if (session('successMessage'))
                                <div class="invalid-feedback">
                                    {{ session('successMessage') }}
                                </div>
                            @endif
                        </div>

                        <div class="h6 bg-dark text-white p-2 rounded shadow-sm">
                            <span class="me-2">Total</span>{{ $pizza->total() }}
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('product#create') }}">
                                <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('product#list') }}" method="get">
                        @csrf
                        <div class="d-flex justify-content-end">
                            <input type="text" name="Key" value="{{ request('Key') }}" class="form-control w-25"
                                placeholder="Search..">
                            <button class="btn btn-dark rounded">
                                Search
                            </button>
                        </div>
                    </form>

                    <h4 class="mb-4 text-success">Search Key: <span class="text-muted d-inline-block"> {{ request('Key') }}
                        </span></h4>


                    @if (count($pizza) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 shadow-sm">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Category ID</th>
                                        <th>Create Date</th>
                                        <th class="text-center">View Count</th>
                                        <th>Update Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizza as $p)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $p->image) }}" alt="image"
                                                    class="img-thumbnail" style="width: 120px">
                                            </td>
                                            <td class="col-2 text-center"> {{ $p->name }} </td>
                                            <td class="col-2 text-center"> {{ $p->category_name }} </td>
                                            <td> {{ $p->created_at->format('j F Y') }} </td>
                                            <td class="col-2 text-center"> <i
                                                    class="fa-solid fa-eye me-2"></i>{{ $p->view_count }}
                                            </td>
                                            <td> {{ $p->updated_at->format('j F Y') }} </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#edit', $p->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="view">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#updatePage', $p->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $pizza->links() }}
                            </div>
                        </div>
                    @else
                        <div class="mt-5 row">
                            <h3 class="offset-4 col-8 text-danger">Your Product Not Found....</h3>
                        </div>
                        <div class="offset-5 col-7 mt-5">
                            <a href="{{ route('product#list') }}" class="text-center btn btn-dark"><i
                                    class="fa-solid fa-arrow-left me-2"></i>Back</a>
                        </div>
                    @endif


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
