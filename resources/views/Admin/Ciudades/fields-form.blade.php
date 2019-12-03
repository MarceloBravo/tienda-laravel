<div class="form-group">
    {!! Form::label('nombre', 'Nombre', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::text('nombre',null,array('class'=>'form-control','placeholder'=>'Ingrese el nombre'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('pais', 'Pais', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::select('pais',$paises,null,array('class'=>'form-control','placeholder'=>'-- Seleccione el pais --'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('region', 'Región', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::select('region',$regiones, null,array('class'=>'form-control','placeholder'=>'-- Seleccione la región --'))  !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('id_comuna', 'Comuna', array('class'=>'col-md-3 control-label')) !!}
    <div class="col-md-6">
        {!! Form::select('id_comuna',$comunas, null,array('class'=>'form-control','placeholder'=>'-- Seleccione la comuna --'))  !!}
    </div>
</div>
