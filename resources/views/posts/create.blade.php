@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="card-header bg-dark text-white">{{ __('Create Post')}}</div>
    
                    <div class="card-body ">
                        <form method="POST" action="{{route('posts.create')}}"  enctype="multipart/form-data">
                                @csrf
                                {{-- For Title --}}
                                <div class="form-group row">
                                    <label for="title" class="col-md-2 col-form-label text-md-right">Title</label>
        
                                    <div class="col-md-10">
                                        <input id="title" type="text" class="shadow-none form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" autofocus>
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- End For Title --}}
    

                                {{-- For body --}}
                                <div class="form-group row">
                                    <label for="body" class="col-md-2 col-form-label text-md-right">Body</label>
        
                                    <div class="col-md-10">
                                        {{-- <input type="text" class="form-control"> --}}
                                        <textarea class="shadow-none form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                                {{-- End For body --}}

                                {{-- File Upload --}}
                                <div class="form-group row">
                                    <label for="body" class="col-md-2 col-form-label text-md-right">File Upload</label>
        
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <div class="custom-file">
                                            <input type="file" class="shadow-none custom-file-input " id="cover_Image" aria-describedby="inputGroupFileAddon01" name="cover_Image">
                                            <label class="custom-file-label" for="cover_Image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End File Upload --}}
                                <div class=" ">
                                    <button type="submit" class="btn btn-dark btn-lg btn-block">Submit</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection