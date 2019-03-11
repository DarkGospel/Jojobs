@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Mensaje nuevo</h2>
            <div class="card"> 
                <form method="post" action="{{route('enviar')}}">
                    @csrf
                <div class="card-header">
                    <select class="custom-select selecuser" name="receptor" id="receptor">
                        @foreach($user as $user)
                            @if($user->name !=Auth::user()->name && $user->activo == "1")
                            <option value="{{$user->id}}" >{{$user->name}}</option>
                            @endif
                        @endforeach  
                    </select>
                </div>
                <div class="card-body">
                    <h4>Titulo</h4>
                    <input type="text" id="titulo" class="form-control" name="titulo"/><br>
                    <h4>Descripción</h4>
                    <textarea id="cuerpo" class="form-control" name="descripcion"></textarea>            
                </div>   
                <div class="botonenviar">
                    <input type="submit" name="submit" class="btn btn-success" value="Enviar mensaje">
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


