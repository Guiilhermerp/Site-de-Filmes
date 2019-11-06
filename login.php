<?php
    // Inicio da sessão 
    session_start();

    include('./includes/generos.php'); 

    if ($_POST) {
        // Pegando os usuario no json e transformando em array
        $usuariosJson = file_get_contents('./includes/usuarios.json');
        $usuariosArray = json_decode($usuariosJson, true);

        // Percore todos os usuarios
        foreach($usuariosArray as $usuario) {
            // Verificando login e senha se esta correta
            if($_POST['email'] == $usuario['email'] && password_verify($_POST['senha'], $usuario['senha'])) {
                // definindo o cookie caso o usuario clique no checkbox
                if ($_POST['manter'] == "on") {
                    // primeira paramentro nome do cookie, segundo nome o valor do cookie
                    setcookie('emailUsuario', $_POST['email']);
                    setcookie('senhaUsuario', $_POST['senha']);
                }
                // Atribuindo a sessao para o usuario que fez login
                $_SESSION['usuario'] = $usuario;

                return header('Location: index.php');
            }
        }

        // Mensgaem de erro caso email e senha estejam errado
        $erro = 'Usuário e senha não coincidem';
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
        <?php if (isset($erro)) { ?>
            <div class="alert alert-danger"><?= $erro ?></div>
        <?php } ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="e-mail">Email</label>
                    <input type="email" name="email" id="e-mail" class="form-control" 
                        <?php if (isset($_COOKIE['emailUsuario'])) { echo "value='$_COOKIE[emailUsuario]'"; } ?> 
                    >

                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" class="form-control"
                        <?php if (isset($_COOKIE['senhaUsuario'])) { echo "value='$_COOKIE[senhaUsuario]'"; } ?>
                    >
                </div>
            </div>
            
            <div class="form-group">
                <input type="checkbox" name="manter" id="manter">
                <label for="manter">Manter Conectado</label>
            </div>

            <button type="submit" class="btn btn-primary  w-25">Entrar</button>
            <a href="cadastroUsuario.php">cadastro de usuario</a>

        </form>
    </main>
</body>

</html>