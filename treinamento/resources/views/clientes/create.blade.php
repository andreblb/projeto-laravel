@extends('layouts.principal')

@section('titulo', 'Novo Cliente')

@section('conteudo')

<h3>Novo Cliente</h3>

<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <label>Nome </label><br>
    <input type="text" name="nome"><br>
    <input type="submit" value="Salvar">
</form>

@endsection
