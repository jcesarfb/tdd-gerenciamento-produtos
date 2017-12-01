@extends('layouts.app')
@section('content')
        <br>
        <div class="col-md-12">
            <div class="content">
                <div class="title m-b-md">
                    Login
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8">
                    <form class="form-horizontal " role="form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 control-label m-b-md">E-mail</label>
                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 control-label m-b-md">Senha</label>
                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6" align="right">
                                <div class="checkbox">
                                    <label class="control-label m-b-md">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar de mim
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" align="center">
                            <div class="col-md-6 col-xs-6">
                                <button href="{{ route('password.request') }}" class="btn button-password">
                                 Esqueci a senha
                                </button>
                            </div>
                            <div class="col-md-6 col-xs-6" align="right">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
