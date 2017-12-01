<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Clinica;
use App\User;
use DB;
use Session;
use Auth;
class ClinicasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clinicaCadastro');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clinicaCadastro');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth()->id();
        $nome = Auth::user()->name;
        $clinica = new Clinica;
        $clinica->id            = $id;
        $clinica->nome          = $nome;
        $clinica->fantasia      = $request->fantasia;
        $clinica->razao_social  = $request->razao_social;
        $clinica->cnpj          = $request->cnpj;
        $clinica->cep           = $request->cep;
        $clinica->endereco      = $request->endereco;
        $clinica->numero        = $request->numero;
        $clinica->bairro        = $request->bairro;
        $clinica->cidade        = $request->cidade;
        $clinica->estado        = $request->estado;
        $clinica->transporte    = $request->transporte;
        $clinica->especialidade = $request->especialidade;
        $clinica->tratamento   = $request->tratamento;
        $clinica->save();
        return view('home');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clinica = Clinica::find($id);
        return view('clinicaView', ['clinica' => $clinica]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clinica = Clinica::find($id);
        $usuario = User::find($id);
        return view('clinicaCadastro', [
            'clinica' => $clinica, 
            'usuario' => $usuario
        ]);
    }
    public function find()
    {
        $clinica = Clinica::all();
        $cont = $clinica->count();
        return view('search', ['clinica' => $clinica,'cont'=> $cont]);
     
    }
    function mapa()
    {
        $clinica = Clinica::all();
        
        foreach ($clinica as $cli){                           
            $cep[] = $cli->cep;
            $name[] = $cli->fantasia;
            $funcao[] = 'maps('.$cli->cep.',"'.$cli->fantasia.'");';
        }
        
        return response()->json($cep);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clinica = Clinica::find($id);
        $clinica->nome          = $request->nome;
        $clinica->fantasia      = $request->fantasia;
        $clinica->razao_social  = $request->razao_social;
        $clinica->cnpj          = $request->cnpj;
        $clinica->cep          = $request->cep;
        $clinica->endereco      = $request->endereco;
        $clinica->numero        = $request->numero;
        $clinica->bairro        = $request->bairro;
        $clinica->cidade        = $request->cidade;
        $clinica->estado        = $request->estado;
        $clinica->transporte    = $request->transporte;
        $clinica->especialidade = $request->especialidade;
        $clinica->tratamento   = $request->tratamento;
        $clinica->save();
        return view('clinicaView', ['clinica' => $clinica]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clinica = Clinica::find($id);
        $user = User::find($id);
        $user->delete();
        $clinica->delete();
        return redirect('base');
    }
}