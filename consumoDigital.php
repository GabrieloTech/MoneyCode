<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLogged = isset($_SESSION['login']) || isset($_SESSION['nome']);
$nomeCompleto = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? $_SESSION['login'] ?? 'Usuário';
$primeiroNome = explode(' ', trim($nomeCompleto))[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Consumo Digital | MONEY CODE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/consumoDigital.css">

    <style>
        :root {
            --bg-page: #0b1d33;
            --bg-card: #132a4a;
            --bg-card-hover: #1a375f;
            --gold: #ffc700;
            --accent-cyan: #00f2ff;
            --text-main: #ffffff;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.08);
        }

        body {
            background-color: var(--bg-page) !important;
            color: var(--text-main) !important;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        /* DESTAQUE PRINCIPAL */
        .destaque-container {
            margin-bottom: 2.5rem;
        }

        .destaque-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            background-color: var(--bg-card);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            display: block;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .destaque-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 242, 255, 0.15);
        }

        .destaque-card img {
            width: 100%;
            height: 420px;
            object-fit: cover;
            display: block;
        }

        .destaque-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(7, 21, 37, 0.95) 10%, rgba(7, 21, 37, 0.6) 60%, transparent 100%);
            padding: 2.5rem 2rem 2rem 2rem;
        }

        .destaque-overlay h2 {
            color: var(--text-main);
            font-size: 1.8rem;
            font-weight: 800;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            line-height: 1.25;
        }

        .destaque-overlay p {
            color: var(--text-muted);
            font-size: 1.05rem;
            margin: 0;
        }

        /* GRID DE MATÉRIAS */
        .grid-materias {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .card-noticia {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            height: 100%;
        }

        .card-noticia:hover {
            transform: translateY(-4px);
            border-color: rgba(0, 242, 255, 0.4);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card-noticia .thumb-wrap {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .card-noticia img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card-noticia:hover img {
            transform: scale(1.05);
        }

        .card-noticia .conteudo {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-noticia h3 {
            color: var(--accent-cyan);
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.35;
            margin-top: 0.6rem;
            margin-bottom: 0.6rem;
        }

        .card-noticia p {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0;
            flex-grow: 1;
        }

        /* CATEGORIAS / BADGES */
        .categoria {
            display: inline-block;
            align-self: flex-start;
            background-color: var(--gold);
            color: #0b1d33;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* RESPONSIVIDADE */
        @media (max-width: 1023px) {
            .grid-materias {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .grid-materias {
                grid-template-columns: 1fr;
            }

            .destaque-card img {
                height: 320px;
            }

            .destaque-overlay h2 {
                font-size: 1.3rem;
            }
        }

        /* Ajuste fino para garantir que no mobile o botão de menu fique alinhado à direita */
        @media screen and (max-width: 1023px) {
            .navbar-brand {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
            }
        }

    </style>
</head>

<body>

       <!-- OVERLAY E DRAWER MOBILE -->
<div class="mobile-menu-overlay" id="mobileOverlay"></div>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-header">
        <!-- Substituído o ₿ pelo elemento de imagem da logo igual ao header -->
        <a href="index.php" class="logo">
            <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 40px; width: auto;">
        </a>
        <button class="drawer-close" id="drawerClose" aria-label="Fechar Menu">&times;</button>
    </div>
    <div class="drawer-body">
        <a href="index.php" class="drawer-item">Início</a>
        <a href="apostas.php" class="drawer-item">Apostas</a>
        <a href="cartao.php" class="drawer-item">Cartão</a>
        <a href="consumoDigital.php" class="drawer-item active">Consumo Digital</a>
        <a href="investimentos.php" class="drawer-item">Investimentos</a>
        <a href="bolsa-de-valor.php" class="drawer-item">Bolsa de Valores</a>
        <hr class="drawer-divider">
        <?php if ($isLogged): ?>
            <div class="px-3 mb-3">
                <a href="perfil.php" class="has-text-weight-bold text-gold is-size-6" style="text-decoration: underline;">
                    Olá, <?= htmlspecialchars($primeiroNome, ENT_QUOTES, 'UTF-8') ?>
                </a>
            </div>
            <a href="perfil.php" class="drawer-item">Meu Perfil / Editar</a>
            <a href="logout.php" class="button btn-cadastrar is-fullwidth mt-3">Sair da Conta</a>
        <?php else: ?>
            <a href="login.html" class="button btn-cadastrar is-fullwidth mb-2">Entrar</a>
        <?php endif; ?>
    </div>
</div>

<!-- NAVBAR DESKTOP & HEADER MOBILE -->
<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a href="index.php" class="navbar-item">
            <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 55px; width: auto;">
        </a>
        <button class="mobile-toggle" id="mobileToggle" aria-label="Abrir menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
    <div class="navbar-menu is-hidden-touch">
        <div class="navbar-start">
            <a href="apostas.php" class="navbar-item">Apostas</a>
            <a href="cartao.php" class="navbar-item">Cartão</a>
            <a href="consumoDigital.php" class="navbar-item is-active">Consumo Digital</a>
            <a href="investimentos.php" class="navbar-item">Investimentos</a>
            <a href="bolsa-de-valor.php" class="navbar-item">Bolsa de Valores</a>
        </div>
     <div class="navbar-end">
            <?php if ($isLogged): ?>
                <div class="navbar-item px-0">
                <a href="perfil.php" class="usuario-logado text-gold has-text-weight-semibold px-3 py-2">
                Olá, <?= htmlspecialchars($primeiroNome, ENT_QUOTES, 'UTF-8') ?>
            </a>
                </div>
                    <div class="navbar-item px-0">
                    <a href="logout.php" class="has-text-danger has-text-weight-semibold px-3 py-2">
                    Sair
                </a>
            </div>
                    <?php else: ?>
                        <div class="navbar-item">
                        <a class="button btn-cadastrar" href="login.html">Login</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

    <!-- ÁREA DE CONTEÚDO PRINCIPAL -->
    <main class="section">
        <div class="container">

            <!-- MATÉRIA 1: DESTAQUE PRINCIPAL -->
            <section class="destaque-container">
                <a href="materias/materia1.php" class="destaque-card">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200" alt="Síndrome de FOMO e Redes Sociais">
                    <div class="destaque-overlay">
                        <span class="categoria">CONSUMO DIGITAL</span>
                        <h2>Síndrome de FOMO: Como o medo de ficar de fora afeta seus gastos digitais</h2>
                        <p>Entenda os gatilhos psicológicos por trás de compras por impulso, redes sociais e como proteger suas finanças.</p>
                    </div>
                </a>
            </section>

            <!-- GRID COM AS OUTRAS 5 MATÉRIAS -->
            <section class="grid-materias">

                <!-- MATÉRIA 2 -->
                <article>
                    <a href="materias/materia2.php" class="card-noticia">
                        <div class="thumb-wrap">
                            <img src="https://plus.unsplash.com/premium_photo-1670863088251-500151f2117b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGNvbXByYXMlMjBhcGxpY2F0aXZvfGVufDB8fDB8fHww" alt="Estratégias para compras no celular">
                        </div>
                        <div class="conteudo">
                            <span class="categoria">DICAS</span>
                            <h3>5 estratégias para evitar compras por impulso em aplicativos</h3>
                            <p>Aprenda a configurar limites práticos e criar filtros de controle financeiro diretamente no seu smartphone.</p>
                        </div>
                    </a>
                </article>

                <!-- MATÉRIA 3 -->
                <article>
                    <a href="materias/materia3.php" class="card-noticia">
                        <div class="thumb-wrap">
                            <img src="https://images.pexels.com/photos/26922999/pexels-photo-26922999.jpeg" alt="Pessoa jogando no celular">
                        </div>
                        <div class="conteudo">
                            <span class="categoria">Jogos</span>
                            <h3>Jogos Gacha: Como induzem o consumo desenfreado em jogadores</h3>
                            <p>Estilo de jogo utiliza mecânicas de recompensa, aleatoriedade e eventos limitados para estimular o consumo.</p>
                        </div>
                    </a>
                </article>

                <!-- MATÉRIA 4 -->
                <article>
                    <a href="materias/materia4.php" class="card-noticia">
                        <div class="thumb-wrap">
                            <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=600" alt="Redes Sociais e Algoritmos">
                        </div>
                        <div class="conteudo">
                            <span class="categoria">TECNOLOGIA</span>
                            <h3>O impacto dos algoritmos nas suas decisões de compra</h3>
                            <p>Como os feeds de redes sociais usam dados comportamentais para induzir o consumo sem que você perceba.</p>
                        </div>
                    </a>
                </article>

                <!-- MATÉRIA 5 -->
                <article>
                    <a href="materias/materia5.php" class="card-noticia">
                        <div class="thumb-wrap">
                            <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=600" alt="Padrões Obscuros no Web Design">
                        </div>
                        <div class="conteudo">
                            <span class="categoria">ANÁLISE</span>
                            <h3>Padrões Obscuros: como interfaces te induzem a gastar</h3>
                            <p>Descubra os truques de design (Dark Patterns) utilizados por plataformas digitais para acelerar pagamentos.</p>
                        </div>
                    </a>
                </article>

                <!-- MATÉRIA 6 -->
                <article>
                    <a href="materias/materia6.php" class="card-noticia">
                        <div class="thumb-wrap">
                            <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=600" alt="Gestão de Assinaturas e Cartões">
                        </div>
                        <div class="conteudo">
                            <span class="categoria">PLANEJAMENTO</span>
                            <h3>Gestão de assinaturas: como cortar serviços não utilizados</h3>
                            <p>Aprenda a mapear mensalidades ocultas de streaming e apps para recuperar dinheiro esquecido.</p>
                        </div>
                    </a>
                </article>

            </section>

        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                    <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 55px; width: auto;">
                </a>
                <p>Plataforma de inteligência e educação financeira. Informações atualizadas para você tomar as melhores decisões sobre cartões, investimentos e consumo.</p>
            </div>

            <div class="footer-nav">
                <h4>Navegação</h4>
                <ul>
                    <li><a href="apostas.php">Apostas</a></li>
                    <li><a href="cartao.php">Cartão</a></li>
                    <li><a href="consumoDigital.php">Consumo Digital</a></li>
                    <li><a href="investimentos.php">Investimentos</a></li>
                    <li><a href="investimento.php">Perfil de Investidor</a></li>
                </ul>
            </div>

            <div class="footer-nav">
                <h4>Categorias Rápidas</h4>
                <ul>
                    <li><a href="#simulador">Sem Anuidade</a></li>
                    <li><a href="#simulador">Programas de Milhas</a></li>
                    <li><a href="#simulador">Cartões com Cashback</a></li>
                    <li><a href="#simulador">Segurança Digital</a></li>
                </ul>
            </div>

            <div class="footer-info">
                <h4>Isenção de Responsabilidade</h4>
                <p>Conteúdo estritamente informativo e educacional. Não realizamos emissão de cartões nem análise direta de crédito.</p>
                <div class="security-tags">
                    <span>Conexão Criptografada</span>
                    <span>Atualizado em 2026</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p>© 2026 MONEY CODE — Todos os direitos reservados.</p>
                <div class="footer-legal-links">
                    <a href="#">Termos de Uso</a>
                    <span>•</span>
                    <a href="#">Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCRIPT DE CONTROLE DO DRAWER MOBILE -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Menu Drawer Mobile
            const mobileToggle = document.getElementById('mobileToggle');
            const drawerClose = document.getElementById('drawerClose');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const mobileDrawer = document.getElementById('mobileDrawer');

            function toggleDrawer(open) {
                const isOpen = open !== undefined ? open : !mobileDrawer.classList.contains('active');
                mobileDrawer.classList.toggle('active', isOpen);
                mobileOverlay.classList.toggle('active', isOpen);
                mobileDrawer.setAttribute('aria-hidden', !isOpen);
                mobileToggle.setAttribute('aria-expanded', isOpen);
                document.body.style.overflow = isOpen ? 'hidden' : '';
            }

            if (mobileToggle) mobileToggle.addEventListener('click', () => toggleDrawer(true));
            if (drawerClose) drawerClose.addEventListener('click', () => toggleDrawer(false));
            if (mobileOverlay) mobileOverlay.addEventListener('click', () => toggleDrawer(false));

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && mobileDrawer.classList.contains('active')) {
                    toggleDrawer(false);
                }
            });

            // Carrossel Responsivo com Touch/Swipe
            const slides = document.querySelectorAll('.mc-slide');
            const dots = document.querySelectorAll('.dot');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const carouselContainer = document.getElementById('carouselContainer');
            
            if (slides.length === 0) return;

            let currentIndex = 0;
            let slideInterval;

            function showSlide(index) {
                if (index >= slides.length) currentIndex = 0;
                else if (index < 0) currentIndex = slides.length - 1;
                else currentIndex = index;

                slides.forEach((slide, i) => slide.classList.toggle('active', i === currentIndex));
                dots.forEach((dot, i) => dot.classList.toggle('active', i === currentIndex));
            }

            function nextSlide() { showSlide(currentIndex + 1); }
            function prevSlide() { showSlide(currentIndex - 1); }

            function startTimer() { slideInterval = setInterval(nextSlide, 5000); }
            function resetTimer() { clearInterval(slideInterval); startTimer(); }

            if (nextBtn && prevBtn) {
                nextBtn.addEventListener('click', () => { nextSlide(); resetTimer(); });
                prevBtn.addEventListener('click', () => { prevSlide(); resetTimer(); });
            }

            dots.forEach(dot => {
                dot.addEventListener('click', (e) => {
                    const idx = parseInt(e.target.dataset.index, 10);
                    showSlide(idx);
                    resetTimer();
                });
            });

            // Gestos Swipe para Telas Sensíveis ao Toque
            let touchStartX = 0;
            let touchEndX = 0;

            if (carouselContainer) {
                carouselContainer.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                carouselContainer.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    if (touchEndX < touchStartX - 40) { nextSlide(); resetTimer(); }
                    if (touchEndX > touchStartX + 40) { prevSlide(); resetTimer(); }
                }, { passive: true });
            }

            startTimer();
        });
    </script>

</body>

</html>