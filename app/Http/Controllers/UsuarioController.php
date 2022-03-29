<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}//valida se o usuario está logado
	
    public function index()
    {//retorna todos os usuarios
        $usuario = new User();
		$usuarios = User::All();
        return view("administrador.CadastrarUsuario", [
			"usuario" => $usuario,
			"usuarios" => $usuarios
		]);
    }
 
    public function store(Request $request)
    {// cadastra os dados de um novo usuário 
        $validado = $request->validate([
			"name" => "required",
			"email" => "required|unique:users|email",
			'email' => Rule::unique('users')->ignore($request->get("id")),
			"foto" => "mimes:jpg,bmp,png,webp",
			"password" => "required",
			'ConfirmarPassword' => 'required|same:password',
			
		], [
			"required" => 'O campo :attribute é obrigatório.',
			"email.unique" => "O e-mail já existe.",
			"email.email" => "O campo deve ser do tipo e-mail.",
			"foto.mimes" => "É necessário importar um arquivo de imagem (jpg, bmp, png, webp).",
			"ConfirmarPassword.same" => "As senhas devem ser iguais."
		]);
		
		if ($request->get("id") != "") {
			$usuario = User::Find($request->get("id"));
		} else {
			$usuario = new User();
		}
		
		$usuario->name = $request->get("name");
		$usuario->email = $request->get("email");
		
		if ($request->hasFile('foto')) 
		{
			$usuario->foto =  $request->file("foto")->store("usuarios");			
		}
		
		$usuario->permissao = $request->get("perfil");
		$usuario->password = Hash::make($request->get("password"));
				
	
		$usuario->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Usuário salvo com sucesso!");
		
		return redirect("/usuario");
    }
   
    public function show()
    {//lista todo os usuários cadastrados
        $usuario = new User();
		$usuarios = User::All();
        return view("administrador.ListarUsuarios", [
			"usuario" => $usuario,
			"usuarios" => $usuarios
		]);
    }
	 public function searchUsuario(Request $request){//pesquissa os usuários cadastrados
		// pega o valor do search pelo request
		$search = $request->input('search');

		//seleciona os usuários de nome e email parecidos ao search
		$usuarios = User::query()
			->where('name', 'LIKE', "%{$search}%")
			->orWhere('email', 'LIKE', '%'.$search.'%')
			->paginate(10);

		//retorna a view com os valores encontrados
		return view('administrador.ListarUsuarios', compact('usuarios'));
	}

	public function editarUser(Request $request)//alteração dos usuários pelo admin sem a senha como obrigatório
    {
        $validado = $request->validate([
			"name" => "required",
			"email" => "required|unique:users|email",
			'email' => Rule::unique('users')->ignore($request->get("id")),
			"foto" => "mimes:jpg,bmp,png,webp",
			'ConfirmarPassword' => 'same:password',
			
		], [
			"required" => 'O campo :attribute é obrigatório.',
			"email.unique" => "O e-mail já existe.",
			"email.email" => "O campo deve ser do tipo e-mail.",
			"foto.mimes" => "É necessário importar um arquivo de imagem (jpg, bmp, png, webp).",
			"ConfirmarPassword.same" => "As senhas devem ser iguais."
		]);
		
		if ($request->get("id") != "") {
			$usuario = User::Find($request->get("id"));
		} else {
			$usuario = new User();
		}
		
		$usuario->name = $request->get("name");
		$usuario->email = $request->get("email");
		
		if ($request->hasFile('foto')) 
		{
			$usuario->foto =  $request->file("foto")->store("usuarios");			
		}
		
		$usuario->permissao = $request->get("perfil");
		
		if ($request->get("password") != "") {
			$usuario->password = Hash::make($request->get("password"));
		} 
		
		$usuario->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Usuário atualizado com sucesso!");
		
		return redirect("/usuariosCadastrados");
    }

    public function edit($id)
    {//encontra e retorna os dados do usuário que tem o id enviado como parametro
		$usuario = User::Find($id);
		$usuarios = User::All();
        return view("administrador.EditarUsuario", [
			"usuario" => $usuario,
			"usuarios" => $usuarios
		]);       
    }

    public function update(Request $request)//alteração de dados do perfil do user autenticado
    {
		$usuario = Auth::user();//pega os dados do usuário autenticado
		
		$usuario->name = $request->get("name");
		$usuario->email = $request->get("email");
		
		if ($request->hasFile('foto')) //verifica se o campo file tem arquivo, caso tenha adiciona a nova foto ao perfil
		{
			$usuario->foto =  $request->file("foto")->store("usuarios");			
		}
		if ($request->get("oldpassword") != "" or $request->get("NewPassword")!= "") {
			if (Hash::check($request->get("oldpassword"),Auth::user()->password)){//valida se a senha atual é igual a digitada no input, caso sim altera a senha para nova senha digitada.
			
				$usuario->password = Hash::make($request->get("NewPassword"));
			}
			else {			
				$request->Session()->flash("status", "erro");
				$request->Session()->flash("mensagem", "Senha incorreta!");
				return redirect("/perfil");
			}	
		}	
		$usuario->save();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Perfil atualizado com sucesso!");
		
		if(Auth::user()->permissao == 1){
			return redirect("/perfilUser");
		}else{
			return redirect("/perfil");
		}
		
    }

    public function destroy($id, Request $request)//exclusão de usuário cadastrado pelo admin
    {
        $usuario = User::Find($id);//encontra o id do usuário enviado como paramentro
		\Storage::delete($usuario->foto);//exclui a foto do storage
		$usuario->delete();
		
		$request->Session()->flash("status", "sucesso");
		$request->Session()->flash("mensagem", "Usuário excluído com sucesso!");
		
		return redirect("/usuariosCadastrados");
    }
}
