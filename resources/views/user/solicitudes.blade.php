@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            <h1>Listado de Solicitudes </h1>
            <table class="table">
                <thead class="thead-dark">
                <tr align="center">
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    
                    <th>Acciones</th>
                    
                </tr>
                </thead>
            @foreach($users as $user)
                @if($user->activo == true)
                    <tr class="bg-success">
                        <td>{{$user->name}}</td>
                        <td>{{$user->surname1}}</td>                        
                        <td>
                            @if($user->activo == 0)
                            <a data-toggle="modal" data-target="#{{$user->id}}"><img src="{{ asset('images/activar.png')}}" class="foto"/></a>
                            @else
                           <a href="{{route('desactivar', [$id=$user->id])}}"><img src="{{ asset('images/desactivar.png')}}" class="foto"/></a>
                            @endif
                        </td>
                       
                    </tr>
                    @else
                    <tr class="bg-primary">
                        <td>{{$user->name}}</td>
                        <td>{{$user->surname1}}</td>
                       <td>
                            @if($user->activo == 0)
                            <a data-toggle="modal" data-target="#{{$user->id}}"><img src="{{ asset('images/activar.png')}}" class="foto"/></a>
                            @else
                           <a href="{{route('desactivar', [$id=$user->id])}}"><img src="{{ asset('images/desactivar.png')}}" class="foto"/></a>
                            @endif
                        </td>
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
                                        <strong>Se va a proceder a activar un usuario</strong> <br><br>
                                        <p>¿Estas seguro? Puede ser un liante</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div align="center">
                                        <a  href="{{route('activar', [$id=$user->id])}}" class="btn btn-success">Si</a>
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
  