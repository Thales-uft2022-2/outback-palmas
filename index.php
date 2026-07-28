<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Outback Palmas</title>

    <link
        rel="stylesheet"
        href="css/style.css"
    >

</head>

<body>

<header>

    <nav class="navbar">

        <div class="logo">
            OUTBACK
            <span>PALMAS</span>
        </div>

        <div class="menu">

            <a href="index.php">Início</a>

            <a href="#sobre">
                Sobre
            </a>

            <a href="#menu">
                Cardápio
            </a>

            <a href="reserva.php">
                Reservas
            </a>

            <?php if(isset($_SESSION['usuario_id'])): ?>

                <a href="minhas-reservas.php">
                    Minhas Reservas
                </a>

                <a
                    class="btn-login"
                    href="logout.php"
                >
                    Sair
                </a>

            <?php else: ?>

                <a
                    class="btn-login"
                    href="login.php"
                >
                    Entrar
                </a>

            <?php endif; ?>

        </div>

    </nav>

</header>


<section class="hero">

    <div class="hero-overlay">

        <div class="hero-content">

            <span class="hero-tag">
                OUTBACK STEAKHOUSE PALMAS
            </span>

            <h1>
                Momentos especiais começam aqui.
            </h1>

            <p>
                Uma experiência inspirada na Austrália
                no coração de Palmas.
            </p>

            <div class="hero-buttons">

                <a
                    href="reserva.php"
                    class="btn-primary"
                >
                    Fazer Reserva
                </a>

                <a
                    href="#menu"
                    class="btn-secondary"
                >
                    Conhecer o Menu
                </a>

            </div>

        </div>

    </div>

</section>


<section
    id="sobre"
    class="section"
>

    <div class="section-title">

        <span>
            NOSSA EXPERIÊNCIA
        </span>

        <h2>
            Bem-vindo ao Outback Palmas
        </h2>

    </div>

    <div class="about-grid">

        <div>

            <h3>
                Uma experiência inesquecível
            </h3>

            <p>
                Ambiente descontraído, pratos marcantes
                e atendimento pensado para transformar
                cada visita em um momento especial.
            </p>

            <p>
                Localizado em Palmas, nosso espaço foi
                pensado para reunir amigos, famílias
                e pessoas que desejam aproveitar uma
                experiência gastronômica especial.
            </p>

        </div>

        <div class="about-card">

            <h3>Horários</h3>

            <p>
                Segunda a Domingo
            </p>

            <strong>
                10h às 23h30
            </strong>

            <hr>

            <p>
                Palmas - Tocantins
            </p>

        </div>

    </div>

</section>


<section
    id="menu"
    class="menu-section"
>

    <div class="section-title">

        <span>
            FAVORITOS
        </span>

        <h2>
            Experimente nossos destaques
        </h2>

    </div>


    <div class="cards">

        <div class="food-card">

            <div class="food-image"></div>

            <div class="food-content">

                <h3>
                    Bloomin' Onion
                </h3>

                <p>
                    A tradicional cebola gigante
                    dourada e crocante.
                </p>

            </div>

        </div>


        <div class="food-card">

            <div class="food-image"></div>

            <div class="food-content">

                <h3>
                    Victoria's Filet
                </h3>

                <p>
                    Corte macio preparado para uma
                    experiência especial.
                </p>

            </div>

        </div>


        <div class="food-card">

            <div class="food-image"></div>

            <div class="food-content">

                <h3>
                    Rockhampton Ribeye
                </h3>

                <p>
                    Um corte marcante para quem
                    aprecia carnes.
                </p>

            </div>

        </div>

    </div>

</section>


<section class="reservation-banner">

    <h2>
        Sua mesa está esperando por você.
    </h2>

    <p>
        Faça sua reserva antecipadamente.
    </p>

    <a
        href="reserva.php"
        class="btn-primary"
    >
        Reservar Agora
    </a>

</section>


<footer>

    <div class="footer-logo">
        OUTBACK PALMAS
    </div>

    <p>
        Projeto local de demonstração.
    </p>

    <p>
        © 2026 Outback Palmas
    </p>

</footer>


<script src="js/script.js"></script>

</body>
</html>