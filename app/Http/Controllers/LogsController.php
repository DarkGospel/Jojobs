<?php

namespace App\Http\Controllers;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    //devuelve la vista del listado logs
    public function index()
    {
        $usuario = \Auth::user()->name;
        $rol = \Auth::user()->rol;
        DB::select('call logs("'.$usuario.'", "Listar", "'.$rol.'")');
        $logs= Log::paginate(8);//8 indica el numero de elementos por pagina        
        return view('logs', [
            'logs' => $logs
        ]);
    }
    //generar pdf del listado de los procedimientos almacenados
    public function pdf(){
        $logs = Log::all();
        $pdf = PDF::loadView('pdflogs', compact('logs'));
        return $pdf->download('listado.pdf');
    }
}
