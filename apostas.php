<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLogged = isset($_SESSION['login']) || isset($_SESSION['nome']);

$nomeCompleto = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? $_SESSION['login'] ?? 'Usuário';
$primeiroNome = explode(' ', trim($nomeCompleto))[0];

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Consumo Digital | TI103</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style/style.css">

    <link rel="stylesheet" href="style/aposta.css">


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
        <a href="apostas.php" class="drawer-item active">Apostas</a>
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
            <a href="apostas.php" class="navbar-item is-active">Apostas</a>
            <a href="cartao.php" class="navbar-item">Cartão</a>
            <a href="consumoDigital.php" class="navbar-item ">Consumo Digital</a>
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


    <main class="apostas">

    <div class="apostas-container">

        <section class="apostas-hero">

            <div class="apostas-texto">

                <span class="apostas-categoria">
                    NOTÍCIA EM DESTAQUE
                </span>

                <h1>
                    Ludopatia: Entenda o vício em jogos de azar
                </h1>

                <p>
                    Ludopatia é o vício em jogos de aposta, como cassinos, apostas esportivas, bingo e jogos on-line.
                    A pessoa perde o controle sobre quanto tempo e dinheiro gasta, mesmo percebendo que isso pode causar problemas financeiros, familiares e emocionais.
                </p>

                <a href="https://g1.globo.com/saude/saude-mental/noticia/2024/07/16/ludopatia-entenda-o-que-e-a-doenc.ghtml">
                            <span class="ler-materia">Ler matéria completa →</span>
                </a> 
                   
            </div>

            <div class="apostas-imagem">

                <img src="https://www.rbsdirect.com.br/filestore/1/7/9/4/5/1/6_5af70464f236165/6154971_74aaf215c8c28c1.jpg?format=webp&w=1280" alt="Futebol">

            </div>

        </section>


        <section class="apostas-noticias">

            <h2>Últimas Notícias</h2>

            <div class="apostas-grid">

                <article class="apostas-card">

                    <img src="https://plus.unsplash.com/premium_photo-1667868018725-36d4a1f32922?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">

                    <div class="card-conteudo">

                        <span>Brasileiro</span>

                        <h3>
                            Milhões de brasileiros fizeram apostas no 1º tri de 2026
                        </h3>

                        <p>
                           Brasileiros fizeram apostas em bets autorizadas pela Secretaria de Apostas, 
                           do Ministério da Fazenda, entre janeiro e março de 2026 
                        </p>
                        
                        <a href="https://www.metropoles.com/colunas/grande-angular/bets-152-milhoes-de-brasileiros-fizeram-apostas-no-1o-tri-de-2026">
                            <span>Ler matéria completa →</span>
                        </a>            

                    </div>

                </article>

                <article class="apostas-card">

                    <img src="https://images.unsplash.com/photo-1570498839593-e565b39455fc?q=80&w=735&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">

                    <div class="card-conteudo">

                        <span>Mercado</span>

                        <h3>
                            Casas de apostas investem em Inteligência Artificial.
                        </h3>

                        <p>
                            Após a regulamentação das apostas no Brasil,
                            a BETesporte lançou uma nova ferramenta para aumentar a segurança dos usuários.
                        </p>

                        <a href="https://www.lance.com.br/lance-negocios/plataforma-de-apostas-vai-usar-inteligencia-artificial-por-mais-seguranca-no-brasil.html">
                            <span>Ler matéria completa →</span>
                        </a> 

                    </div>

                </article>

                <article class="apostas-card">

                    <img src="https://images.unsplash.com/photo-1659025807948-4d4674c4abbf?q=80&w=1464&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">

                    <div class="card-conteudo">

                        <span>Análise</span>

                        <h3>
                            Como interpretar odds antes de apostar, e fazer a melhor aposta.
                        </h3>

                        <p>
                            Entenda como pequenas mudanças podem alterar o valor
                            de uma aposta. Nem sempre o que rende mais é melhor.
                        </p>

                        <a href="https://www.gazetaesportiva.com/apostas/odds">
                            <span>Ler matéria completa →</span>
                        </a> 

                    </div>

                </article>

                <article class="apostas-card">

                    <img src="https://images.unsplash.com/photo-1527871369852-eb58cb2b54e2?q=80&w=1631&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">

                    <div class="card-conteudo">

                        <span>Futebol</span>

                        <h3>
                            Finais prometem equilíbrio entre os favoritos.
                        </h3>

                        <p>
                            Supercomputador prevê favoritos nas oitavas da Copa do Mundo, veja as chances do Brasil. prometem confrontos equilibrados
                      </p>

                        <a href="https://exame.com/esporte/supercomputador-preve-favoritos-nas-oitavas-da-copa-do-mundo-veja-as-chances-do-brasil/">
                            <span>Ler matéria completa →</span>
                        </a> 

                    </div>

                </article>

                <article class="apostas-card">

                    <img src="https://acontecebotucatu.com.br/wp-content/uploads/2022/02/01.jpg">

                    <div class="card-conteudo">

                        <span>Dicas</span>

                        <h3>
                            Gestão de banca continua sendo a principal estratégia.
                        </h3>

                        <p>
                            Gestão de banca: por que a maioria dos brasileiros aposta sem método?
                        </p>

                        <a href="https://www.oddschecker.com/br/noticias/apostas/gestao-de-banca-por-que-a-maioria-dos-brasileiros-aposta-sem-metodo">
                            <span>Ler matéria completa →</span>
                        </a> 

                    </div>

                </article>

                <article class="apostas-card">

                    <img src="https://gamingera.biz/wp-content/uploads/2025/06/esports-esportes-eletronicos-gamer-jogador-pro-player-mobile-mobile-gamer.jpg">

                    <div class="card-conteudo">

                        <span>eSports</span>

                        <h3>
                            Competições de eSports seguem em crescimento.
                        </h3>

                        <p>
                            O cenário competitivo movimenta milhões de fãs em
                            todo o mundo.
                        </p>

                        <a href="https://gamingera.biz/esports-brasil-crescimento-impacto-mercado-ricardo-filo/">
                            <span>Ler matéria completa →</span>
                        </a> 

                    </div>

                </article>

            </div>

        </section>


        <section class="estatisticas">

            <h2>Estatísticas do Mercado</h2>

            <div class="estatisticas-grid">

                <div class="numero">

                    <h3>+100</h3>

                    <p>Casas Regulamentadas</p>

                </div>

                <div class="numero">

                    <h3>+50</h3>

                    <p>Modalidades Esportivas</p>

                </div>

                <div class="numero">

                    <h3>24h</h3>

                    <p>Mercado Ativo</p>

                </div>

                <div class="numero">

                    <h3>Bilhões</h3>

                    <p>Apostas por Ano</p>

                </div>

            </div>

        </section>


        <section class="jogos-alta">

            <h2>Jogos em Alta</h2>

            <ul>

                <li>Palmeiras x Flamengo  </li>

                <li>Lakers x Celtics</li>

                <li>Tenis</li>

                <li>Fórmula 1</li>

                <li>CS2 Major</li>

            </ul>

        </section>


        <section class="responsavel">

            <h2>Aposta não é investimento</h2>

            <p>
                Apostar pode parecer diversão, mas os riscos são reais: proteja seu dinheiro, sua saúde e seu futuro..
            </p>

        </section>

    </div>

</main>
</section>

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




