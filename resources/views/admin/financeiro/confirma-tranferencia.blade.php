@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="page-header">Confirmar Transferencia</h2>
    </div>

    <div class="col-md-6 text-right">
        <ol class="breadcrumb">
            <li><a href="">Financeiro</a></li>
            <li><a href="{{ route('admin.financeiro') }}">Saldo</a></li>
            <li class="active">Confirmar Transferencia</li>
        </ol>
    </div>
</div>

@include('admin.includes.alerts')

<div class="row">
    <div class="col-md-6">

    <strong>Saldo Atual: {{ number_format($saldo->tot_quantia, 2, ',', '.') }}</strong><br>
    <strong>Para: {{ $usuario->name }}</strong>

    {!! Form::open(['route' => 'admin.financeiro.confirmar-tranferir']) !!}
        {{ Form::hidden('id_usuario_destino', $usuario->id) }}

        <div class="form-group">
            {{ Form::label('valor', 'Valor da transferencia:', ['class' => 'control-label']) }}
            {{ Form::text('valor', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Confirmar', ['class' => 'btn btn-default']) }}
    {!! Form::close() !!}
    </div>
</div>

@endsection