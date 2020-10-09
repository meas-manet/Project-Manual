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
            @if ($post->cover_Image === 'noimage.jpg')
                
            @else
              <a href="{{route('post.viewPdf', $post->id)}}" target="_blank"><button type="button" class="btn btn-sm btn-dark float-right">View Pdf</button></a>
            @endif
            
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
@endsection

    
<script type="text/javascript">
  document.title = `{{ $post->title }}`;
</script>