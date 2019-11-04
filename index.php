<?php

	include('./includes/generos.php');
	
	$filmesJson = file_get_contents('includes/filmes.json');
	$filmes = json_decode($filmesJson, true);

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
	
	<main>
		<section>
			<?php foreach ($filmes as $filme) {?>
					<article>
						<a href="#">
							<img src="./assets/img/cartazes/<?= $filme['foto'] ?> " alt="titulo">
							<span>Ver +</span>
						</a>
					</article>
			<?php } ?>
		</section>
	</main>
</body>
</html>