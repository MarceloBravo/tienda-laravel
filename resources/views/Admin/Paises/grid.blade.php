@extends('layouts.admin')

@section('Content')

@include('includes.admin.page-header')

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
                <a href="/admin/paises/create" class="btn btn-primary">Nuevo</a>
            </div>
            <div class="col-md-6">
                <form id="form-filtro" action="/admin/paises-filtro" method="POST">                        
                    @csrf
                    <input type="text" id="filtro" name="filtro" value="{{ $filtro }}" placeholder="Ingresa el texto a buscar" class="form-control"/>
                </form>
            </div>
        </div>
        <br/>
        <table class="table table-bordered table-striped mb-none" id="datatable-default">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th width="10%">Editar</th>
                </tr>
            </thead>
            <tbody id="tbody">
            @foreach($paises as $item)                        
                <tr>
                    <td>{{ $item->nombre }}</td>
                    <td class="col-editar">
                        <a href="/admin/paises/{{ $item->id }}/edit"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($paises) > 0)
            {{ $paises->links() }}
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