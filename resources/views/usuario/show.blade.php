@extends('layouts.interno-edit')
<style type="text/css">
    .footer{
        position: absolute;
    }
</style>
@section('content')
@if (Route::has('login'))
         @if (Auth::check())
            @if((Auth::user()->tipo) ==1)
        <div class="col-md-12">
            <div class="content">
                <div class="title m-b-md">
                    Seus Dados
                </div>
            </div>
        </div>
            @if (Route::has('login'))
                    @if (Auth::check())
                    <div class="col-md-12" align="center">
                        <div class="form-group">
                        <table class="table table-condensed color-input">
                            <thead>
                              <tr>
                                <th style="font-size: 18px;">Nome:</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="font-size: 20px;">
                              <strong>{{$usuario->name}}</strong></td>
                              </tr>
                            </tbody>
                        </table>
                        <table class="table table-condensed color-input">
                            <thead>
                              <tr>
                                <th style="font-size: 18px;">E-mail:</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="font-size: 20px;">
                                 <strong>{{$usuario->email}}</strong></td>
                              </tr>
                            </tbody>
                        </table>
                        <table class="table table-condensed color-input">
                            <thead>
                              <tr>
                                <th style="font-size: 18px;">Tipo:</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="font-size: 20px;">
                                 @if(($usuario->tipo) == 1)
                                    <strong>Usuário</strong>
                                    @else
                                    <strong>Clínica</strong>
                                   @endif
                                   </td>
                              </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                        <div class="col-md-12" align="center">
                            <a href="{{ url('/home') }}"><button type="submit" class="btn btn-primary">Voltar</button></a> 
                            <br><br>
                        </div>  
            @endif  
            @endif

            
        @else
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Registrar</a>
        @endif
    @endif

@endif     

@endsection
