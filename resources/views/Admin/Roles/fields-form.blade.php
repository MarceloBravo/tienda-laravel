<div class="form-group">
    {!!Form::label('nombre','Nombre',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre',null,['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del rol.']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('descripcion','Descripción',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-9">
        {!! Form::text('descripcion',null,['class'=>'form-control','placeholder'=>'Ingrese una descripción para el rol.']) !!}
    </div>
</div>