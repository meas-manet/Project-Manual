@extends('layouts.master')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')

    <div class="container d-flex justify-content-center">
    <div class="noscroll">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <img src="/img/Frontpage.svg" class="img-fluid" alt="Max-width 100%">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-dark">Manuals Online</h5>
                    <p class="text-dark">Thousands of free manuals. An engaged and helpful community. &nbsp;<a href="{{ url('/posts') }}"><button type="button" class="btn btn btn-dark btn-sm">See Posts</button></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
    
<script type="text/javascript">
    document.title = `Welcome`;
</script>