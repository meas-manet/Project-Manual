@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ implode(',', $user->roles()->get()->pluck('name')->toArray())}}</td>
                                <td>
                                    @can('edit-users')
                                        <a href="{{route('admin.users.edit' , $user->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                                    @endcan

                                    @can('delete-users')
                                    <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="float-left">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                                <td>
                                    @if($user->isban == '0')
                                        <label class="badge badge-primary">Not Banned</label>
                                    @elseif($user->isban == '1')  
                                        <label class="badge badge-danger">Banned</label>  
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection