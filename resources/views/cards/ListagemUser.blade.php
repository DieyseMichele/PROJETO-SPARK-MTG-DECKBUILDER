@extends("templates.templateUser")
@section("titulo", "Cards Cadastrados")
@section("content")
	<div class="container px-6 mx-auto grid">
		</br></br>
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 text-center">
		  Cards
		</h4>
		
		</br>
		<div class="w-full overflow-hidden rounded-lg shadow-xs">
            
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                        <tr>
                            <div class="flex justify-center flex-1 lg:mr-32">
                                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">

                                <form action="/searchCardUnimagic" method="GET">
                                    @csrf
                                    <input
                                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                        type="text"
                                        placeholder="Digite o nome do card,quantidade de mana, raridade "
                                        aria-label="Search" name="search" id="search"
                                    />
                                    <span class="absolute inset-y-0 right-0 flex items-center pl-2">
                                        <button type="submit" class="p-1 focus:outline-none focus:shadow-outline focus-within:text-purple-500">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </button>
                                    </span>
                                </form>
                                </div>
                            </div>
                            </tr></br>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

                            <th class="px-4 py-3">Imagem</th>
                            <th class="px-4 py-3">Nome</th>                           
                            <th class="px-4 py-3">Mana</th>
                            <th class="px-4 py-3">Raridade</th>                            
                            <th class="px-4 py-3">Disponibilidade</th>
                            <th class="px-4 py-3">Quantidade</th>
                            
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($cards as $card)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    @if (isset($card->imageUrl))
                                    <div class="dropdown relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full"
                                            src="{{$card->imageUrl}}" alt="{{ $card->name }}" width="100" loading="lazy"
                                        />
                                        <div class="dropdown-content ">
                                        <img src="{{$card->imageUrl}}" alt="{{ $card->name }}" >
                                        </div>
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    @endif
                                </div>
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                <p class="font-semibold">{{ $card->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                {{ $card->manaCost }}
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                {{ $card->rarity }}
                                </td>
                                <td class="px-4 py-3 text-sm ">
								@if($card->disponivel==1)
									<span
								  class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
									>
									Disponível
								</span>
								@else
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                                >
                                    Indisponível
                                </span>
								@endif
                                </td>
								<td class="px-4 py-3 text-sm ">
                                {{ $card->quantidade }}
                                </td>
                               
                            </tr>
                        @endforeach
						
                        </tbody>
                    </table>
             </div>			   
		</div>
	</div>
   
@endsection
