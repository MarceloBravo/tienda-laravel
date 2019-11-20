<div class="form-group">
    {!! Form::label('rut','Rut',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::text('rut',null,['class'=>'form-control','placeholder'=>'Ingrese el rut del usuario.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('nombre','Nombre',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del usuario.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('a_paterno','A. Paterno',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::text('a_paterno',null,['class'=>'form-control','placeholder'=>'Ingrese el apellido paterno.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('a_materno','A. materno',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::text('a_materno',null,['class'=>'form-control','placeholder'=>'Ingrese el apellido materno.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email','Email',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Ingrese correo el ectrónico.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('dirección','Dirección',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la dirección del usuario.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('rol_id','Rol',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::select('rol_id',$roles,null,['class'=>'form-control','placeholder'=>'Seleccione un rol para el usuario.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('id_pais','Pais',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::select('id_pais',$paises, null,['id'=>'id_pais','class'=>'form-control','placeholder'=>'Seleccione un pais.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('id_region','Región',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::select('id_region',$regiones, null,['id'=>'id_region','class'=>'form-control','placeholder'=>'Seleccione una región.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('id_comuna','Comuna',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::select('id_comuna',$comunas, null,['id'=>'id_comuna','class'=>'form-control','placeholder'=>'Seleccione una comuna.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('id_ciudad','Ciudad',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::select('id_ciudad',$ciudades, null,['id'=>'id_ciudad','class'=>'form-control','placeholder'=>'Seleccione una ciudad.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('fono','Fono',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::text('fono',null,['class'=>'form-control','placeholder'=>'Ingrese el telefono del usuario.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('nickname','Nickname',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::text('nickname',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de usuario (Nickname).']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('password','Contraseña',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese la contraseña del usuario.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('confirm_password','Contraseña',['class'=>'label-form col-md-3']) !!}
    <div class="col-md-4">
        {!! Form::password('confirm_password',['class'=>'form-control','placeholder'=>'Ingrese la contraseña del usuario.']) !!}
    </div>
</div>