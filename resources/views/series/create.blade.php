<x-layout title="Nova série">
    <form method="post" action="/serie/salvar">
    @csrf
        <label for="nome"> Nome: </label>
        <input type="text" id="nome" name="nome">
        <input  type="submit" value="Enviar"> 
    </form>
</x-layout>