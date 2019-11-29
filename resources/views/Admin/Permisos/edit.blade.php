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
                        <input type="hidden" name="_rol" value="{{ $idRol }}" />

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
                                    <input type="hidden" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-crear' : $item->id.'-0-crear' }}" value="0" />
                                    @if($item->crear)                                        
                                        <input type="checkbox" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-crear' : $item->id.'-0-crear' }}" checked="checked" value="1"/>
                                    @else
                                        <input type="checkbox" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-crear' : $item->id.'-0-crear' }}" value="1"/>                                        
                                    @endif
                                </div>
                                <div class="col-md-3 col-checkbox">
                                    <input type="hidden" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-actualizar' : $item->id.'-0-actualizar' }}" value="0" />
                                    @if($item->actualizar)
                                        <input type="checkbox" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-actualizar' : $item->id.'-0-actualizar' }}" checked="checked" value="1"/>
                                    @else
                                        <input type="checkbox" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-actualizar' : $item->id.'-0-actualizar' }}" value="1"/>
                                    @endif
                                </div>
                                <div class="col-md-3 col-checkbox">
                                    <input type="hidden" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-eliminar' : $item->id.'-0-eliminar' }}" value="0" />
                                    @if($item->eliminar)
                                        <input type="checkbox" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-eliminar' : $item->id.'-0-eliminar' }}" checked="checked" value="1"/>
                                    @else
                                        <input type="checkbox" name="{{ is_null($item->id) ? '0-'.$item->pantalla_id.'-eliminar' : $item->id.'-0-eliminar' }}" value="1"/>
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