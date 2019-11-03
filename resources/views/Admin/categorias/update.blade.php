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
                    <li><span>Categorías</span></li>
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
            
                            <h2 class="panel-title">Categorías</h2>
                        </header>
                        <div class="panel-body">

                            {!! Form::model($categoria, ['id' => 'form', 'route'=>['categorias.update', $categoria->id], 'method'=>'PUT']) !!}

                                @include('admin.categorias.fields-form')
                                
                            {!! Form::close() !!}

                            <form id="eliminar" method="post" action="/admin/categorias/{{ $categoria->id}}">
                                <input type="hidden" name="_method" value="DELETE"/>
                                @csrf
                            </form>

                            <div class="row">
                                <div class="form-group buttons-group">
                                    <button type="button" id="btnGrabar" class="btn btn-primary">Grabar</button>
                                    <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                                    <a href="/admin/categorias" class="btn btn-default">Cancelar</a>
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
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/forms.css') }}">
@endsection


@section('script')
<script src="{{ asset('js/mantenedores/categorias/form.js') }}"></script>
@endsection
