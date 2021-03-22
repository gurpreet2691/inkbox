@extends('layout.mainlayout')

@section('content')
{{--    {{dd($orders)}}--}}
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <h1>All Filled Sheets</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">order_id</th>
                        <th scope="col">order_number</th>
                        <th scope="col">customer_id</th>
                        <th scope="col">total_price</th>
                        <th scope="col">fulfillment_status</th>
                        <th scope="col">order_status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order['order_id'] }}</th>
                            <td>{{ $order['order_number'] }}</td>
                            <td>{{ $order['customer_id'] }}</td>
                            <td>{{ $order['total_price'] }}</td>
                            <td>{{ $order['fulfillment_status'] }}</td>
                            <td>{{ $order['order_status'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<b></b>
