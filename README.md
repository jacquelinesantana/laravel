# Laravel Crud completo

Nesse tutorial vou relatar os processos necessários para criar uma aplicação backend em Laravel e crud completo.

Para isso vou dar sequencia no projeto aqui disponível na branch introdução_laravel: https://github.com/jacquelinesantana/laravel/tree/introducao_laravel

## Camada de controle com melhorias

```
public function store(Request $request)
  {

     $nomeSerie = $request->nome;
     $serie = new Serie();
     $serie-> nome = $nomeSerie;
     $serie->save();

     return redirect('/serie');
  }
```

A primeira mudança para o método Store, que faz novo registro de séries no banco, é que estamos passando o parâmetro diretamente para o $nomeSerie, essa é também uma forma funcional de realizar essa ação. Mas ainda podemos diminuir esse código tornando ainda mais curto e assertivo, o Laravel possui um método de atribuição em massa. Imagine que estamos trabalhando com um formulário com vários campos que devem ser passados para o banco de dados.

Como fica essa forma de trabalho?

public function store(Request $request)
  {

     Serie::create($request->all());
    
     return redirect('/serie');
  }

O código acima faz o recebimento do objeto que vem do formulário e vai automaticamente atribuir os valores aos atributos, mas no entanto precisamos lembrar que o Laravel possui camada de segurança para evitar deixarmos o usuário inputar dados não permitidos, exemplo se auto nomear um adm do sistema, no caso de cadastro ou atualização dos dados de usuário. Então para tratar isso vamos ter que alterar a Model da Serie



