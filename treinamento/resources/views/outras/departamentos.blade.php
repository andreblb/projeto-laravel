@extends('layouts.principal')

@section('titulo', 'Departamento')

@section('conteudo')

<h3>Departamentos</h3>

<ul>
    <li>Computadores</li>
    <li>Eletronicos</li>
    <li>Acessorios</li>
    <li>Roupas</li>
</ul>

@component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'info'])

    <p><strong>Erro Insperado</strong></p>
    <p>Ocorreu um erro ao mosta a lista de produtos</p>

@endcomponent

@component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'error'])

    <p><strong>Erro Insperado</strong></p>
    <p>Ocorreu um erro ao mosta a lista de produtos</p>

@endcomponent

@component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'success'])

    <p><strong>Erro Insperado</strong></p>
    <p>Ocorreu um erro ao mosta a lista de produtos</p>

@endcomponent

@component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'warning'])

    <p><strong>Erro Insperado</strong></p>
    <p>Ocorreu um erro ao mosta a lista de produtos</p>

@endcomponent


@endsection
