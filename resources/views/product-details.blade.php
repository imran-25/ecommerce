@extends('frontend.layouts.master')

@section('content')

<div class="row mt-4">
    <div class="col-md-4">
        <img src="{{ asset('storage/products/'.$product->image) }}" height="400" alt="{{ $product->name }}">
    </div>
    <div class="col-md-8">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->price }}</p>
        <p>{!! $product->description !!}</p>

        <form action="{{ route('cart.store') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}"/>
            <label>Qty:</label><input type="number" name="qty">
            <button type="submit"  class="btn btn-sm btn-primary">Add to Cart</button>
        <form>
    </div>
</div>

@endsection
