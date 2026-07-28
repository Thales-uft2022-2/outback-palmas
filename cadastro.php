<?php

session_start();

/*
|--------------------------------------------------------------------------
| SE JÁ ESTIVER LOGADO
|--------------------------------------------------------------------------
*/

if (isset($_SESSION["usuario_id"])) {

    if (
        isset($_SESSION["usuario_tipo"]) &&
        $_SESSION["usuario_tipo"] === "admin"
    ) {

        header("Location: admin/painel.php");
        exit;
    }

    header("Location: user/painel.php");
    exit;
}

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
        Criar Conta | Outback Palmas
    </title>

    <link
        rel="stylesheet"
        href="css/style.css"
    >

    <style>

        .mensagem-erro {

            background: #501519;

            color: #ffb1b5;

            padding: 12px;

            border-radius: 6px;

            margin-bottom: 20px;
        }


        .mensagem-sucesso {

            background: #113f2a;

            color: #7fffad;

            padding: 12px;

            border-radius: 6px;

            margin-bottom: 20px;
        }


        .tipo-info {

            color: #888;

            font-size: 13px;

            margin-top: 7px;

            line-height: 1.4;
        }


        .form-group select {

            width: 100%;

            background: #111;

            border: 1px solid #333;

            color: white;

            padding: 14px;

            border-radius: 5px;

            outline: none;

            cursor: pointer;
        }


        .form-group select:focus {

            border-color: #d9272e;
        }


        .login-link {

            margin-top: 20px;
        }


        .login-link a {

            color: #e62b31;
        }

    </style>

</head>


<body>


<div class="auth-container">


    <div class="auth-box">


        <h1>
            Criar conta
        </h1>


        <p
            style="
                color:#aaa;
                margin-bottom:25px;
            "
        >
            Cadastre uma nova conta no sistema.
        </p>



        <!-- ERROS -->


        <?php if (
            isset($_GET["erro"]) &&
            $_GET["erro"] === "campos"
        ): ?>

            <div class="mensagem-erro">

                Preencha todos os campos obrigatórios.

            </div>

        <?php endif; ?>



        <?php if (
            isset($_GET["erro"]) &&
            $_GET["erro"] === "email"
        ): ?>

            <div class="mensagem-erro">

                Informe um endereço de e-mail válido.

            </div>

        <?php endif; ?>



        <?php if (
            isset($_GET["erro"]) &&
            $_GET["erro"] === "existe"
        ): ?>

            <div class="mensagem-erro">

                Este e-mail já está cadastrado.

            </div>

        <?php endif; ?>



        <?php if (
            isset($_GET["erro"]) &&
            $_GET["erro"] === "senha"
        ): ?>

            <div class="mensagem-erro">

                A senha precisa ter pelo menos 6 caracteres.

            </div>

        <?php endif; ?>



        <?php if (
            isset($_GET["erro"]) &&
            $_GET["erro"] === "sistema"
        ): ?>

            <div class="mensagem-erro">

                Não foi possível realizar o cadastro.

            </div>

        <?php endif; ?>



        <!-- FORMULÁRIO -->


        <form
            action="actions/cadastro_action.php"
            method="POST"
        >


            <!-- NOME -->

            <div class="form-group">

                <label for="nome">

                    Nome

                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    maxlength="120"
                    autocomplete="name"
                    required
                >

            </div>



            <!-- EMAIL -->

            <div class="form-group">

                <label for="email">

                    Email

                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    maxlength="150"
                    autocomplete="email"
                    required
                >

            </div>



            <!-- TELEFONE -->

            <div class="form-group">

                <label for="telefone">

                    Telefone

                </label>

                <input
                    type="tel"
                    id="telefone"
                    name="telefone"
                    maxlength="20"
                    placeholder="(63) 99999-9999"
                    autocomplete="tel"
                >

            </div>



            <!-- TIPO DE USUÁRIO -->

            <div class="form-group">

                <label for="tipo">

                    Tipo de usuário

                </label>


                <select
                    name="tipo"
                    id="tipo"
                    required
                >

                    <option
                        value="cliente"
                        selected
                    >
                        Cliente
                    </option>

                    <option value="admin">

                        Administrador

                    </option>

                </select>


                <p
                    class="tipo-info"
                    id="tipoInfo"
                >
                    Cliente terá acesso às próprias
                    reservas.
                </p>

            </div>



            <!-- SENHA -->

            <div class="form-group">

                <label for="senha">

                    Senha

                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    minlength="6"
                    autocomplete="new-password"
                    required
                >

            </div>



            <!-- CONFIRMAR SENHA -->

            <div class="form-group">

                <label for="confirmar_senha">

                    Confirmar senha

                </label>

                <input
                    type="password"
                    id="confirmar_senha"
                    name="confirmar_senha"
                    minlength="6"
                    autocomplete="new-password"
                    required
                >

            </div>



            <button
                class="btn-primary"
                type="submit"
            >

                Criar Conta

            </button>


        </form>



        <div class="login-link">

            Já possui conta?

            <a href="login.php">

                Entrar

            </a>

        </div>


        <br>


        <a
            href="index.php"
            style="color:#aaa;"
        >

            ← Voltar para página inicial

        </a>


    </div>


</div>



<script>

const tipo =
    document.getElementById("tipo");

const tipoInfo =
    document.getElementById("tipoInfo");


tipo.addEventListener(
    "change",
    function () {

        if (this.value === "admin") {

            tipoInfo.textContent =
                "Administrador terá acesso ao painel administrativo, usuários e reservas.";

        } else {

            tipoInfo.textContent =
                "Cliente terá acesso às próprias reservas.";
        }

    }
);

</script>


</body>

</html>