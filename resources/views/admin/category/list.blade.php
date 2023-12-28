@extends('admin.layouts.master')

@section('title', 'Category List Page')

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
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>

                        <div class="h6 bg-dark text-white p-2 rounded shadow-sm">
                            Total {{ $Categories->total() }}
                        </div>

                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('category#list') }}" method="GET">
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

                    @if (count($Categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Create Date</th>
                                        <th>Update Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Categories as $item)
                                        <tr class="tr-shadow">
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>{{ $item->created_at->format('d - F - Y') }}</td>
                                            <td>{{ $item->updated_at->format('d - F - Y | h:i:a') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#edit', $item->id) }}" class="me-2">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('category#delete', $item->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
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
                                {{ $Categories->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @else
                        <div class="mt-5 row">
                            <h3 class="offset-4 col-8 text-danger">Your Category Not Found....</h3>
                        </div>
                        <div class="offset-5 col-7 mt-5">
                            <a href="{{ route('category#list') }}" class="text-center btn btn-dark"> <i
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
