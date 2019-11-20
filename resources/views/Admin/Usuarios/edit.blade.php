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
            <li><span>Páginas</span></li>
            <li><span>Usuarios</li>
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

                <h2 class="panel-title">Usuarios</h2>
            </header>
            <div class="panel-body">
                
                {!! Form::model($usuario,['id'=>'form','route'=>['usuarios.update', $usuario->id], 'method'=>'put']) !!}

                    @include('admin.usuarios.fields-form')
                    
                {!! Form::close() !!}
                
                {!! Form::model($usuario, ['id'=>'eliminar', 'route'=>['usuarios.destroy', $usuario->id], 'method'=>'delete']) !!}
                {!! Form::close() !!}

                <div class="row">
                    <div class="form-group buttons-group">
                        <button type="button" id="btnGrabar" class="btn btn-primary">Grabar</button>
                        <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                        <a href="/admin/usuarios" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>            
<!-- end: page -->

@include('includes.loading')

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/custom/carrito.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/productos.css') }}">
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/mantenedores/shared/form.js') }}"></script>
<script src="{{ asset('js/mantenedores/usuarios.js') }}"></script>
@endsection