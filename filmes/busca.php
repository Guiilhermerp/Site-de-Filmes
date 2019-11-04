<?php

	// Incluindo os filmes
	include('./includes/generos.php');
	include('./includes/filmes.php');

	// Lendo superglobal para variável
	$trecho = $_GET['trecho'];

	function contemNoTitulo($filme){
		global $trecho;		
		return stripos($filme['titulo'],$trecho) > -1;
	}

	$filmesFiltrados = array_filter($filmes,'contemNoTitulo');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Clube do Filme</title>

	<!-- Meu css -->
	<link rel="stylesheet" href="./assets/css/geral.css">
	<link rel="stylesheet" href="./assets/css/index.css">

</head>
<body>
	<nav>
		<ul>
			<?php
				foreach($generos as $g){
					echo('<li><a href="#">'.$g.'</a></li>');
				}
			?>
		</ul>
		<form method="GET" action="busca.php">
			<input type="text" name="trecho">
			<button type="submit">Buscar</button>
		</form>
	</nav>
	
	<main>
		<section>
			<?php
				if(count($filmesFiltrados) == 0){
					echo('Nenhum filme encontrado');
				}
			?>
			<?php foreach($filmesFiltrados as $i => $f){ ?>
				<article>
					<a href="filme.php?id=<?= $i ?>">
						<img src="./assets/img/cartazes/cartaz-<?= $i ?>.png" alt="<?= $f['titulo'] ?>">
						<span>Ver +</span>
					</a>
				</article>
			<?php } ?>
		</section>
	</main>
</body>
</html>