@extends('layouts.principal')

@section('titulo', 'Clientes')

@section('conteudo')

<h1>{{ $titulo }}</h1>
<a href="{{ route('clientes.create') }}">Novo Cliente</a>

@if (count($clientes)>0)

<ul>
    @foreach ($clientes as $c)
    <li>
        {{ $c['id'] }}    |   {{ $c['nome'] }} |
        <a href="{{ route('clientes.edit', $c['id']) }}">Editar</a> |
        <a href="{{ route('clientes.show', $c['id']) }}">Info</a>   |
        <form action="{{ route('clientes.destroy', $c['id']) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Apagar">
        </form>
    </li>
    @endforeach
</ul>

@else

<h3>Não existe clientes cadastrados</h3>

@endif

@empty($clientes)
<h3>Não existe clientes cadastrados 2</h3>
@endempty

@endsection
