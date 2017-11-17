<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->paginate(10);
        return view('usuarios.index',['usuarios' => $usuarios]);
    }
  
    public function create()
    {
        return view('usuarios.create');
    }
  
    public function store(UsuarioRequest $request)
    {
        $usuario = new Usuario;
        $usuario->nome        = $request->nome;
        $usuario->endereco	 = $request->endereco;
        $usuario->cnpj		 = $request->cnpj;
        $usuario->save();
        return redirect()->route('usuarios.index')->with('message', 'Usuario created successfully!');
    }
  
    public function show($id)
    {
        //
    }
  
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit',compact('Usuario'));
    }
  
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->nome        = $request->nome;
        $usuario->endereco	 = $request->endereco;
        $usuario->cnpj		 = $request->cnpj;
        $usuario->save();
        return redirect()->route('usuarios.index')->with('message', 'Usuario updated successfully!');
    }
  
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('alert-success','Usuario hasbeen deleted!');
    }
}
}

}
