@extends('layouts.app')

@section('content')
    
    <div class="container text-center">
        <div class="page-header">
            <h1><i class="fa fa-user">Identificación de usuario</i></h1>
        </div>

        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="page">
                    <form method="POST" action="/auth/login">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="label-form col-md-2">Email</label>
                            <div class="col-md-10">
                                <input type="email" id="email" class="control-form col-md-12" placeholder="Correo electrónico"/> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label-form col-md-2">Password</label>
                            <div class="col-md-10">
                                <input type="password" id="password" class="control-form col-md-12" placeholder="Conraseña"/> 
                            </div>
                        </div>
                        <br/>
                        <div class="row div-btn-login">
                            <button id="btn-login" type="submit" class="btn btn-primary">Ingresar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection