@extends('layouts.app')

@section('content')
<div class="unit-5 overlay" style="background-image: url('images/img-2.jpg'); z-index: 1;">
    <div class="container text-center">
        <h2 class="mb-0">Users</h2>
        
    </div>
</div>
<div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3" style="padding-top: 7em; padding-bottom: 7em;">
    <div class="card border-primary">
        <div class="card-header bg-primary" style="color: #fff">User Details
        </div>
        <div class="card-body">
            <div class="form-group row">
                <b for="user-role" class="col-md-4 col-form-label ">Username</b>
                <span class="col-md-4 col-form-label" >{{ $user->name }}</span>
            </div>
            <div class="form-group row">
                <b for="user-role" class="col-md-4 col-form-label ">First Name</b>
                <span class="col-md-4 col-form-label" >{{ $user->first_name }}</span>
            </div>
            <div class="form-group row">
                <b for="user-role" class="col-md-4 col-form-label ">Last Name</b>
                <span class="col-md-4 col-form-label" >{{ $user->last_name }}</span>
            </div>
            <div class="form-group row">
                <b for="user-role" class="col-md-4 col-form-label ">Role</b>
                <span class="col-md-4 col-form-label" >{{ $role->name }}</span>
            </div>
            @if( ($user->email === 'test@test.com') && (Auth::user()->email !== $user->email) )
                @else
                <div class="form-group row">
                    <b for="user-role" class="col-md-4 col-form-label ">E-Mail Address</b>
                    <span class="col-md-4 col-form-label" >{{ $user->email }}</span>
                </div>
            @endif        
            @if( Auth::user()->role_id === 1 || Auth::user()->id === $user->id )
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <input type="button" onclick="location.href='/users/{{$user->id}}/edit'" class="btn btn-primary" value="Edit Details" />
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection