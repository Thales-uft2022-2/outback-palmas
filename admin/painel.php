<?php

session_start();

require "../config/database.php";

/*
|--------------------------------------------------------------------------
| VERIFICA LOGIN
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION["usuario_id"])) {

    header("Location: ../login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| VERIFICA SE É ADMIN
|--------------------------------------------------------------------------
*/

if (
    !isset($_SESSION["usuario_tipo"]) ||
    $_SESSION["usuario_tipo"] !== "admin"
) {

    http_response_code(403);

    die("Acesso negado. Área exclusiva para administradores.");
}


/*
|--------------------------------------------------------------------------
| ESTATÍSTICAS
|--------------------------------------------------------------------------
*/

$totalUsuarios = $pdo
    ->query("SELECT COUNT(*) FROM usuarios")
    ->fetchColumn();


$totalReservas = $pdo
    ->query("SELECT COUNT(*) FROM reservas")
    ->fetchColumn();


$reservasPendentes = $pdo
    ->query("
        SELECT COUNT(*)
        FROM reservas
        WHERE status = 'pendente'
    ")
    ->fetchColumn();


$reservasConfirmadas = $pdo
    ->query("
        SELECT COUNT(*)
        FROM reservas
        WHERE status = 'confirmada'
    ")
    ->fetchColumn();


/*
|--------------------------------------------------------------------------
| BUSCA RESERVAS
|--------------------------------------------------------------------------
*/

$stmt = $pdo->query("
    SELECT
        reservas.id,
        reservas.data_reserva,
        reservas.horario,
        reservas.quantidade_pessoas,
        reservas.observacoes,
        reservas.status,
        reservas.criado_em,

        usuarios.nome,
        usuarios.email,
        usuarios.telefone

    FROM reservas

    INNER JOIN usuarios
        ON reservas.usuario_id = usuarios.id

    ORDER BY
        reservas.data_reserva DESC,
        reservas.horario DESC
");

$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*
|--------------------------------------------------------------------------
| BUSCA USUÁRIOS
|--------------------------------------------------------------------------
*/

$stmtUsuarios = $pdo->query("
    SELECT
        id,
        nome,
        email,
        telefone,
        tipo,
        criado_em

    FROM usuarios

    ORDER BY id DESC
");

$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<title>
Painel Administrativo | Outback Palmas
</title>

<link
    rel="stylesheet"
    href="../css/style.css"
>

<style>

body {
    background: #0d0d0d;
}

.admin-container {

    max-width: 1400px;

    margin: auto;

    padding: 30px;
}


/* CABEÇALHO */

.admin-header {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 40px;

    gap: 20px;

    flex-wrap: wrap;
}

.admin-header h1 {

    font-size: 32px;
}

.admin-header p {

    color: #999;

    margin-top: 5px;
}

.admin-actions {

    display: flex;

    gap: 10px;
}


/* DASHBOARD */

.dashboard-cards {

    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 20px;

    margin-bottom: 40px;
}

.dashboard-card {

    background: #191919;

    border: 1px solid #292929;

    border-radius: 12px;

    padding: 25px;
}

.dashboard-card span {

    display: block;

    color: #999;

    font-size: 14px;

    margin-bottom: 10px;
}

.dashboard-card strong {

    font-size: 35px;
}

.dashboard-card.destaque {

    border-left:
        4px solid #d9272e;
}


/* MENU ADMIN */

.admin-menu {

    display: flex;

    gap: 10px;

    margin-bottom: 30px;

    flex-wrap: wrap;
}

.admin-menu button {

    border: 1px solid #333;

    background: #181818;

    color: white;

    padding: 12px 20px;

    border-radius: 6px;

    cursor: pointer;
}

.admin-menu button:hover {

    background: #d9272e;
}


/* PAINÉIS */

.admin-section {

    background: #161616;

    border-radius: 12px;

    padding: 25px;

    margin-bottom: 30px;

    overflow-x: auto;
}

.admin-section h2 {

    margin-bottom: 25px;
}


/* TABELA */

.admin-table {

    width: 100%;

    border-collapse: collapse;

    min-width: 900px;
}

.admin-table th {

    text-align: left;

    background: #202020;

    color: #ccc;

    padding: 15px;

    font-size: 13px;
}

.admin-table td {

    padding: 15px;

    border-bottom:
        1px solid #292929;

    color: #ddd;
}

.admin-table tr:hover {

    background: #1d1d1d;
}


/* STATUS */

.status {

    display: inline-block;

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: bold;
}

.status-pendente {

    background: #5e4500;

    color: #ffd76a;
}

.status-confirmada {

    background: #113f2a;

    color: #7fffad;
}

.status-cancelada {

    background: #501519;

    color: #ff9298;
}

.status-finalizada {

    background: #26344e;

    color: #8db8ff;
}


/* BOTÕES */

.btn-admin {

    border: none;

    padding: 8px 12px;

    border-radius: 5px;

    cursor: pointer;

    color: white;

    font-size: 12px;
}

.btn-confirmar {

    background: #1b7f46;
}

.btn-cancelar {

    background: #b52229;
}

.btn-finalizar {

    background: #315b9e;
}


/* RESPONSIVO */

@media(max-width: 900px) {

    .dashboard-cards {

        grid-template-columns:
            repeat(2, 1fr);
    }
}


@media(max-width: 550px) {

    .dashboard-cards {

        grid-template-columns: 1fr;
    }

}

</style>

</head>

<body>


<div class="admin-container">


<!-- CABEÇALHO -->

<div class="admin-header">

    <div>

        <h1>
            Painel Administrativo
        </h1>

        <p>

            Bem-vindo,

            <?= htmlspecialchars(
                $_SESSION["usuario_nome"]
            ) ?>

        </p>

    </div>


    <div class="admin-actions">

        <a
            href="../index.php"
            class="btn-secondary"
        >
            Ver site
        </a>

        <a
            href="../logout.php"
            class="btn-primary"
        >
            Sair
        </a>

    </div>

</div>



<!-- ESTATÍSTICAS -->

<div class="dashboard-cards">


    <div class="dashboard-card">

        <span>
            Usuários
        </span>

        <strong>
            <?= $totalUsuarios ?>
        </strong>

    </div>


    <div class="dashboard-card">

        <span>
            Total de reservas
        </span>

        <strong>
            <?= $totalReservas ?>
        </strong>

    </div>


    <div class="dashboard-card destaque">

        <span>
            Reservas pendentes
        </span>

        <strong>
            <?= $reservasPendentes ?>
        </strong>

    </div>


    <div class="dashboard-card">

        <span>
            Confirmadas
        </span>

        <strong>
            <?= $reservasConfirmadas ?>
        </strong>

    </div>


</div>



<!-- MENU -->

<div class="admin-menu">

    <button
        onclick="mostrarPainel('reservas')"
    >
        Reservas
    </button>

    <button
        onclick="mostrarPainel('usuarios')"
    >
        Usuários
    </button>

</div>



<!-- RESERVAS -->

<div
    class="admin-section"
    id="reservas"
>

<h2>
Reservas
</h2>


<?php if (count($reservas) === 0): ?>

<p
    style="color:#999;"
>
Nenhuma reserva cadastrada.
</p>

<?php else: ?>


<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Cliente</th>

<th>Contato</th>

<th>Data</th>

<th>Horário</th>

<th>Pessoas</th>

<th>Status</th>

<th>Ações</th>

</tr>

</thead>


<tbody>


<?php foreach ($reservas as $reserva): ?>


<tr>

<td>

#<?= $reserva["id"] ?>

</td>


<td>

<strong>

<?= htmlspecialchars(
    $reserva["nome"]
) ?>

</strong>

<br>

<small>

<?= htmlspecialchars(
    $reserva["email"]
) ?>

</small>

</td>


<td>

<?= htmlspecialchars(
    $reserva["telefone"]
) ?>

</td>


<td>

<?= date(
    "d/m/Y",
    strtotime(
        $reserva["data_reserva"]
    )
) ?>

</td>


<td>

<?= substr(
    $reserva["horario"],
    0,
    5
) ?>

</td>


<td>

<?= $reserva[
    "quantidade_pessoas"
] ?>

</td>


<td>

<span
    class="
        status
        status-<?= $reserva["status"] ?>
    "
>

<?= ucfirst(
    $reserva["status"]
) ?>

</span>

</td>


<td>


<?php if (
    $reserva["status"]
    === "pendente"
): ?>


<form
    action="atualizar_reserva.php"
    method="POST"
    style="display:inline;"
>

<input
    type="hidden"
    name="id"
    value="<?= $reserva["id"] ?>"
>

<input
    type="hidden"
    name="status"
    value="confirmada"
>

<button
    class="
        btn-admin
        btn-confirmar
    "
>
Confirmar
</button>

</form>


<?php endif; ?>



<?php if (
    $reserva["status"]
    !== "cancelada"
): ?>


<form
    action="atualizar_reserva.php"
    method="POST"
    style="display:inline;"
>

<input
    type="hidden"
    name="id"
    value="<?= $reserva["id"] ?>"
>

<input
    type="hidden"
    name="status"
    value="cancelada"
>

<button
    class="
        btn-admin
        btn-cancelar
    "
>
Cancelar
</button>

</form>


<?php endif; ?>



<?php if (
    $reserva["status"]
    === "confirmada"
): ?>


<form
    action="atualizar_reserva.php"
    method="POST"
    style="display:inline;"
>

<input
    type="hidden"
    name="id"
    value="<?= $reserva["id"] ?>"
>

<input
    type="hidden"
    name="status"
    value="finalizada"
>

<button
    class="
        btn-admin
        btn-finalizar
    "
>
Finalizar
</button>

</form>


<?php endif; ?>


</td>

</tr>


<?php endforeach; ?>


</tbody>

</table>


<?php endif; ?>

</div>



<!-- USUÁRIOS -->

<div
    class="admin-section"
    id="usuarios"
    style="display:none;"
>

<h2>
Usuários cadastrados
</h2>


<table class="admin-table">

<thead>

<tr>

<th>ID</th>

<th>Nome</th>

<th>Email</th>

<th>Telefone</th>

<th>Tipo</th>

<th>Cadastro</th>

</tr>

</thead>


<tbody>


<?php foreach ($usuarios as $usuario): ?>


<tr>

<td>

#<?= $usuario["id"] ?>

</td>


<td>

<?= htmlspecialchars(
    $usuario["nome"]
) ?>

</td>


<td>

<?= htmlspecialchars(
    $usuario["email"]
) ?>

</td>


<td>

<?= htmlspecialchars(
    $usuario["telefone"]
) ?>

</td>


<td>

<strong>

<?= strtoupper(
    $usuario["tipo"]
) ?>

</strong>

</td>


<td>

<?= date(
    "d/m/Y H:i",
    strtotime(
        $usuario["criado_em"]
    )
) ?>

</td>

</tr>


<?php endforeach; ?>


</tbody>

</table>

</div>


</div>


<script>

function mostrarPainel(painel) {

    const reservas =
        document.getElementById(
            "reservas"
        );

    const usuarios =
        document.getElementById(
            "usuarios"
        );


    reservas.style.display =
        "none";

    usuarios.style.display =
        "none";


    document.getElementById(
        painel
    ).style.display =
        "block";
}

</script>


</body>

</html>