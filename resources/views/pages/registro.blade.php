@extends('layouts.app')

@section('Content')
    
@include('includes.admin.messages')

<!-- start: page -->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                </div>

                <h2 class="panel-title">Registro de clientes</h2>
            </header>
            <div class="col-md-12">
                <div class="col-md-1">
                </div>
                <div class="panel-body col-md-5">
                    
                    {!! Form::open(['id'=>'form','route'=>'usuarios.store', 'method'=>'post']) !!}

                    <div class="form-group col-md-12">
                        {!! Form::label('rut','Rut',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-6">
                            {!! Form::text('rut',null,['class'=>'form-control','placeholder'=>'Ingrese el rut del usuario.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('nombre','Nombre',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del usuario.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('a_paterno','A. Paterno',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::text('a_paterno',null,['class'=>'form-control','placeholder'=>'Ingrese el apellido paterno.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('a_materno','A. materno',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::text('a_materno',null,['class'=>'form-control','placeholder'=>'Ingrese el apellido materno.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('email','Email',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese correo el ectrónico.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('dirección','Dirección',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la dirección del usuario.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('fono','Fono',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::text('fono',null,['class'=>'form-control','placeholder'=>'Ingrese el telefono del usuario.']) !!}
                        </div>
                    </div>
                </div>
                <div class="panel-body col-md-5">
                    {!! Form::hidden('rol_id',$rolId) !!}
                    
                    <div class="form-group col-md-12">
                        {!! Form::label('id_pais','Pais',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::select('id_pais',$paises, null,['id'=>'id_pais','class'=>'form-control','placeholder'=>'Seleccione un pais.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('id_region','Región',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::select('id_region',$regiones, null,['id'=>'id_region','class'=>'form-control','placeholder'=>'Seleccione una región.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('id_comuna','Comuna',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::select('id_comuna',$comunas, null,['id'=>'id_comuna','class'=>'form-control','placeholder'=>'Seleccione una comuna.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('id_ciudad','Ciudad',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::select('id_ciudad',$ciudades, null,['id'=>'id_ciudad','class'=>'form-control','placeholder'=>'Seleccione una ciudad.']) !!}
                        </div>
                    </div>                    
                    <div class="form-group col-md-12">
                        {!! Form::label('nickname','Nickname',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::text('nickname',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de usuario (Nickname).']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('password','Contraseña',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese la contraseña del usuario.']) !!}
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        {!! Form::label('confirm_password','Confirmar contraseña',['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-9">
                            {!! Form::password('confirm_password',['class'=>'form-control','placeholder'=>'Ingrese la contraseña del usuario.']) !!}
                        </div>
                    </div>
                        
                    {!! Form::close() !!}
                    
                    <div class="row">
                        <div class="form-group buttons-group">
                            <button type="button" id="btnGrabar" class="btn btn-primary">Grabar</button>
                            <a href="/" class="btn btn-default">Cancelar</a>
                        </div>
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
@endsection

@section('script')
<script src="{{ asset('js/mantenedores/shared/form.js') }}"></script>
<script src="{{ asset('js/mantenedores/usuarios.js') }}"></script>
@endsection