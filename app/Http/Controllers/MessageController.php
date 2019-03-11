<?php

namespace App\Http\Controllers;
use App\mensajes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function listar(){
        $usuario = \Auth::user()->id;
        $mensajes = mensajes::where("id_receptor", $usuario)->paginate(5);
        return view('mensajes.listarmensajes', [
            'mensajes' => $mensajes
        ]);
    }
    
    public function enviar(Request $request){
        $user = \Auth::user();
        $titulo = $request->input('titulo');
        $descripcion = $request->input('descripcion');
        $emisor = $user->name;
        $receptor = $request->input('receptor');
        
        
        DB::table("mensajes")->insert( [
           "emisor" => $emisor,
           "Titulo" => $titulo,
           "Descripcion" => $descripcion,
           "fecha" => date("Y-m-d H:i:s"),
           "id_receptor" => $receptor 
        ]);
        
        return redirect()-> action('MessageController@listar');
    }
    
}
