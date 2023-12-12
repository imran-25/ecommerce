@extends('frontend.layouts.master')

@section('content')

<div class="row mt-4">
    <div class="col-md-12">
        <form action="{{ route('orders.store') }}" method="post">
            @csrf
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Total Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <input type="hidden" name="product_id[]"  value="{{ $item->product->id }}"/>
                        {{ $item->product->name }}
                    </td>
                    <td>{{ $item->product->price }}</td>
                    <td>
                        <input type="number" name="qty[]"  value="{{ $item->qty }}"/>
                    </td>
                    <td>{{ $item->product->price * $item->qty }}</td>
                </tr>
                @endforeach
            </tbody>
        <table>

        <input type="text" name="contact_number" class="form-control p-2" placeholder="Enter your contact number" />
        <label class="form-label mt-2">Shipping Address</label>
        <textarea name="shipping_address" class="form-control"></textarea>
        <button class="btn btn-sm btn-success" type="submit">Place Order</button>
        </form>
    </div>
</div>

@endsection
