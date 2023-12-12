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
                        <form  action="{{ route('categories.index')}}"  method="GET">
                            <input type="text" name="cat_name" />
                            <button type="submit">Search Category</button>
                        </form>
                    </div>
                    <div class="col-6">
                        Category List
                        <a  href="{{ route('categories.create')}}" class="btn btn-sm btn-success">Add New Category</a>

                        <a class="btn btn-sm btn-primary" href="{{ route('category.report')}}">Download <i class="fa-regular fa-file-pdf"></i></a>
                        <a class="btn btn-sm btn-info" href="{{ route('category.excel_report')}}"> Download <i class="fa-regular fa-file-excel"></i></a>
                    </div>
                </div>



            </div>




            <div class="card-body p-3">
                <table class="table table-sm table-bordered ">
                    <tr>
                        <th class="text-center">Ser No</th>
                        <th class="text-center">Name</th>
                        <th>Products</th>
                        <th class="text-center">Actions</th>
                    </tr>
                   <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center">{{ ++$serNo }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>
                                <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="btn btn-sm btn-info">Show</a>
                                <a  href="{{ route('categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', ['category' => $category->id])}}" method="POST" style="display: inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>

                {{ $categories->links('pagination::bootstrap-4') }}

            </div>
        </div>
    </div>
@endsection
