

# PHP Laravel - versão em desenvolvimento e análise

Este documento destina-se a orientar como criar os primeiros projetos em Laravel PHP de maneira objetiva e prática.

Nos próximos passos vamos criar uma aplicação com MVC.

As vantagens de se utilizar esse Framework são muitas, entre elas é ter em mãos uma ferramenta que facilita muito a escrita de códigos já que muita coisa já vem pronto e não precisaremos, por exemplo escrever todas as consultas do banco. Laravel é uma ferramenta com ampla biblioteca de funcionalidades pré-programadas para diversos fins, tais como:

- Autenticação
- Roteamento
- Modelos HTML
- Permite escrita de Back end API
- Permite escrita de um sistema FullStack (front e back end)
- Permite controle de versão de banco de dados através de Migrações
- Permite separar a lógica do HTML
- Permite uso de sessões
- Torna simples a validação de dados
- Facilita o tratamento de erros
- Suporta testes unitários

## Instalação do Laravel

### Requisitos 

Para utilização do Laravel precisamos ter alguns requisitos que vamos conhecer a seguir:

- PHP instalado na máquina 
- Banco de dados Mysql
- Composer instalado na máquina

### Instalação

Segundo a documentação no link:https://laravel.com/docs/10.x , podemos iniciar através do composer, caso não tenho o mesmo vc pode acessar o site: https://getcomposer.org/Composer-Setup.exe

Já no composer vamos digitar a linha de comando, vale lembrar que o código a seguir foi digitado após eu já estar dentro da pasta onde desejo criar meu projeto:

```
composer create-project laravel/laravel nome-aplicacao
```

> Caso seja necessário, você também pode criar uma aplicação em uma versão anterior do Laravel usando a linha de comando a baixo, obs: onde coloquei 9 você indicará a versão desejada do Laravel.

```
composer create-project laravel/laravel nome-aplicacao ^9
```

![Imagem da aplicação sendo criada](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230428124913336.png)

Após todo processo de processamento e download das dependências e estrutura do projeto, você já pode executar o projeto para validar se o mesmo esta rodando corretamente:

```
php artisan serve --host=0.0.0.0 --port=8000
```

 Uma vez em execução o projeto podemos abrir uma aba do navegador e acessar o mesmo através da URL: 

http://localhost:8000/

> Um detalhe importante, sempre que for iniciar o projeto com o comando *php artisan serve*, certifique de estar dentro do diretório do projeto correto.

## Primeira configuração de rota

Para configurar uma nova rota para sua aplicação você deve acessar o diretório routes, dentro do seu projeto. O Arquivo web.php dispõem da primeira rota, mas podemos incluir para esse arquivo as rotas necessárias.

```
<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});
```

Entendendo o código do arquivo web.php

```
<?php 
```

inicia o arquivo, tag para arquivos do tipo php

```
use Illuminate\Support\Facades\Route;
```

inclui no projeto, a biblioteca de rotas, route

```
Route::get('/', function () {
```

Com a biblioteca Route, método de acesso GET definimos a rota /

```
return view('welcome');
```

aqui indica o que a função deve retornar, no caso o Welcome

```
});
```

finalizando a função

Acabamos de ver a rota que já vem definida na aplicação Laravel, agora vamos escrever uma nova rota:

```
Route::get('/ola', function(){
  echo 'Olá mundo';
});
```

O código acima indica, uma rota que faz uso da biblioteca Route, passa o método de acesso GET e a rota /ola para escrever na tela o resultado "Olá mundo", em seguida a função é finalizada.

Para ver o resultado da função acima você pode salvar o arquivo e acessar a rota: http://localhost:8000/ola

Essa primeira função foi para poder entender melhor essa estrutura e como ela vai ajudar a compor novas rotas na nossa aplicação, mas a seguir criaremos novas rotas funcionais dentro da mesma.

### Criar nova rota para Controlle

Criar nova controller:

1. No console digitar a linha de comando:

```
php artisan make:controller SeriesController
```

Com o comando make:controller vamos criar uma classe SeriesController dentro do pacote controller que fica em app->http->controller

2. Código a seguir deve ser criado dentro desse controller

Código da classe:

```
public function listarSeries(){

    $series = [
        'Punisher',
        'Lost',
        'Grey\'s  Anatony'
    ];
    $html = '<ul>';
    foreach ($series as $serie){
    	$html .= "<li> $serie</li>";
    }
    $html .= '</ul>';
    echo $html;
//não é a forma mais indicada de se manipular, apenas para entendimento
}
```

