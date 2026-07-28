# 🥩 Outback Palmas — Sistema de Reservas

Sistema web desenvolvido para gerenciamento de usuários e reservas de um restaurante, utilizando **PHP, MySQL, HTML, CSS e JavaScript**.

O projeto está sendo desenvolvido para fins de **estudo e demonstração**, executado inicialmente em ambiente local com **XAMPP**.

> ⚠️ Este é um projeto independente para fins educacionais e não representa um site oficial do Outback Steakhouse.

---

## 📌 Sobre o projeto

O **Outback Palmas** é uma aplicação web que permite que clientes criem uma conta, façam login e realizem reservas.

O sistema também possui uma área administrativa separada, permitindo o gerenciamento das reservas e visualização dos usuários cadastrados.

---

## 🚀 Funcionalidades

### 👤 Área do Cliente

- Cadastro de usuário
- Login seguro
- Senhas armazenadas utilizando `password_hash()`
- Sessões PHP
- Painel do cliente
- Nova reserva
- Visualização das próprias reservas
- Acompanhamento do status da reserva
- Logout

### 🔐 Área Administrativa

- Login de administrador
- Painel administrativo
- Dashboard com estatísticas
- Visualização dos usuários cadastrados
- Visualização de todas as reservas
- Confirmação de reservas
- Cancelamento de reservas
- Finalização de reservas
- Controle de acesso baseado no tipo de usuário

---

## 🛠️ Tecnologias utilizadas

- HTML5
- CSS3
- JavaScript
- PHP 8
- MySQL
- PDO
- XAMPP
- phpMyAdmin
- Git
- GitHub

---

## 📂 Estrutura do projeto

```text
outback-palmas/
│
├── actions/
│   ├── cadastro_action.php
│   ├── login_action.php
│   └── reserva_action.php
│
├── admin/
│   ├── painel.php
│   └── atualizar_reserva.php
│
├── config/
│   └── database.php
│
├── css/
│   └── style.css
│
├── user/
│   └── painel.php
│
├── cadastro.php
├── index.php
├── login.php
├── logout.php
├── minhas-reservas.php
├── reserva.php
├── README.md
└── LICENSE
```

---

## 🗄️ Banco de dados

O projeto utiliza o banco:

```text
outback_palmas
```

### Tabela `usuarios`

Principais campos:

```text
id
nome
email
telefone
senha
tipo
criado_em
```

Tipos de usuário:

```text
cliente
admin
```

### Tabela `reservas`

Principais campos:

```text
id
usuario_id
data_reserva
horario
quantidade_pessoas
observacoes
status
criado_em
```

Status disponíveis:

```text
pendente
confirmada
cancelada
finalizada
```

---

## 💻 Como executar

### 1. Instale o XAMPP

É necessário ter o **Apache** e **MySQL** disponíveis.

### 2. Clone o repositório

```bash
git clone URL-DO-SEU-REPOSITORIO
```

Entre na pasta:

```bash
cd outback-palmas
```

Caso utilize XAMPP no Windows, mantenha o projeto dentro de:

```text
C:\xampp\htdocs\outback-palmas
```

---

### 3. Inicie os serviços

Abra o XAMPP e inicie:

```text
Apache
MySQL
```

---

### 4. Configure o banco

Acesse o phpMyAdmin pelo ambiente local e crie:

```sql
CREATE DATABASE outback_palmas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Depois crie as tabelas necessárias ou importe o arquivo SQL do projeto, quando disponível.

---

### 5. Configure a conexão

Arquivo:

```text
config/database.php
```

Exemplo para ambiente XAMPP local:

```php
<?php

$host = "localhost";
$dbname = "outback_palmas";
$user = "root";
$password = "";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $erro) {

    die("Erro ao conectar ao banco de dados.");
}
```

> Não publique senhas reais ou credenciais de produção no GitHub.

---

## 🌐 Executando no navegador

Com Apache e MySQL iniciados, acesse:

```text
http://localhost/outback-palmas/
```

---

## 🔐 Controle de acesso

Após o login, o sistema verifica o tipo de usuário.

### Administrador

```text
/admin/painel.php
```

O administrador pode gerenciar reservas e visualizar usuários.

### Cliente

```text
/user/painel.php
```

O cliente pode acessar suas próprias informações e reservas.

---

## 🔒 Segurança

O projeto utiliza alguns recursos importantes de segurança:

- `password_hash()`
- `password_verify()`
- PDO
- Prepared Statements
- Sessões PHP
- `session_regenerate_id()`
- `htmlspecialchars()`
- Validação de tipo de usuário
- Proteção das páginas administrativas

---

## 📈 Melhorias futuras

Algumas funcionalidades planejadas:

- Recuperação de senha
- Edição de perfil
- Cancelamento de reserva pelo cliente
- Pesquisa de reservas
- Filtros por data e status
- Controle de disponibilidade por horário
- Controle de mesas
- Dashboard administrativo com gráficos
- Notificações
- Confirmação de reserva
- Cardápio integrado ao banco de dados
- Melhorias na versão mobile
- Configuração por variáveis de ambiente

---

## 👨‍💻 Desenvolvedor

**Thales Marques Rodrigues**

Estudante de **Sistemas para Internet — IFTO**

---

## 📄 Licença

Este projeto possui arquivo `LICENSE`. Consulte-o para mais informações.

---

## ⚠️ Aviso

Este projeto foi desenvolvido para fins acadêmicos, educacionais e de demonstração.

As marcas e nomes comerciais mencionados pertencem aos seus respectivos proprietários. Este repositório não representa um sistema oficial do Outback Steakhouse.