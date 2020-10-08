@extends('layouts.master')

@section('content')

<div class="row justify-content-center">
  <div class="col-md-12">
        <div class="card text-center shadow">
          <div class="card-header">
            <h2>{{ $post->title }}</h2>
          </div>
          <div class="card-body text-left">
            <p class="card-text">{{$post->body}}</p>
            <p>Manual FileName:  {{$post->cover_Image}}</p>
            <small>Wrtten on {{$post->created_at}} by {{$post->user->name}}</small>
          </div>
          <div class="card-footer text-muted text-left">
            <a href="/posts" class="btn btn-dark btn-sm">Back</a>
            <a href="{{route('post.download', $post->id)}}"><button type="button" class="btn btn-dark  float-right btn-sm" style="margin-left: 10px;">Download</button></a>
            <a href="{{URL::asset('/storage/app/public/cover_images/'.$post->cover_Image)}}" target="_blank"><button type="button" class="btn btn-sm btn-dark float-right">View Pdf</button></a>
          </div>
        </div>
        <div class="container" style="margin: 10px;"> 
          @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
                <form action="{{route('post.delete', array("id" => $post->id))}}" method="POST">
                    @csrf 
                    {{-- {{method_field('DELETE')}} --}}
                    <button type="submit" class="btn btn-dark float-right btn-sm" style="margin-left: 10px;">Delete</button>
                </form>
                <a href="/posts/{{$post->id}}/edit" class="btn btn-dark float-right btn-sm">Edit</a>
            @endif
          @endif
      </div>
  </div>
</div>







    {{-- <h1>{{ $post->title }}</h1>
    <div>
        {{$post->body}}
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$post->cover_Image}}</td>
            <td><a href="{{URL::asset('/storage/app/public/cover_images/'.$post->cover_Image)}}" target="_blank"><button type="button" class="btn btn-primary float-right">View</button></a></td>
            <td><a href="{{route('post.download', $post->id)}}"><button type="button" class="btn btn-primary  float-right">Download</button></a></td>
          </tr>
        </tbody>
      </table>
    <small>Wrtten on {{$post->created_at}} by {{$post->user->name}}</small>
    <br>
    <hr>
    <a href="/posts" class="btn btn-primary">Back</a>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
            <form action="{{route('post.delete', array("id" => $post->id))}}" method="POST" class="float-left">
                @csrf --}}
                {{-- {{method_field('DELETE')}} --}}
                {{-- <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif
    @endif --}}
@endsection