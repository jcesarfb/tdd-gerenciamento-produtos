<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinica;
use DB;


class SearchController extends Controller
{

    public function busca(Request $request) {
        $search = $request->input('search');
        $query = DB::table('clinicas')->where('fantasia', $search)->get()->count();

        if ($query === 0){
        
            $dados = DB::table('clinicas')->get();

            echo('Não foi possível encontrar nada nos registros');
        
        } elseif ($query > 0){
          
          $dados = DB::table('clinicas')->where('fantasia', $search)->get();
          return view('busca', ['dados' => $dados]);
        }
        return view('busca', ['dados' => $dados]);
    }
    public function index(){
        return view('base');
    }
}

    
