<?php
	// inicio da sessao 
	session_start();

	include('./includes/generos.php');
	
	//Pegando os filmes em json e transformando em array
	$filmesJson = file_get_contents('includes/filmes.json');
	$filmes = json_decode($filmesJson, true);

	// Restrição caso usuario nao esteja logado ele retorna para tela de login
	if (!isset($_SESSION['usuario'])) {
		header('Location: login.php');
	}

 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Clube do Filme</title>

	<!-- inserindo o bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- Meu css -->
	<link rel="stylesheet" href="./assets/css/geral.css">
	<link rel="stylesheet" href="./assets/css/index.css">

</head>
<body>
	<!-- Navbar com os generos -->
	<nav>
		<ul>
			<!-- Funcao para pegar os generos do generos.php -->
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
		<a href="logout.php" class="btn btn-danger">logout</a>
	</nav>
	
	<main>
		<h3>Olá, <?= $_SESSION['usuario']['nome']; ?></h3>
		<section>
			<!-- Loop para pegar os filmes no ARRAY e setar a foto de cada -->
			<?php foreach($filmes as $filme) { ?>
				<article>
					<a href="#">
						<img src="./assets/img/cartazes/<?= $filme['foto'] ?>" alt="titulo">
						<span>Ver +</span>
					</a>
				</article>
			<?php } ?>
		</section>
	</main>
</body>
</html>