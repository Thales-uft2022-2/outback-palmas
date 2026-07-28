<?php

session_start();

require "../config/database.php";

if (!isset($_SESSION["usuario_id"])) {

    header("Location: ../login.php");
    exit;
}

if ($_SESSION["usuario_tipo"] === "admin") {

    header("Location: ../admin/painel.php");
    exit;
}

$usuarioId = $_SESSION["usuario_id"];

$stmt = $pdo->prepare("
    SELECT *
    FROM reservas
    WHERE usuario_id = ?
    ORDER BY data_reserva DESC, horario DESC
");

$stmt->execute([$usuarioId]);

$reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
Minha Conta | Outback Palmas
</title>

<link
    rel="stylesheet"
    href="../css/style.css"
>

<style>

.user-container {

    max-width: 1200px;
    margin: auto;
    padding: 40px 25px;
}

.user-header {

    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 40px;

    gap: 20px;

    flex-wrap: wrap;
}

.user-header p {

    color: #999;
    margin-top: 5px;
}

.user-actions {

    display: flex;
    gap: 10px;
}

.user-dashboard {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 20px;

    margin-bottom: 40px;
}

.user-card {

    background: #1a1a1a;

    border: 1px solid #292929;

    border-radius: 12px;

    padding: 25px;
}

.user-card span {

    color: #999;

    display: block;

    margin-bottom: 10px;
}

.user-card strong {

    font-size: 30px;
}

.user-section {

    background: #161616;

    padding: 25px;

    border-radius: 12px;

    margin-bottom: 30px;
}

.reserva-card {

    background: #202020;

    padding: 20px;

    border-radius: 8px;

    margin-top: 15px;

    border-left: 4px solid #d9272e;
}

.reserva-card p {

    color: #bbb;

    margin-top: 8px;
}

.status {

    display: inline-block;

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 12px;

    margin-top: 10px;
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

@media(max-width: 700px) {

    .user-dashboard {

        grid-template-columns: 1fr;
    }

}

</style>

</head>

<body>

<div class="user-container">

    <div class="user-header">

        <div>

            <h1>
                Minha Conta
            </h1>

            <p>
                Olá,
                <?= htmlspecialchars(
                    $_SESSION["usuario_nome"]
                ) ?>
            </p>

        </div>


        <div class="user-actions">

            <a
                href="../index.php"
                class="btn-secondary"
            >
                Início
            </a>

            <a
                href="../reserva.php"
                class="btn-primary"
            >
                Nova Reserva
            </a>

            <a
                href="../logout.php"
                class="btn-secondary"
            >
                Sair
            </a>

        </div>

    </div>


    <?php

    $totalReservas =
        count($reservas);

    $pendentes = 0;
    $confirmadas = 0;

    foreach ($reservas as $reserva) {

        if (
            $reserva["status"]
            === "pendente"
        ) {

            $pendentes++;
        }

        if (
            $reserva["status"]
            === "confirmada"
        ) {

            $confirmadas++;
        }
    }

    ?>


    <div class="user-dashboard">

        <div class="user-card">

            <span>
                Total de reservas
            </span>

            <strong>
                <?= $totalReservas ?>
            </strong>

        </div>


        <div class="user-card">

            <span>
                Pendentes
            </span>

            <strong>
                <?= $pendentes ?>
            </strong>

        </div>


        <div class="user-card">

            <span>
                Confirmadas
            </span>

            <strong>
                <?= $confirmadas ?>
            </strong>

        </div>

    </div>


    <div class="user-section">

        <h2>
            Minhas Reservas
        </h2>


        <?php if (!$reservas): ?>

            <p
                style="
                    color:#999;
                    margin-top:20px;
                "
            >
                Você ainda não possui reservas.
            </p>

        <?php endif; ?>


        <?php foreach ($reservas as $reserva): ?>

            <div class="reserva-card">

                <h3>

                    <?= date(
                        "d/m/Y",
                        strtotime(
                            $reserva[
                                "data_reserva"
                            ]
                        )
                    ) ?>

                </h3>


                <p>

                    Horário:

                    <strong>

                        <?= substr(
                            $reserva[
                                "horario"
                            ],
                            0,
                            5
                        ) ?>

                    </strong>

                </p>


                <p>

                    Pessoas:

                    <?= intval(
                        $reserva[
                            "quantidade_pessoas"
                        ]
                    ) ?>

                </p>


                <?php if (
                    !empty(
                        $reserva[
                            "observacoes"
                        ]
                    )
                ): ?>

                    <p>

                        Observação:

                        <?= htmlspecialchars(
                            $reserva[
                                "observacoes"
                            ]
                        ) ?>

                    </p>

                <?php endif; ?>


                <span
                    class="
                        status
                        status-<?= htmlspecialchars(
                            $reserva[
                                "status"
                            ]
                        ) ?>
                    "
                >

                    <?= ucfirst(
                        $reserva[
                            "status"
                        ]
                    ) ?>

                </span>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>

</html>