3. Chamar a controller para executar dentro do arquivo web.php

```
Route::get('/serie', [SeriesController::class, 'listarSeries']);
```

> não esquecer de importar essa nova classe para o funcionamento da mesma.

A URL consumida para apresentar essa nova funcionalidade deve ser: http://localhost:8000/serie

![código da classe SeriesController - fins educativos e entendimento da controller](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230503235529734.png)

> Lembrando que para ver os comandos disponíveis, você pode digitar em seu terminal o comando :

```
php artisan
```

Vale lembrar também que esse código acima pode ser melhorado utilizando-se das boas práticas indicadas na própria documentação do Laravel. Link: https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controller

Existem alguns nomes sugeridos para as funções criadas nessa classe, assim como o verbo http e também a rota. Tudo isso para melhorar ainda mais a experiência da pessoa desenvolvedora, padronizar aplicações e facilitar as futuras manutenções para esses códigos.

Conforme a tabela a seguir podemos ver que para o verbo GET que tem como objetivos exibir dados, retornar resultados de buscas... Temos a sugestão de URI, action e route name. Sendo assim,  vamos reescrever a classe SerieController para torna-lá adequada a esses padrões.

| Verb      | URI                    | Action  | Route Name     |
| --------- | ---------------------- | ------- | -------------- |
| GET       | `/photos`              | index   | photos.index   |
| GET       | `/photos/create`       | create  | photos.create  |
| POST      | `/photos`              | store   | photos.store   |
| GET       | `/photos/{photo}`      | show    | photos.show    |
| GET       | `/photos/{photo}/edit` | edit    | photos.edit    |
| PUT/PATCH | `/photos/{photo}`      | update  | photos.update  |
| DELETE    | `/photos/{photo}`      | destroy | photos.destroy |


    public function index(){
    
    $series = [
        'Punisher',
        'Lost',
        'Grey\'s  Anatony'
    ];
    $html = '<ul>';
    foreach ($series as $serie){
    	$html .= "<li> $serie</li>";
    }
    $html .= '</ul>';
    echo $html;
    //não é a forma mais indicada de se manipular, apenas para entendimento
    }

A alteração também será aplicada dentro da rota, arquivo routers/web.php:

```
Route::get('/serie', [SeriesController::class, 'index']);
```

> Note que ajustamos o nome da função conforme o informado na documentação, coluna Action.

Caso já queira criar uma controller que fará uso de todos esses Verbos e ações, podemos faze-lo de forma mais sucinta através da linha de comando: 

```
php artisan make:controller FilmesController --resource
```

O resultado esperado é o que apresenta-se na imagem a seguir:

![Classe FilmesController criada com sucesso](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230504011219262.png)

Conforme é possível acompanhar na imagem os métodos foram criados com os nomes que se vimos na documentação oficial do Laravel, agora basta completar com as ações de cada um deles. Junto a cada um desses também podemos ver uma breve anotação dizendo a sua finalidade dentro do código.

Note que já foi incluída em nossa classe controller a classe Request, linha 5 da imagem. Trata-se de uma classe específica para trabalhar com os dados enviados em requisições. Isso impacta na entrega de respostas HTTP, por exemplo ou até mesmo retorno de imputs de um formulário que tenha sido enviado a esta requisição.

#### Trabalhando a Controller com Requisições passando parâmetros

Apenas relembrando que para algumas requisições pode ser importante passar parâmetros para a consulta, por exemplo um ID ou um valor para gerar resultados filtrados dos dados de um banco de dados por exemplo, vamos usar alguns exemplos nesse sentido.

Para isso vamos usar da Biblioteca Illuminate\Http a classe Request, vamos realizar alguns testes para entender como funciona o Request e algumas funções que ele tem.

Para ver o resultado, verifique no seu navegador após a implementação de cada uma das alterações do código, vamos usar a SerieController para esse exercício:

```
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
  //

  public function index(Request $request)
  {
    return $request->get('id'); // retorna o ID enviado na requisição

  }
}
```
resultado:

![resultado do $request->get('id')](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230521222707141.png)


```
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
  //

  public function index(Request $request)
  {
    return $request->url(); // retorna a url da requisição

  }
}
```
resultado:

![resultado do $request->url](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230521222523003.png)


```
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
  //

  public function index(Request $request)

{
    return  $request->method(); // retorna o verbo da requisição

  }
}
```
resultado:

![resultado a função $request->method()](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230521222409577.png)

