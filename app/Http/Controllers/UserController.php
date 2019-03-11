<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response; //para funcion que devuelve la imagen que tenemos en el disco
use Illuminate\Support\Facades\Storage; //Para las imagenes
use Illuminate\Support\Facades\File; //Para las imagenes
use Barryvdh\DomPDF\Facade as PDF; //Para generar pdf

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }
    public function listar(){
        $user = \Auth::user();
        if($user->rol != "Administrador"){
            $users = User::where('activo', '1')->paginate(5);
        }else if($user->rol == "Administrador"){
            $users = User::paginate(5);
        }
        return view('user.listar', [
            'users' => $users
        ]);
    }
    public function solicitudes(){
        $users = User::paginate(5);
        return view('user.solicitudes', [
            'users' => $users
        ]);
    }
    public function eliminar($id){
        $user = User::find($id);
        $user -> delete();
        return redirect()->route('listar')
                         ->with(['message'=>'Usuario eliminado correctament ya no vale arrepentirse']);
    }
    public function activar($id){
        $user = User::find($id);
        $user->activo = 1;
        $user->update();
        return redirect()->route('listar')
                         ->with(['message'=>'Ya puede entrar este usuario ¡CUIDADO!']);
    }
    public function desactivar($id){
        $user = User::find($id);
        $user->activo = 0;
        $user->update();
        return redirect()->route('listar')
                         ->with(['message'=>'Se le acabo la tonteria juajuajua']);
    }

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
        
        return redirect()->route('config')
                         ->with(['message'=>'Usuario actualizado correctament']);
    }
    
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response ($file, 200);
        
    }
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
    
    public function pdf(){
        $users = User::all();
        $pdf = PDF::loadView('user.pdf', compact('users'));
        return $pdf->download('listado usuarios.pdf');
    }
}