@extends('layouts.admin')

@section('content')
@include('partials.errors')
<div class="container pt-5">
    <form action="{{route('admin.posts.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="title"><h3>title</h3></label>
      <input type="text"  name="title" class="form-control " id="formGroupExampleInput" placeholder="Insert title here">
    </div>
    <div class="form-group">
      <label for="content"><h3>Description</h3></label>
      <input type="text"   name="description" class="form-control" id="formGroupExampleInput2" placeholder="Description here">
    </div>

    <div class="form-group">
        <label for="content"><h3>Image</h3></label>
        <input   type="text"  name="img" class="form-control" id="formGroupExampleInput2" placeholder="Insert image">
      </div>
      <button class="btn btn-primary" type="submit">Add Post</button>
</form>
    
</div>

@endsection