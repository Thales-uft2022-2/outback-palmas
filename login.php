<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1"
>

<title>
Login | Outback Palmas
</title>

<link
    rel="stylesheet"
    href="css/style.css"
>

</head>

<body>


<div class="auth-container">

<div class="auth-box">

<h1>Bem-vindo</h1>

<p
    style="
        margin-bottom:25px;
        color:#aaa;
    "
>
Entre para gerenciar suas reservas.
</p>


<form
    action="actions/login_action.php"
    method="POST"
>

<div class="form-group">

<label>Email</label>

<input
    type="email"
    name="email"
    required
>

</div>


<div class="form-group">

<label>Senha</label>

<input
    type="password"
    name="senha"
    required
>

</div>


<button
    type="submit"
    class="btn-primary"
>
Entrar
</button>

</form>


<br>

<p>

Ainda não possui conta?

<a
    href="cadastro.php"
    style="color:#d9272e"
>
Criar conta
</a>

</p>


<br>

<a
    href="index.php"
    style="color:#aaa"
>
← Voltar
</a>

</div>

</div>

</body>
</html>