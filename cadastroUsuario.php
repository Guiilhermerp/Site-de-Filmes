<?php 
    include('./includes/generos.php'); 

    if ($_POST) {
        $usuariosJson = file_get_contents('./includes/usuarios.json');
        $usuariosArray = json_decode($usuariosJson, true);

        $novoUsuario = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT),
        ];

        $usuariosArray[] = $novoUsuario;

        $novoUsuariosJson = json_encode($usuariosArray);
        $cadastrou = file_put_contents('./includes/usuarios.json', $novoUsuariosJson);

        if ($cadastrou) {
            header('Location: login.php');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row">

                <div class="col-md-6">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control">
                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-6">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-6">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control">
                </div>

            </div>



            <button type="submit" class="btn btn-primary w-25">CADASTRAR</button>
            <a href="login.php">LOGIN</a>

        </form>
    </main>
</body>

</html>