## Separar o HTML da Controller 

A seguir vamos conhecer a função response, que tem como objetivo retornar um objeto de tipo response com o corpo, status e cabeçalhos.

Arquivo de Series html fica com nome listar-series.php

```
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Séries</title>
</head>

<body>
  <h1>Séries</h1>
  <ul>
​    <?php foreach($series as $serie): ?>
​    <li> <?= $serie; ?> </li>
​    <?php endforeach; ?>
  </ul>

</body>
</html>
```

Arquivo controller ficará:

```
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

  //
  public function index(Request $request){

​    $series = [
​      'Punisher',
​      'Lost',
​      'Grey\'s  Anatony'
​    ];

​    //arquivo atualizado trazendo o arquivo da view
​    return view('listar-series', ['series' => $series]);

  }
}
```

As mudanças aplicadas ao código teve o objetivo de tornar o mesmo mais organizado, separando o backend do front(HTML), essa é uma boa prática, já que torna as manutenções futuras menos confusas. 

Para o arquivo SeriesController, podemos ainda substituir a linha do `return view('listar-series', ['series' => $series]);` por `return view('listar-series', compact('series'));`e ainda ter o mesmo resultado.

### Blade PHP

Blade é um componente que ajuda a criar componentes Views.
Vantagens:

1. pode remover o<?php do php subistituindo para @ exemplo:

   - `@foreach($series as $serie`) e `@endforeach`
2. você pode deixar declarar o echo de maneira mais reduzida através do {{ $valor }} para printar variáveis
   - {{$serie}}

Exemplo do código reescrito com blade o arquivo se chamará  listar-series.blade.php:

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Séries</title>
</head>

<body>
  <h1>Séries</h1>  

  <ul>
​    @foreach ($series as $serie)
​    <li> {{$serie}} </li>
​    @endforeach
  </ul>
</body>
</html>
```

Também podemos reescrever a controller passando um código mais simples de entender ficando:

Para saber mais sobre o blade documentação: https://laravel.com/docs/5.1/blade

Ainda podemos usar no blade estruturas de laço de repetição, decisão e estruturar o layout, vale apena ler a documentação que é bem simples.

#### Criar Layout com blade

A primeira coisa que precisamos definir quando utilizamos o blade para criar o layout é que vamos agora organizar nossas paginas com nome padronizado assim como os componentes, para uma pagina do index, nosso arquivo vai se chamar index.blade.php. **Como vamos ter certamente mais de um arquivo index, vamos organiza-los em diretórios. No caso das séries teremos um diretório series, dentro desse teremos o arquivo listar-series que será renomeado para index.blade.php**

Feita essa mudança na estrutura e nome do arquivo, vamos mudar o controler, SeriesController indicando a pasta e arquivo da seguinte forma: 

```
return view('series.index') -> with ('series', $series);
```

Acima vimos que passamos nome da pasta ponto(.) nome do arquivo.

```
return view ('pasta.arquivo')...
```

Outra coisa interessante aqui é o uso de componentes que te ajudará a reutilizar estruturas de páginas e evitar reescrever tudo do início a cada nova página.

#### Componentes

Dentro da pasta View vamos adicionar uma pasta com nome components onde vamos armazenar a estrutura de pagina a ser utilizada. 

Sendo assim, vamos adicionar nosso layout dentro da pasta components, a estrutura dele ficará assim:

arquivo layout.blade.php

<!DOCTYPE html>

```
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>{{$title}}</title>

</head>
<body>
  <h1>{{$title}}</h1>

  {{$slot}}

</body>
</html>
```

Onde temos a variável $title vamos definir no arquivo index o título e o $slot será o corpo da nossa requisição, falando nela o arquivo index.blade.php, ficará assim:

```
<x-layout title="Séries">
  <ul>
​    @foreach ($series as $serie)
​    <li> {{$serie}} </li>
​    @endforeach
  </ul>
