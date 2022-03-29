@extends("templates.templateAdmin")
@section("titulo", "Perfil")
@section("content")
	<div class="container px-6 my-6 grid">
		<center>			
			<img class="object-cover w-56 h-56 rounded-full  imgPerfil" 
				   @if (Auth::check())
					src="{{ asset('storage/'.Auth::user()->foto) }}" @endif 
					alt="" aria-hidden="true"
			/><br>
			<form action="/updatePerfil" method="POST" enctype="multipart/form-data">
				<input class="block text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="file" name="foto" />
						
			<h2 class="mb-8 text-2xl font-semibold text-gray-600 dark:text-gray-300">
				<span class="ml-4">@if (Auth::check())
					{{Auth::user()->name}} @endif
				</span>	
                  
			</h2>
			
		</center>
		<div class="px-6 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >
			
				<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
					Informações básicas
				</h4></br>
				
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Nome:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					  type="text" name="name" value="{{Auth::user()->name}}"  required/>
				</label>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">E-mail:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="email" name="email" value="{{Auth::user()->email}}" required/>
				</label>	
				</br></br>
				<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
					Alterar Senha:
				</h4></br>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Senha Atual:</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
					   type="password" name="oldpassword" placeholder="***************" />
				</label>
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">
						Nova senha:
					</span>
					<input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
						type="password" name="NewPassword" placeholder="***************" />
				</label>
				</br>
				<button type="reset" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red" >
                  Cancelar
                </button>
				@csrf
				<input type="hidden" name="id" value="{{ Auth::user()->id }}" />
				<button type="submit" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" >
                  Atualizar    
                </button>		
			</form>
		</div>
		
	</div>	
@endsection