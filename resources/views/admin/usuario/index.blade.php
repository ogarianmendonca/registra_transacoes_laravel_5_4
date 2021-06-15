@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Listagem de Usuários</h2>
        </div>

        <div class="col-md-6 text-right">
            <ol class="breadcrumb">
                <li><a href="">Usuários</a></li>
                <li class="active">Listagem</li>
            </ol>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Data Criação</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($usuarios as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->format('d/m/Y')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection