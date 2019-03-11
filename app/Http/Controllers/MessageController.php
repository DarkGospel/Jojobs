<?php

namespace App\Http\Controllers;
use App\mensajes;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function listar(){
        $mensajes = mensajes::paginate(5);
        return view('mensajes.listarmensajes', [
            'mensajes' => $mensajes
        ]);
    }
    
}
