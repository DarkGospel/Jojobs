@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Configuración de mi cuenta</div>

                <div class="card-body">
                    <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="surname1" class="col-md-4 col-form-label text-md-right">Apellido1</label>

                            <div class="col-md-6">
                                <input id="surname1" type="text" class="form-control" name="surname1" value="{{ $user->surname1 }}" required>
                                @if ($errors->has('surname1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="surname2" class="col-md-4 col-form-label text-md-right">Apellido2</label>

                            <div class="col-md-6">
                                <input id="surname2" type="text" class="form-control" name="surname2" value="{{ $user->surname2 }}" >
                                @if ($errors->has('surname2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nick" class="col-md-4 col-form-label text-md-right">Nick</label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control" name="nick" value="{{ $user->nick }}" required>
                                @if ($errors->has('nick'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nick') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                         <div class="form-group row">
                            <label for="image_path" class="col-md-4 col-form-label text-md-right">Avatar</label>

                            <div class="col-md-6">
                                @if(Auth::user()->foto != null)
                                    <img src="{{ route('user.avatar',['filename'=>$user->foto])}}" class="avatar"/>
                                @else
                                   <img src="{{ asset('images/imagenpordefecto.png')}}" class="avatar"/>
                                @endif
                                <input id="image_path" type="file" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="image_path">

                                @if ($errors->has('foto'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

