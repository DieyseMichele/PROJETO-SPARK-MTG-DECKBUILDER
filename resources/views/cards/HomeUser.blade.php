@extends("templates.templateUser")
@section("titulo", "Cards Cadastrados")
<?php
		$conexao = new mysqli("localhost", "root", "", "projetomagic");
?>
@section("content")
	<div class="container px-6 mx-auto grid">
		</br></br>
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 text-center">
		  Cards
		</h4>
		<div class="dropdown " >
		  <button class="dropbtn px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">Visualizar</button>
		  <div class="dropdown-content">
			  <a href="/HomeUser?tipo=lista" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
				<svg
					  class="w-5 h-5"
					  aria-hidden="true"
					  fill="none"
					  stroke-linecap="round"
					  stroke-linejoin="round"
					  stroke-width="2"
					  viewBox="0 0 24 24"
					  stroke="currentColor"
					>
					  <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
					</svg>
					<span class="ml-4">Lista</span>
			  </a>
			  <a href="/HomeUser?tipo=icone" class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
				<svg
					  class="w-5 h-5"
					  aria-hidden="true"
					  fill="none"
					  stroke-linecap="round"
					  stroke-linejoin="round"
					  stroke-width="2"
					  viewBox="0 0 24 24"
					  stroke="currentColor"
					>
					  <path fill="none" d="M7.228,11.464H1.996c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
						c0.723,0,1.308-0.586,1.308-1.308v-5.232C8.536,12.051,7.95,11.464,7.228,11.464z M7.228,17.351c0,0.361-0.293,0.654-0.654,0.654
						H2.649c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
						 M17.692,11.464H12.46c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
						c0.722,0,1.308-0.586,1.308-1.308v-5.232C19,12.051,18.414,11.464,17.692,11.464z M17.692,17.351c0,0.361-0.293,0.654-0.654,0.654
						h-3.924c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.293-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
						 M7.228,1H1.996C1.273,1,0.688,1.585,0.688,2.308V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232c0.723,0,1.308-0.585,1.308-1.308
						V2.308C8.536,1.585,7.95,1,7.228,1z M7.228,6.886c0,0.361-0.293,0.654-0.654,0.654H2.649c-0.361,0-0.654-0.292-0.654-0.654V2.962
						c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.292,0.654,0.654V6.886z M17.692,1H12.46c-0.723,0-1.308,0.585-1.308,1.308
						V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232C18.414,8.848,19,8.263,19,7.54V2.308C19,1.585,18.414,1,17.692,1z M17.692,6.886
						c0,0.361-0.293,0.654-0.654,0.654h-3.924c-0.361,0-0.654-0.292-0.654-0.654V2.962c0-0.361,0.293-0.654,0.654-0.654h3.924
						c0.361,0,0.654,0.292,0.654,0.654V6.886z"></path>

					</svg>
					<span class="ml-4">Ícones Grandes</span>
			  </a>
		  </div>
		</div>
		</br>
		<div class="w-full overflow-hidden rounded-lg shadow-xs">

            @if ($tipo == 'lista')
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                        <tr>
                            <div class="flex justify-center flex-1 lg:mr-32">
                                <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">

                                <form action="/searchCardUser" method="GET">
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
                            <th class="px-4 py-3">Descrição</th>
                            <th class="px-4 py-3">Mana</th>
                            <th class="px-4 py-3">Raridade</th>
                            <th class="px-4 py-3">Cores</th>
                            <th class="px-4 py-3">Tipo</th>
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
                                @if (isset($card->text))
                               
									{{ $card->text }}
                                
                                @endif
								</td>
                                <td class="px-4 py-3 text-sm ">
                                {{ $card->manaCost }}
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                {{ $card->rarity }}
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                @if (isset( $card->colors))
                               
                                    @foreach ( $card->colors as $c => $value)
                                      {{ $value}}
                                     @endforeach
                    
                              @endif
                                </td>
                                <td class="px-4 py-3 text-sm ">
                                {{ $card->type }}
                                </td>                               
                            </tr>
                        @endforeach
						
                        </tbody>
                    </table>

                </div>
            @endif

			@if ($tipo == 'icone')
				<div class="flex justify-center flex-1 lg:mr-32">
					<div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">

						<form action="/searchCardUser" method="GET">
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
                 </div></br>
                    @foreach ($cardsGroup as $group)
                        <div class="flex">
                            @foreach ($group as $card)
                                <div class="flip-box rounded rounded-t-lg shadow">
                                    <div class="flip-box-inner text-xs font-semibold">
                                        @if (isset($card->imageUrl))
                                        <div class="flip-box-front rounded rounded-t-lg shadow my-3 text-center">
                                            <img src="{{$card->imageUrl}}" alt="{{ $card->name }}" class="w-f" >
                                        </div>
										@else
											<div class="flip-box-front rounded rounded-t-lg shadow my-3 text-center">
												<p class="font-semibold items-center">{{ $card->name }}</p>
											</div>
                                        @endif
                                        <div class="flip-box-back px-4 py-3 text-sm ">
                                            <p class="font-semibold">Nome: {{ $card->name }}</p>
                                             <p class="font-semibold"> Descrição: @if (isset($card->text)) 
												{{ $card->text }} @endif 
											</p>
											<p class="font-semibold"> Custo de Mana: @if (isset($card->manaCost)) 
												{{ $card->manaCost }} @endif 
											</p>
											<p class="font-semibold"> Cores:
												@foreach ( $card->colors as $c => $value)
													{{ $value}}
												@endforeach
											</p>
											<p class="font-semibold"> Edição: @if (isset($card->releaseDate))
												{{ $card->releaseDate }} @endif
											</p>
                                            <p class="font-semibold"> Raridade: {{ $card->rarity }}</p>
											
                                        </div>										
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endforeach
            @endif
		</div>

	</div>
    <div
        class="flex justify-center px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
    >
    <!-- Pagination -->
    <span class="flex">
        <nav aria-label="Table navigation">
        <ul class="inline-flex">
            <li>
                @php $anterior = $pagina -1; @endphp
            <a
                href="{{ "/HomeUser?pagina={$anterior}&tipo={$tipo}" }}"
                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                aria-label="Previous"
            >
                <svg
                class="w-4 h-4 fill-current"
                aria-hidden="true"
                viewBox="0 0 20 20"
                >
                <path
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd"
                    fill-rule="evenodd"
                ></path>
                </svg>
            </a>
            </li>

            @for ($i = $pagina; $i <= $pagina + $pageSize; $i++)
            <li>
                <a
                    href="{{ "/HomeUser?pagina={$i}&tipo={$tipo}" }}"
                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                    @if ($pagina == $i) style="color: #9a75f4; font-weight: bold;" @endif
                >
                {{$i}}
                </a>
            </li>
            @endfor

            <li>
                @php $proxima = $pagina + 1; @endphp
                <a
                    href="{{ "/HomeUser?pagina={$proxima}&tipo={$tipo}" }}"
                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                    aria-label="Next"
                >
                    <svg
                        class="w-4 h-4 fill-current"
                        aria-hidden="true"
                        viewBox="0 0 20 20"
                    >
                        <path
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                        ></path>
                    </svg>
                </a>
            </li>
        </ul>
        </nav>
    </span>
</div>

@endsection
