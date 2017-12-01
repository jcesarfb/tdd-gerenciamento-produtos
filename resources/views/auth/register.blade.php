@extends('layouts.app')
@section('content')
<br>
<div class="col-md-12">
    <div class="content">
        <div class="title m-b-md">
            Cadastro
        </div>
    </div>
</div>
<br>
 <div class="flex-center position-ref full-height">
        <form class="form-horizontal form-login" id="register" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label m-b-md">Nome</label>

            <div class="col-md-4">
                <input id="name" type="text" class="form-control" onkeypress="return txtBoxFormat(event);" minlength="3" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong style="color: #fff;"><?php echo('Insira um nome');?></strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label m-b-md">E-Mail</label>

            <div class="col-md-4">
                <input id="email" type="email" class="form-control required" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color: #fff;"><?php echo "Este endereço de email não é válido"; ?></strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label m-b-md">Senha</label>

            <div class="col-md-4">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: #fff;"><?php echo "A senha deve ter 6 digitos"; ?></strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label m-b-md">Confirmar senha</label>

            <div class="col-md-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
            <label for="tipo" class="col-md-4 col-xs-4 control-label m-b-md">Tipo</label>

            <div class="col-md-4 col-xs-4 color-input m-b-md" align="center">
                <input id="tipo" type="radio" name="tipo" value="0"> Clínica
                <input id="tipo" type="radio" name="tipo" value="1"> Usuário

            @if ($errors->has('tipo'))
                    <span class="help-block">
                        <strong style="color: #fff;"><?php echo "Selecione um tipo"; ?></strong>
                    </span>
                @endif


            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6" align="right">
                <button type="submit" class="btn btn-primary">
                    Cadastrar
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    
    function txtBoxFormat(evtKeyPress) {
        var i, nCount, sValue, fldLen, mskLen,bolMask, sCod, nTecla;

        if(document.all) { // Internet Explorer
            nTecla = evtKeyPress.keyCode;
        } else if(document.layers) { // Nestcape
            nTecla = evtKeyPress.which;
        } else {
            nTecla = evtKeyPress.which;
            if (nTecla == 8) {
                return true;
            }
        }
        if (nTecla != 8)
          return ((nTecla <= 47) || (nTecla >= 58)); 
        else 
          return true;
    }


</script>
@endsection