</x-layout>
```

Linha 1 - definimos o título, onde no componente for chamada a variável Title será recebido o valor de title = Séries

Linha 2 - a tag <x-layout... diz respeito ao nome do componente que é Layout, assim para componente com nome formulario utilizaremos tag x-formulario.

Ainda podemos separar esses componentes em pastas, exemplo forms/input.blade.php que ficaria com a tag <x-forms.input usando o ponto como separador da pasta e arquivo.

> **Atenção:**
> Os components podem ser criados por linha de comando através do comando:

```
php artisan make:component NomeDoComponente -view
```

O nome do componente seguindo o padrão deve ser iniciado com letra maiúscula, não ter acentos ou caracteres especiais.

documentação para components: https://laravel.com/docs/9.x/blade#components

Outra coisa que devemos ter em mente é que o uso da Blade nos ajuda a prevenir ataques do tipo XSS que é quanto é passado algum script malicioso para o site através de formulários por exemplo.

Além disso se você precisar passar um valor do tipo {{ texto }} onde texto não é uma constante e sim apenas pretende printar na tela como texto as chaves e o texto você pode usar o @ antes desse valor ficando: @{{ texto }}

##### Trabalhando com JS e PHP no Blade

Para passar um valor do PHP para um Script Javascript podemos fazer da seguinte forma:

<script>
    const series = {{ JS::from($series)}}
</script>
o JS::from garante que o valor da variável $series não chegue com os caracteres especiais convertidos para html.

> Sobre ataques XSS:
>
> O Blade nos protege contra esse tipo de ataque, este funciona injetando script e nosso website, um script Javascript pode redirecionar dados da sua página para um invasor ou realizar qualquer evento não esperado. uma solução seria pegar a saída de dados em colocar esta entre a função htmlentities() que no PHP faz a tratativa dos caracteres de script sejam convertidos para HTML. Dessa forma um Script Javascript passa a ser apenas um texto. Para filtrar a entrada tbm podemos usar no PHP a função filter_input(), ficaria: filter_input(INPUT_POST, 'variavelComDados', FILTER_SANITIZE_STRING), essa função pegaria sua variável e trataria tirando caracteres e possíveis scripts maliciosos, removendo tags e aspas.
>
> 



## Criar estrutura para cadastro de novas séries

Para termos a funcionalidade de cadastro de novas séries vamos adicionar um arquivo **create.blade.php** no diretório **view/series** e definir a rota para esta nova pagina, abaixo segue o código com formulário simples:

```
<x-layout title="Nova série">
  <form action="" method="post">
​    <label for="nome"> Nome: </label>
​    <input type="text" id="nome" name="nome">
  </form>
</x-layout>
```

> Recapitulando, a linha com a tag x-layout é para indicar que essa estrutura deve vir dentro do nosso modelo Layout, e com Title Nova série, o restante é uma estrutura HTML simples de formulário.

A primeira parte, que foi criar o arquivo já esta finalizado, agora vamos criar a rota para esse arquivo poder ser executado no navegador, as linhas a seguir vão ser inseridas no arquivo **routes/web.php**:

```
Route::get('/serie/criar', [SeriesController::class, 'create']);
```

Basicamente a linha acima esta apontando uma url que deve ser passada no navegador **/serie/criar** para chegar ao objetivo, formulário de cadastro de uma nova série.

Próximo passo agora será definir na controller para que ela retorne essa view. Lembre-se que a controller controla a ação para cada rota.

Sendo assim, vamos adicionar a função a seguir dentro do arquivo **SeriesController** :

```
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SeriesController extends Controller
{  
  public function index(Request $request){
​    $series = [
​      'Punisher',
​      'Lost',
​      'Grey\'s  Anatony'
​    ];

​    return view('series.index') -> with ('series', $series);
 }
//a função abaixo defini que o retorno deve ser o arquivo create que esta dentro do diretorio series
  public function create(){
​    return view('series.create');
  }

}
```

Testando o formulário:

Se tudo deu certo até aqui você poderá acessar o formulário, ainda sem ação de cadastrar através da URL: http://localhost:8000/serie/criar



![image-20230603161531594](C:\Users\tijac\AppData\Roaming\Typora\typora-user-images\image-20230603161531594.png)

### Laravel Mix

Para uso dessa, precisaremos do Node instalado na máquina, com esse pacote teremos muito mais facilidades em usar e gerenciar as dependências necessárias para o desenvolvimento front do projeto. 

Para instalação desse recurso vamos executar o comando, no terminal dentro da pasta do projeto:

```
npm install

npm install laravel-mix --save-dev

