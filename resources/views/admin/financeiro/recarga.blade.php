@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="page-header">Recarga</h2>
    </div>

    <div class="col-md-6 text-right">
        <ol class="breadcrumb">
            <li><a href="">Financeiro</a></li>
            <li><a href="{{ route('admin.financeiro') }}">Saldo</a></li>
            <li class="active">Recarga</li>
        </ol>
    </div>
</div>

@include('admin.includes.alerts')

<div class="row">
    <div class="col-md-6">
    {!! Form::open(['route' => 'admin.financeiro.recarregar']) !!}
        <div class="form-group">
            {{ Form::label('valor', 'Valor Recarga:', ['class' => 'control-label']) }}
            {{ Form::text('valor', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Recarregar', ['class' => 'btn btn-default']) }}
    {!! Form::close() !!}
    </div>
</div>

@endsection