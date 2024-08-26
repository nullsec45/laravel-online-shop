@extends('layouts.dashboard')

@section('title')
    Users Dashboard
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Users</h2>
            <p class="dashboard-subtitle">
                Update User
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div> 
                    @endif
                    <div class="card">
                        <div class="card-body">
                           <form action="{{route('admin.users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                                @method("PUT")
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name_user">Name User</label>
                                            <input type="text" name="name" class="form-control" id="name_user" value="{{$user->name}}" required>
                                        </div>
                                    </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email_users">Email User</label>
                                            <input type="email" id="email_users" name="email" class="form-control" value="{{$user->email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password_user">Password User</label>
                                            <input type="password" id="password_user" name="password" class="form-control">
                                            <small>*Kosongkan jika tidak ingin mengganti password</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="roles">Roles</label>
                                            <select name="roles" id="roles" class="form-control">
                                                @foreach ($roles as $role )
                                                    <option value="{{$role['value']}}" {{$user->roles == $role['value'] ? "selected" : ""}}>{{$role["teks"]}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
                                    </div>
                                </div>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection