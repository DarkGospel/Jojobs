@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Mensaje nuevo</h2>
            <div class="card">                
                <div class="card-header">
                    <select class="custom-select selecuser">
                        @foreach($user as $user)
                            @if($user->name !=Auth::user()->name )
                                <option>{{$user->name}}</option>
                            @endif
                        @endforeach  
                    </select>
                </div>

                <div class="card-body">
                    <h4>Titulo</h4>
                    <input type="text" id="titulo" class="form-control"/><br>
                    <h4>Descripción</h4>
                    <textarea id="cuerpo" class="form-control"></textarea>            
                </div>   
                <div class="botonenviar">
                    <a href="{{--route('enviar')--}}"><button class="btn btn-success">Enviar</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


