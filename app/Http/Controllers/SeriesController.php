<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    //método que retorna uma série cadastrada
    public function index(Request $request){
        
        $series = Serie::query()->orderBy('nome', 'desc')->get();
        return view('series.index') -> with ('series', $series);
    }
    public function create(){
        return view('series.create');
    }
    //metodo que cadastra novas séries
    public function store(Request $request)
    {
        Serie::create($request->all());

        return redirect('/serie');

    }


}
