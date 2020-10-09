@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header bg-dark text-white">{{ __('Users') }}</div>

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
                                        <a href="{{route('admin.users.edit' , $user->id)}}"><button type="button" class="btn btn-secondary btn-sm float-left" style="margin-right: 10px;" >Edit</button></a>
                                    @endcan

                                    @can('delete-users')
                                    <form action="{{route('admin.users.destroy', $user)}}" method="POST" class="float-left">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-secondary btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                                <td>
                                    @if($user->isban == '0')
                                        <label class="badge badge-info text-light">Not Banned</label>
                                    @elseif($user->isban == '1')  
                                        <label class="badge badge-danger text-dark">Banned</label>  
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

    
<script type="text/javascript">
    document.title = `User Management`;
</script>