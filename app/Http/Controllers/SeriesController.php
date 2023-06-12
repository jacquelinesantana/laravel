<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    //
    public function index(Request $request){
        //return $request->get('id'); // retorna o ID enviado na requisição
        
        //return $request->url(); // retorna a url da requisição
        //return  $request->method(); // retorna o verbo da requisição
        
        //return response('',302,['Location' => 'https://google.com']); // redireciona para o google
        //return redirect('https://google.com');//redireciona para o google

        // $series = [
        //     'Punisher',
        //     'Lost',
        //     'Grey\'s  Anatony'
        // ];
        //Series do bando de dados
            //$series = DB::select('SELECT nome FROM series;');
            //dd($series); //Faz a mesma ação do VarDump exibe o conteúdo do array que vem do banco 
        /* $html = '<ul>';
        foreach ($series as $serie){
            $html .= "<li> $serie</li>";
        }
        $html .= '</ul>';
        //return $html;
        
        return $html; */

        //arquivo atualizado trazendo o arquivo da view

        $series = Serie::query()->orderBy('nome', 'desc')->get();
        return view('series.index') -> with ('series', $series);

        //não é a forma mais indicada de se manipular, apenas para entendimento
    }
    public function create(){
        return view('series.create');
    }
    public function store(Request $request)
    {
        $nomeSerie = $request->input("nome");
        /* PASSANDO O SQL PARA INSERIR DADOS NO BANCO
        
        if(DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]))
        {
            return redirect('/serie');
        }
        else
        {
            return 'Deu ruim';
        }  */
        $serie = new Serie();
        $serie-> nome = $nomeSerie;
        $serie->save();

        return redirect('/serie');

    }


}
