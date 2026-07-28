<?php

session_start();

require "../config/database.php";


/*
|--------------------------------------------------------------------------
| VERIFICA ADMIN
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION["usuario_id"]) ||
    !isset($_SESSION["usuario_tipo"]) ||
    $_SESSION["usuario_tipo"] !== "admin"
) {

    http_response_code(403);

    die("Acesso negado.");
}


/*
|--------------------------------------------------------------------------
| RECEBE DADOS
|--------------------------------------------------------------------------
*/

$id =
    filter_input(
        INPUT_POST,
        "id",
        FILTER_VALIDATE_INT
    );

$status =
    $_POST["status"] ?? "";


/*
|--------------------------------------------------------------------------
| STATUS PERMITIDOS
|--------------------------------------------------------------------------
*/

$statusPermitidos = [

    "pendente",
    "confirmada",
    "cancelada",
    "finalizada"

];


if (
    !$id ||
    !in_array(
        $status,
        $statusPermitidos,
        true
    )
) {

    die("Dados inválidos.");
}


/*
|--------------------------------------------------------------------------
| ATUALIZA
|--------------------------------------------------------------------------
*/

$stmt = $pdo->prepare(
    "
    UPDATE reservas
    SET status = ?
    WHERE id = ?
    "
);

$stmt->execute([

    $status,
    $id

]);


header(
    "Location: painel.php"
);

exit;