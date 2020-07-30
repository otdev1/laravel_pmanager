@extends('layouts.app')

@section('content')
<div class="unit-5 overlay" style="background-image: url('images/img-2.jpg'); z-index: 1;">
    <div class="container text-center">
        <h2 class="mb-0">Reset Password</h2>
    </div>
</div>

<div class="col-md-6 col-lg-6 offset-md-3 offset-lg-3" style="padding-top: 7em; padding-bottom: 7em;">
    <div class="card border-primary">
        <div class="card-header bg-primary" style="color: rgb(255, 255, 255);">
            Reset Password
        </div>
        <div class="card-body">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }} 
            </div>
            @endif
            <form method="POST" action="{{ route('changepassword', $user_id) }}"> 
                @csrf
                <div class="form-group row {{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-md-4 control-label">Current Password</label>
                    <div class="col-md-6">
                        <input id="current-password" type="password" class="form-control" name="current-password" required>
                        @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-md-4 control-label">New Password</label>
                    <div class="col-md-6">
                        <input id="new-password" type="password" class="form-control" name="new-password" required>
                        @if ($errors->has('new-password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new-password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                    <div class="col-md-6">
                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                    </div>
                </div>
                @if( Auth::user()->id === 4 )
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <a class="btn btn-secondary" style="cursor: auto;">
                            {{ __('Change Password') }}
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>  
</div>
@endsection
