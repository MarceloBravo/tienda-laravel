@extends('layouts.admin')

@section('Content')

<header class="page-header">
    <h2>Movimientos</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.html">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Administración</span></li>
            <li><span>Pedidos</span></li>
        </ol>

    </div>
</header>

@include('includes.admin.messages')

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
        </div>

        <h2 class="panel-title">Pedidos</h2>
    </header>           
    <div class="panel-body">
        <div class="row form-group">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
                <form id="form-filtro" action="/admin/pedidos-filtro" method="POST">                        
                    @csrf
                    <input type="text" id="filtro" name="filtro" value="{{ $filtro }}" placeholder="Ingresa el texto a buscar" class="form-control"/>
                </form>
            </div>
        </div>
        <br/>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th width="10%">Ver</th>
                </tr>
            </thead>
            <tbody id="tbody">
            @foreach($pedidos as $item)
                <tr>
                    <td class="col-img col-cliente">
                    {{ $item->usuarios()->get()[0]->nombre }} {{ $item->usuarios()->get()[0]->a_paterno }} {{ $item->usuarios()->get()[0]->a_materno }}
                    </td>
                    <td class="col-fecha">{{ date_format($item->created_at,'d/m/Y') }}</td>
                    <td class="col-monto">$ {{ number_format($item->subtotal + $item->shiping, 0,',','.') }}</td>
                    <td class="col-estado">
                    {{ $item->estado()->get()[0]->nombre }}
                    </td>
                    <td class="col-editar">
                        <a href="/admin/pedidos/{{ $item->id }}/edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($pedidos) > 0)
            {{ $pedidos->links() }}
        @endif
    </div>
</section>
<!-- end: page -->

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/grid.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/productos-grid.css') }}" />
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/pedidos.css') }}" />
@endsection

@section('script')
<script src="{{ asset('admin/assets/vendor/select2/select2.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>

<script src="{{ asset('js/mantenedores/shared/grid.js') }}"></script>
@endsection