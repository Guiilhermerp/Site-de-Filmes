<?php

	include('./includes/generos.php');
	
	if ($_POST) {

		if ($_FILES['foto']['error'] == 0) {
			$nomeFoto = $_FILES['foto']['name'];
			$caminhoTmp = $_FILES['foto']['tmp_name'];

			move_uploaded_file(
				$caminhoTmp, 
				'./assets/img/cartazes/' . $nomeFoto
			);
		}

		$filmesJson = file_get_contents('./includes/filmes.json');
		
		$arrayFilmes = json_decode($filmesJson, true);

		$novoFilme = [
			'nome' => $_POST['nome'],			
			'sinopse' => $_POST['sinopse'],			
			'genero' => $_POST['genero'],			
			'trailer' => $_POST['trailer'],			
			'critica' => $_POST['critica'],			
			'censura' => $_POST['censura'],	
			'foto' => $nomeFoto	
		];

		$arrayFilmes[] = $novoFilme;

		$novoFilmesJson = json_encode($arrayFilmes);

		$salvou = file_put_contents('./includes/filmes.json', $novoFilmesJson);
		
		if ($salvou) {
			header('Location: index.php');
		}
	}
 ?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatiblefile" content="ie=edge">
	<title>Clube do Filme</title>
	
	<!-- inserindo o bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- Meu css -->
	<link rel="stylesheet" href="./assets/css/geral.css">
	<link rel="stylesheet" href="./assets/css/cadastro.css">
</head>
<body>
	<nav>
		<ul>
			<?php 
				for($i=0 ; $i < count($generos) ; $i++){
					echo("<li><a href='#'>$generos[$i]</a></li>");
				}
			?>
		</ul>
		<form method="GET" action="busca.php">
			<input type="text" name="trecho">
			<button type="submit">Buscar</button>
		</form>
	</nav>
	
	<main class="container mt-5">
		<form
			method="post"
			enctype="multipart/form-data"
		>
			<div class="form-group row">
				<div class="col-md-6">
					<label for="nome">Nome</label>
					<input
						type="text"
						name="nome"
						id="nome"		
						class="form-control"
					>			
				</div>

				<div class="col-md-6">
					<label for="genero">Gênero</label>
					<select class="form-control" name="genero" id="genero">
						<option selected disabled>Selecione um gênero</option>
						<?php
							foreach ($generos as $i => $genero) {
								echo("<option value='$i'>$genero</option>");
							}
						?>
					</select>
				</div>	
			</div>

			<div class="form-group row">
				<div class="col-md-6">
					<label for="sinopse">Sinopse</label>
					<textarea id="sinopse" name="sinopse" class="form-control"></textarea>
				</div>
			
				<div class="col-md-6">
					<label for="critica">Crítica</label>
					<textarea id="critica" name="critica" class="form-control"></textarea>
				</div>
			</div>

			<div class="form-group row">
				<div class="col-md-6">
					<label for="trailer">Trailer</label>
					<input id="trailer" type="text" name="trailer" class="form-control">
				</div>

				<div class="col-md-6">
					<label for="censura">Censura</label>
					<input id="censura" type="number" name="censura" min="0" max="18" step="1" class="form-control">
				</div>
			</div>
			
			<div class="form-group row">
				<div class="col-12">
					<div class="custom-file">
						<input name="foto" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
						<label class="custom-file-label" for="inputGroupFile01">Selecione a foto de capa</label>
					</div>
				</div>
			</div>

			<button type="submit" class="btn btn-primary float-right w-25">Enviar</button>

		</form>
	</main>
</body>
</html>