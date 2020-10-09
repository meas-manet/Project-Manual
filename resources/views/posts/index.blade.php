@extends('layouts.master')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-white">{{ __('Posts') }}</div>

                <div class="card-body">
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)

                            <div class="card shadow-sm" style="width: 41rem; margin-bottom: 20px;">
                                <div class="card-body">
                                  <h2 class="card-title">{{$post->title}}</h2>
                                  <p class="card-text">{{$post->body}}</p>
                                </div>
                                <div class="card-footer  bg-light text-dark">
                                    <small>Wrtten on {{$post->created_at}} by </small><i>{{$post->user->name}}</i>
                                    <a href="/posts/{{$post->id}}" class="btn btn-dark float-right">View</a>
                                </div>
                            </div>
                             
                        @endforeach
                    @else
                        <div class="container text-center">
                            <h2>No Post Found !!</h2>
                        </div>         
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

    
<script type="text/javascript">
    document.title = `Post`;
</script>