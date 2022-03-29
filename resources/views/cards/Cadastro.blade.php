@extends("templates.templateAdmin")

@section("content")
	
	<div class="container px-6 my-6 grid">
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
		
			Cadastrar Cards manual:
			
		</h4>
		<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >
			<form action="/cadastrarCard" method="POST" enctype="multipart/form-data">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">MULTIVERSE ID:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					  type="text" name="id_api" placeholder="Digite o ID do card '86bf43b1-8d4e-4759-bb2d-0b2e03ba7012'"
					  value=""/>
				</label>

				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Nome do card:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					   type="text" name="name" placeholder="Static Orb" value=""/>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Mana:</span>
					<input class="block w-g mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="text" name="manaCost" placeholder="{U}" value=""/>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Imagem:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="text" name="imageUrl" placeholder="Digite a url da imagem" value=""/>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Cores:</span>
					  <div class="form-row-content-band">
						  <label class="advanced-search-checkbox small-columns">
							<input type="checkbox" name="identity[]" value="W" class="js-advanced-search-toggle form-checkbox" data-group="identity" data-toggle="color">
							<abbr class="card-symbol card-symbol-W text-gray-700 dark:text-gray-400" title="one white mana">{W}</abbr>
							<span class="text-gray-700 dark:text-gray-400">Branco</span>
						  </label>
						  <label class="advanced-search-checkbox small-columns">
							<input type="checkbox" name="identity[]" value="U" class="js-advanced-search-toggle form-checkbox" data-group="identity" data-toggle="color">
							<abbr class="card-symbol card-symbol-U text-gray-700 dark:text-gray-400" title="one blue mana">{U}</abbr>
							<span class="text-gray-700 dark:text-gray-400">Azul</span>
						  </label>
						  <label class="advanced-search-checkbox small-columns">
							<input type="checkbox" name="identity[]" value="B" class="js-advanced-search-toggle form-checkbox" data-group="identity" data-toggle="color">
							<abbr class="card-symbol card-symbol-B text-gray-700 dark:text-gray-400" title="one black mana">{B}</abbr>
							<span class="text-gray-700 dark:text-gray-400">Preto</span>
						  </label>
						  <label class="advanced-search-checkbox small-columns">
							<input type="checkbox" name="identity[]" value="R" class="js-advanced-search-toggle form-checkbox" data-group="identity" data-toggle="color">
							<abbr class="card-symbol card-symbol-R text-gray-700 dark:text-gray-400" title="one red mana">{R}</abbr>
							<span class="text-gray-700 dark:text-gray-400">Vermelho</span>
						  </label>
						  <label class="advanced-search-checkbox small-columns">
							<input type="checkbox" name="identity[]" value="G" class="js-advanced-search-toggle form-checkbox" data-group="identity" data-toggle="color">
							<abbr class="card-symbol card-symbol-G text-gray-700 dark:text-gray-400" title="one green mana">{G}</abbr>
							<span class="text-gray-700 dark:text-gray-400">Verde</span>
						  </label>
						<label class="advanced-search-checkbox small-columns">
						  <input type="checkbox" name="identity[]" value="c" class="js-advanced-search-toggle form-checkbox" data-group="identity" data-toggle="colorless">
						  <abbr class="card-symbol card-symbol-C text-gray-700 dark:text-gray-400" title="one colorless mana">{C}</abbr>
						  <span class="text-gray-700 dark:text-gray-400">Colorless</span>
						</label>
					  </div>
				</label>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Raridade:</span>
					<select name="rarity" id= "rarity" class="form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" >
						<option value>Adicionar raridade</option>
						<option value="common">Comum</option>
						<option value="uncommon">Incomum</option>
						<option value="rare">Raro</option>
						<option value="mythic">Mítico Raro</option>
					</select>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Quantidade:</span>
					<input class="block w-g mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="number" name="quantidade" placeholder="Digite a quantidade de cartas" value=""/>
				</label>
				</br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Este card está disponível?</span>
					<input type="radio" name="disponivel" value="1" class="js-advanced-search-toggle form-radio" />
					<span class="text-gray-700 dark:text-gray-400">Sim</span>
					<input type="radio" name="disponivel" value="0" class="js-advanced-search-toggle form-radio" />
					<span class="text-gray-700 dark:text-gray-400">Não</span>
				</label>
				</br>
				<button type="reset" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" >
                  Cancelar
                </button>
				@csrf
				<input type="hidden" name="id" value="{{$card->id}}" />
				<button onclick="window.opener.location.href='\home'; window.close()" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" >
                  Salvar    
                </button>		
			</form>
			
		</div>
	</div>
<script>
	
	
</script>
@endsection