@extends('backend.master')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="container">
        <div class="card shadow">
            <div class="card-header">

                <div class="row">
                    <div class="col-6">
                        <form  action="{{ route('products.index')}}"  method="GET">
                            <input type="text" name="cat_name" />
                            <button type="submit">Search product</button>
                        </form>
                    </div>
                    <div class="col-6">
                        Product List
                        <a  href="{{ route('products.create')}}" class="btn btn-sm btn-success">Add New product</a>
                        {{-- <a class="btn btn-sm btn-primary" href="{{ route('product.report')}}">Download <i class="fa-regular fa-file-pdf"></i></a> --}}
                        {{-- <a class="btn btn-sm btn-info" href="{{ route('product.excel_report')}}"> Download <i class="fa-regular fa-file-excel"></i></a> --}}
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <table class="table table-sm table-bordered ">
                    <tr>
                        <th class="text-center">Ser No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Actions</th>
                    </tr>
                   <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center">{{ ++$serNo }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name }}</td>
                            <td><img src="{{ asset('storage/products/'.$product->image) }}" height="100"></td>
                            <td>
                                <button class="btn btn-sm btn-primary">Show</button>
                                <a href="{{ route('product.edit', $product->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>

                {{-- {{ $categories->links('pagination::bootstrap-4') }} --}}

            </div>
        </div>
    </div>
@endsection
