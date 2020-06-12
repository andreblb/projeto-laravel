@extends('layouts.principal')

@section('titulo', 'Options')

@section('conteudo')
<div class="options">
    <ul>
        <li><a class="warning" href="{{ route('opcoes',1) }}">warning</a></li>
        <li><a class="info"    href="{{ route('opcoes',2) }}">info</a></li>
        <li><a class="success" href="{{ route('opcoes',3) }}">success</a></li>
        <li><a class="error"   href="{{ route('opcoes',4) }}">erro</a></li>
    </ul>
</div>

@if (isset($opcao))

    @switch($opcao)
        @case(1)
            @component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'warning'])
            <p><strong>Erro Insperado</strong></p>
            <p>Ocorreu um erro ao mosta a lista de produtos</p>
            @endcomponent
                @break
        @case(2)
            @component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'info'])
            <p><strong>Erro Insperado</strong></p>
            <p>Ocorreu um erro ao mosta a lista de produtos</p>
            @endcomponent
                @break
        @case(3)
            @component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'success'])
            <p><strong>Erro Insperado</strong></p>
            <p>Ocorreu um erro ao mosta a lista de produtos</p>
            @endcomponent
                @break
        @case(4)
            @component('components.alert', ['titulo'=>'Erro fatal', 'tipo'=>'error'])
            <p><strong>Erro Insperado</strong></p>
            <p>Ocorreu um erro ao mosta a lista de produtos</p>
            @endcomponent
                @break
    @endswitch
@endif

@endsection

