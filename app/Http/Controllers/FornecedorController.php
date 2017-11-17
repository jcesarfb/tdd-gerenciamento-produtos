<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{

    public function index()
    {
        $fornecedores = Fornecedor::orderBy('created_at', 'desc')->paginate(10);
        return view('Fornecedores.index',['Fornecedores' => $Fornecedores]);
    }
  
    public function create()
    {
        return view('Fornecedores.create');
    }
  
    public function store(FornecedorRequest $request)
    {
        $fornecedor = new Fornecedor;
        $fornecedor->nome        = $request->nome;
        $fornecedor->endereco	 = $request->endereco;
        $fornecedor->cnpj		 = $request->cnpj;
        $fornecedor->save();
        return redirect()->route('Fornecedores.index')->with('message', 'Fornecedor created successfully!');
    }
  
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('Fornecedores.edit',compact('Fornecedor'));
    }
  
    public function update(FornecedorRequest $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->nome        = $request->nome;
        $fornecedor->endereco	 = $request->endereco;
        $fornecedor->cnpj		 = $request->cnpj;
        $fornecedor->save();
        return redirect()->route('Fornecedores.index')->with('message', 'Fornecedor updated successfully!');
    }
  
    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect()->route('Fornecedores.index')->with('alert-success','Fornecedor hasbeen deleted!');
    }
}
}

}
