
@extends('backend.master')

@section('content')

<div class="container">
    <div class="card shadow">
        <div class="card-header">
             Create FORM
        </div>
        <div class="card-body p-3">

          <form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Select Category</label>
            <select class="form-select" name="category_id">
              <option>Select One</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name ?? ''}}</option>
              @endforeach
            </select>
            @error('category_id')
                <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

            <label>Name</label>
            <input type="text" name="name"  value="{{ old('name') }}"  class="form-control"/>
            @error('name')
                <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

            <label>Price</label>
            <input type="number" name="price"  value="{{ old('price') }}"  class="form-control"/>
            @error('price')
                <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

            <label>Image</label>
            <input type="file" name="image" accept="image/*"/><br/>
            @error('image')
                <span class="text-danger"> {{ $message }}</span>
            @enderror <br>

            <label class="form-label">Description</label>
            <textarea  id="editor" type="text" name="description" class="form-control">
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
