@extends('admin.layouts.master')

@section('title', 'Order List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">

                    <form action="{{ route('order#status') }}" method="get">
                        @csrf
                        <div class="float-right">
                            <button type="submit" class="btn btn-dark">confirm</button>
                        </div>
                        <div class="col-2 float-right mb-3 text-center">
                            <select name="orderStatus" class="form-control">
                                <option value="">ALL</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Rejected</option>
                            </select>
                        </div>
                    </form>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderData as $D)
                                    <tr class="align-middle text-center">
                                        <input type="hidden" class="orderId" value="{{ $D->id }}">
                                        <td>{{ $D->id }}</td>
                                        <td>{{ $D->user_name }}</td>
                                        <td>
                                            <a href="{{ route('order#info', $D->order_code) }}"
                                                class="btn btn-ourline-secondary">{{ $D->order_code }}</a>
                                        </td>
                                        <td>{{ $D->total_price }}</td>
                                        <td>{{ $D->created_at->format('d - F - Y') }}</td>
                                        <td class="col-2">
                                            <select class="form-control w-100 statusChange">
                                                <option value="0" @if ($D->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($D->status == 1) selected @endif>
                                                    Success</option>
                                                <option value="2" @if ($D->status == 2) selected @endif>
                                                    Rejected</option>
                                            </select>
                                        </td>
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

@section('AjaxSource')

    <script>
        $(document).ready(function() {

            //order status change
            $('.statusChange').change(function() {

                $parent = $(this).parents('tr');
                $orderId = $parent.find('.orderId').val();

                $currentStatus = $(this).val();

                $data = {
                    'currentStatus': $currentStatus,
                    'orderId': $orderId
                };

                $.ajax({
                    type: 'get',
                    url: '/order/change/status',
                    data: $data,
                    dataType: 'json',
                })
            })

        })
    </script>

@endsection
