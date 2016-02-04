@extends('auth._authLayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal auth-form" role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}
                
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <svg class="icon icon-profile-male">
                                <use xlink:href="/svg/sprites.svg#profile-male"></use>
                            </svg>
                        </span>
                        <input type="text" class="form-control form-control-lg" name="name" value="{{ old('name') }}" placeholder="Name..">
                    </div>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <svg class="icon icon-envelope">
                                <use xlink:href="/svg/sprites.svg#envelope"></use>
                            </svg>
                        </span>
                        <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="Email..">
                    </div>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <svg class="icon icon-key">
                                <use xlink:href="/svg/sprites.svg#key"></use>
                            </svg>
                        </span>
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password..">
                    </div>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <svg class="icon icon-key">
                                <use xlink:href="/svg/sprites.svg#key"></use>
                            </svg>
                        </span>
                        <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm password..">
                    </div>

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Register">
                </div>

                <div class="form-group text-center">
                    <small><a href="{{ url('/login') }}">Already have an account ?</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
