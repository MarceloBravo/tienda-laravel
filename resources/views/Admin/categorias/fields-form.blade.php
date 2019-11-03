<div class="form-group">
        {!! Form::label('nombre', 'Nombre', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::text('nombre',null,array('class'=>'form-control','placeholder'=>'Ingrese el nombre'))  !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('descripcion','Descripcion',array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::text('descripcion',null,array('class'=>'form-control')) !!}
        </div>
    </div>