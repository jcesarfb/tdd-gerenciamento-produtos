<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller {
   public function accessSessionData(Request $request) {
      if($request->session() ->has('name'))
         echo $request->session() ->get('name');
      else
         echo 'No data in the session';
   }
   public function storeSessionData(Request $request) {
      $request->session() ->put('name','Virat Gandhi');
      echo "Data has been added to session";
   }
   public function deleteSessionData() {
      $id = Auth::user()->id;
      echo $id;
   }
}