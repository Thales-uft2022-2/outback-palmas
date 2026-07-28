<?php

session_start();

require "config/database.php";


if (!isset($_SESSION["usuario_id"])) {

    header("Location: login.php");

    exit;
}


$stmt = $pdo->prepare(
    "SELECT *
     FROM reservas
     WHERE usuario_id = ?
     ORDER BY data_reserva DESC"
);

$stmt->execute([
    $_SESSION["usuario_id"]
]);

$reservas =
    $stmt->fetchAll(
        PDO::FETCH_ASSOC
    );

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>
Minhas Reservas
</title>

<link
    rel="stylesheet"
    href="css/style.css"
>

</head>

<body>


<section class="section">

<h1>
Olá,
<?= htmlspecialchars(
    $_SESSION["usuario_nome"]
) ?>
</h1>


<br>


<a
    href="reserva.php"
    class="btn-primary"
>
Nova Reserva
</a>


<br><br><br>


<?php if(!$reservas): ?>

<p>
Você ainda não possui reservas.
</p>

<?php endif; ?>


<?php foreach($reservas as $reserva): ?>

<div
    class="about-card"
    style="margin-bottom:20px;"
>

<h3>

<?= date(
    "d/m/Y",
    strtotime(
        $reserva["data_reserva"]
    )
) ?>

</h3>


<p>

Horário:

<strong>
<?= substr(
    $reserva["horario"],
    0,
    5
) ?>
</strong>

</p>


<p>

Pessoas:

<?= $reserva[
    "quantidade_pessoas"
] ?>

</p>


<p>

Status:

<strong>
<?= ucfirst(
    $reserva["status"]
) ?>
</strong>

</p>

</div>

<?php endforeach; ?>


<br>

<a
    href="index.php"
    style="color:#aaa"
>
← Página inicial
</a>


</section>

</body>
</html>