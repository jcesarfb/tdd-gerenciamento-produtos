foreach($usuarios as $usuario)

    {{ $usuario->nome }} <br/>
    {{ $usuario->email }} <br/>
    {{ $usuario->senha }}<br/>
    {{ $usuario->tipo }}<br/>
    {{ $usuario->acesso }}<br/>
@endforeach