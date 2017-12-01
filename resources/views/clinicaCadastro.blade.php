@extends('layouts.interno-edit')
@section('content')
@if (Route::has('login'))
         @if (Auth::check())
            @if((Auth::user()->tipo) ==0)

<div class="col-md-12">
    <div class="content">
        <div class="title m-b-md">
            Cadastro da Clínica
        </div>
    </div>
</div>
@if(($clinica) != '')
    {{ Form::model($clinica, array('route' => array('clinica.update', $clinica->id), 'method' => 'PUT')) }}
@else
    <div class="col-md-12"> 
    <form action="/clinica" method="POST">
    @endif
     {{ csrf_field() }}
        <div class="col-md-12">
            <div class="form-group">
                <label for="administrador">Administrador</label>
                <input type="text" readonly class="form-control" id="nome" value="{{$usuario->name}}" name="nome">
            </div>  
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="nome_fantasia">Nome Fantasia</label>
                @if(($clinica) != '')
                <input type="text" class="form-control" id="fantasia" name="fantasia" value="{{$clinica->fantasia}}">

                @else
                <input type="text" class="form-control" id="fantasia" name="fantasia" placeholder="Nome Fantasia">
               @endif
            </div>  
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="razao_social">Razão Social</label>

                @if(($clinica) == '')
                <input type="text" class="form-control required" id="razao_social" name="razao_social">

                @else
                <input type="text" class="form-control required" id="razao_social" name="razao_social" value="{{$clinica->razao_social}}">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                @if(($clinica) == '')
                <input type="text" onkeyup="FormataCnpj(this,event)" onblur="if(!validarCNPJ(this.value)){swal({text: 'CNPJ inválido!',icon: 'error',button: 'Voltar',}); this.value='';}" maxlength="18"  class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ">

                @else
                <input type="text" onkeyup="FormataCnpj(this,event)" onblur="if(!validarCNPJ(this.value)){swal({text: 'CNPJ inválido!',icon: 'error',button: 'Voltar',}); this.value='';}" class="form-control" id="cnpj" name="cnpj" value="{{$clinica->cnpj}}">
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="cep">CEP</label>
                @if(($clinica) == '')
                <input type="text" class="form-control" id="cep" name="cep">
                @else
                <input type="text" class="form-control" id="cep" name="cep" value="{{$clinica->cep}}">
                @endif
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <a onclick="buscarCEP()" class="btn btn-primary button-cel">Buscar</a>               
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="endereco">Endereço</label>
                @if(($clinica) == '')
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço">

                @else
                <input type="text" class="form-control" id="endereco" name="endereco" value="{{$clinica->endereco}}">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="numero">Número</label>
                @if(($clinica) != '')
                <input type="text" class="form-control" id="numero" name="numero" value="{{$clinica->numero}}">

                @else
                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="bairro">Bairro</label>
                @if(($clinica) != '')
                <input type="text" class="form-control" id="bairro" name="bairro" value="{{$clinica->bairro}}">

                @else
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cidade">Cidade</label>
                @if(($clinica) == '')
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">

                @else
                <input type="text" class="form-control" id="cidade" name="cidade" value="{{$clinica->cidade}}">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="estado">Estado</label>
                @if(($clinica) == '')
                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">

                @else
                <input type="text" class="form-control" id="estado" name="estado" value="{{$clinica->estado}}">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="transporte">Transporte</label><br>
                @if(($clinica) == '')
                <input type="radio" id="transporte" name="transporte" value="0">Não
                <input type="radio" id="transporte" name="transporte" value="1">Sim
                @else
                    @if(($clinica->transporte) == 0)
                    <input type="radio" id="transporte" name="transporte" value="0" checked>Não
                    <input type="radio" id="transporte" name="transporte" value="1">Sim
                    @else(($clinica->transporte) == 1)
                    <input type="radio" id="transporte" name="transporte" value="0">Não
                    <input type="radio" id="transporte" name="transporte" value="1" checked>Sim
                    @endif
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="especialidades">Especialidades</label>
                @if(($clinica) == '')
                <textarea class="form-control" rows="5" cols="50" id="especialidade" name="especialidade" placeholder="Especialidade"></textarea>

                @else
                <textarea class="form-control" rows="5" cols="50" id="especialidade" name="especialidade" value="{{$clinica->especialidade}}">{{$clinica->especialidade}}</textarea>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="tratamento">Tratamento</label>
                @if(($clinica) == '')
                <textarea class="form-control" rows="5" cols="50" id="tratamento" name="tratamento"></textarea>

                @else
                <textarea class="form-control" rows="5" cols="50" id="tratamento" name="tratamento" value="{{$clinica->tratamento}}">{{$clinica->tratamento}}</textarea>
                @endif
            </div>
        </div>
        <div class="col-md-6 col-xs-8">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
    <div class="col-md-6 col-xs-1" align="right">
            <div class="form-group">
                <a href="{{ url('/home') }}"><button type="submit" class="btn btn-primary">Voltar</button></a>
            </div>       
        </div>
    </div>
</div>    
@else
<a href="{{ url('/login') }}">Login</a>
<a href="{{ url('/register') }}">Registrar</a>
@endif
    @endif

@endif     
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
function FormataCnpj(campo, teclapres)
            {
                var tecla = teclapres.keyCode;
                var vr = new String(campo.value);
                vr = vr.replace(".", "");
                vr = vr.replace("/", "");
                vr = vr.replace("-", "");
                tam = vr.length + 1;
                if (tecla != 14)
                {
                    if (tam == 3)
                        campo.value = vr.substr(0, 2) + '.';
                    if (tam == 6)
                        campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 5) + '.';
                    if (tam == 10)
                        campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/';
                    if (tam == 15)
                        campo.value = vr.substr(0, 2) + '.' + vr.substr(2, 3) + '.' + vr.substr(6, 3) + '/' + vr.substr(9, 4) + '-' + vr.substr(13, 2);
                }
            }
function validarCNPJ(cnpj) {
 
    cnpj = cnpj.replace(/[^\d]+/g,'');
 
    if(cnpj == '') return false;
     
    if (cnpj.length != 14)
        return false;
 
    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" || 
        cnpj == "11111111111111" || 
        cnpj == "22222222222222" || 
        cnpj == "33333333333333" || 
        cnpj == "44444444444444" || 
        cnpj == "55555555555555" || 
        cnpj == "66666666666666" || 
        cnpj == "77777777777777" || 
        cnpj == "88888888888888" || 
        cnpj == "99999999999999")
        return false;
         
    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;
         
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
          return false;
           
    return true;
    
}


 function buscarCEP(){
    var cep =  $("#cep").val().replace(/[^\d]+/g,'');
    
     //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco").val("...");
                $("#cidade").val("...");
                $("#bairro").val("...");
                $("#uf").val("...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco").val(dados.logradouro);
                        $("#cidade").val(dados.localidade);
                        $("#bairro").val(dados.bairro);
                        $("#estado").val(dados.uf);
                      } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        swal({text: 'CNPJ inválido!',icon: 'error',button: 'Voltar',});
                    }
                });
            }
        } else{
            swal({text: 'CNPJ inválido!',icon: 'error',button: 'Voltar',});
        }        
} 
</script>
@endsection