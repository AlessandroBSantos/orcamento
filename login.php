$stmt = $pdo->prepare("
    SELECT *
    FROM usuarios
    WHERE email = ?
    LIMIT 1
");

$stmt->execute([$email]);

$usuario = $stmt->fetch();

if($usuario){

    if(password_verify($senha, $usuario['senha'])){

        echo "Login realizado";

    }else{

        echo "Senha inválida";

    }

}else{

    echo "Usuário não encontrado";

}