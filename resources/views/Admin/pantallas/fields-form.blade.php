<div class="form-group">
    {!! Form::label('nombre','Nombre',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null,['class'=>'form-control col-md-12','placeholder'=>'Ingrese el nombre de la pantalla.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('tabla','Tabla',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::text('tabla', null,['class'=>'form-control col-md-12','placeholder'=>'Ingrese el nombre de la tabla asociada a esta pantalla.']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('permite_crear','Permite crear',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('permite_crear', 1, null) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('permite_actualizar','Permite actualizar',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('permite_actualizar', 1, null) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('permite_eliminar','Permite eliminar',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::checkbox('permite_eliminar', 1, null) !!}
    </div>
</div>