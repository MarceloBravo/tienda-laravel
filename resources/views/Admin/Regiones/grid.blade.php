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
            <li><span>Administración</span></li>
            <li><span>{{ $pantalla }}</span></li>
        </ol>

    </div>
</header>

@include('includes.admin.messages')
<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="panel-actions">
        </div>

        <h2 class="panel-title">{{ $pantalla }}</h2>
    </header>           
    <div class="panel-body">
        <div class="row form-group">
            <div class="col-md-6">
                <a href="/admin/regiones/create" class="btn btn-primary">Nuevo</a>
            </div>
            <div class="col-md-6">
                <form id="form-filtro" action="/admin/regiones-filtro" method="POST">                        
                    @csrf
                    <input type="text" id="filtro" name="filtro" value="{{ $filtro }}" placeholder="Ingresa el texto a buscar" class="form-control"/>
                </form>
            </div>
        </div>
        <br/>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th>Región</th>
                    <th>Pais</th>
                    <th width="10%">Editar</th>
                </tr>
            </thead>
            <tbody id="tbody">
            @foreach($regiones as $item)                        
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->pais()->get()[0]->nombre }}</td>
                    <td class="col-editar">
                        <a href="/admin/regiones/{{ $item->id }}/edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($regiones) > 0)
            {{ $regiones->links() }}
        @endif
    </div>
</section>
<!-- end: page -->

@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
<link rel="stylesheet" href="{{ asset('css/admin/mantenedores/grid.css') }}"/>
@endsection

@section('script')
<script src="{{ asset('admin/assets/vendor/select2/select2.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
<script src="{{ asset('js/mantenedores/shared/grid.js') }}"></script>
@endsection