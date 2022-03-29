<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CardCadastroController;
use App\Http\Controllers\DeckCadastroController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardDeckController;
use App\Http\Controllers\OrdenacaoController;
use App\Http\Controllers\FuncoesUserController;
use App\Http\Controllers\EmprestimoAdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ConsumirAPIController;

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

Route::resources([
	"usuario" => UsuarioController::class,
	"cadastrarCard" => CardCadastroController::class,
	"cardsUnimagic" => CardController::class,
	"cadastrarDeck" => DeckCadastroController::class,
	"emprestimoAdmin"=>EmprestimoAdminController::class,	
	"card_deck"=>CardDeckController::class,	
	"cardsdeck"=>FuncoesUserController::class,	
	"UserCadastrarDeck"=>FuncoesUserController::class,	
]);

Route::get('/', function () {
    return view('templates.templateLogin');
});//exibir página de login
Route::get('/login', function () {
    return view('templates.templateLogin');
})->name("login");//exibir página de login


Route::get('/perfil', function () {
    return view('administrador.PerfilAdmin');
});
Route::get('/perfilUser', function () {
    return view('usuario.Perfil');
});//exibir página do perfil
Route::get('/UserCadastrar', function () {
    return view('decks.UserCadastrar');
});
Route::get('/campeonato', function () {
    return view('templates.templateDesenvolvimento');
});



//card
Route::get("/search", [ SearchController::class, "search" ]);//busca cards digitados no input
Route::get("/searchApi", [ ConsumirAPIController::class, "search" ]);//busca cards digitados no input
Route::get("/searchCard", [ CardController::class, "searchCard" ]);//busca cards para tabela Add Card
Route::get("/searchCardUser", [ FuncoesUserController::class, "search" ]);//busca cards para tabela Add Card
Route::get("/searchCardUnimagic", [ FuncoesUserController::class, "searchCardUnimagic" ]);//busca cards para tabela Add Card
Route::get("/cardsCadastrados", [ CardController::class, "show" ]);//exibir cards cadastrados
Route::get("/ListarCards", [ FuncoesUserController::class, "ListarCards" ]);//exibir cards cadastrados para usuário comum

//decks
Route::get("/decksCadastrados", [ DeckCadastroController::class, "show" ]);//exibir decks cadastrados
Route::get("/ListarDecksUser", [ FuncoesUserController::class, "ListarDecksUser" ]);//exibir decks cadastrados du usuário
Route::get("/ListarTodosDecks", [ FuncoesUserController::class, "ListarTodosDecks" ]);//exibir todos os decks cadastrados
Route::get("/cardDeckShow", [ FuncoesUserController::class, "show" ]);//exibir todos os cards do deck
Route::get("/searchDeck", [ DeckCadastroController::class, "searchDeck" ]);//busca decks para tabela decks cadastrados
Route::get("/searchDeckUser", [ FuncoesUserController::class, "searchDeck" ]);//busca decks cadastadros do usuário
Route::get("/searchDeckAuth", [ FuncoesUserController::class, "searchDeckAuth" ]);//busca decks cadastadros do usuário
Route::post("/ExportardecksCadastrados", [ DeckCadastroController::class, "exportar" ]);


//usuários
Route::get("/usuariosCadastrados", [ UsuarioController::class, "show" ]);//exibir usuarios cadastrados
Route::post("/editarUser", [ UsuarioController::class, "editarUser" ]);//editar usuário pelo Admin
Route::post("/updatePerfil", [ UsuarioController::class, "update" ]);//editar perfil do usuário
Route::get("/searchUsuario", [ UsuarioController::class, "searchUsuario" ]);//busca Usuários para tabela usuários cadastrados

//empréstimos
Route::get("/relatorioEmprestimo", [ EmprestimoAdminController::class, "show" ]);//exibir relatório de empréstimos
Route::get("/searchEmprestimo", [ EmprestimoAdminController::class, "searchEmprestimo" ]);//busca empréstimos no relatorio de emprestimos realizados

Route::get("/home", [ ConsumirAPIController::class, "index" ]);//home admin
Route::get("/HomeUser", [ FuncoesUserController::class, "HomeUser" ]);//home para usuário comum
Route::get("/consumirApi", [ ConsumirAPIController::class, "index" ]);//conexão api

Route::get('/ordenacaoDeck', [ OrdenacaoController::class, "ordenacaoDeck" ]);
Route::post('/ordenacaoDeck', [ OrdenacaoController::class, "ordenacaoDeck" ]);

//Rotas para Login e Logoff
Route::post("/login", [ LoginController::class, "login" ]);
Route::get("/logoff", [ LoginController::class, "logoff" ]);


//Rotas para Template Esqueceu a senha
Route::get('/forgot-password', function () {
    return view('templates.templateForgotPassword');
})->middleware('guest')->name('password.request');

//Rota e função para esqueceu a senha
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

//Rotas para Template resetar a senha
Route::get('/reset-password/{token}', function ($token) {
    return view('templates.templateResetPassword', ['token' => $token]);
})->middleware('guest')->name('password.reset');

//Rota e função para resetar a senha
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');