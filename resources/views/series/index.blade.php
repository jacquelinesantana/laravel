<x-layout title="Séries">
    <a href="/serie/criar" class="btn btn-warning">Cadastrar nova série</a>
    <ul>
        @foreach ($series as $serie)

        <li class="list-group-item"> {{$serie -> nome}} </li>
        @endforeach
    </ul>
</x-layout>