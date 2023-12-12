@extends('frontend.layouts.master')

@section('content')
<h2 class="text-center mt-3">Featured Products</h2>
<p class="text-center">Get Your Desired Products!</p>

<div class="row mt-4">
    @foreach ($products as $product)
    <div class="col-md-3 mb-2">
        <div class="card" >
            <img src="{{ asset('storage/products/'.$product->image) }}" height="300" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{!! $product->price !!}</p>
            </div>

            <div class="card-body">
                <a href="{{ route('product.details', $product->slug) }}" class="card-link">Details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
