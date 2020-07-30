@extends('layouts.app')

@section('content')

<div class="unit-5 overlay" style="background-image: url('images/img-2.jpg'); z-index: 1;">
    <div class="container text-center">
        <h2 class="mb-0">Edit Profile</h2>
        
    </div>
</div>

<div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3" style="padding-top: 7em; padding-bottom: 7em;">     
    <div class="card border-primary">
        <div class="card-header bg-primary" style="color: rgb(255, 255, 255);">
            Edit Details
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.update',[$user->id]) }}">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-md-4 col-form-label text-md-right">First Name</label>
                    <div class="col-md-6">
                        <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $user->first_name }}" required autocomplete="fname" autofocus>
                        @error('fname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-md-4 col-form-label text-md-right">Last Name</label>
                    <div class="col-md-6">
                        <input id="lname" type="text" class="form-control @error('fname') is-invalid @enderror" name="lname" value="{{ $user->last_name }}" required autocomplete="lname" autofocus>
                        @error('lname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @if($roles != null) 
                <div class="form-group row">
                    <label for="company-content" class="col-md-4 col-form-label text-md-right">Select Role</label>
                    <select name="role_id" class="form-control col-md-6"> 
                    @foreach($roles as $role)
                        @if ($user->role_id === $role->id ) 
                        <option selected="selected" value="{{$role->id}}" > {{$role->name}} </option>
                        @else
                        <option value="{{$role->id}}"> {{$role->name}} </option>
                        @endif
                    @endforeach
                    </select>
                </div>
                @endif
                @if( ($user->email === 'test@test.com') && (Auth::user()->email !== $user->email) )
                @else
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endif
                <div class="form-group row">             
                    <div class="col-md-6 offset-md-4">                  
                    @if( $user->id != 4 )
                        <a class="btn btn-link" href="/users/changepassword/{{$user->id}}" style="text-decoration: none">
                                {{ __('Reset Password') }}
                        </a>
                    @endif
                    </div>
                </div>
                @if( Auth::user()->id === 4 || $user->id === 4 )
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <a  href="#" class="btn btn-secondary" style="cursor: auto;">
                            {{ __('Update Details') }}
                        </a>       
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <a  href="#" class="btn btn-secondary" style="cursor: auto;">
                            {{ __('Delete Profile') }}
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Details') }}
                        </button>
                    </div>
                </div>
                @endif
            </form>            
            @if( Auth::user()->id !== 4 && $user->id !== 4 )
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <form id="delete-form" action="/users/delete" 
                            method="POST"> 
                                    @csrf 

                                    <input type="hidden" name="uid" value="{{$user->id}}">

                                    <input type="submit"

                                            class="btn btn-primary"

                                            value="Delete Profile"

                                            onclick="
                                            var result = confirm('Are you sure you wish to delete this user?');
                                            if( result ){ 
                                                    this.form.submit();
                                                    }
                                            else{
                                            return false;
                                            }"
                                    />
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection