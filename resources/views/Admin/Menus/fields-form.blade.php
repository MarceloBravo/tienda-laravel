<div class="form-group">
    {!! Form::label('nombre', 'Nombre', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::text('nombre',null,array('class'=>'form-control','placeholder'=>'Ingrese el nombre del menú'))  !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('icono_class', 'Código Icono', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::text('icono_class',null,array('class'=>'form-control','placeholder'=>'Ingrese el código de la clase fa fa'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('url', 'Url', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::text('url',null,array('class'=>'form-control','placeholder'=>'Ingrese la ruta para acceder al formuario por la web.'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('posicion', 'Posición', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::number('posicion',null,array('class'=>'form-control','placeholder'=>'Ingrese la posición que ocupara el menú'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('menu_padre_id', 'Menu padre', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::select('menu_padre_id',$menuPadre,null,array('class'=>'form-control','placeholder'=>'-- Seleccione --'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pantalla_id', 'Pantalla', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::select('pantalla_id',$pantallas,null,array('class'=>'form-control','placeholder'=>'-- Seleccione --'))  !!}
    </div>
</div>