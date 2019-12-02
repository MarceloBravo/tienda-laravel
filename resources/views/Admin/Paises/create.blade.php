@extends('layouts.admin')

@section('Content')

    
    @include('includes.admin.page-header')
    
    @include('includes.admin.messages')

    <!-- start: page -->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>
        
                        <h2 class="panel-title">{{ $pantalla }}</h2>
                    </header>
                    <div class="panel-body">
                        
                        {!! Form::open(['id'=>'form','route'=>'paises.store', 'method'=>'post']) !!}

                            @include('admin.paises.fields-form')
                            
                        {!! Form::close() !!}
                        
                        <div class="row">
                            <div class="form-group buttons-group">
                                <button type="button" id="btnGrabar" class="btn btn-primary">Grabar</button>
                                <button type="button" id="btnEliminar" class="btn btn-danger" disabled>Eliminar</button>
                                <a href="/admin/paises" class="btn btn-default">Cancelar</a>
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
<script src="{{ asset('js/mantenedores/shared/form.js') }}"></script>
@endsection