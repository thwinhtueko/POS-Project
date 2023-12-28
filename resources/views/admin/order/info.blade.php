@extends('admin.layouts.master')

@section('title', 'Order List Page')

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
                                <h2 class="title-1">Customer Order List</h2>
                            </div>
                            <div class="mt-4">
                                <button type="button" class="btn btn-dark text-white" onclick="history.back()">
                                    <i class="fa-solid fa-arrow-left me-1"></i> Back
                                </button>
                            </div>
                        </div>

                        <div class="table-data__tool-right">
                            <div class="overview-wrap rounded">
                                <div class="card p-2">
                                    <div class="card-header bg-white text-center m-3">
                                        <h4 class="mb-3">Details</h4>
                                        <span class="text-muted">Included Delivery Fee</span>
                                    </div>
                                    <div class="card-body w-100">
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="mb-4">
                                                <i class="fa-solid fa-user fs-6 me-1"></i>
                                                <span>{{ $orderList[0]->user_name }}</span>
                                            </div>
                                            <div class="mb-4">
                                                <i class="fa-solid fa-barcode fs-6 md-1"></i>
                                                <span> {{ $orderList[0]->order_code }} </span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="mb-4">
                                                <i class="fa-solid fa-sack-dollar fs-6 me-1"></i>
                                                <span> {{ $order[0]->total_price }} MMK</span>
                                            </div>
                                            <div class="mb-4">
                                                <i class="fa-regular fa-calendar-days fs-6 me-1"></i>
                                                <span> {{ $orderList[0]->created_at->format('j M Y') }} </span>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-white">
                                            <i class="fa-regular fa-thumbs-up fs-6 me-1"></i>
                                            <span class="text-muted">Thanks for choosing our service</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr class="text-center">
                                    <th>Image</th>
                                    <th>Total Amount</th>
                                    <th>Qty</th>
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $L)
                                    <tr class="align-middle text-center">
                                        <td class="col-1"> <img src="{{ asset('storage/' . $L->product_image) }}"> </td>
                                        <td>{{ $L->total }}</td>
                                        <td>{{ $L->qty }}</td>
                                        <td> {{ $L->order_code }} </td>
                                        <td>{{ $L->created_at->format('j F Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
