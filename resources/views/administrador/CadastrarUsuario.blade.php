@extends("templates.templateAdmin")

@section("titulo", "Cadastrar Usuário")

@section("content")
	<div class="container px-6 my-6 grid">
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
			Cadastrar Usuário:
		</h4></br>
		<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >
			<form action="/usuario" method="POST" enctype="multipart/form-data">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Nome:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					  type="text" name="name" placeholder="Nome completo" value="{{ $usuario->name }}" required/>
				</label></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">E-mail:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="email" name="email" placeholder="nome@email.com" value="{{ ($usuario->email) }}"required/>
				</label></br>	
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Foto:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="file" name="foto" placeholder="Selecionar Arquivo"/>
				</label></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Perfil:</span>
					<select name="perfil" id= "perfil" class="form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-select" >
						<option value>Selecionar Perfil</option>
						<option value="0">Admin</option>
						<option value="1">Usuário</option>
					</select>
				</label></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Senha:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					   type="password" name="password" placeholder="***************" />
				</label>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">
						Confirme a senha:
					</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="password" name="ConfirmarPassword" placeholder="***************" />
				</label>
				</br>
				<button type="reset" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" >
                  Cancelar
                </button>
				@csrf
				<input type="hidden" name="id" value="{{ $usuario->id }}" />
				<button type="submit" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" >
                  Salvar    
                </button>		
			</form>
		</div>
	</div>	

@endsection