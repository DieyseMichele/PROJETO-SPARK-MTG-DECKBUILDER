<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CadastrarDeck;
use Illuminate\Support\Facades\DB;

class OrdenacaoController extends Controller
{
    public function ordenacaoDeck(Request $request) 
	{
		$ordenacao = $request->get("ordenacao");
		if ($ordenacao == "") $ordenacao = "0";
		
		if ($ordenacao == "0") {
			$decks = DB::table("cadastrar_deck")->simplePaginate(3);
		} else if ($ordenacao == "1") {
			$decks = DB::table("cadastrar_deck")->orderBy("name")->simplePaginate(3);
		} else if ($ordenacao == "2") {
			$decks = DB::table("cadastrar_deck")->orderBy("formato")->simplePaginate(3);
		} else {
			$decks = DB::table("cadastrar_deck")->simplePaginate(3);
		}

        return view("decks.DecksCadastrados", [
			"deck" => $deck,
			"decks" => $decks
		]);
	}
}