//detro da raiz do projeto, criar um arquivo: webpack.mix.js com o código abaixo
const mix = require('laravel-mix');
```

Para a versão 9 Laravel, tivemos uma atualização onde o Mix foi substituído pela ferramenta Vite. 

Além disso, no arquivo package.json vamos incluir a linha "mix": "mix", o resultado final será:

```json
{
    "private": true,
    "scripts": {
        "dev": "vite",
        "build": "vite build",
        "mix": "mix"
    },
    "devDependencies": {
        // Dependências aqui
    }
}
```

Após todas essas alterações vamos executar o projeto com: `npm run dev`

O Laravel Mix apesar de ser recomendado pela equipe Laravel, é um pacote Javascript.

###  Instalando o Bootstrap

Para instalação do pacote Bootstrap no nosso projeto, vamos executar no terminal, ainda dentro do diretório do projeto o comando:

```
npm install bootstrap
```

Agora vamos importar as estilizações do bootstrap para o nosso projeto com a seguinte ação: vamos abrir o arquivo resources/css/app.css a linha: `@import "~bootstrap/scss/bootstrap";`

Também precisamos **renomear o arquivo app.css para app.scss.**

Configuração do nosso arquivo webpack.mix.js também precisa ser alterada e vamos adicionar as seguintes linhas para o mesmo: 

```
mix

.sass('resources/css/app.scss', 'public/css')

.js('resources/js/app.js', 'public/js');
```

> Nas linha acima estamos indicando o caminho do nosso arquivo css e onde ele será replicado, no caso na public/css, o mesmo para o javascript que vem da resources/js/app.js e será replicado para o public/js

## Configurações do projeto Laravel

No diretório Config do projeto podemos ver vários arquivos de configuração do projeto, mas o arquivo app.php esta recheado com as configurações do projeto, incluindo a informação de versão do projeto, se o mesmo esta em fase de desenvolvimento ou em produção. Autenticação também esta nesse arquivo.

Vamos então, no arquivo **database.php**, nele vamos  utilizar SQLite, para isso então vamos seguir os seguintes passos: para a linha 41 do código, temos que o arquivo com dados de conexão com o novo banco de dados fica em um arquivo chamado: **database.sqlite** então vamos criar o mesmo dentro do diretório database.

> OBS as alterações a seguir de mysql para sqlite é para o caso de desejar usar o banco de dados sqlite, mas poderia dar sequencia no projeto utilizando o MYSQL mesmo normalmente.

Vamos tomar o devido cuidado para não informar dados seguros do banco de dados para esse arquivo, vamos fazer isso via Variáveis de Ambiente** no arquivo .env, este não será enviado para o seu versionador/Github, vamos alterar a linha 11 do arquivo .env e mudar onde esta `DB_CONNECTION=mysql` para `DB_CONNECTION=sqlite`. Vamos também **remover** o trecho a seguir desse arquivo:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Agora vamos utilizar o Laravel para criar a estrutura do banco de dados.

### Criando estrutura do banco de dados

Quando falamos de banco de dados em um projeto Laravel, o mesmo possui alguns recursos para facilitar a vida da pessoa desenvolvedora, entre eles: no diretório **database/seeders** - podemos criar alguns dados para teste da sua aplicação, exemplo usuario padrão com permissões no sistema. Em **database/factories** - podemos criar dados falsos para teste apenas. 

Já em **database/migrations** conseguimos criar versões do banco de dados que real da aplicação, com as estruturas das tabelas e tudo que for necessário para o funcionamento do sistema. Ele é basicamente um versionamento do seu banco de dados.

Para criar nosso arquivo Migrations para o sistema de controle de series, vamos no terminal executar o seguinte comando:

```
$ php artisan make:migration create_series_table
```

A linha de comando acima indica que o php artisan vai gerar o arquivo do tipo migration com nome create_series_table

Teremos para esse arquivo a seguinte estrutura de código:

```
public function up(): void
{
    Schema::create('series', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
    });
}
```

O código acima já indica que essa tabela criada vai ter um campo de ID, vamos incluir então os demais campos/ atributos:

```
$table->string('nome', 128);
```

Após incluir os campos necessários, acima incluimos o campo nome com tamanho 128 caracteres e formato string, vamos executar o comando para essa estrutura ser adicionada no seu SQLite:

```
$ php artisan migrate
```

ao executar o comando vamos ter o seguinte resultado: no arquivo database.sqlite vai ser adicionado todos os SQL para criar as tabelas necessárias para o sistema e incluindo a tabela series com o campo nome e id, resultado do arquivo migrate que criamos:

```
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

  /**
   \* Run the migrations.
   */

  public function up(): void
  {
    Schema::create('series', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('nome', 128);
    });
  }

  /**
   \* Reverse the migrations.
   */

  public function down(): void
  {
    Schema::dropIfExists('series');
  }
};
```

#### Persistir dados do formulário para o banco de dados 

