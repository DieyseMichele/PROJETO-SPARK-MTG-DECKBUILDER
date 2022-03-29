@extends("templates.templateAdmin")

@section("content")
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header ">
					<h5 class="card-title">Cadastrar Usuário</h5>
				</div>
				<div class="card-body">
					<form action="/usuario" method="POST" class="row">
						<div class="col-4 form-group">
							<label for="name">Nome:</label>
							<input type="text" id="name" name="name" class="form-control" value="{{ $usuario->name }}" />
						</div>
						<div class="col-4 form-group">
							<label for="email">Email:</label>
							<input type="email" id="email" name="email" class="form-control" value='{{ $usuario->email }}' />
						</div>
						<div class="col-4 form-group">
							<label for="password">Senha:</label>
							<input type="password" id="password" name="password" class="form-control" />
						</div>
						<div class="ml-auto mr-auto">
							@csrf
							<input type="hidden" name="id" value="{{ $usuario->id }}" />
							<button type="submit" class="btn btn-primary btn-round">Salvar</button>
						</div>
					</form>
				</div>
			</div>
			
			<div class="card">
				<div class="card-header ">
					<h5 class="card-title">Listagem</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped">
						<colgroup>
							<col width="500" />
							<col width="500" />
							<col width="200" />
							<col width="200" />
						</colgroup>
						<thead>
							<tr>
								<th>Usuário</th>
								<th>E-mail</th>
								<th>Editar</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($usuarios as $usuario)
								<tr>
									<td>{{ $usuario->name }}</td>
									<td>{{ $usuario->email }}</td>
									<td>
										<a href="/usuario/{{ $usuario->id }}/edit" class="btn btn-warning btn-round">Editar</a>
									</td>
									<td>
										<form action="/usuario/{{ $usuario->id }}" method="POST">
											<input type="hidden" name="_method" value="DELETE" />
											@csrf
											<button type="submit" class="btn btn-danger btn-round">Excluir</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
	</div>
	
@endsection