foreach($fornecedores as $fornecedor)

    {{ $fornecedor->nome }} <br/>
    {{ $fornecedor->endereco }} <br/>
    {{ $fornecedor->cnpj }}<br/>

@endforeach