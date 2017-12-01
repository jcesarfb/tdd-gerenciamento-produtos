@extends('layouts.interno-edit')
@section('content')
@if (Route::has('login'))
         @if (Auth::check())
            @if((Auth::user()->tipo) ==1)
<style type="text/css">
    .footer{
        position: absolute;
    }
</style>
<div class="col-md-12">
    <div class="content">
        <div class="title m-b-md">
            Seus Dados
        </div>
    </div>
</div>

    {{ Form::model($usuario, array('route' => array('usuario.update', $usuario->id), 'method' => 'PUT')) }}
    <div class="col-md-6"> 
     {{ csrf_field() }}
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name">Nome</label>
                <input type="text" readonly class="form-control" id="name" value="{{$usuario->name}}" name="name">
            </div>  
        </div>
    </div> 
    <div class="col-md-6"> 
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" >
                <label for="email">E-mail</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}" required>
            </div>  
        </div>
    </div>
        <div class="col-md-12">
            <div class="col-md-6 col-xs-8">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
            <div class="col-md-6 col-xs-1" align="right">
                <div class="form-group">
                <a href="{{ url('/home') }}" class="btn btn-primary">Voltar</a>
            </div>       
        </div>
    </div>
   
@else
<a href="{{ url('/login') }}">Login</a>
<a href="{{ url('/register') }}">Registrar</a>
        @endif
    @endif

@endif     

@endsection