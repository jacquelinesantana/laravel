<x-layout title="Séries">
    <a href="/series/create" class="btn btn-warning">Cadastrar nova série</a>
    <ul>
        @foreach ($series as $serie)

        <li class="list-group-item"> {{$serie}} </li>
        @endforeach
    </ul>
</x-layout>