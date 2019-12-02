<div class="form-group">
    {!! Form::Label('nombre','Nombre', ['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre',null,['class'=>'form-control col-md-12','placeholder'=>'Ingresa el nombre de la comuna.']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::Label('pais','Pais', ['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::select('pais',$paises,null,['id'=>'pais','class'=>'form-control col-md-12','placeholder'=>'-- Seleccione el pais --']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::Label('id_region','Región', ['class'=>'control-label col-md-3']) !!}
    <div class="col-md-6">
        {!! Form::select('id_region',$regiones,null,['id'=>'region','class'=>'form-control col-md-12','placeholder'=>'-- Seleccione la región --']) !!}
    </div>
</div>