<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CardController;
use App\Models\CadastroCards;
use mtgsdk\Card;

class ConsumirAPIController extends Controller
{
    public function index(Request $request)
	{
		$pagina = ($request->get('pagina')) ? $request->get('pagina') : 1;
        $tipo = ($request->get('tipo')) ? $request->get('tipo') : 'lista';
        $pageSize = 12;

		$params = [
            'page' => $pagina,
            'pageSize' => $pageSize
        ];
        $query = http_build_query($params);
        $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request(
            'GET',
            "https://api.magicthegathering.io/v1/cards?{$query}",
        );
        $promise = $client->sendAsync($request)->then(function ($response) use ($pagina, $pageSize, $tipo) {
            $body = json_decode($response->getBody()->getContents(), false);
            $headers = $response->getHeaders();
            
            $totalCount = $headers['Total-Count'][0];
            $totalPages = ceil($totalCount / $pageSize);
            $cards = $body->cards;
            $cardsGroup = array_chunk($cards, 4, true);
			$cardsUnimagi = CadastroCards::All();

            echo view('cards.Listagem', compact('cards', 'cardsGroup', 'totalPages', 'pagina', 'pageSize', 'tipo','cardsUnimagi'));
        });
        $promise->wait();
	}

	public function search(Request $request)
	{
		$busca = $request->get('search');

		$pagina = ($request->get('pagina')) ? $request->get('pagina') : 1;
        $tipo = ($request->get('tipo')) ? $request->get('tipo') : 'lista';
        $pageSize = 12;
		$params = [
            'page' => $pagina,
            'pageSize' => $pageSize
        ];
        if($busca){
            $params['name'] = $busca;
        }
        $query = http_build_query($params);
        $client = new \GuzzleHttp\Client();
        $request = new \GuzzleHttp\Psr7\Request(
            'GET',
            "https://api.magicthegathering.io/v1/cards?{$query}",
        );
        $promise = $client->sendAsync($request)->then(function ($response) use ($pagina, $pageSize, $tipo) {
            $body = json_decode($response->getBody()->getContents(), false);
            $headers = $response->getHeaders();
            $totalCount = $headers['Total-Count'][0];
            $totalPages = ceil($totalCount / $pageSize);
            $cards = $body->cards;
            $cardsGroup = array_chunk($cards, 4, true);
			$cardsUnimagi = CadastroCards::All();

            echo view('cards.Listagem', compact('cards', 'cardsGroup', 'totalPages', 'pagina', 'pageSize', 'tipo','cardsUnimagi'));
        });
        $promise->wait();
	}
}
