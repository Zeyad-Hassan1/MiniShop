@extends('layouts.app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    {{ implode(', ' , $errors->all()) }}
</div>

@endif
<div class="container">
    <h1>Add Product</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input type="text" class="form-control" id="description" name="description" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">image</label>
            <div class="input-group">
            <input type="file" id="imageinput" name="image" accept="image/*" class="form-control" id="inputGroupFile">
            <img id="previewimage"src="" alt="preview" style="max-width: 300px;display:none;">
            <label for="inputGroupFile" class="input-group-text">
                <i class="bi bi-upload"></i>
            </label>
            </div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
<script>
    document.getElementById('imageinput').addEventListener('change' , function(event){
        let file = event.target.files[0];
        if(file) {
            let reader = new FileReader();
            reader.onload = function(e){
                let preview = document.getElementById('previewimage');
                preview.src = e.target.result;
                preview.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
