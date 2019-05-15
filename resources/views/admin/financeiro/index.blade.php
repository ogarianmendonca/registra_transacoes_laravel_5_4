@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="page-header">Saldo</h2>
    </div>

    <div class="col-md-6 text-right">
        <ol class="breadcrumb">
            <li><a href="">Financeiro</a></li>
            <li class="active">Saldo</li>
        </ol>
    </div>
</div>

@include('admin.includes.alerts')

<div class="row">
    <div class="col-md-6">
        <a href="{{ route('admin.financeiro.recarga') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Recarregar</a>
        
        @if($saldo_total > 0)
            <a href="{{ route('admin.financeiro.saque') }}" class="btn btn-danger"><i class="fas fa-minus"></i> Sacar</a>
        
            <a href="{{ route('admin.financeiro.transfere') }}" class="btn btn-info"><i class="fas fa-exchange-alt"></i> Transferir</a>
        @endif
    </div>
</div>

<br>

<div class="panel panel-default">
    <div class="panel-heading" style="background: #4bad68;">
        <div class="row">
            <div class="col-md-8">
                <h2 style="color: white;">R$ {{ number_format($saldo_total, 2, ',', '') }}</h2>
            </div>

            <div class="col-md-4 text-right">
                <i class="far fa-money-bill-alt icone-dinheiro"></i>
            </div>
        </div>
    </div>
    <div class="panel-body text-center">
        <a href="{{ route('admin.financeiro.historico') }}">Histórico <i class="far fa-arrow-alt-circle-right"></i></a>
    </div>
</div>

@endsection