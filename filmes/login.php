<?php

	include('./includes/generos.php');
	
	if ($_POST) {
        $usuariosJson = file_get_contents('./includes/usuarios.json');
        $usuariosArray = json_decode($usuariosJson, true);

        foreach ($usuariosArray as $usuario) {
           if ($_POST['email'] == $usuario['email'] && 
                password_verify($_POST['senha'],$usuario['senha'])
            ) {
             return header('Location: index.php'); 
           } 
        }


        $erro = 'Usuario e senha não coincidem';
    };

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- inserindo o bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<!-- Meu css -->
	<link rel="stylesheet" href="./assets/css/geral.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    
    <title>Login</title>
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

    <div class="container mt-5">
        <?php
        if (isset($erro) && $erro) {?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php } ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="e-mail" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" class="form-control" id="senha" placeholder="Password">
            </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <small>
                    <a href="cadastroUsuario.php">Não tem cadastro ?</a>
                </small>
        </form>
    </div>

</body>
</html>