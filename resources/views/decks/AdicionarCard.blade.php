@extends("templates.popup")

@section("titulo", "Adicionar Card")

@section("content")
	<div class="container px-6 my-6 grid">
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
			Adicionar Cards ao Deck:
		</h4></br>
		<form action="/card_deck" method="POST" enctype="multipart/form-data">
				<label class="block text-sm">
					<span class="text-gray-700 dark:text-gray-400">Cards:</span>
					<select required name="card" id= "card" class="meuselect form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-select" >
						<<option value>Selecionar o card</option>
						@foreach($cards as $card)
							<option value="{{$card->id}}">{{$card->name}}</option>
						@endforeach
					</select>
				</label></br>
				</br>
				@csrf
				<input type="hidden" id="id" name="id" value="{{ $cardDeck->id }}" />
				<input type="hidden" id="deck" name="deck" value="{{ $cardDeck->deck }}" />
				<button type="submit" class="px-4 py-2 font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue" >
                  Adicionar
                </button>
			</form>
			</br>
			<div class="w-full overflow-hidden rounded-lg shadow-xs">

                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap ">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">

                            <th class="px-4 py-3">Imagem</th>
                            <th class="px-4 py-3">Nome</th>
                            <th class="px-4 py-3">Mana</th>
                            <th class="px-4 py-3">Raridade</th>
                            <th class="px-4 py-3">Disponibilidade</th>
                            <th class="px-4 py-3">Ações</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

							@foreach($cds as $c)
								@if($c->deck_id == $cardDeck->deck)
								<tr class="text-gray-700 dark:text-gray-400">
									<td class="px-4 py-3">
									<div class="flex items-center text-sm">
										<!-- Avatar with inset shadow -->
										@if (isset($c->imageUrl))
										<div class="dropdown relative hidden w-8 h-8 mr-3 rounded-full md:block">
											<img class="object-cover w-full h-full rounded-full"
												src="{{$c->imageUrl}}" alt="{{ $c->name }}" width="100" loading="lazy"
											/>
											<div class="dropdown-content ">
											<img src="{{$c->imageUrl}}" alt="{{ $c->name }}" >
											</div>
											<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
										</div>
										@endif
									</div>
									</td>
									<td class="px-4 py-3 text-sm ">
									<p class="font-semibold">{{ $c->name }}</p>
									</td>
									<td class="px-4 py-3 text-sm ">
									{{ $c->manaCost }}
									</td>
									<td class="px-4 py-3 text-sm ">
									{{ $c->rarity }}
									</td>
									<td class="px-4 py-3 text-sm ">
									@if($c->disponivel==1)
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
									<td class="px-4 py-3">
									<div class="flex items-center space-x-4 text-sm">
										  <form action="{{ route('card_deck.destroy', [ 'card_deck' => $c->card_deck_id ]) }}" method="POST" onclick="return confirm('Tem certeza que deseja remover');">
												@csrf
                                                @method('DELETE')
												<button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
												aria-label="Delete"
												>
													<svg
													  class="w-5 h-5"
													  aria-hidden="true"
													  fill="currentColor"
													  viewBox="0 0 20 20"
													>
													  <path
														fill-rule="evenodd"
														d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
														clip-rule="evenodd"
													  ></path>
													</svg>
												</button>
										 </form>
										</div>
									</td>
								</tr>
								@endif
							@endforeach


                        </tbody>
                    </table>
             </div>
		</div>
	</div>

@endsection
