@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Curriculum Vitae</h1>
            <form method="post" action="{{--route("newcv")--}}">
                @csrf
                <textarea name="contenido" id="contenido" class="ckeditor">
                    <h1>Formacion academica</h1>
                    <hr>
                    <br>
                    Formado en:
                    Disciplina: 
                    <br>
                    Nivel de ingles:
                    <h1>Competencias profesionales</h1>
                    <hr>
                    <br>
                    <h3>Lenguajes de programacion/scripting</h3>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3>Sistemas operativos</h3>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3>Base de datos</h3>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                    <h3>Programacion/Diseño Web</h3>
                    <ul>
                        <li></li>
                        <li></li>
                    </ul>
                </textarea>
                
                <br>
                <input type="submit" name="submit" value="Enviar" class="btn btn-danger">
            </form>
            @section('js')
            <script>
                CKEDITOR.replace( 'contenido' ),{
                    height : "1100px",
                    uiColor: '#FFFFF',
                    languaje: "es"
                };
            </script>
            @endsection
        </div>
    </div>
</div>
@endsection
