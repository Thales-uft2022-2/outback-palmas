# 🥩 Outback Steakhouse Palmas — Sistema de Reservas

Sistema web desenvolvido para gerenciamento de usuários e reservas de um restaurante, utilizando **PHP, MySQL, HTML, CSS e JavaScript**.

O projeto está sendo desenvolvido para fins de **estudo e demonstração**, com execução local em ambiente **XAMPP**.

> ⚠️ Este é um projeto independente para fins educacionais e não representa um site oficial do Outback Steakhouse. Marcas, nomes e imagens pertencem aos seus respectivos proprietários.

---

## 📌 Sobre o projeto

O **Outback Steakhouse Palmas** é uma aplicação web de demonstração que reúne uma página inicial temática, acesso de usuários e fluxo de reservas. A interface foi atualizada para apresentar o restaurante e o cardápio de maneira mais visual, com imagens de pratos e bebidas, cartões de conteúdo e navegação adaptável a diferentes tamanhos de tela.

A aplicação também contempla uma área administrativa separada para acompanhar usuários e reservas, conforme a estrutura implementada no projeto.

## ✨ Atualizações recentes da página inicial

A página inicial (`index.php`, anteriormente identificada no desenvolvimento como `index.original.php`) e a folha de estilos `css/style.css` receberam uma atualização visual.

- **Hero/banner visual:** seção de destaque com imagens de comida ao fundo e camada de contraste para melhorar a leitura do texto.
- **Imagens de pratos e bebidas:** organização em cartões com dimensões consistentes e corte de imagem padronizado para reduzir diferenças de altura e proporção.
- **Seções do conteúdo:** apresentação de entradas, pratos principais, sobremesas e bebidas em blocos visuais.
- **Identidade visual:** cores e detalhes inspirados no estilo de uma steakhouse, com destaque para tons escuros e vermelhos.
- **Animações de entrada:** elementos podem aparecer gradualmente conforme o visitante percorre a página.
- **Navegação responsiva:** menu preparado para telas menores, como celulares e tablets.
- **Link para o iFood:** botão externo para acessar o iFood em uma nova aba. Por padrão, ele pode apontar para a página geral do serviço; configure o endereço específico da unidade, caso disponível.
- **Links de acesso:** atalhos para login e reserva, mantendo a integração com as páginas existentes do projeto.

> **Observação sobre as imagens:** as imagens usadas na interface podem ser ilustrativas e carregadas de serviços externos. É necessária conexão com a internet para exibi-las quando não estiverem armazenadas localmente. Confira os direitos de uso e substitua os endereços pelas imagens autorizadas do projeto, quando necessário.

> **Observação sobre o iFood:** o botão só direciona para o restaurante específico se o `href` estiver configurado com o link correto da unidade de Palmas.

---

## 🚀 Funcionalidades

### 👤 Área do cliente

- Cadastro de usuário
- Login
- Senhas armazenadas com `password_hash()`, conforme implementação
- Sessões PHP
- Painel do cliente
- Criação de reservas
- Visualização das próprias reservas
- Acompanhamento do status da reserva
- Logout

### 🔐 Área administrativa

- Login de administrador
- Painel administrativo
- Dashboard com estatísticas
- Visualização dos usuários cadastrados
- Visualização de todas as reservas
- Confirmação de reservas
- Cancelamento de reservas
- Finalização de reservas
- Controle de acesso conforme o tipo de usuário

### 🖥️ Página inicial

- Apresentação visual do projeto
- Imagens de pratos e bebidas
- Cartões de conteúdo para categorias do cardápio
- Navegação para as páginas de login e reserva
- Botão externo para o iFood
- Layout adaptável a computadores e dispositivos móveis

> A disponibilidade real de cada funcionalidade depende dos arquivos e da configuração presentes na versão do projeto instalada.

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

Estrutura de referência, de acordo com a organização documentada:

```text
outback-palmas/
├── actions/
│   ├── cadastro_action.php
│   ├── login_action.php
│   └── reserva_action.php
├── admin/
│   ├── painel.php
│   └── atualizar_reserva.php
├── config/
│   └── database.php
├── css/
│   └── style.css
├── user/
│   └── painel.php
├── cadastro.php
├── index.php
├── login.php
├── logout.php
├── minhas-reservas.php
├── outback-palmas.sql
├── reserva.php
├── README.md
└── LICENSE
```

> Esta é uma estrutura de referência. Se os nomes ou diretórios do repositório estiverem diferentes, ajuste a árvore acima para refletir os arquivos realmente versionados.

---

