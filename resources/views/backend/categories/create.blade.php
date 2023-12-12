
@extends('backend.master')

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header">
             Create FORM
        </div>
        <div class="card-body p-3">

          <form action="{{ route('categories.store')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <label>Name</label>
            <input type="text" name="name"  value="{{ old('name') }}"  class="form-control"/>

            @error('name')
                <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

            <label>Image</label>
            <input type="file" name="image" accept="image/*" value="{{ old('image') }}"  class="form-control"/>

            <label class="form-label">Description</label>
            <textarea  id="editor" type="text" name="description" class="form-control"> {!! old('description') !!}
            </textarea>

            @error('description')
            <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

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
