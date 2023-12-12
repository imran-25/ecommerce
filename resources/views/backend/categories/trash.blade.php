@extends('backend.master')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="container">
        <div class="card shadow">

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
                            <td>
                                {{ count($category->products)}}

                            </td>
                            <td>
                                <form action="{{ route('categories.restore', ['id' => $category->id])}}" method="POST" style="display: inline">
                                    @csrf
                                    @method('patch')
                                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Are you sure want to restore?')">Restore</button>
                                </form>

                                <form action="{{ route('categories.delete', ['id' => $category->id])}}" method="POST" style="display: inline">
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
