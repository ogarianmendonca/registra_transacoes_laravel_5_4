@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2 class="page-header">Histórico</h2>
    </div>

    <div class="col-md-6 text-right">
        <ol class="breadcrumb">
            <li><a href="">Financeiro</a></li>
            <li class="active">Histórico</li>
        </ol>
    </div>
</div>

<br>

<div class="row">
    {!! Form::open(['route' => 'admin.financeiro.pesquisa-historico']) !!}
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('id', 'ID:', ['class' => 'control-label']) }}
                {{ Form::text('id', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('data', 'Data:', ['class' => 'control-label']) }}
                {{ Form::date('data', null, ['class' => 'form-control']) }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo:', ['class' => 'control-label']) }}
                {{ Form::select('tipo', $tipos, null, ['class' => 'form-control', 'placeholder' => 'Selecione...']) }} 
            </div>

            <div class="form-group text-right">
                <br>
                {{ Form::submit('Pesquisar', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    {!! Form::close() !!}
</div>


@include('admin.includes.alerts')

<br>

<table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Valor</th>
        <th>Saldo Anterior</th>
        <th>Saldo Atual</th>
        <th>Tipo de Transação</th>
        <th>Remetente</th>
        <th>Data Transação</th>
      </tr>
    </thead>
    <tbody>
        @foreach($historicos as $historico)
            <tr>
                <td>{{ $historico->id }}</td>
                <td>{{ number_format($historico->tot_quantia, 2, ',' , '.') }}</td>
                <td>{{ number_format($historico->tot_anterior, 2, ',' , '.') }}</td>
                <td>{{ number_format($historico->tot_depois, 2, ',' , '.') }}</td>
                <td>{{ $historico->tipo($historico->tp_transacao) }}</td>
                <td>
                    @if($historico->usuario_transferencia_id)
                        {{ $historico->user->name }}
                    @else
                     - 
                    @endif
                </td>
                <td>{{ $historico->dt_transacao }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if(isset($dados))
    {!! $historicos->appends($dados)->links() !!}
@else
    {!! $historicos->links() !!}
@endif

@endsection