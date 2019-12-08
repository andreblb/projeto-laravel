<h3>{{$titulo}}</h3>
<br>

<a href="{{route('clientes.create')}}">novo cliente</a>
<ul>
  @foreach ($clientes as $c)
      <li>
        {{$c['id']}} - {{$c['nome']}}
        <a href="{{route('clientes.edit', $c['id'])}}">editar</a>|
        <a href="{{route('clientes.show', $c['id'])}}">info</a>|
        <form action="{{route('clientes.destroy', $c['id'])}}" method="POST">
          @csrf
          @method('DELETE')
          <input type="submit" value="Apagar">

        </form>
      </li>
  @endforeach

</ul>
