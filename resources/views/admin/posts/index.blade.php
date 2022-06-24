@extends('layouts.admin')



@section('content')

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
      <td><img width="100px" src="{{$post->img}}" alt=""></td>
      <td>
        <a class="btn btn-primary" href="{{route('admin.posts.show', $post->id)}}">Views</a>
        <a class="btn btn-secondary" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
       
        <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-post-{{$post->id}}">
        Delete
      </button>

          <!-- Modal -->
          <div class="modal fade" id="delete-post-{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Current</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    
                  </button>
                </div>
                <div class="modal-body">
                  Are u sure?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                

                  <form action="{{route('admin.posts.destroy', '$post->id')}}" method="post" >
                    
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Confirm</button>
                  
                  </form>
                </div>
              </div>
            </div>
          </div>
        
        
        
      </td>
    </tr>
    @endforeach
    
    

  </tbody>
</table>
@endsection

