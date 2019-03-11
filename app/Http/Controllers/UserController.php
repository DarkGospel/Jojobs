<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response; //para funcion que devuelve la imagen que tenemos en el disco
use Illuminate\Support\Facades\Storage; //Para las imagenes
use Illuminate\Support\Facades\File; //Para las imagenes
use Barryvdh\DomPDF\Facade as PDF; //Para generar pdf
use Illuminate\Support\Facades\DB; //Para poder hacer la llamada al procedimiento log

class UserController extends Controller
{
    //Verifica que esta logeado
    public function __construct(){
        $this->middleware('auth');
    }
    //devuelve la pagina perfil
    public function perfil($id){
        $user = User::find($id);
        /*var_dump($user->name);
        die();*/
        return view('user.perfil', [
            'user' => $user
        ]);
    }
    //devuelve la vista del curriculum
    public function cv(){
        return view('curriculum.curriculum');
    }
    //devuelve la vista config que es para actualizar info
    public function config($id){
        $user = User::find($id);
        return view('user.config', [
            'user' => $user
        ]);
    }
    //devuelve segun el rol del usuario logueado la lista de una manera o de otra
    public function listar(){
        $user = \Auth::user();
        $usuario = \Auth::user()->rol;
        DB::select('call logs("'.$user->name.'", "Listar", "'.$usuario.'")');
        if($user->rol != "Administrador"){
            $users = User::where('activo', '1')->paginate(5);
        }else if($user->rol == "Administrador"){
            $users = User::paginate(5);
        }
        return view('user.listar', [
            'users' => $users
        ]);
    }
    //devuelve la vista de todos lo usuarios que quieren registrarse
    //si quiero dar de baja lo hago desde el listado
    public function solicitudes(){
        $users = User::where("activo", "0")->paginate(5);
        return view('user.solicitudes', [
            'users' => $users
        ]);
    }
    //elimina el usuario 
    //@id es el id del usuario clicado en el listado
    //redirige de nuevo al listado con el mensaje oportuno
    public function eliminar($id){
        $user = User::find($id);
        $user -> delete();
        $usuario = \Auth::user()->name;
        DB::select('call logs("'.$usuario.'", "Eliminar", "Administrador")');
        return redirect()->route('listar')
                         ->with(['message'=>'Usuario eliminado correctament ya no vale arrepentirse']);
    }
    //activa/da de alta al usuario 
    //@id es el id del usuario clicado en el listado
    //redirige de nuevo al listado con el mensaje oportuno
    public function activar($id){
        $user = User::find($id);
        $user->activo = 1;
        $user->update();
        $usuario = \Auth::user()->name;
        DB::select('call logs("'.$usuario.'", "Activó usuario", "Administrador")');
        return redirect()->route('listar')
                         ->with(['message'=>'Ya puede entrar este usuario ¡CUIDADO!']);
    }
    //desactiva/da de baja al usuario 
    //@id es el id del usuario clicado en el listado
    //redirige de nuevo al listado con el mensaje oportuno
    public function desactivar($id){
        $user = User::find($id);
        $user->activo = 0;
        $user->update();
        $usuario = \Auth::user()->name;
        DB::select('call logs("'.$usuario.'", "Desactivó usuario", "Administrador")');
        return redirect()->route('listar')
                         ->with(['message'=>'Se le acabo la tonteria juajuajua']);
    }
    //recoge los datos de la vista config
    //y actualiza los datos en la base de datos
    public function update(Request $request){
        //conseguir usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        
        //validacion del usuario
        $validate = $this->validate($request, [
            'name'=>'required|string|max:255',
            'surname1' =>'required|string|max:255',
            'surname2' =>'string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        //recoger datos del usuario
        $name = $request->input('name');
        $surname1 = $request->input('surname1');
        $surname2 = $request->input('surname2');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        //asignar valores a usuario
        $user->name= $name;
        $user->surname1= $surname1;
        $user->surname2= $surname2;
        $user->nick= $nick;
        $user->email= $email;
        
        //subir imagen
        $image_path = $request->file('image_path');
        if($image_path){
            //Poner nombre unico
            $image_path_full = time().$image_path->getClientOriginalName();
            //Guardar en la carpeta storage (app/users)
            Storage::disk('users')->put($image_path_full, File::get($image_path));
            //Seteo el nombre de la imagen en el objeto
            $user->foto = $image_path_full;
        }
        
        //ejecutar consulta y cambios en la base de datos
        $user->update();
        $usuario = \Auth::user()->rol;
        DB::select('call logs("'.$user->name.'", "Actualizar", "'.$usuario.'")');
        return redirect()->route('config')
                         ->with(['message'=>'Usuario actualizado correctament']);
    }
    //devuelve el archivo almacenado en la carpeta users
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response ($file, 200);
        
    }
    //para crear un nuevo mensaje(esto esta por modificar)
    //segun el rol del usuario logueado 
    //devolvera todos los usuarios si el rol es administrador
    //si es otro solo devolvera los usuarios que sean administradores
    public function nuevo(){
        $user = \Auth::user();
        if($user->rol != "Administrador"){
            $users = User::where('rol', 'Administrador')->get();
        }else if($user->rol == "Administrador"){
            $users = User::all();
        }
       
        return view('mensajes.nuevo', [
            'user' => $users
        ]);
    }
    //funcion que genera el pdf de listado de usuarios
    public function pdf(){
        $users = User::all();
        $pdf = PDF::loadView('user.pdf', compact('users'));
        return $pdf->download('listado usuarios.pdf');
    }
}