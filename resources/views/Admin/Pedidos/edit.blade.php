@extends('layouts.admin')

@section('Content')

<header class="page-header">
    <h2>Mantenedores</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Páginas</span></li>
            <li><span>Pedidos</span></li>
        </ol>

        <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
    </div>
</header>

@include('includes.admin.messages')

<!-- start: page -->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                </div>

                <h2 class="panel-title">Pedidos</h2>
            </header>
            <div class="panel-body">

                {!! Form::model($pedido, ['id' => 'form', 'route'=>['pedidos.update', $pedido->id], 'method'=>'PUT']) !!}

                    <div class="form-group">
                        <label class="label-form col-md-3">Nombre cliente</label>                        
                        <div class="col-md-9">
                            {!! Form::hidden('user_id', null) !!}
                            {{ $pedido->usuarios()->get()[0]->nombre }} {{ $pedido->usuarios()->get()[0]->a_paterno }} {{ $pedido->usuarios()->get()[0]->a_materno }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-form col-md-3">Fecha de compra</label>
                        <div class="col-md-9">
                            {{ date_format($pedido->created_at, 'd/m/Y') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-form col-md-3">SubTotal</label>
                        <div class="col-md-9">                            
                            {!! Form::hidden('subtotal', null) !!}                            
                            {{ number_format($pedido->subtotal, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-form col-md-3">Gastos de envío</label>
                        <div class="col-md-9">
                            {!! Form::hidden('shiping', null) !!}                            
                            {{ number_format($pedido->shiping, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label-form col-md-3">Total</label>
                        <div class="col-md-9">                            
                            {{ number_format(($pedido->subtotal+$pedido->shiping), 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('estado_id', 'Estado', ['class'=>'label-form col-md-3']) !!}
                        <div class="col-md-6">
                            {!! Form::select('estado_id', $estados, null, ['class'=>'form-control', 'placeholder' => ' -- Seleccione --']) !!}
                        </div>
                    </div>
                    <div class="titulo-detalle"> 
                        <h3>Detalle del pedido</h3>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-striped mb-none">
                            <thead>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </thead>
                            <tbody>
                            @foreach($pedido->itemsOrden()->get() as $item)
                                <tr>
                                    <td class="col-img">
                                    @if(is_object($item->producto()->get()[0]->imagenes()->where('default', true)->first()))  
                                        <img src="{{ asset($item->producto()->get()[0]->imagenes()->where('default', true)->first()->url ) }}" class="img-grid"/>
                                    @else
                                        <a href="#"><i class="fa fa-image fa-2x"></i></a>
                                    @endif
                                    </td>
                                    <td class="col-cliente">{{ $item->producto()->get()[0]->nombre }}</td>
                                    <td class="col-precio">$ {{ number_format($item->precio, 0 , ',', '.') }}</td>
                                    <td class="col-cantidad">{{ $item->cantidad }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                {!! Form::close() !!}
                
                <form id="eliminar" method="post" action="/admin/pedidos/{{ $pedido->id}}">
                    <input type="hidden" name="_method" value="DELETE"/>
                    @csrf
                </form>

                <div class="row">
                    <div class="form-group buttons-group">
                        <button type="button" id="btnGrabar" class="btn btn-primary">Grabar</button>
                        <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                        <a href="/admin/pedidos" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>            
<!-- end: page -->

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/custom/carrito.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/productos.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/pedidos.css') }}">
@endsection

@section('script')
<script src="{{ asset('js/mantenedores/shared/form.js') }}"></script>
@endsection