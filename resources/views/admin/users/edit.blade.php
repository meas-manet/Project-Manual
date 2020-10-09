@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-white">{{ __('Edit user')}}</div>

                <div class="card-body">
                    <form action="{{route('admin.users.update', $user)}}" method="POST">

                        {{-- For Email --}}
                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="shadow-none form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- End For Email --}}


                        {{-- For Name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="shadow-none form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- End For Name --}}


                        {{-- For Roles --}}
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group row">
                            <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                            <div class="col-md-10">
                                @foreach($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                    @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                    <label>{{$role->name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- End Roles --}}


                        {{-- For Banned/UnBanned --}}
                        <div class="form-group row">
                            <label for="bans" class="col-md-2 col-form-label text-md-right">Ban Status</label>
                            <div class="col-md-10">
                                <select name="isban" class="form-control">
                                    <option value="">-- Select BAN / UNBAN --</option>
                                    <option value="0">UNBAN</option>
                                    <option value="1">BAN</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark btn-lg btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    
<script type="text/javascript">
    document.title = `Edit User`;
</script>