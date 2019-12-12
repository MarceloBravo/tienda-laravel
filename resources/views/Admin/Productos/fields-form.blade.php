    <div class="form-group">
        {!! Form::label('categoria', 'Categoria', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::select('categoria_id',$categorias,null,array('class'=>'form-control','placeholder'=>'Seleccione la categoría'))  !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('nombre', 'Nombre', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::text('nombre',null,array('class'=>'form-control','placeholder'=>'Ingrese el nombre'))  !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('descripcion', 'Descripción', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::textarea('descripcion',null,array('class'=>'form-control','placeholder'=>'Ingrese una descripción del producto'))  !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('resumen', 'Resumen', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::text('resumen',null,array('class'=>'form-control','placeholder'=>'Ingrese un resumen de la descripción'))  !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('color', 'Color', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
        {!! Form::text('color',null,array('class'=>'form-control','placeholder'=>'Ingrese el color del producto.'))  !!}
            <!-- <input type="color" name="color" class="form-control col-md-3" value="{{ isset($producto->color) ? $producto->color : null }}"/> -->
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('marca', 'Marcas', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::select('marca_id',$marcas,null,array('class'=>'form-control','placeholder'=>'Seleccione una marca'))  !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('precio', 'Precio', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::number('precio',null,array('class'=>'form-control','placeholder'=>'Ingrese el precio', 'step'=>'any'))  !!}   <!-- step indica que permite numerois decimales --> 
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('precio_anterior', 'Precio anterior', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::number('precio_anterior',null,array('class'=>'form-control','placeholder'=>'Ingrese el precio anterior (Opcional)')) !!}   <!-- step indica que permite numerois decimales -->  
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('nuevo', 'Nuevo', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::checkbox('nuevo',1, null) !!} <!-- El N° 1 indica que el checkbox ha de trabajjar con valores 1 y 0 no con True o False-->
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('visible', 'Visible en home', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::checkbox('visible',1, null) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('oferta', 'Oferta', array('class'=>'col-md-3 control-label')) !!}
        <div class="col-md-6">
            {!! Form::checkbox('oferta',1, null) !!}
        </div>
    </div>
    
    <input type="hidden" 
        id="imagen_predeterminada" 
        name="imagen_predeterminada" 
        value="{{ !is_null($producto->imagenes()->where('default','=',true)->first()) ? $producto->imagenes()->where('default','=',true)->first()->nombre_archivo : ''}}"
    />
    

    <div class="panel-body">
        <div>
            <button type="button" id="btn-add-image" class="btn btn-default">Agregar imágen</button>
            <input type="file" id="input-file"/>            
        </div>  
        <div id="div-imagenes"></div>     
        <div id="div-imagenes-eliminadas"></div>     
        <br/>  
        <table class="table table-bordered table-striped mb-none">
            <thead>
            <tr>
                <th width="10%">Vista previa</th>
                <th>Archivo</th>
                <th width="15%">Predeterminada</th>
                <th width="10%">Eliminar</th>
            </tr>
            </thead>
            <tbody id="tbody">                                
                @foreach($producto->imagenes()->get() as $imagen)                    
                    <tr id="row-img{{$imagen->id}}">
                        <td>
                            <img class='img-responsive' src="{{ asset($imagen->url) }}"></td>
                        <td class="col-align-left">{{ $imagen->nombre_archivo }}<input type="hidden" name="imagenes_id[]" value="{{ $imagen->id }}"/></td>
                        <td class="col-align-center">
                            <input type="radio" id="option-{{ $imagen->nombre_archivo }}" name="default-image" {{ $imagen->default ? "checked" : "" }} data-fila="{{ $imagen->nombre_archivo }}" onchange="changeDefaultImage('{{ $imagen->nombre_archivo }}')"/>                            
                        </td>
                        <td class="col-align-center">
                            <span onclick="eliminarImagen('{{ $imagen->id }}', false)"><i class="fa fa-trash"></i></span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>