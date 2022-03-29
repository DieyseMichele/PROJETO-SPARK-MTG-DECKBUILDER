@extends("templates.templateAdmin")

@section("titulo", "Fazer Empréstimo")

@section("content")
	<div class="container px-6 my-6 grid">
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
			Realizar Empréstimo:
		</h4></br>
		<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >
			<form action="/emprestimoAdmin" method="POST" enctype="multipart/form-data">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Usuário:</span>
					<select name="user" id= "user" class="meuselect form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-select" >
						<option value>Selecionar o usuário</option>
						@foreach($usuarios as $usuario)
							<option value="{{$usuario->id}}">{{$usuario->name}}</option>
						@endforeach
					</select>
				</label></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Deck:</span>
					<select name="deck" id= "deck" class="meuselect form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" >
						<option value>Selecione o Deck</option>
						@foreach($decks as $deck)
							<option value="{{$deck->id}}">{{$deck->name}}</option>
						@endforeach
					</select>
				</label></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Data Empréstimo:</span>
					<input class="block w-g mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="date" name="dataEmprestimo" placeholder="2001-04-11" value=""/>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Data Devolução:</span>
					<input class="block w-g mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="date" name="dataDevolucao" placeholder="2001-04-11" value=""/>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Status:</span>
					<select name="status" id= "status" class="form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" >
						<option >Selecione o status</option>						
						<option value="E">Emprestado</option>
						<option value="D">Devolvido</option>
						<option value="A">Atraso</option>						
					</select>
				</label></br>
				<button type="reset" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" >
                  Cancelar
                </button>
				@csrf
				<input type="hidden" name="admin" value="{{ Auth::user()->id }}" />
				<button type="submit" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" >
                  Salvar    
                </button>		
			</form>
		</div>
	</div>	

@endsection