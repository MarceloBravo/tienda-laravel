
@if(Auth::check() )
    <li>
        <a href="#" class="dropdown-togle" data-togle="dropdown" role="button" aria-expanded="false">
            <li><a href="#"><i class="fa fa-user-o"></i> {{ Auth::user()->nombre }} {{ Auth::user()->a_paterno }}</a></li>
        </a>
    </li>
    <li>
        <ul>            
            <li class="dropdown-item"><a href="#" onclick="document.getElementById('frm-logout').submit()"><i class="fa fa-sign-out"></i>Cerrar sesión</a></li>
        </ul>
    </li>
    <form id="frm-logout" action="/logout" method="POST">
        @csrf
    </form>
@else
    <li><a href="/login"><i class="fa fa-user-o"></i> Iniciar sesión</a></li>
@endif