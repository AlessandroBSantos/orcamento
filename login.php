<?php
session_start();

require_once 'config/database.php';

if(isset($_SESSION['usuario_id'])){
    header("Location: dashboard.php");
    exit;
}

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    $sql = $pdo->prepare("
        SELECT *
        FROM usuarios
        WHERE email = ?
        LIMIT 1
    ");

    $sql->execute([$email]);

    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if($usuario){

        if($usuario["status"] != "Ativo"){

            $erro = "Usuário inativo.";

        }elseif(password_verify($senha,$usuario["senha"])){

            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nome"] = $usuario["nome"];
            $_SESSION["usuario_email"] = $usuario["email"];
            $_SESSION["usuario_perfil"] = $usuario["perfil"];

            $update = $pdo->prepare("
                UPDATE usuarios
                SET ultimo_login = NOW()
                WHERE id = ?
            ");

            $update->execute([$usuario["id"]]);

            header("Location: dashboard.php");
            exit;

        }else{

            $erro = "Senha inválida.";

        }

    }else{

        $erro = "Usuário não encontrado.";

    }

}
?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>LLA ERP Comercial</title>

<link rel="stylesheet" href="assets/css/reset.css">

<link rel="stylesheet" href="assets/css/variables.css">

<link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="login">

    <div class="login-box">

        <img
        src="assets/images/logo.png"
        class="logo">

        <h1>

            LLA ERP

        </h1>

        <p>

            Sistema de Gestão Comercial

        </p>

        <?php if($erro): ?>

            <div class="erro">

                <?= $erro ?>

            </div>

        <?php endif; ?>

        <form method="POST">

            <input
            type="email"
            name="email"
            placeholder="E-mail"
            required>

            <input
            type="password"
            name="senha"
            placeholder="Senha"
            required>

            <button type="submit">

                Entrar

            </button>

        </form>

    </div>

</div>

<script src="assets/js/login.js"></script>

</body>

</html>