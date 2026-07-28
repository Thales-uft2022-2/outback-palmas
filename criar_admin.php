<?php

require "config/database.php";

$nome = "Administrador";
$email = "admin@outbackpalmas.local";
$telefone = "63999999999";
$senha = "admin123";

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

/*
 * Verifica se o admin já existe
 */
$stmt = $pdo->prepare("
    SELECT id
    FROM usuarios
    WHERE email = ?
");

$stmt->execute([$email]);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {

    // Atualiza o usuário existente
    $stmt = $pdo->prepare("
        UPDATE usuarios
        SET
            nome = ?,
            telefone = ?,
            senha = ?,
            tipo = 'admin'
        WHERE email = ?
    ");

    $stmt->execute([
        $nome,
        $telefone,
        $senhaHash,
        $email
    ]);

    echo "<h2>Administrador atualizado com sucesso!</h2>";

} else {

    // Cria um novo administrador
    $stmt = $pdo->prepare("
        INSERT INTO usuarios
        (
            nome,
            email,
            telefone,
            senha,
            tipo
        )
        VALUES (?, ?, ?, ?, 'admin')
    ");

    $stmt->execute([
        $nome,
        $email,
        $telefone,
        $senhaHash
    ]);

    echo "<h2>Administrador criado com sucesso!</h2>";
}

echo "<p>Email: admin@outbackpalmas.local</p>";
echo "<p>Senha: admin123</p>";

echo '<br><a href="login.php">Ir para o Login</a>';