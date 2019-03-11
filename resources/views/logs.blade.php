@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Listado de logs <a href="{{ route('logspdf')}}"><img class="alineadoTextoImagen" src="{{asset('images/PDF.png')}}" width="40px" height="40px"/></a></h1>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Acción</th>
                    <th>Rol</th>
                    <th>Fecha</th>
                </tr>
                </thead>
            @foreach($logs as $log)
                @switch($log->accion)
                    @case("Registro")
                    <tr class="bg-success">
                        <td>{{$log->usuario}}</td>
                        <td>{{$log->accion}}</td>
                        <td>{{$log->rol}}</td>
                        <td>{{$log->fecha}}</td>
                    </tr>
                    @break
                    @case("Listar")
                    <tr class="bg-primary">
                        <td>{{$log->usuario}}</td>
                        <td>{{$log->accion}}</td>
                        <td>{{$log->rol}}</td>
                        <td>{{$log->fecha}}</td>
                    </tr>
                    @break
                @endswitch               
            @endforeach
            </table>
             <div class="clearfix">
                {{$logs->links()}}                
            </div>
        </div>
        
    </div>
</div>    
@endsection
  