@extends('layouts.admin')

@section('content')

    <h1>Posts</h1>

    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>User</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Title</th>
            <th>body</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>

        @if($posts)

            @foreach($posts as $post)
          <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->user_id}}</td>
            <td>{{$post->category_id}}</td>
            <td>{{$post->photo_id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForhumans()}}</td>
            <td>{{$post->updated_at->diffForhumans()}}</td>
          </tr>
          @endforeach
        @endif
        </tbody>
      </table>




@endsection
