@if(count($menu[1])>0)      
    
    <li class="nav-parent">
        <a>
            <i class="{{ $menu[0]->icono_class }}" aria-hidden="true"></i>
            <span>{{ $menu[0]->nombre }}</span>
        </a>        
        <ul class="nav nav-children">        
        @foreach($menu[1] as $item)          
            @include('layouts.menus',['menu' => $item])     
        @endforeach
        </ul>
    </li>
@else   
    <li>
        <a href="{{ $menu[0]->url}}">
            <i class="{{ $menu[0]->icono_class }}" aria-hidden="true"></i>
            <span>{{ $menu[0]->nombre }}</span>
        </a>
    </li>            
@endif