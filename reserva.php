<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {

    header("Location: login.php");

    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1"
>

<title>
Reservar Mesa | Outback Palmas
</title>

<link
    rel="stylesheet"
    href="css/style.css"
>

</head>

<body>


<div class="auth-container">

<div class="auth-box">

<h1>Reservar uma mesa</h1>


<form
    action="actions/reserva_action.php"
    method="POST"
>


<div class="form-group">

<label>
Data da reserva
</label>

<input
    type="date"
    name="data"
    required
>

</div>


<div class="form-group">

<label>
Horário
</label>

<select
    name="horario"
    required
>

<option value="">
Selecione
</option>

<option value="11:00">
11:00
</option>

<option value="12:00">
12:00
</option>

<option value="13:00">
13:00
</option>

<option value="18:00">
18:00
</option>

<option value="19:00">
19:00
</option>

<option value="20:00">
20:00
</option>

<option value="21:00">
21:00
</option>

<option value="22:00">
22:00
</option>

</select>

</div>


<div class="form-group">

<label>
Quantidade de pessoas
</label>

<input
    type="number"
    name="pessoas"
    min="1"
    max="20"
    required
>

</div>


<div class="form-group">

<label>
Observações
</label>

<textarea
    name="observacoes"
    rows="4"
></textarea>

</div>


<button
    class="btn-primary"
    type="submit"
>
Confirmar Reserva
</button>


</form>

<br>

<a
    href="index.php"
    style="color:#aaa"
>
← Página inicial
</a>

</div>

</div>

</body>
</html>