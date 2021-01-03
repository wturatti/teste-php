@extends('layout')

@section('title', 'Clientes')

@section('top')

@endsection

@section('content')
    <div class="col-12 m-2">
        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-6">
                    <h5>Listagem de clientes</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="<?= url('/new'); ?>"><button class="btn btn-primary text-right">Novo cliente</button></a>
                </div>
                </div>
            </div>
            <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Nome</th>
                    <th>Data Nascimento</th>
                    <th>Sexo</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->data_nascimento}}</td>
                    <td>{{$cliente->sexo}}</td>
                    <td><a href="{{ route('cliente.show', $cliente->id) }}"><button class="btn btn-primary">Editar</button></a></td>
                    <td><a href="{{ url('/destroy', $cliente->id) }}"><button class="btn btn-danger">Excluir</button></a></td>
                </tr>
                @endforeach
            </table>
            </div>
        </div>
    </div>
    <div class="col-12 p-0">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}
            </div>
        @endif
    </div>
@endsection