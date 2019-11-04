<?php
	// Incluindo $filmes
	include('./includes/filmes.php');

	// Incluindo $generos
	include('./includes/generos.php');

	$id_filme = $_GET['id'];
	$filme = $filmes[$id_filme];


	echo('<pre>');
	print_r($_GET);
	echo('</pre>');
	die();

	
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Turma da Mônica - Laços - Clube do Filme</title>

	<!-- Meu estilo -->
	<link rel="stylesheet" href="./assets/css/geral.css">
	<link rel="stylesheet" href="./assets/css/filme.css">
</head>

<body>
	<nav>
		<ul>
			<li><a href="#">Gênero 1</a></li>
			<li><a href="#">Gênero 2</a></li>
			<li><a href="#">Gênero 3</a></li>
			<li><a href="#">Gênero 4</a></li>
			<li><a href="#">Gênero 5</a></li>
		</ul>
		<form method="GET" action="busca.php">
			<input type="text" name="trecho">
			<button type="submit">Buscar</button>
		</form>
	</nav>
	<main>

		<h2><?= $filme['titulo'] ?></h2>
		<img src="./assets/img/cartazes/cartaz-<?= $id_filme ?>.png" alt="Título do filme" class="cartaz">
		<section>

			<div class="sinopse">
				<h5>Sinopse</h5>
				<div><?= $filme['sinopse'] ?></div>
			</div>

			<div class="censura">
				<h5>Censura</h5>
				<div><?= $filme['censura'] ?></div>
			</div>
			
			<div class="critica">
				<h5>Crítica</h5>
				<div><?= $filme['critica'] ?></div>
			</div>
		</section>

		<?= $filme['trailer'] ?>
	</main>
</body>

</html>