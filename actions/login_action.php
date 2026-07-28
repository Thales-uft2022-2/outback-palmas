<?php

session_start();

require "../config/database.php";

$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

$stmt = $pdo->prepare("
    SELECT *
    FROM usuarios
    WHERE email = ?
");

$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (
    $usuario &&
    password_verify($senha, $usuario["senha"])
) {

    session_regenerate_id(true);

    $_SESSION["usuario_id"] = $usuario["id"];
    $_SESSION["usuario_nome"] = $usuario["nome"];
    $_SESSION["usuario_tipo"] = $usuario["tipo"];

    if ($usuario["tipo"] === "admin") {

        header("Location: ../admin/painel.php");
        exit;

    }

    header("Location: ../user/painel.php");
    exit;
}

header("Location: ../login.php?erro=1");
exit;