@extends('layouts.master')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
              <div class="card text-center shadow">
                <div class="card-header">
                    <div class="container">
                        <h1>{{ $user->name }}</h1>
                    </div>
                </div>
                <div class="card-body text-left">
                  <h4 class="card-text">Name: &nbsp; {{ $user->name }}</h4>
                  <h4 class="card-text">Email: &nbsp; {{ $user->email }}</h4>
                  <h4 class="card-text">Role: &nbsp; {{ implode(',', $user->roles()->get()->pluck('name')->toArray())}}</h4>
                  <h4 class="card-text">Status: 
                    @if($user->isban == '0')
                        <label class="badge badge-info text-light">Not Banned</label>
                    @elseif($user->isban == '1')  
                        <label class="badge badge-danger text-dark">Banned</label>  
                    @endif
                  </h4>
                </div>
                <div class="card-footer text-muted text-left">
                  <a href="/home" class="btn btn-dark btn-sm">Back</a>
                </div>
              </div>
        </div>
      </div>
@endsection

<script type="text/javascript">
    document.title = `{{$user['name']}}'s Profile`;
</script>