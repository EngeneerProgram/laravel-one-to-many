@extends('layouts.admin')


@section('content')
@include('partials.errors')
<h1>Edit {{$post->title}}</h1>
<form action="{{route('admin.posts.update', $post->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="title"><h3>title</h3></label>
      <input type="text"  class="form-control " id="formGroupExampleInput" placeholder="Insert title here" value="{{old('title', $post->title)}}">
    </div>
    <div class="form-group">
      <label for="content"><h3>Description</h3></label>
      <input type="text"  name="description" class="form-control" id="formGroupExampleInput2" placeholder="Description here" value="{{old('description', $post->description)}}">
    </div>

    <div class="form-group">
        <label for="content"><h3>Image</h3></label>
        <input   type="text"  name="img" class="form-control" id="formGroupExampleInput2" placeholder="Insert image" value="{{old('img', $post->img)}}">
    </div>
      <button class="btn btn-primary" type="submit">Edit Post</button>
</form>

@endsection