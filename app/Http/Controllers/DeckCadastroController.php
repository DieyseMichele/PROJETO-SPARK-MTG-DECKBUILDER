<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\CadastroCards;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\Emprestimo;
use App\Models\CardDeck;

class DeckCadastroController extends Controller
{
    public function __construct() {
		$this->middleware("auth");
	}
	
    public function index(Request $request)
    {
        $deck = new CadastrarDeck();
		$deck->user_id = $request->get("usuario");
		$decks = CadastrarDeck::All();
        return view("decks.CadastrarDeck", [
			"deck" => $deck,
			"decks" => $decks
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
			$deck = CadastrarDeck::Find($request->get("id"));
		} else {
			$deck = new CadastrarDeck();
		}
		$deck->user_id = $request->get("usuario");
		$deck->name = $request->get("name");
		$deck->formato = $request->get("formato");

		$deck->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Deck Cadastrado com sucesso!");
			
		return redirect("/decksCadastrados");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $deck = new CadastrarDeck();
		
		$decks = DB::table('cadastrar_deck')
            ->join('users', 'users.id', '=', 'cadastrar_deck.user_id')
            ->select('cadastrar_deck.*', 'users.name AS usuario')
            ->get();
		
        return view("decks.DecksCadastrados", [
			"deck" => $deck,
			"decks" => $decks
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
        $deck = CadastrarDeck::Find($id);
		$decks = CadastrarDeck::All();
		return view("decks.EditarDeck", [
			"decks" => $decks,
			"deck" => $deck
		]);
    }
	public function exportar(Request $request)
    {
        
		$arquivo = "deck.txt";
		$id = $request->id;
		//abrir arquivo txt
		$arq = fopen($arquivo, "w");

		//faz consulta no banco de dados


			$result = DB::table('card_deck')
			->select(
                'cadastro_card.*',
            )
			->join('cadastro_card', 'cadastro_card.id', '=', 'card_deck.card')
			->join('cadastrar_deck', 'cadastrar_deck.id', '=', 'card_deck.deck')
			->where('cadastrar_deck.id', $id)
			->get();

		$cabecalho = "Cards no deck\n";

		fwrite($arq, $cabecalho);

		foreach($result as $escrever){
			$conteudo = $escrever->id_api.";";
			$conteudo .= $escrever->name.";";
			$conteudo .= $escrever->quantidade.";";
            $conteudo .= "\n\n";

			//escreve no arquivo txt
			fwrite($arq, $conteudo);
		}

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($arquivo));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($arquivo));
        ob_clean();
        flush();
        readfile($arquivo);
        unlink($arquivo);

        fclose($arq);
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
			
		if (Emprestimo::where('deck_id', '=', $id)->exists()) {
			$request->Session()->flash("status", "erro");
			$request->Session()->flash("mensagem", "Não é possivel excluir esse deck, pois está emprestado!");
		
			return redirect("/decksCadastrados");
		}	
		else if (CardDeck::where('deck', '=', $id)->exists()){
			
			$request->Session()->flash("status", "erro");
			$request->Session()->flash("mensagem", "Não é possivel excluir esse deck, exclua os cards primeiro!");
		
			return redirect("/decksCadastrados");
		}else{
			
			
			CadastrarDeck::Destroy($id);
			
			$request->Session()->flash("status", "sucesso");
			$request->Session()->flash("mensagem", "Deck excluído com sucesso!");
		
			return redirect("/decksCadastrados");
		}
		
    }
	
	public function searchDeck(Request $request){
		// Get the search value from the request
		$search = $request->input('search');

		// Search in the title and body columns from the posts table
		$decks = CadastrarDeck::query()
			->where('name', 'LIKE', "%{$search}%")
			->orWhere('formato', 'LIKE', '%'.$search.'%')
            ->orWhere('user_id', 'LIKE', '%'.$search.'%')
			->paginate(10);

		// Return the search view with the resluts compacted
		return view('decks/DecksCadastrados', compact('decks'));
	}
}
