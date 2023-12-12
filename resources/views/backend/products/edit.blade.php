
@extends('backend.master') 

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header">
             EDIT FORM
        </div>
        <div class="card-body p-3">

          <form action="{{ route('product.update', $product->id)}}" method="POST">

            @csrf

            <label>Name</label>
            <input type="text" name="name"  value="{{ $product->name}}" class="form-control"/>
            <label>Description</label>
            <textarea  id="editor" type="text" name="description"  class="form-control">
              {!! $product->description !!}
            </textarea>
            <button type="submit" class="btn btn-sm btn-success mt-4">Save</button>
          </form>



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