## 🗄️ Banco de dados

O banco utilizado pelo projeto é:

```text
outback_palmas
```

### Tabela `usuarios`

Campos documentados:

```text
id
nome
email
telefone
senha
tipo
criado_em
```

Tipos de usuário previstos:

```text
cliente
admin
```

### Tabela `reservas`

Campos documentados:

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

Status previstos:

```text
pendente
confirmada
cancelada
finalizada
```

---

## 💻 Como executar localmente

### 1. Instale e inicie o XAMPP

Instale o XAMPP e inicie os serviços:

- Apache
- MySQL

### 2. Coloque o projeto na pasta do servidor

No Windows, use como referência:

```text
C:\xampp\htdocs\outback-palmas
```

### 3. Crie o banco de dados

Abra o phpMyAdmin em `http://localhost/phpmyadmin/` e execute:

```sql
CREATE DATABASE outback_palmas
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Depois, importe o arquivo `outback-palmas.sql`, caso ele esteja presente no repositório, ou crie as tabelas conforme o esquema do projeto.

### 4. Configure a conexão

Edite `config/database.php` conforme as credenciais do seu ambiente. Exemplo comum para uma instalação local padrão do XAMPP:

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

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die("Erro ao conectar ao banco de dados.");
}
```

> Não publique senhas reais, tokens ou credenciais de produção no GitHub.

### 5. Abra o sistema

Com Apache e MySQL ativos, acesse:

```text
http://localhost/outback-palmas/
```

---

## 🔗 Links da navegação

Os caminhos usados pela página inicial devem corresponder aos arquivos existentes no projeto:

- `index.php` — página inicial
- `login.php` — acesso do usuário
- `reserva.php` — formulário de reserva
- `logout.php` — encerramento da sessão
- `minhas-reservas.php` — reservas do cliente
- iFood — configure o endereço no `href` do botão correspondente em `index.php`

Se algum arquivo tiver outro nome ou estiver em uma subpasta, atualize o link correspondente no código.

---

## 🌐 Publicação e limitações de hospedagem

O projeto utiliza PHP e MySQL. **O GitHub Pages não executa PHP nem hospeda um banco MySQL**: ele serve arquivos estáticos, como HTML, CSS e JavaScript.

Para executar login, sessões, reservas e acesso ao banco, publique a aplicação em um serviço de hospedagem que ofereça PHP e MySQL. O repositório GitHub pode continuar sendo usado para versionar e manter o código-fonte.

---

## 🔐 Controle de acesso

Após o login, a aplicação pode direcionar cada tipo de usuário para sua área correspondente:

### Administrador

```text
/admin/painel.php
```

Permite acompanhar usuários e gerenciar reservas, de acordo com as funcionalidades implementadas.

### Cliente

```text
/user/painel.php
```

Permite acessar as informações e reservas do próprio usuário, conforme a implementação existente.

---

## 🔒 Segurança

O projeto documenta o uso dos seguintes mecanismos:

- `password_hash()` para gerar hashes de senhas
- `password_verify()` para validar senhas
- PDO e consultas preparadas
- Sessões PHP
- `session_regenerate_id()`
- `htmlspecialchars()` para escapar conteúdo HTML
- Validação do tipo de usuário
- Proteção das páginas administrativas

Esses mecanismos devem ser aplicados de forma consistente em todos os pontos de entrada. Antes de publicar em produção, revise também validação de dados, autorização, proteção contra CSRF, tratamento de erros e configuração segura do servidor.

---

## 📈 Melhorias futuras

- Recuperação de senha
- Edição de perfil
- Cancelamento de reserva pelo cliente
- Pesquisa de reservas
- Filtros por data e status
- Controle de disponibilidade por horário
- Controle de mesas
- Dashboard administrativo com gráficos
- Notificações e confirmação de reservas
- Cardápio gerenciado pelo banco de dados
- Otimização e hospedagem local das imagens
- Ajustes de acessibilidade e desempenho
- Configuração por variáveis de ambiente
- Configuração do link direto da unidade no iFood

---

## 👨‍💻 Desenvolvedor

**Thales Marques Rodrigues**

Estudante de **Sistemas para Internet — IFTO**.

---

## 📄 Licença

Consulte o arquivo `LICENSE` para conhecer os termos de uso e distribuição do projeto.

---

## ⚠️ Aviso

Este projeto foi desenvolvido para fins acadêmicos, educacionais e de demonstração. Não é um site oficial do Outback Steakhouse. As marcas, os nomes e os materiais visuais mencionados pertencem aos seus respectivos proprietários.
