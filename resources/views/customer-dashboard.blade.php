@extends('frontend.layouts.master')

@section('content')

<div class="row mt-4">
   {{ auth()->user()->name }}
</div>

@endsection
