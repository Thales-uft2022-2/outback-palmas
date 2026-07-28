<?php

/*
|--------------------------------------------------------------------------
| INICIA SESSÃO
|--------------------------------------------------------------------------
*/

session_start();


/*
|--------------------------------------------------------------------------
| BANCO DE DADOS
|--------------------------------------------------------------------------
*/

require "../config/database.php";


/*
|--------------------------------------------------------------------------
| ACEITA SOMENTE POST
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: ../cadastro.php");
    exit;
}


/*
|--------------------------------------------------------------------------
| RECEBE OS DADOS
|--------------------------------------------------------------------------
*/

$nome = trim(
    $_POST["nome"] ?? ""
);


$email = strtolower(
    trim(
        $_POST["email"] ?? ""
    )
);


$telefone = trim(
    $_POST["telefone"] ?? ""
);


$tipo = trim(
    $_POST["tipo"] ?? "cliente"
);


$senha =
    $_POST["senha"] ?? "";


$confirmarSenha =
    $_POST["confirmar_senha"] ?? "";


/*
|--------------------------------------------------------------------------
| CAMPOS OBRIGATÓRIOS
|--------------------------------------------------------------------------
*/

if (
    $nome === "" ||
    $email === "" ||
    $senha === "" ||
    $confirmarSenha === ""
) {

    header(
        "Location: ../cadastro.php?erro=campos"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| VALIDA EMAIL
|--------------------------------------------------------------------------
*/

if (
    !filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    )
) {

    header(
        "Location: ../cadastro.php?erro=email"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| VALIDA TAMANHO DA SENHA
|--------------------------------------------------------------------------
*/

if (
    strlen($senha) < 6
) {

    header(
        "Location: ../cadastro.php?erro=senha"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| CONFIRMAÇÃO DA SENHA
|--------------------------------------------------------------------------
*/

if (
    $senha !== $confirmarSenha
) {

    header(
        "Location: ../cadastro.php?erro=senha"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| TIPOS DE USUÁRIO PERMITIDOS
|--------------------------------------------------------------------------
*/

$tiposPermitidos = [

    "cliente",
    "admin"

];


if (
    !in_array(
        $tipo,
        $tiposPermitidos,
        true
    )
) {

    $tipo = "cliente";
}


/*
|--------------------------------------------------------------------------
| LIMITA TAMANHO DOS CAMPOS
|--------------------------------------------------------------------------
*/

$nome =
    substr(
        $nome,
        0,
        120
    );


$email =
    substr(
        $email,
        0,
        150
    );


$telefone =
    substr(
        $telefone,
        0,
        20
    );


/*
|--------------------------------------------------------------------------
| VERIFICA SE O EMAIL JÁ EXISTE
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare(
    "
        SELECT id
        FROM usuarios
        WHERE email = ?
        LIMIT 1
    "
);


$stmt->execute([
    $email
]);


if ($stmt->fetch()) {

    header(
        "Location: ../cadastro.php?erro=existe"
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| CRIA HASH SEGURO DA SENHA
|--------------------------------------------------------------------------
*/

$senhaHash =
    password_hash(
        $senha,
        PASSWORD_DEFAULT
    );


/*
|--------------------------------------------------------------------------
| CADASTRA USUÁRIO
|--------------------------------------------------------------------------
*/

try {

    $stmt = $pdo->prepare(
        "
        INSERT INTO usuarios
        (
            nome,
            email,
            telefone,
            senha,
            tipo
        )

        VALUES
        (
            ?,
            ?,
            ?,
            ?,
            ?
        )
        "
    );


    $stmt->execute([

        $nome,
        $email,
        $telefone,
        $senhaHash,
        $tipo

    ]);


    /*
    |--------------------------------------------------------------------------
    | PEGA ID DO NOVO USUÁRIO
    |--------------------------------------------------------------------------
    */

    $usuarioId =
        $pdo->lastInsertId();


    /*
    |--------------------------------------------------------------------------
    | FAZ LOGIN AUTOMÁTICO
    |--------------------------------------------------------------------------
    */

    session_regenerate_id(true);


    $_SESSION["usuario_id"] =
        $usuarioId;


    $_SESSION["usuario_nome"] =
        $nome;


    $_SESSION["usuario_email"] =
        $email;


    $_SESSION["usuario_tipo"] =
        $tipo;


    /*
    |--------------------------------------------------------------------------
    | REDIRECIONA CONFORME TIPO
    |--------------------------------------------------------------------------
    */

    if ($tipo === "admin") {

        header(
            "Location: ../admin/painel.php"
        );

        exit;
    }


    header(
        "Location: ../user/painel.php"
    );

    exit;


} catch (PDOException $erro) {


    /*
    |--------------------------------------------------------------------------
    | NÃO EXIBE DETALHES DO MYSQL PARA O USUÁRIO
    |--------------------------------------------------------------------------
    */

    header(
        "Location: ../cadastro.php?erro=sistema"
    );

    exit;

}