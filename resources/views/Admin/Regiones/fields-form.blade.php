<div class="form-group">
    {!! Form::label('nombre','Nombre',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre',null,['class'=>'form-control col-md-12','placeholder'=>'Ingrese el nombre del pais.']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('id_pais','Región',['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::select('id_pais',$paises,null,['class'=>'form-control col-md-12','placeholder'=>'-- Seleccione el pais --']) !!}
    </div>
</div>