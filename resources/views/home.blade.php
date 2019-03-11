@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->surname2 == null)
                        <script>
                            //En este scrip vamos a lanzar un modal de manera automatica
                            //La condicion será que el usuario tenga su segundo apellido en null
                        $(document).ready(function()
                        {
                          $("#myModal").modal("show");
                        });
                        </script>
                    @endif
                    
                    <!-- The Modal para elim-->
                  <div class="modal" id="myModal">
                        <div class="modal-dialog">
                                <div class="modal-content"  style="text-align: center;">
                                    <div class="modal-header" >
                                        <h4 class="modal-title" >¡Bienvenido!</h4>
                                    </div>
                                    <div class="modal-body" align="center">
                                        <strong>Termina de rellenar tus datos</strong> <br><br>
                                        <p>Dirígete a tu perfil para editarlo :D</p>
                                    </div>
                                    
                                </div>
                            </div>
                  </div>
        <div class="col-md-12">
            <!--<div class="card">
               <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                </div>-->
               <a href="{{ route('listar')}}" class="col-md-4"> <img src="{{asset('images/listar.png')}}" id="imglistar"/></a>  
               <a href="{{route('listarmensajes')}}" class="col-md-4"> <img src="{{asset('images/mensajes.png')}}" id="imglistar"/></a>  
               @if(Auth::user()->rol == "Administrador")
               <a href="{{ route('config')}}" class="col-md-4"> <img src="{{asset('images/addusuario.png')}}" id="imglistar"/></a>
               <a href="{{ route('logs')}}" class="col-md-4"> <img src="{{asset('images/logs.png')}}" id="imglistar"/></a>
               <a href="{{ route('solicitudes')}}" class="col-md-4"> <img src="{{asset('images/activarusuario.png')}}" id="imglistar"/></a>
               @endif
            <!--</div>-->
        </div>
    </div>
</div>
@endsection
