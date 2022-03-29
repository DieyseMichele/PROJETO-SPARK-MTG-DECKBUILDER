<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Spark - MTG Deckbuilder - @yield("titulo")</title>
		<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/fancybox.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/fontAwesome.css') }}" />
		<link rel="shortcut icon" type="imagex/png" href="{{ asset('css/img/unimagic.png') }}">
		
		<script src="{{ asset('js/jquery.js') }}"></script>
		<script src="{{ asset('js/bootstrap.js') }}"></script>
		<script src="{{ asset('js/fancybox.js') }}"></script>
		<script src="{{ asset('js/jquery.mask.js') }}"></script>
		<script src="{{ asset('js/script.js') }}"></script>
		<script src="{{ asset('js/fontAwesome.js') }}"></script>
		
	</head>
	
	<body id="bodyLogin">
		@if (Session::get("status") == "sucesso")
				<div class="bg-green-100 border border-green-600 text-green-700 px-4 py-3 rounded relative">
					<span>
						{{ Session::get("mensagem") }}
					</span>
				</div>
			@endif
			
			@if (Session::get("status") == "erro")
				<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
					<span>
						{{ Session::get("mensagem") }}
					</span>
				</div>
			@endif
			
			@if ($errors->any())
				<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
					<span>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</span>
				</div>
		@endif
		<form id = "formularioLogin" action="/login" method="POST" class=" col-md-6 offset-md-3 ">
		  <div class="imgcontainer " >
			<img src="{{ asset('css/img/avatarLogin.png') }}" alt="Avatar" class="avatar">
		  </div>

		  <div id = "loginContainer" class="Logincontainer form-group" >
			<label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">E-mail:</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  type="email" placeholder="Digite o e-mail" name="email" required />
            </label>
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Senha:</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  type="password" placeholder="Digite a senha" name="password" required/>
            </label>
			@csrf
			<button type="submit">Login</button>
			<label>
			  <input type="checkbox" checked="checked" name="remember"> Remember me
			</label>
		  </div>
		  <div id = "loginBtn" class="Logincontainer" style="background-color:#f1f1f1">
			<button type="reset" class="cancelbtn">Cancelar</button>
			<span class="senha">Esqueceu a <a href="/forgot-password">senha?</a></span>
		  </div>
		</form>
		
	</body>
</html>