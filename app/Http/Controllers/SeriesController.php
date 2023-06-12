<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    //
    public function index(Request $request){
        //return $request->get('id'); // retorna o ID enviado na requisição
        
        //return $request->url(); // retorna a url da requisição
        //return  $request->method(); // retorna o verbo da requisição
        
        //return response('',302,['Location' => 'https://google.com']); // redireciona para o google
        //return redirect('https://google.com');//redireciona para o google

        $series = [
            'Punisher',
            'Lost',
            'Grey\'s  Anatony'
        ];
        /* $html = '<ul>';
        foreach ($series as $serie){
            $html .= "<li> $serie</li>";
        }
        $html .= '</ul>';
        //return $html;
        
        return $html; */

        //arquivo atualizado trazendo o arquivo da view
        return view('series.index') -> with ('series', $series);

        //não é a forma mais indicada de se manipular, apenas para entendimento
    }
    public function create(){
        return view('series.create');
    }
    public function store (Request $resquest)
{
	$nomeSerie = $request->input("nome");
	if(DB::insert('INSERT INTO series (nome) VALUES (?)', [$nomeSerie]))
	{
		return 'ok';
	}
	else
	{
		return 'Deu ruim';
	}
}
}
