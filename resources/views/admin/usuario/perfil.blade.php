@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="page-header">Editar Perfil</h2>
    </div>

    <div class="col-md-6 text-right">
        <ol class="breadcrumb">
            <li><a href="">Usuários</a></li>
            <li class="active">Editar Perfil</li>
        </ol>
    </div>
</div>

@include('admin.includes.alerts')

{!! Form::open(['route' => 'admin.usuario.editar-perfil', 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <img src="{{ asset('storage/users/' . auth()->user()->imagem) }}" class="img-perfil" style="width: 20%">
                <br>
                
                {{ Form::label('imagem', 'Imagem:', ['class' => 'control-label']) }}
                {{ Form::file('imagem', ['class' => 'form-control']) }} 
            </div>
        </div>
    </div>    
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('name', 'Nome:', ['class' => 'control-label']) }}
                {{ Form::text('name', auth()->user()->name, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'E-mail:', ['class' => 'control-label']) }}
                {{ Form::email('email', auth()->user()->email, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('perfil_id', 'Perfil:', ['class' => 'control-label']) }}
                {{ Form::select('perfil_id', $perfis, auth()->user()->perfil_id, ['class' => 'form-control', 'placeholder' => 'Selecione...']) }} 
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Senha:', ['class' => 'control-label']) }}
                {{ Form::password('password', ['id' => 'password', "class" => "form-control"]) }}
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="form-group text-right">
            <br>
            {{ Form::submit('Salvar', ['class' => 'btn btn-primary']) }}
        </div>
    </div>

{!! Form::close() !!}

@endsection