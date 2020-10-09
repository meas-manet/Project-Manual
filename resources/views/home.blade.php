@extends('layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-white">{{ __('Dashboard') }}
                    <a href="/posts/create"><button class="btn btn-secondary btn-sm float-right">Create Posts</button></a>
                </div>
                <br>
                <h3 style="text-align: center" >Your Blog Posts</h3>
                <div class="card-body">
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)

                            <div class="card shadow-sm" style="width: 41rem; margin-bottom: 20px;">
                                <div class="card-body">
                                  <h2 class="card-title">{{$post->title}}</h2>
                                  <p class="card-text">{{$post->body}}</p>
                                </div>
                                <div class="card-footer  bg-light text-dark">
                                    <small>Wrtten on {{$post->created_at}} by {{$post->user->name}}</small>
                                    
                                    <form action="{{route('post.delete', array("id" => $post->id))}}" method="POST" class="float-right" style="margin-left: 10px;">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm" >Delete</button>
                                    </form>
                                    <a href="/posts/{{$post->id}}/edit"><button type="button" class="btn btn-secondary btn-sm float-right" style="margin-left: 10px;">Edit</button></a>
                                    <a href="/posts/{{$post->id}}" class="btn btn-secondary btn-sm float-right">View</a>
                                </div>
                            </div>
                             
                        @endforeach
                    @else
                        <div class="container text-center">
                            <h5>You have no posts</h5>
                        </div>         
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

<script type="text/javascript">
    document.title = `Home`;
</script>
