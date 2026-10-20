<?php
/*
 * Outback Palmas — Página temporária de manutenção
 * Não requer conexão com banco de dados.
 */
http_response_code(503);
header('Retry-After: 3600');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#080808">
    <title>Em manutenção | Outback Palmas</title>
    <link rel="stylesheet" href="maintenance.css">
</head>
<body>
    <main class="maintenance">
        <div class="brand" aria-label="Outback Palmas">
            <span class="brand-outback">OUTBACK</span>
            <span class="brand-palmas">PALMAS</span>
        </div>

        <div class="maintenance-icon" aria-hidden="true">
            <svg viewBox="0 0 96 96" role="img">
                <path d="M59 16a24 24 0 0 0-30 30L12 63a10 10 0 0 0 14 14l17-17a24 24 0 0 0 30-30L59 44 48 33 59 16Z"
                      fill="none" stroke="currentColor" stroke-width="5"
                      stroke-linecap="round" stroke-linejoin="round"/>
                <path d="m56 57 22 22" fill="none" stroke="currentColor"
                      stroke-width="7" stroke-linecap="round"/>
                <path d="m70 69 8-8 8 8-8 8Z" fill="#e32636"/>
            </svg>
        </div>

        <p class="eyebrow">ESTAMOS MELHORANDO</p>
        <h1>Voltamos em breve.</h1>
        <p class="message">
            O site do Outback Palmas está temporariamente em manutenção
            para receber algumas melhorias.
        </p>

        <div class="status">
            <span class="status-dot"></span>
            <span>Melhorias em andamento</span>
        </div>

        <p class="footer">OUTBACK PALMAS <span aria-hidden="true">•</span> OBRIGADO PELA COMPREENSÃO</p>
    </main>
</body>
</html>
