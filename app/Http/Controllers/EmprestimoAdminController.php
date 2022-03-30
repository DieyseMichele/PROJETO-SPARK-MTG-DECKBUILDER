<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;
use App\Models\Card;
use App\Models\CadastrarDeck;
use App\Models\User;
use App\Models\Emprestimo;

class EmprestimoAdminController extends Controller
{

	public function __construct() {
		$this->middleware("auth");
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = new User();
		$deck = new CadastrarDeck();
		$emprestimo = new Emprestimo();
		$usuarios = User::All();
		$decks = CadastrarDeck::All();
		$emprestimos = Emprestimo::All();
        return view("emprestimos.emprestimoAdmin", [
			"usuario" => $usuario,
			"usuarios" => $usuarios,
			"deck" => $deck,
			"decks" => $decks,
			'emprestimo' => $emprestimo,
			'emprestimos' => $emprestimos,
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
		$validado = $request->validate([
			"user" => "required",
			"deck" => "required",
			"dataEmprestimo" => "required|date|before:dataDevolucao",
			"dataDevolucao" => "required|date|after:dataEmprestimo",
			"status" => "required",

		], [
			"required" => 'O campo :attribute é obrigatório.',
		]);

        if ($request->get("id") != "") {
			$emprestimo = Emprestimo::find($request->get("id"));
		} else {
			$emprestimo = new Emprestimo();
            $emprestimo->deck_id = $request->get("deck");
		}
		$emprestimo->user_id = $request->get("user");
		$emprestimo->admin_id = $request->get("admin");
		if (Emprestimo::where('deck_id', $request->get("deck"))
                        ->orWhere('status', 'E')
                        ->orWhere('status', 'A')
                        ->exists()
            && !$request->get("id")
        ) {
            $request->session()->flash("status", "erro");
            $request->session()->flash("mensagem", "O deck selecionado está indisponível!");
            return redirect("/emprestimoAdmin");
		} else {

			$emprestimo->deck_id = $request->get("deck");
		}
		$emprestimo->dataEmprestimo = $request->get("dataEmprestimo");
		$emprestimo->dataDevolucao = $request->get("dataDevolucao");

		$emprestimo->status = $request->get("status");

		$emprestimo->save();

		$request->session()->flash("status", "sucesso");
		$request->session()->flash("mensagem", "Empréstimo realizado com sucesso!");

		return redirect("/emprestimoAdmin");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $emprestimo = new Emprestimo();

		$emprestimos = DB::table('emprestimo')
            ->join('users', 'users.id', '=', 'emprestimo.user_id')
            ->join('cadastrar_deck', 'cadastrar_deck.id', '=', 'emprestimo.deck_id')
            ->select('emprestimo.*', 'users.name AS usuario', 'cadastrar_deck.name AS deck')
            ->get();

        return view("emprestimos.relatorioEmprestimo", [
			"emprestimo" => $emprestimo,
			"emprestimos" => $emprestimos
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
		$usuario = new User();
		$deck = new CadastrarDeck();
		$usuarios = User::All();
		$decks = CadastrarDeck::All();
		$emprestimo = Emprestimo::Find($id);
		$emprestimos = Emprestimo::All();
        return view("emprestimos.editarEmprestimo", [
			"emprestimo" => $emprestimo,
			"emprestimos" => $emprestimos,
			"usuario" => $usuario,
			"usuarios" => $usuarios,
			"deck" => $deck,
			"decks" => $decks,
		]);
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

	//busca na tabela de relatório de emprestimo
	public function searchEmprestimo(Request $request){
		// Get the search value from the request
		$search = $request->input('search');


		// Search in the title and body columns from the posts table
		$emprestimos = Emprestimo::query()
			->join('users', 'users.id', '=', 'emprestimo.user_id')
            ->join('cadastrar_deck', 'cadastrar_deck.id', '=', 'emprestimo.deck_id')
            ->select('Emprestimo.*', 'users.name AS usuario', 'cadastrar_deck.name AS deck')
			->where('users.name', 'LIKE', "%{$search}%")
			->orWhere('cadastrar_deck.name', 'LIKE', "%{$search}%")
			->orWhere('Emprestimo.dataEmprestimo', 'LIKE', "%{$search}%")
			->orWhere('Emprestimo.dataDevolucao', 'LIKE', "%{$search}%")
			->paginate(10);

		// Return the search view with the resluts compacted
		return view('emprestimos.relatorioEmprestimo', compact('emprestimos'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Emprestimo::Destroy($id);

		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Empréstimo excluído com sucesso!");

		return redirect("/relatorioEmprestimo");
    }


}
