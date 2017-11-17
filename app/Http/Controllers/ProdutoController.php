<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $products = Produto::orderBy('created_at', 'desc')->paginate(10);
        return view('produtos.index',['produtos' => $produtos]);
    }
  
    public function create()
    {
        return view('produtos.create');
    }
  
    public function store(ProdutoRequest $request)
    {
        $produto = new Produto;
        $produto->nome        = $request->nome;
        $produto->descricao	  = $request->descricao;
        $produto->quantidade  = $request->quantidade;
        $produto->custo       = $request->custo;
        $produto->save();
        return redirect()->route('produtos.index')->with('message', 'Produtos criados com sucesso!');
    }
  
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit',compact('produto'));
    }
  
    public function update(ProdutoRequest $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->nome        = $request->nome;
        $produto->descricao   = $request->descricao;
        $produto->quantidade  = $request->quantidade;
        $produto->custo       = $request->custo;
        $produto->save();
        return redirect()->route('produtos.index')->with('message', 'Produto atualizado com sucesso!');
    }
  
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return redirect()->route('produtos.index')->with('alert-success','Product hasbeen deleted!');
    }
}
}
