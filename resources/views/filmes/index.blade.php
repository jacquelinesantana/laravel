<x-layout title="Filmes">
    <a href="/filmes/criar" class="btn btn-warning">Cadastrar novo filme</a>
    <ul>
        @foreach ($filmes as $filme)

        <li class="list-group-item"> {{$filme -> nome}} - {{$filme -> genero}} </li>
        @endforeach
    </ul>
</x-layout>