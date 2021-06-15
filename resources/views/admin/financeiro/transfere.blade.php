@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Transferir (Informe o recebedor)</h2>
        </div>

        <div class="col-md-6 text-right">
            <ol class="breadcrumb">
                <li><a href="">Financeiro</a></li>
                <li><a href="{{ route('admin.financeiro') }}">Saldo</a></li>
                <li class="active">Transferir</li>
            </ol>
        </div>
    </div>

    @include('admin.includes.alerts')

    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['route' => 'admin.financeiro.transferir']) !!}
            <div class="form-group">
                {{ Form::label('tranferir', 'Nome ou E-mail:', ['class' => 'control-label']) }}
                {{ Form::text('tranferir', null, ['class' => 'form-control', 'placeholder' => 'Informe quem vai receber a tranferencia (nome ou e-mail)']) }}
            </div>

            {{ Form::submit('Próxima Etapa', ['class' => 'btn btn-default']) }}
            {!! Form::close() !!}
        </div>
    </div>
@endsection