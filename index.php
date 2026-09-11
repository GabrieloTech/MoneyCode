<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cabeçalhos para evitar cache de sessão no navegador
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verificação de autenticação idêntica à página de cartões
$isLogged = isset($_SESSION['login']) || isset($_SESSION['nome']) || isset($_SESSION['usuario_nome']);

$nomeCompleto = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? $_SESSION['login'] ?? 'Usuário';
$primeiroNome = explode(' ', trim($nomeCompleto))[0];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONEY CODE - Portal de Notícias e Finanças</title>
    <meta name="description" content="Plataforma de inteligência e educação financeira. Saiba mais sobre cartões, investimentos e consumo.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    
    <style>
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


  <!-- NAVBAR DESSA BAGAÇA SOCORRO(comentario do gabriel) -->
<div class="mobile-menu-overlay" id="mobileOverlay"></div>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-header">
            <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 40px; width: auto;">
        <button class="drawer-close" id="drawerClose" aria-label="Fechar Menu">&times;</button>
    </div>
    <div class="drawer-body">
        <a href="index.php" class="drawer-item active">Início</a>
        <a href="apostas.php" class="drawer-item">Apostas</a>
        <a href="cartao.php" class="drawer-item">Cartão</a>
        <a href="consumoDigital.php" class="drawer-item">Consumo Digital</a>
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
            <a href="consumoDigital.php" class="navbar-item">Consumo Digital</a>
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

    


    <div class="news-ticker" role="region" aria-label="Notícias de Plantão">
        <div class="container">
            <div class="ticker-wrapper">
                <span class="ticker-badge">PLANTÃO</span>
                <div class="ticker-track-container">
                    <div class="ticker-track">
                        <span class="ticker-text">Selic e mercado: Entenda as decisões de investimentos para este mês &nbsp;&bull;&nbsp; </span>
                        <span class="ticker-text">Uso do rotativo do cartão exige cautela no orçamento doméstico &nbsp;&bull;&nbsp; </span>
                        <span class="ticker-text">Bolsa de Valores fecha em alta impulsionada pelo setor de tecnologia &nbsp;&bull;&nbsp; </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="section pt-4 pb-4">
        <div class="container">
            <div class="columns">
                <div class="column is-8-desktop is-12-tablet">
                    
                    <div class="mc-carousel-container" id="carouselContainer">
                        <div class="mc-carousel-slides" id="carouselSlides">
                            <article class="mc-slide active">
                                <a href="apostas.php" class="post-link">
                                    <div class="featured-card">
                                        <img src="imagens/investimento/apostaINV.jpg" alt="Apostas Online" width="800" height="450" fetchpriority="high" decoding="async">
                                        <div class="overlay">
                                            <span class="tag tag-yellow mb-2">APOSTAS</span>
                                            <h2 class="title is-4-desktop is-5-mobile has-text-white mb-2">Apostas online: risco silencioso para sua vida financeira</h2>
                                            <p class="is-hidden-mobile">Sem controle, o crescimento das plataformas digitais pode gerar dívidas e perda de patrimônio.</p>
                                        </div>
                                    </div>
                                </a>
                            </article>

                            <article class="mc-slide">
                                <a href="bolsa-de-valor.php" class="post-link">
                                    <div class="featured-card">
                                        <img src="imagens/investimento/bolsaINV.jpg" alt="Bolsa de Valores" width="800" height="450" loading="lazy" decoding="async">
                                        <div class="overlay">
                                            <span class="tag tag-yellow mb-2">BOLSA DE VALORES</span>
                                            <h2 class="title is-4-desktop is-5-mobile has-text-white mb-2">Análise de mercado: Estratégias para diversificação em ações</h2>
                                            <p class="is-hidden-mobile">Entenda os fundamentos básicos para montar uma carteira de renda variável.</p>
                                        </div>
                                    </div>
                                </a>
                            </article>

                            <article class="mc-slide">
                                <a href="cartao.php" class="post-link">
                                    <div class="featured-card">
                                        <img src="imagens/investimento/cartaoINV.jpg" alt="Cartão de Crédito" width="800" height="450" loading="lazy" decoding="async">
                                        <div class="overlay">
                                            <span class="tag tag-yellow mb-2">CARTÃO</span>
                                            <h2 class="title is-4-desktop is-5-mobile has-text-white mb-2">Cartão de crédito: planejamento e uso consciente de limites</h2>
                                            <p class="is-hidden-mobile">Aprenda a controlar o fluxo de vencimentos e usar o crédito como estratégia.</p>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        </div>

                        <button class="carousel-btn prev" id="prevBtn" aria-label="Slide Anterior">&lsaquo;</button>
                        <button class="carousel-btn next" id="nextBtn" aria-label="Próximo Slide">&rsaquo;</button>
                        
                        <div class="carousel-dots" id="carouselDots">
                            <button class="dot active" data-index="0" aria-label="Ir para slide 1"></button>
                            <button class="dot" data-index="1" aria-label="Ir para slide 2"></button>
                            <button class="dot" data-index="2" aria-label="Ir para slide 3"></button>
                        </div>
                    </div>

                    <div class="columns is-multiline is-mobile-stacked mt-3">
                        <div class="column is-6">
                            <a href="investimentos.php" class="post-link">
                                <article class="card-glass p-4 h-100">
                                    <span class="tag tag-yellow mb-2">INVESTIMENTOS</span>
                                    <h3 class="title is-6 mb-2 text-gold">Construção de Reserva de Emergência</h3>
                                    <p class="is-size-7">Onde aplicar capital com liquidez diária e baixo risco para imprevistos domésticos.</p>
                                </article>
                            </a>
                        </div>
                        <div class="column is-6">
                            <a href="consumoDigital.php" class="post-link">
                                <article class="card-glass p-4 h-100">
                                    <span class="tag tag-yellow mb-2">CONSUMO</span>
                                    <h3 class="title is-6 mb-2 text-gold">Gestão de Assinaturas e Recorrentes</h3>
                                    <p class="is-size-7">Identifique e elimine microdespesas digitais que acumulam no final do mês.</p>
                                </article>
                            </a>
                        </div>
                    </div>

                </div>

                <aside class="column is-4-desktop is-12-tablet">
                    <div class="sidebar">
                        <h3 class="sidebar-title">MAIS LIDAS</h3>

                        <a href="apostas.php" class="rank-item">
                            <span class="rank-num">01</span>
                            <div>
                                <strong class="rank-heading">Apostas Online</strong>
                                <p class="is-size-7">Análise de riscos e educação financeira</p>
                            </div>
                        </a>

                        <a href="cartao.php" class="rank-item">
                            <span class="rank-num">02</span>
                            <div>
                                <strong class="rank-heading">Uso Racional do Cartão</strong>
                                <p class="is-size-7">Como gerenciar datas e pagamentos</p>
                            </div>
                        </a>

                        <a href="consumoDigital.php" class="rank-item">
                            <span class="rank-num">03</span>
                            <div>
                                <strong class="rank-heading">Consumo Digital</strong>
                                <p class="is-size-7">Controle de faturas e assinaturas</p>
                            </div>
                        </a>

                        <a href="investimentos.php" class="rank-item">
                            <span class="rank-num">04</span>
                            <div>
                                <strong class="rank-heading">Investimentos</strong>
                                <p class="is-size-7">Passos iniciais para aplicar recursos</p>
                            </div>
                        </a>

                        <a href="bolsa-de-valor.php" class="rank-item">
                            <span class="rank-num">05</span>
                            <div>
                                <strong class="rank-heading">Bolsa de Valores</strong>
                                <p class="is-size-7">Conceitos práticos de renda variável</p>
                            </div>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <section class="section pt-0">
        <div class="container">
            
            <div class="category-block mb-6">
                <div class="category-header mb-4">
                    <h3 class="category-title">INVESTIMENTOS & FINANÇAS</h3>
                    <a href="investimentos.php" class="see-more">Ver todos em Investimentos &rsaquo;</a>
                </div>
                <div class="columns is-multiline">
                    <div class="column is-4-desktop is-6-tablet">
                        <a href="investimentos.php" class="post-link">
                            <article class="news-card-vertical card-glass">
                                <img src="imagens/index/tesouroINV.webp" alt="Tesouro Direto vs CDBs" width="400" height="225" loading="lazy" decoding="async">
                                <div class="p-4">
                                    <span class="tag tag-yellow mb-2">RENDA FIXA</span>
                                    <h4 class="title is-6 text-gold mb-2">Tesouro Direto vs CDBs de Liquidez Diária</h4>
                                    <p class="is-size-7">Compare a rentabilidade real considerando alíquotas de imposto de renda e inflação.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                    <div class="column is-4-desktop is-6-tablet">
                        <a href="investimentos.php" class="post-link">
                            <article class="news-card-vertical card-glass">
                                <img src="imagens/index/aportesINV.jpeg" alt="Aportes Mensais" width="400" height="225" loading="lazy" decoding="async">
                                <div class="p-4">
                                    <span class="tag tag-yellow mb-2">PLANEJAMENTO</span>
                                    <h4 class="title is-6 text-gold mb-2">Como manter aportes mensais constantes</h4>
                                    <p class="is-size-7">Estratégias para automatizar economias sem comprometer o custo de vida mensal.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                    <div class="column is-4-desktop is-6-tablet">
                        <a href="investimentos.php" class="post-link">
                            <article class="news-card-vertical card-glass">
                                <img src="imagens/index/perfilINV.png" alt="Perfil de Investidor" width="400" height="225" loading="lazy" decoding="async">
                                <div class="p-4">
                                    <span class="tag tag-yellow mb-2">PERFIL DE INVESTIDOR</span>
                                    <h4 class="title is-6 text-gold mb-2">Descubra sua tolerância ao risco no mercado</h4>
                                    <p class="is-size-7">Conservador, moderado ou arrojado: entenda qual carteira se adapta aos seus objetivos.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                </div>
            </div>

            <div class="category-block mb-6">
                <div class="category-header mb-4">
                    <h3 class="category-title">CARTÃO & CONSUMO DIGITAL</h3>
                    <a href="cartao.php" class="see-more">Ver mais notícias &rsaquo;</a>
                </div>
                <div class="columns is-multiline">
                    <div class="column is-6-desktop is-12-tablet">
                        <a href="cartao.php" class="post-link">
                            <article class="news-item card-glass p-3">
                                <img src="imagens/investimento/cartaoINV.jpg" alt="Juros do Cartão" width="200" height="150" loading="lazy" decoding="async">
                                <div>
                                    <span class="tag tag-yellow mb-1">CARTÃO</span>
                                    <h4 class="title is-6 mb-1 text-gold">Juros do rotativo: entenda o impacto no orçamento</h4>
                                    <p class="is-size-7">Evite parcelamentos automáticos das operadoras e renegocie prazos antes do vencimento.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                    <div class="column is-6-desktop is-12-tablet">
                        <a href="consumoDigital.php" class="post-link">
                            <article class="news-item card-glass p-3">
                                <img src="imagens/investimento/consumoINV.jpg" alt="Assinaturas Esquecidas" width="200" height="150" loading="lazy" decoding="async">
                                <div>
                                    <span class="tag tag-yellow mb-1">CONSUMO DIGITAL</span>
                                    <h4 class="title is-6 mb-1 text-gold">Assinaturas esquecidas que pesam no bolso</h4>
                                    <p class="is-size-7">Saiba como auditar suas faturas de cartão para eliminar cobranças automáticas desnecessárias.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                </div>
            </div>

            <div class="category-block mb-6">
                <div class="category-header mb-4">
                    <h3 class="category-title">BOLSA DE VALORES & MERCADOS</h3>
                    <a href="bolsa-de-valor.php" class="see-more">Ver tudo em Bolsa &rsaquo;</a>
                </div>
                <div class="columns is-multiline">
                    <div class="column is-4-desktop is-6-tablet">
                        <a href="bolsa-de-valor.php" class="post-link">
                            <article class="news-card-vertical card-glass">
                                <img src="imagens/index/acoesINV.jpg" alt="Análise de Ações" width="400" height="225" loading="lazy" decoding="async">
                                <div class="p-4">
                                    <span class="tag tag-yellow mb-2">AÇÕES</span>
                                    <h4 class="title is-6 text-gold mb-2">Análise fundamentalista para iniciantes</h4>
                                    <p class="is-size-7">Os principais indicadores para avaliar a saúde financeira das empresas na B3.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                    <div class="column is-4-desktop is-6-tablet">
                        <a href="bolsa-de-valor.php" class="post-link">
                            <article class="news-card-vertical card-glass">
                                <img src="imagens/index/fiisINV.jpg" alt="Fundos Imobiliários" width="400" height="225" loading="lazy" decoding="async">
                                <div class="p-4">
                                    <span class="tag tag-yellow mb-2">FIIs</span>
                                    <h4 class="title is-6 text-gold mb-2">Fundos Imobiliários: renda mensal com proventos</h4>
                                    <p class="is-size-7">Entenda como investir no setor imobiliário sem a necessidade de comprar imóveis físicos.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                    <div class="column is-4-desktop is-6-tablet">
                        <a href="apostas.php" class="post-link">
                            <article class="news-card-vertical card-glass">
                                <img src="imagens/index/diferencial.jpg" alt="Investimento vs Apostas" width="100" height="150" loading="lazy" decoding="async">
                                <div class="p-4">
                                    <span class="tag tag-yellow mb-2">CONSCIENTIZAÇÃO</span>
                                    <h4 class="title is-6 text-gold mb-2">Investimento vs Apostas: entenda a diferença</h4>
                                    <p class="is-size-7">Por que apostas não devem ser tratadas como investimento ou fonte de renda.</p>
                                </div>
                            </article>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                   <img src="imagens/logo/logo.png" alt="MONEY CODE" width="180" height="55" style="max-height: 55px; width: auto;" loading="lazy" decoding="async">
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
                    <li><a href="bolsa-de-valor.php">Bolsa de Valores</a></li>
                </ul>
            </div>

            <div class="footer-nav">
                <h4>Categorias Rápidas</h4>
                <ul>
                    <li><a href="cartao.php">Sem Anuidade</a></li>
                    <li><a href="cartao.php">Programas de Milhas</a></li>
                    <li><a href="cartao.php">Cartões com Cashback</a></li>
                    <li><a href="consumoDigital.php">Segurança Digital</a></li>
                </ul>
            </div>

            <div class="footer-info">
                <h4>Isenção de Responsabilidade</h4>
                <p>Conteúdo estritamente informativo e educacional. Não realizamos emissão de cartões nem análise direta de crédito.</p>
                <div class="security-tags">
                    <span>Conexão Criptografada</span>
                    <span>Atualizado em <?= date('Y') ?></span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p>© <?= date('Y') ?> MONEY CODE — Todos os direitos reservados.</p>
                <div class="footer-legal-links">
                    <a href="#">Termos de Uso</a>
                    <span>•</span>
                    <a href="#">Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

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