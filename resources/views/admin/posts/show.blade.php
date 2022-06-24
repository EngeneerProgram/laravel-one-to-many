@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <img src="{{$post->img}}" alt="{{$post->title}}">
        </div>

        <div class="col">
            <h1>{{$post->title}}</h1>
            <p>{{$post->description}}</p>
        </div>
    </div>
</div>

@endsection