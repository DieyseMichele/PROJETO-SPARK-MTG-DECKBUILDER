@extends("templates.popup")

@section("titulo", "Editar Deck")

@section("editar")
	<div class="container px-6 my-6 grid">
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
			Editar Deck
		</h4>
		<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >
			<form action="/cadastrarDeck" method="POST" enctype="multipart/form-data">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Nome:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					  type="text" name="name" placeholder="Nome do deck"  value="{{ $deck->name }}"/>
				</label></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Formato:</span>
					<select name="formato" id= "formato" class="form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" value="{{ $deck->formato }}">
						<option value>Escolha o formato</option>
						<option value="Constructed"  
							<?=($deck->formato == 'Constructed')? 'selected' : ''?> >Constructed
						</option>
						<option value="Commander"  
							<?=($deck->formato == 'Commander')? 'selected' : ''?> >Commander
						</option>
						<option value="Limited"  
							<?=($deck->formato == 'Limited')? 'selected' : ''?> >Limited
						</option>
						<option value="Variant"  
							<?=($deck->formato == 'Variant')? 'selected' : ''?> >Variant
						</option>
						<option value="List"  
							<?=($deck->formato == 'List')? 'selected' : ''?> >List
						</option>
						
					</select>
				</label></br>
				</br>
				<button type="reset" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" >
                  Limpar
                </button>
				@csrf
				<input type="hidden" id="id" name="id" value="{{ $deck->id }}" />
				<input type="hidden" id="usuario" name="usuario" value="{{Auth::user()->id}}" />
				<button type="submit" value="Close" onClick="window.parent.jQuery.fancybox.close();" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" >
                  Criar    
                </button>		
			</form>
		</div>
	</div>	
@endsection