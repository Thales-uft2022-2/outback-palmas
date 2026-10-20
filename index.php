<?php
session_start();

/*
 * Página inicial demonstrativa do Outback Palmas.
 * Ajuste os links abaixo caso os nomes dos arquivos do seu projeto sejam diferentes.
 */
$usuarioLogado = isset($_SESSION['usuario_id']);
$nomeUsuario = $_SESSION['usuario_nome'] ?? $_SESSION['nome'] ?? 'Visitante';

$slides = [
    [
        'imagem' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=2000&q=85',
        'alt' => 'Prato grelhado servido à mesa',
        'titulo' => 'Bons momentos,',
        'destaque' => 'grandes sabores.',
        'texto' => 'Reúna quem você gosta e transforme qualquer encontro em uma ocasião especial.'
    ],
    [
        'imagem' => 'https://images.unsplash.com/photo-1558030006-450675393462?auto=format&fit=crop&w=2000&q=85',
        'alt' => 'Carne grelhada com acompanhamentos',
        'titulo' => 'Sabor que dá',
        'destaque' => 'vontade de voltar.',
        'texto' => 'Uma experiência descontraída para compartilhar pratos e boas histórias.'
    ],
    [
        'imagem' => 'https://images.unsplash.com/photo-1547595628-c61a29f495f7?auto=format&fit=crop&w=2000&q=85',
        'alt' => 'Refeição preparada para compartilhar',
        'titulo' => 'Sua próxima história',
        'destaque' => 'começa à mesa.',
        'texto' => 'Escolha a companhia, planeje sua visita e aproveite o momento.'
    ],
];

