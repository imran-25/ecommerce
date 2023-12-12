
@extends('backend.master')

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header">
             Category Details
        </div>
        <div class="card-body p-3">
            <h1>Title: {{ $category->name }}</h1>
        </div>
    </div>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
	ClassicEditor
		.create( document.querySelector( '#editor' ) )
		.catch( error => {
			console.error( error );
		} );
</script>

@endsection
