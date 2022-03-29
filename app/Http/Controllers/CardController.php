<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserCollection;
use App\Models\CadastroCards;
use App\Models\CardDeck;
use mtgsdk\Card;

class CardController extends Controller
{
    public function __construct() {
		$this->middleware("auth");
	}//valida se o usuario está logado
	
    public function index()
    {	
        $card = new CadastroCards();
		$cards = CadastroCards::All();
        return view("cards.CardsUnimagic", [
			"card" => $card,
			"cards" => $cards
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
			$card = CadastroCards::Find($request->get("id"));
		} else {
			$card = new CadastroCards();
		}        
		
		$card->id_api = $request->get("id_api");
		$card->name = $request->get("name");
		$card->imageUrl = $request->get("imageUrl");
		$card->manaCost = $request->get("manaCost");
		$card->rarity = $request->get("rarity");
		$card->colors = $request->get("colors");
		$card->quantidade = $request->get("quantidade");
		$card->disponivel = $request->get("disponivel");
		
	
	
		$card->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Card salvo com sucesso!");
		
		return redirect("\cardUnimagic");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
		
		$card = new CadastroCards();
		$cards = CadastroCards::All();
        return view("cards.CardsUnimagic", [
			"card" => $card,
			"cards" => $cards
		]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = CadastroCards::Find($id);
		$cards = CadastroCards::All();
        return view("cards.editarCardUnimagic", [
			"card" => $card,
			"cards" => $cards
		]); 
		
    }

	public function searchCard(Request $request){
		// Get the search value from the request
		$search = $request->input('search');

		// Search in the title and body columns from the posts table
		$posts = CadastroCards::query()
			->where('name', 'LIKE', "%{$search}%")
			->orWhere('manaCost', 'LIKE', '%'.$search.'%')
            ->orWhere('rarity', 'LIKE', '%'.$search.'%')
			->paginate(10);
			
			

		// Return the search view with the resluts compacted
		return view('search', compact('posts'));
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
    public function destroy(Request $request,$id)
    {
		if(CardDeck::where(['card' => $id] )->exists()){
			$request->Session()->flash("status", "erro");
			$request->Session()->flash("mensagem", "Não é possível escluir este card, pois ele compoem um deck");
			return redirect("/cardsUnimagic");
		}
    
    else{
			CadastroCards::Destroy($id);
		
			$request->Session()->flash("status", "sucesso");
			$request->Session()->flash("mensagem", "Card excluído com sucesso!");
		
			return redirect("/cardsUnimagic");
		}
        
    }
}