$categorias = [
    [
        'numero' => '01 / ENTRADAS',
        'titulo' => 'Comece compartilhando',
        'descricao' => 'Petiscos e entradas para abrir o apetite e reunir todo mundo em volta da mesa.',
        'imagem' => 'https://images.unsplash.com/photo-1625938145744-e380515399bf?auto=format&fit=crop&w=900&q=85',
        'alt' => 'Entrada para compartilhar'
    ],
    [
        'numero' => '02 / PRINCIPAIS',
        'titulo' => 'O sabor é protagonista',
        'descricao' => 'Pratos marcantes, carnes grelhadas e acompanhamentos cheios de personalidade.',
        'imagem' => 'https://images.unsplash.com/photo-1546241072-48010ad2862c?auto=format&fit=crop&w=900&q=85',
        'alt' => 'Carne grelhada com acompanhamentos'
    ],
    [
        'numero' => '03 / SOBREMESAS',
        'titulo' => 'Guarde espaço para doce',
        'descricao' => 'Uma pausa doce para terminar a experiência com aquele gostinho de quero mais.',
        'imagem' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?auto=format&fit=crop&w=900&q=85',
        'alt' => 'Sobremesa gelada'
    ],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Outback Palmas: uma página demonstrativa para planejar encontros e conhecer categorias do cardápio.">
    <meta name="theme-color" content="#171717">
    <title>Outback Palmas | Bons momentos, grandes sabores</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="top">
<header class="site-header">
    <div class="navbar">
        <a class="logo" href="index.php" aria-label="Outback Palmas - início">
            <span class="logo-main">OUTBACK</span>
            <span class="logo-city">PALMAS</span>
        </a>

        <button class="menu-toggle" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="menu-principal">
            <span></span><span></span><span></span>
        </button>

        <nav class="menu" id="menu-principal" aria-label="Menu principal">
            <a href="#sobre">Sobre</a>
            <a href="#menu">Experiência</a>
            <a href="#bebidas">Bebidas</a>
            <?php if ($usuarioLogado): ?>
                <a href="minhas-reservas.php">Minhas reservas</a>
                <span class="user-greeting">Olá, <?= htmlspecialchars($nomeUsuario, ENT_QUOTES, 'UTF-8') ?></span>
                <a class="nav-login" href="logout.php">Sair</a>
            <?php else: ?>
                <a href="login.php">Entrar</a>
                <a class="nav-login" href="reserva.php">Fazer reserva</a>
                <a class="nav-ifood" href="https://www.ifood.com.br/" target="_blank" rel="noopener noreferrer">Pedir pelo iFood <span aria-hidden="true">↗</span></a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main>
    <section class="hero" aria-label="Destaques">
        <div class="hero-slides" aria-hidden="true">
            <?php foreach ($slides as $indice => $slide): ?>
                <div class="hero-slide<?= $indice === 0 ? ' is-active' : '' ?>"
                    style="background-image: url('<?= htmlspecialchars($slide['imagem'], ENT_QUOTES, 'UTF-8') ?>')"></div>
            <?php endforeach; ?>
        </div>
        <div class="hero-shade"></div>
        <div class="hero-content">
            <span class="hero-eyebrow"><span class="eyebrow-line"></span> OUTBACK PALMAS</span>
            <h1 id="hero-title"><?= htmlspecialchars($slides[0]['titulo'], ENT_QUOTES, 'UTF-8') ?><br><em><?= htmlspecialchars($slides[0]['destaque'], ENT_QUOTES, 'UTF-8') ?></em></h1>
            <p id="hero-text"><?= htmlspecialchars($slides[0]['texto'], ENT_QUOTES, 'UTF-8') ?></p>
            <div class="hero-buttons">
                <a class="btn btn-primary" href="reserva.php">Planeje sua visita <span aria-hidden="true">↗</span></a>
                <a class="btn btn-outline" href="#menu">Conheça a experiência</a>
            </div>
        </div>
        <div class="hero-bottom">
            <a class="scroll-cue" href="#sobre"><span></span> DESCUBRA</a>
            <div class="hero-pagination" aria-label="Selecionar destaque">
                <?php foreach ($slides as $indice => $slide): ?>
                    <button type="button" class="pagination-dot<?= $indice === 0 ? ' is-active' : '' ?>"
                            aria-label="Mostrar destaque <?= $indice + 1 ?>" data-slide="<?= $indice ?>"></button>
                <?php endforeach; ?>
            </div>
            <span class="hero-side-note">GOOD FOOD · GOOD TIMES</span>
        </div>
    </section>

    <section class="intro section-wrap" id="sobre">
        <div class="intro-copy reveal">
            <span class="section-kicker">MAIS QUE UMA REFEIÇÃO</span>
            <h2>Feito para <em>compartilhar.</em></h2>
            <p>Reúna a turma, celebre uma conquista ou transforme um dia comum em uma ocasião especial. Aqui, o clima é descontraído e cada encontro merece ser aproveitado.</p>
            <a class="text-link" href="reserva.php">Planeje sua visita <span aria-hidden="true">→</span></a>
        </div>
        <div class="intro-visual reveal">
            <img src="https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1100&q=85"
                alt="Prato de comida grelhada servido à mesa" loading="lazy">
            <div class="image-stamp"><span>GOOD</span><strong>FOOD</strong><span>GOOD TIMES</span></div>
        </div>
    </section>

    <section class="menu-section section-wrap" id="menu">
        <div class="section-heading reveal">
            <div>
                <span class="section-kicker">DO PRIMEIRO PEDIDO À ÚLTIMA MORDIDA</span>
                <h2>Encontre seu <em>favorito.</em></h2>
            </div>
            <p>Entradas para dividir, pratos que impressionam e sobremesas que fecham o encontro com chave de ouro.</p>
        </div>

        <div class="food-grid">
            <?php foreach ($categorias as $categoria): ?>
                <article class="food-card reveal">
                    <div class="food-photo">
                        <img src="<?= htmlspecialchars($categoria['imagem'], ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($categoria['alt'], ENT_QUOTES, 'UTF-8') ?>" loading="lazy">
                        <span class="photo-label"><?= htmlspecialchars($categoria['numero'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="food-info">
                        <span class="card-number"><?= htmlspecialchars($categoria['numero'], ENT_QUOTES, 'UTF-8') ?></span>
                        <h3><?= htmlspecialchars($categoria['titulo'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <p><?= htmlspecialchars($categoria['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <p class="menu-disclaimer">Imagens ilustrativas. Consulte os canais oficiais da unidade para confirmar cardápio e disponibilidade.</p>
    </section>

    <section class="drinks-section" id="bebidas">
        <div class="drinks-image" role="img" aria-label="Bebidas preparadas para um encontro"></div>
        <div class="drinks-content reveal">
            <span class="section-kicker">BRINDE AOS BONS MOMENTOS</span>
            <h2>Um brinde à <em>boa companhia.</em></h2>
            <p>Drinks, cervejas e bebidas para acompanhar sua escolha e deixar o encontro ainda mais especial.</p>
            <a href="reserva.php" class="btn btn-primary">Venha brindar com a gente <span aria-hidden="true">↗</span></a>
            <small>Consulte a disponibilidade de bebidas na unidade. Venda de bebidas alcoólicas proibida para menores de 18 anos.</small>
        </div>
        <div class="floating-caption" aria-hidden="true">POUR · SIP · ENJOY</div>
    </section>

    <section class="reservation-cta">
        <div class="cta-glow"></div>
        <div class="cta-content reveal">
            <span class="section-kicker">A MESA ESTÁ POSTA</span>
            <h2>Seu próximo encontro<br><em>começa com uma reserva.</em></h2>
            <p>Chame quem você gosta e venha aproveitar esse momento.</p>
            <a href="reserva.php" class="btn btn-primary">Fazer uma reserva <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>

<footer class="site-footer">
    <a class="logo footer-brand" href="index.php"><span class="logo-main">OUTBACK</span><span class="logo-city">PALMAS</span></a>
    <p>Projeto local de demonstração. Consulte os canais oficiais para informações atualizadas sobre horários, cardápio e disponibilidade.</p>
    <div class="footer-bottom">
        <span>© <?= date('Y') ?> Outback Palmas</span>
        <a href="#top">Voltar ao topo ↑</a>
    </div>
</footer>

<script>
(() => {
    const toggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const aberto = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(aberto));
            toggle.setAttribute('aria-label', aberto ? 'Fechar menu' : 'Abrir menu');
        });

        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.setAttribute('aria-label', 'Abrir menu');
            });
        });
    }

    const slides = [...document.querySelectorAll('.hero-slide')];
    const dots = [...document.querySelectorAll('.pagination-dot')];
    const title = document.querySelector('#hero-title');
    const paragraph = document.querySelector('#hero-text');
    const slideContent = <?= json_encode(array_map(static function ($slide) {
        return [
            'titulo' => $slide['titulo'],
            'destaque' => $slide['destaque'],
            'texto' => $slide['texto']
        ];
    }, $slides), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;

    let currentSlide = 0;
    let slideTimer;

    function showSlide(index) {
        if (!slides.length) return;
        currentSlide = (index + slides.length) % slides.length;

        slides.forEach((slide, i) => slide.classList.toggle('is-active', i === currentSlide));
        dots.forEach((dot, i) => {
            dot.classList.toggle('is-active', i === currentSlide);
            dot.setAttribute('aria-pressed', String(i === currentSlide));
        });

        if (title && paragraph && slideContent[currentSlide]) {
            title.innerHTML = `${escapeHtml(slideContent[currentSlide].titulo)}<br><em>${escapeHtml(slideContent[currentSlide].destaque)}</em>`;
            paragraph.textContent = slideContent[currentSlide].texto;
        }
    }

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, char => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'
        }[char]));
    }

    function restartTimer() {
        window.clearInterval(slideTimer);
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches && slides.length > 1) {
            slideTimer = window.setInterval(() => showSlide(currentSlide + 1), 6500);
        }
    }

    dots.forEach(dot => dot.addEventListener('click', () => {
        showSlide(Number(dot.dataset.slide));
        restartTimer();
    }));
    restartTimer();

    const revealItems = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealItems.forEach(item => observer.observe(item));
    } else {
        revealItems.forEach(item => item.classList.add('is-visible'));
    }
})();
</script>
</body>
</html>
