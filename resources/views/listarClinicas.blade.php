@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
           
                <div class="panel-heading"><h3>Clínicas Cadastradas</h3></div>
                <div class="panel-body">
                    
                <div class="top-right links">
                    
					<div class="col-md-12">
                        <div class="form-group">
                    	
                        @foreach($clinicas as $clinica)
                        <div >
                        <table class="table table-striped">
                            <thead>
	                        <tr>
	                        	<th>Admin</th>
                                <th>Nome Fantasia</th>
                                <th>Endereço</th>
	                        	
	                        </tr>
                            </thead>
                            <tbody>
	                        <tr>
                                <td>{{$clinica->nome}}</td>
	                        	<td>{{$clinica->fantasia}}</td>
                                <td>{{$clinica->endereco}}, {{$clinica->numero}} {{$clinica->bairro}} {{$clinica->cidade}} - {{$clinica->estado}}</td>	                        
	                        </tr>
                            </tbody>
                            </table>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6 col-xs-1" align="right">
                            <div class="form-group">
                                <a href="{{ url('/home') }}"><button type="submit" class="btn btn-primary">Voltar</button></a>
                            </div>       
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
