@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            <h1>Listado de Usuarios <a href="{{route('pdf')}}"><img class="alineadoTextoImagen" src="{{asset('images/PDF.png')}}" width="40px" height="40px"/></a></h1>
            <table class="table">
                <thead class="thead-dark" align="center">
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    <th>Rol</th>
                    @if(Auth::user()->rol == "Administrador")
                    <th>Acciones</th>
                    @endif
                </tr>
                </thead>
            @foreach($users as $user)
                @if($user->activo == true)
                    <tr class="bg-success">
                        @if($user->foto != null)
                        <td> <img src="{{ route('user.avatar',['filename'=>$user->foto])}}" class="foto"/></td>
                        @else
                        <td> <img src="{{ asset('images/imagenpordefecto.png')}}" class="foto"/></td>
                        @endif
                        <td><a href="{{route('perfil', [$id= $user->id])}}" style="color:#FFFF;">{{$user->name}}</a></td>
                        <td>{{$user->surname1}}</td>
                        <td>{{$user->rol}}</td>
                        @if(Auth::user()->rol == "Administrador" )
                            @if($user->name != Auth::user()->name)
                                <td>
                                    <a data-toggle="modal" data-target="#{{$user->id}}"><img src="{{asset('images/borrar.png')}}" width="20px" height="20px"></a>
                                    <a href="{{route('config', [$id=$user->id])}}"><img class="alineadoTextoImagen" src="{{asset('images/editar.png')}}" width="20px" height="20px"/></a>
                                    <a href="{{ route('mensaje')}}"><img class="alineadoTextoImagen" src="{{asset('images/mensajes.png')}}" width="28px" height="28px"/></a>
                                    @if($user->activo == 0)
                                        <a href="{{route('activar', [$id=$user->id])}}"><img src="{{ asset('images/activar.png')}}" class="foto"/></a>
                                    @else
                                        <a href="{{route('desactivar', [$id=$user->id])}}"><img src="{{ asset('images/desactivar.png')}}" class="foto"/></a>
                                    @endif
                                </td>
                            @else
                                <td></td>
                            @endif
                        @endif
                    </tr>
                    @else
                    <tr class="bg-primary">
                        @if($user->foto != null)
                         <td> <img src="{{ route('user.avatar',['filename'=>$user->foto])}}" class="foto"/></td>
                        @else
                        <td> <img src="{{ asset('images/imagenpordefecto.png')}}" class="foto"/></td>
                        @endif
                        <td><a href="{{route('perfil', [$id= $user->id])}}" style="color:#FFFF;">{{$user->name}}</a></td>
                        <td>{{$user->surname1}}</td>
                        <td>{{$user->rol}}</td>
                        @if(Auth::user()->rol == "Administrador")
                        <td>
                            <a data-toggle="modal" data-target="#{{$user->id}}"><img src="{{asset('images/borrar.png')}}" width="20px" height="20px"></a>
                            <a href="{{route('config', [$id=$user->id])}}"><img class="alineadoTextoImagen" src="{{asset('images/editar.png')}}" width="20px" height="20px"/></a>
                            <a href="{{route('mensaje')}}"><img class="alineadoTextoImagen" src="{{asset('images/mensajes.png')}}" width="28px" height="28px"/></a>
                            @if($user->activo == 0)
                            <a href="{{route('activar', [$id=$user->id])}}"><img src="{{ asset('images/activar.png')}}" class="foto"/></a>
                            @else
                            <a href="{{route('desactivar', [$id=$user->id])}}"><img src="{{ asset('images/desactivar.png')}}" class="foto"/></a>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endif 
                    <!-- The Modal para elim-->
                  <div class="modal" id="{{$user->id}}">
                        <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" align="center">¡ATENCIÓN!</h4>
                                    </div>
                                    <div class="modal-body" align="center">
                                        <strong>Se va a proceder a borrar un usuario</strong> <br><br>
                                        <p>¿Estas seguro?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div align="center">
                                        <a  href="{{route('eliminar', [$id=$user->id])}}" class="btn btn-success">Si</a>
                                        <a href="#" data-dismiss="modal" class="btn btn-danger">No</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                  </div>
                
            @endforeach   
            
            </table>
             <div class="clearfix">
                {{$users->links()}}                
            </div>
        </div>
        
    </div>
</div>    
@endsection
  