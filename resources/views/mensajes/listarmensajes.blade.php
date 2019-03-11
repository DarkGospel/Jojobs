@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mensajes</div>

                <div class="card-body">
                    <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th>Titulo</th>
                    <th>Usuario</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>                    
                </tr>
                </thead>
            @foreach($mensajes as $mesaje)
                <tr>
                    <td>{{$mesaje->Titulo}}</td>
                    <td>{{$mesaje->id_usuario}}</td>
                    <td>{{str_limit($mesaje->Descripcion, 25)}}</td>
                    <td>{{$mesaje->fecha}}</td>
                    
                    </tr>                
            @endforeach   
            
            </table>
             <div class="clearfix">
                {{$mensajes->links()}}                
            </div>
            <div class="clearfix">
                <a href="{{route("mensaje")}}"> <button class="btn btn-primary">+</button></a>
            </div>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection

