@extends('auth._authLayout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal auth-form" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}

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

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                </div>

                <div class="form-group text-center">
                    <small><a href="{{ url('/password/reset') }}">Forgot your password ?</a></small>
                    | <small><a href="{{ url('/register') }}">Create an account</a></small>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
