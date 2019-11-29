@extends('layouts.admin')

@section('Content')

<header class="page-header">
    <h2>Mantenedores</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Administración</span></li>
            <li><span>Permisos</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>
@include('includes.admin.messages')

<!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>
    
                    <h2 class="panel-title">Permisos</h2>
                </header>
                <div class="panel-body">

                    <form id="form" class="" method="POST" action="/admin/permisos/{{ $idRol }}">
                        <input type="hidden" name="_method" value="PUT" />
                        @csrf

                        <div class="form-group row-title">
                            <label class="col-md-3">Pantalla</label>
                            <label class="col-md-3 col-checkbox">Crear</label>
                            <label class="col-md-3 col-checkbox">Actualizar</label>
                            <label class="col-md-3 col-checkbox">Eliminar</label>
                        </div>
                        @foreach($permisos as $item)                            
                            <div class="form-group">
                                <label for="{{ $item->id }}" class="col-md-3">{{ $item->pantalla }}</label>
                                <div class="col-md-3 col-checkbox">
                                    @if($item->crear)                                        
                                        <input type="checkbox" id="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" checked="true" value="1"/>
                                    @else
                                        <input type="checkbox" id="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" value="1"/>
                                        <input type="hidden" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" value="0" />
                                    @endif
                                </div>
                                <div class="col-md-3 col-checkbox">
                                    @if($item->actualizar)
                                        <input type="checkbox" id="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" checked="FALSE" value="true"/>
                                    @else
                                        <input type="checkbox" id="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" value="FALSE"/>
                                    @endif
                                </div>
                                <div class="col-md-3 col-checkbox">
                                    @if($item->eliminar)
                                        <input type="checkbox" id="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" checked="checked"/>
                                    @else
                                        <input type="checkbox" id="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" name="{{ is_null($item->id) ? 'nuevo-'.$item->fila : $item->id }}" />
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        
                    </form>

                    <div class="row">
                        <div class="form-group buttons-group">
                            <button type="button" id="btnGrabar" class="btn btn-primary">Grabar</button>                            
                            <a href="/admin/permisos" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>            
<!-- end: page -->

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/custom/carrito.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/productos.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/permisos.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/mantenedores/shared/form.js') }}"></script>
@endsection