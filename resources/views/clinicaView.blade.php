@extends('layouts.interno-edit')
<style type="text/css">
    .footer{
        position: absolute;
    }
</style>
@section('content')
@if (Route::has('login'))
         @if (Auth::check())
            @if((Auth::user()->tipo) ==0)
        <div class="col-md-12">
            <div class="content">
                <div class="title m-b-md">
                    Dados da Clínica
                </div>
            </div>
        </div>
            @if (Route::has('login'))
                    @if (Auth::check())
					<div class="col-md-12" align="center">
                        <div class="form-group">
                    	@if(($clinica) != '')
                        <table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Administrador</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						      <strong>{{$clinica->nome}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Nome Fantasia</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	 <strong>{{$clinica->fantasia}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Razão Social</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->razao_social}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">CNPJ</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->cnpj}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">CEP</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->cep}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Endereço</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->endereco}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Número</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->numero}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Bairro</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->bairro}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Cidade</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->cidade}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Estado</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->estado}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Transporte</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        @if(($clinica->transporte)==1)
	                        	<td><strong>Sim</strong></td>
	                        	@else
	                        	<td><strong>Não</strong></td>
	                        	@endif
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Especialidade</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->especialidade}}</strong></td>
						      </tr>
						    </tbody>
						</table>
						<table class="table table-condensed color-input">
						    <thead>
						      <tr>
						        <th style="font-size: 18px;">Tratamentos</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr>
						        <td style="font-size: 20px;">
						     	<strong>{{$clinica->tratamento}}</strong></td>
						      </tr>
						    </tbody>
						</table>
                        </div>
                        </div>
                        <div class="col-md-12" align="center">
                            <a href="{{ url('/home') }}"><button type="submit" class="btn btn-primary">Voltar</button></a> 
                            <br><br>
                        </div>

                        @else
                        <?php
                            $id = Auth::user()->id;
                        ?>
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                    	<a href="{{ url('/clinica/'.$id.'/edit') }}"><button type="submit" class="btn btn-primary">Complete seu cadastro!</button></a>
                                    </div>
                                     <div class="col-md-2">
                                        <a href="{{ url('/home') }}"><button type="submit" class="btn btn-primary button-cel">Voltar</button></a> 
                                    </div>
                                </div>
                            </div>
                        </div>
						@endif   
            @endif  
            @endif

            
        @else
        <a href="{{ url('/login') }}">Login</a>
        <a href="{{ url('/register') }}">Registrar</a>
        @endif
    @endif

@endif     

@endsection
