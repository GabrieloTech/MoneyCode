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
    <title>Investimentos | TI103</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/investimentos.css">


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
        <a href="cartao.php" class="drawer-item ">Cartão</a>
        <a href="consumoDigital.php" class="drawer-item">Consumo Digital</a>
        <a href="investimentos.php" class="drawer-item active">Investimentos</a>
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
            <a href="cartao.php" class="navbar-item ">Cartão</a>
            <a href="consumoDigital.php" class="navbar-item">Consumo Digital</a>
            <a href="investimentos.php" class="navbar-item is-active">Investimentos</a>
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

    <section class="section">
        <div class="container post-container">

            <div class="columns is-vcentered">

                <div class="column is-5">
                    <figure class="image">
                        <img class="post-image"
                            src="imagens/investimento/investimento.jpg"
                            alt="Investimentos"
                            style="border-radius: 12px;">
                    </figure>
                </div>

                <div class="column is-7 has-text-white">

                    <h1 class="title has-text-white">
                        O que são investimentos?
                    </h1>

                    <p class="is-size-7 has-text-grey-light mb-3">
                        Por Admin • 23 Abril 2026 • 5 min de leitura
                    </p>

                    <div class="content mt-4">

                        <p>
                            Investir é, basicamente, aplicar o seu dinheiro para fazê-lo render ao longo do tempo através de juros ou valorização de ativos. O investimento deve fazer parte do seu planejamento financeiro e atender aos seus objetivos de vida.
                        </p>

                        <p>
                            Você pode querer investir por vários motivos: para garantir uma reserva para emergências, realizar conquistas de médio prazo ou construir uma aposentadoria mais tranquila.
                        </p>

                    </div>

                    <a href="https://www.caixa.gov.br/investimentos/Paginas/default.aspx"
                        target="_blank"
                        class="button is-link is-medium is-rounded mt-3"
                        style="background-color: #c6b946; border: none; color: #000; font-weight: bold;">
                        Leia a matéria completa
                    </a>

                    <br>

                    <button
                        class="button is-link is-medium is-rounded mt-3"
                        style="background-color: #c6b946; border: none; color: #000; font-weight: bold;"
                        id="btnReiniciar"
                        onclick="window.location.href='investimento.php'">
                        Quais principais formas de investimento
                    
                    </button>
                    <br>
             
                    
            </div>
            </div>

            <hr class="my-6" style="background-color: rgba(255, 255, 255, 0.1);">

            <div class="columns">

                <div class="column is-12">

                    <h2 class="title is-3 has-text-white">
                        Simulador de Investimentos
                    </h2>

                    <div class="box"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">

                        <div class="field">
                            <label class="label has-text-white">
                                Valor inicial (R$)
                            </label>

                            <div class="control">
                                <input
                                    id="valorInicial"
                                    class="input"
                                    type="number"
                                    placeholder="Ex: 1.000">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label has-text-white">
                                Aporte mensal (R$)
                            </label>

                            <div class="control">
                                <input
                                    id="aporte"
                                    class="input"
                                    type="number"
                                    placeholder="Ex: 200">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label has-text-white">
                                Taxa de juros (% ao mês)
                            </label>

                            <div class="control">
                                <input
                                    id="taxa"
                                    class="input"
                                    type="number"
                                    step="0.01"
                                    placeholder="Ex: 1">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label has-text-white">
                                Período (meses)
                            </label>

                            <div class="control">
                                <input
                                    id="tempo"
                                    class="input"
                                    type="number"
                                    placeholder="Ex: 24">
                            </div>
                        </div>

                        <div class="control mt-4">

                            <button
                                class="button custom-button is-rounded is-fullwidth"
                                onclick="simular()"
                                style="background-color: #c6b946; color: #000; font-weight: bold; border: none;">
                                Calcular
                            </button>

                        </div>
                    </div>

                    <div class="box mt-4"
                        style="background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 255, 255, 0.15);">

                        <h3 class="subtitle is-4 has-text-white mb-2">
                            Resultado
                        </h3>

                        <p id="resultado" class="has-text-grey-light">
                            Preencha os dados e clique em calcular.
                        </p>

                    </div>

                </div>
            </div>

        </div>
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

        // Função do Simulador
        function simular() {

            const valorInicial =
                parseFloat(document.getElementById('valorInicial').value) || 0;

            const aporte =
                parseFloat(document.getElementById('aporte').value) || 0;

            const taxa =
                (parseFloat(document.getElementById('taxa').value) || 0) / 100;

            const tempo =
                parseInt(document.getElementById('tempo').value) || 0;

            let montante = valorInicial;

            for (let i = 0; i < tempo; i++) {
                montante = (montante + aporte) * (1 + taxa);
            }

            document.getElementById('resultado').innerHTML =
                `<span class="has-text-white">Valor final estimado:</span> 
                <strong class="has-text-warning" style="font-size: 1.3rem;">
                    R$ ${montante.toLocaleString('pt-BR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}
                </strong>`;
        }


        // Toggle Menu Mobile
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