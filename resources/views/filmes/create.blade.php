<x-layout title="Novo Filme">
    <form method="post" action="/filmes/salvar">
    @csrf
        <label for="nome"> Nome: </label>
        <input type="text" id="nome" name="nome">
        >
        <label for="genero"> Genêro: </label>
        <input type="text" id="genero" name="genero">
        <input  type="submit" value="Enviar"> 
    </form>
</x-layout>