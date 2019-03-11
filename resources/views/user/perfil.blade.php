@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if($user->foto != null)
                        <td> <img src="{{ route('user.avatar',['filename'=>$user->foto])}}" class="perfil"/></td>
                        @else
                        <td> <img src="{{ asset('images/imagenpordefecto.png')}}" class="perfil"/></td>
                        @endif
                    {{$user->name}} {{$user->surname1}}  {{$user->surname2}} 
                    &nbsp;
                    <a href="{{route('config', [$id= $user->id])}}" id="btneditar"><button class="btn btn-primary"><img src="{{asset("images/editar.png")}}" width="25px" height="25px"/></button></a>
                </div>
                <div></div>
                <div class="card-body">
                    Nombre de usuario: <br><input type="text" value="{{$user->nick}}" class="form-control" readonly/>
                    <br>
                    Correo electronico:
                    <input type="text" value="{{$user->email}}" class="form-control" readonly/>
                    <br>
                    Rol: <input type="text" value="{{$user->rol}}" class="form-control" readonly/>
                    <br>
                    Telefono de contacto:
                    <input type="text" value="{{$user->movil}} {{$user->fijo}}" class="form-control" readonly/> 
                    <br>
                    Departamento:
                    <input type="text" value="{{$user->departamento}} " class="form-control" readonly/>
                    <br>
                    Redes Sociales:
                    <input type="text" value="{{$user->github}} " class="form-control" readonly/>
                    <input type="text" value="{{$user->twitter}} " class="form-control" readonly/>
                    <input type="text" value="{{$user->blog}} " class="form-control" readonly/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


