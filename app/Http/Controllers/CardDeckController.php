<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mtgsdk\Card;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\CardDeck;
use App\Models\CadastroCards;
use DB;

class CardDeckController extends Controller
{
    function __construct()
    {
        // obriga estar logado;
        $this->middleware('auth');
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function index(Request $request)
	{

		$cardDeck = new CardDeck();
		$cardDeck->deck = $request->get("deck");
		$cardDecks = CardDeck::Where("deck", $request->get("deck"))->get();
		$card = new CadastroCards();
		$cards = CadastroCards::All();
		$cds = DB::table('card_deck')
            ->join('cadastro_card', 'cadastro_card.id', '=', 'card_deck.card')
            ->join('cadastrar_deck', 'cadastrar_deck.id', '=', 'card_deck.deck')
            ->select('cadastro_card.*', 'cadastrar_deck.id AS deck_id', 'card_deck.id AS card_deck_id')
            ->get();
		return view("decks.AdicionarCard", [
			"cardDeck" => $cardDeck,
			"cardDecks" => $cardDecks,
			"card" => $card,
			"cards" => $cards,
			"cds" => $cds,
		]);
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$cardDeck = $cardDeck::Find($request->get("id"));
		} else {
			$cardDeck = new CardDeck();
		}

		$cardDeck->deck = $request->get("deck");
		$cardDeck->card = $request->get("card");

		$cardDeck->save();

		$request->session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Card adicionado com sucesso!");

		return redirect()->action(
			[CardDeckController::class, "index"], [ "deck" => $request->get("deck") ]
		);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($card_deck, Request $request)
    {
        $cardDeck = CardDeck::find($card_deck);
		$deck = $cardDeck->deck;
		$cardDeck->delete();

		$request->session()->flash("status", "sucesso");
		$request->session()->flash("mensagem", "Card removido com sucesso!");

		return redirect()->action(
			[CardDeckController::class, "index"], [ "deck" => $deck ]
		);
    }

}
