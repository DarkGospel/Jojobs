@if(Auth::user()->foto)
<div class="container-avatar">
    @if(Auth::user()->foto != null)
    <img src="{{ route('user.avatar',['filename'=>Auth::user()->foto])}}" class="avatar"/>
    @else
    <img src="{{ asset('images/imagenpordefecto.png')}}" class="avatar"/>
    @endif
</div>
@endif