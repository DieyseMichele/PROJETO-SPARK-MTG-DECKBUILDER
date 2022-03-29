<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request) {
		
		$validado = $request->validate([
			"email" => "required|email",
			"password" => "required"
		], [
			"required" => 'O campo :attribute é obrigatório.',
			"email.email" => "O campo deve ser do tipo e-mail"
		]);
		
		$credenciais = $request->only("email", "password");
		
		if (Auth::attempt($credenciais)) {
			
			if(Auth::user()->permissao == 0){
				return redirect("/home");
			}else{
				return redirect("/HomeUser");
			}
            
        } else {
			$request->Session()->flash("status", "erro");
			$request->Session()->flash("mensagem", "Usuário ou senha incorretos!");
			return redirect("/");
		}		
		
	}
	
	public function logoff(Request $request) {
		Auth::logout();
		return redirect("/");
	}
}
