<?php

session_start();

require "../config/database.php";


if (!isset($_SESSION["usuario_id"])) {

    header("Location: ../login.php");

    exit;
}


$usuarioId =
    $_SESSION["usuario_id"];

$data =
    $_POST["data"] ?? "";

$horario =
    $_POST["horario"] ?? "";

$pessoas =
    intval($_POST["pessoas"] ?? 0);

$observacoes =
    trim($_POST["observacoes"] ?? "");


if (
    empty($data) ||
    empty($horario) ||
    $pessoas <= 0
) {

    die("Dados da reserva inválidos.");
}


/* NÃO PERMITIR DATA PASSADA */

if (
    strtotime($data) <
    strtotime(date("Y-m-d"))
) {

    die(
        "Não é possível reservar uma data passada."
    );
}


$stmt = $pdo->prepare(
    "INSERT INTO reservas
    (
        usuario_id,
        data_reserva,
        horario,
        quantidade_pessoas,
        observacoes
    )
    VALUES (?, ?, ?, ?, ?)"
);


$stmt->execute([

    $usuarioId,
    $data,
    $horario,
    $pessoas,
    $observacoes

]);


header(
    "Location: ../minhas-reservas.php"
);

exit;