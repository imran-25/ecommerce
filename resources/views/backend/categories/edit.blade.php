
@extends('backend.master')

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header">
             EDIT FORM
        </div>
        <div class="card-body p-3">

          <form action="{{ route('categories.update', ['category' => $category->id])}}" method="POST">

            @csrf
            @method('patch')

            <label>Name</label>
            <input type="text" name="name"  value="{{ $category->name}}" class="form-control"/>
            @error('name')
                <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

            <label>Description</label>
            <textarea  id="editor" type="text" name="description"  class="form-control">
              {!! $category->description !!}
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
