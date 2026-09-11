<?php

/* =====================================================
   SESSÃO DO USUÁRIO
===================================================== */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLogged = isset($_SESSION['login']) || isset($_SESSION['nome']);

$nomeCompleto = $_SESSION['nome']
    ?? $_SESSION['usuario_nome']
    ?? $_SESSION['login']
    ?? 'Usuário';

$primeiroNome = explode(' ', trim($nomeCompleto))[0];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Bolsa de Valores | Projeto TI03</title>


    <!-- =====================================================
         BULMA
    ====================================================== -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">


    <!-- =====================================================
         CSS DO PROJETO
    ====================================================== -->

    <link rel="stylesheet"
          href="style/style.css">

    <link rel="stylesheet"
          href="style/investimento.css">

    <link rel="stylesheet"
          href="style/bolsa.css">


    <style>
        /* Ajuste fino para garantir que no mobile o botão de menu fique alinhado à direita */
        @media screen and (max-width: 1023px) {
            .navbar-brand {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
            }

            /* Layout principal adaptado para coluna no mobile */
            .bolsa-layout {
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }

            .bolsa-content, 
            .mercados-sidebar {
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Widget do TradingView adaptável para mobile */
            tv-market-overview {
                width: 100% !important;
                height: 500px !important;
            }

            /* Permite rolagem horizontal na tabela de corretoras sem quebrar o layout */
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .two-columns {
                grid-template-columns: 1fr !important;
            }
        }
    </style>

</head>


<body>


    <!-- Menuzin do mobile -->
    <div class="mobile-menu-overlay" id="mobileOverlay"></div>

    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
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
            <a href="investimentos.php" class="drawer-item">Investimentos</a>
            <a href="bolsa-de-valor.php" class="drawer-item active">Bolsa de Valores</a>
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
                <a href="bolsa-de-valor.php" class="navbar-item is-active">Bolsa de Valores</a>
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
    </nav>

    <!-- =====================================================
         TICKER TAPE - COTAÇÕES DO MERCADO
    ====================================================== -->

      <script type="module"
            src="https://widgets.tradingview-widget.com/w/en/tv-ticker-tape.js">
    </script>
    <tv-ticker-tape
        symbols="BMFBOVESPA:IBOV,NASDAQ:GOOG,NASDAQ:AAPL,NASDAQ:TSLA,NYSE:BA,NASDAQ:META,NASDAQ:NVDA,NASDAQ:SPCX,NASDAQ:NFLX"
        item-size="compact"
        theme="dark"
        transparent>
    </tv-ticker-tape>


    <!-- =====================================================
         CONTEÚDO PRINCIPAL
    ====================================================== -->

    <main class="section bolsa-page">

        <div class="container bolsa-layout">

            <!-- =================================================
                 CONTEÚDO PRINCIPAL DA BOLSA
            ================================================== -->

            <div class="bolsa-content">

                <!-- =================================================
                     HERO
                ================================================== -->

                <section class="bolsa-hero">
                    <span class="bolsa-tag">
                        MERCADO FINANCEIRO
                    </span>

                    <h1 class="title">
                        Acompanhe a Bolsa de Valores
                    </h1>

                    <p>
                        Conheça alternativas para começar a investir,
                        compare corretoras e acompanhe o mercado em
                        um só lugar.
                    </p>
                </section>


                <!-- =================================================
                     MARKET SUMMARY
                ================================================== -->

                <br>
                <br>

                <div class="market-summary-container">
                    <script
                        type="module"
                        src="https://widgets.tradingview-widget.com/w/en/tv-market-summary.js">
                    </script>

                    <tv-market-summary
                        time-frame="LASTSESSION"
                        layout-mode="grid"
                        assets-type="crypto"
                        theme="dark"
                        transparent>
                    </tv-market-summary>
                </div>


                <!-- =================================================
                     MOEDAS E ÍNDICES
                ================================================== -->

                <section class="bolsa-section">
                    <h2>
                        Moedas e índices para acompanhar
                    </h2>

                    <div class="bolsa-cards two-columns">

                        <!-- MOEDAS -->
                        <article class="bolsa-card">
                            <h3>Moedas</h3>
                            <ul>
                                <li>Real brasileiro (BRL)</li>
                                <li>Dólar americano (USD)</li>
                                <li>Euro (EUR)</li>
                                <li>Bitcoin (BTC)</li>
                            </ul>
                        </article>

                        <!-- ÍNDICES -->
                        <article class="bolsa-card">
                            <h3>Índices</h3>
                            <ul>
                                <li>Ibovespa (IBOV)</li>
                                <li>S&P 500</li>
                                <li>Nasdaq</li>
                                <li>Dow Jones</li>
                            </ul>
                        </article>

                    </div>
                </section>


                <!-- =================================================
                     AVISOS SOBRE INVESTIMENTOS
                ================================================== -->

                <section class="bolsa-section">
                    <h2>
                        Antes de investir
                    </h2>

                    <div class="bolsa-cards two-columns">

                        <!-- CARD 1 -->
                        <article class="bolsa-card">
                            <span>!</span>
                            <h3>Não invista mais do que você pode perder</h3>
                            <p>
                                Evite comprometer dinheiro destinado
                                às suas necessidades básicas ou
                                despesas essenciais.
                            </p>
                        </article>

                        <!-- CARD 2 -->
                        <article class="bolsa-card">
                            <span>!</span>
                            <h3>Tenha uma reserva financeira</h3>
                            <p>
                                Antes de assumir riscos maiores,
                                considere manter uma reserva para
                                situações inesperadas.
                            </p>
                        </article>

                        <!-- CARD 3 -->
                        <article class="bolsa-card">
                            <span>!</span>
                            <h3>Diversifique seus investimentos</h3>
                            <p>
                                Evite concentrar todo o seu patrimônio
                                em apenas um ativo ou tipo de investimento.
                            </p>
                        </article>

                        <!-- CARD 4 -->
                        <article class="bolsa-card">
                            <span>!</span>
                            <h3>Conheça os riscos</h3>
                            <p>
                                Todo investimento possui riscos.
                                Analise as características do produto
                                antes de tomar uma decisão.
                            </p>
                        </article>

                    </div>
                </section>


                <!-- =================================================
                     CORRETORAS
                ================================================== -->

                <section class="corretoras-tabela">
                    <h2>
                        Principais corretoras
                    </h2>

                    <p>
                        Compare algumas das principais plataformas
                        utilizadas por investidores no Brasil.
                    </p>

                    <!-- DIV com classe table-container para permitir scroll no mobile se preciso -->
                    <div class="table-container">
                        <table class="table is-fullwidth">
                            <thead>
                                <tr>
                                    <th>Marca</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Site</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- XP -->
                                <tr>
                                    <td>XP</td>
                                    <td>XP Investimentos</td>
                                    <td>Plataforma para renda fixa, ações e fundos.</td>
                                    <td>
                                        <a href="https://www.xpi.com.br" target="_blank" rel="noopener noreferrer" class="btn-site">
                                            Visitar
                                        </a>
                                    </td>
                                </tr>

                                <!-- RICO -->
                                <tr>
                                    <td>Rico</td>
                                    <td>Rico</td>
                                    <td>Corretora voltada para investidores iniciantes.</td>
                                    <td>
                                        <a href="https://www.rico.com.vc" target="_blank" rel="noopener noreferrer" class="btn-site">
                                            Visitar
                                        </a>
                                    </td>
                                </tr>

                                <!-- BTG -->
                                <tr>
                                    <td>BTG</td>
                                    <td>BTG Pactual</td>
                                    <td>Banco de investimentos com diversos produtos financeiros.</td>
                                    <td>
                                        <a href="https://www.btgpactual.com" target="_blank" rel="noopener noreferrer" class="btn-site">
                                            Visitar
                                        </a>
                                    </td>
                                </tr>

                                <!-- INTER -->
                                <tr>
                                    <td>Inter</td>
                                    <td>Banco Inter</td>
                                    <td>Investimentos integrados à conta digital.</td>
                                    <td>
                                        <a href="https://inter.co" target="_blank" rel="noopener noreferrer" class="btn-site">
                                            Visitar
                                        </a>
                                    </td>
                                </tr>

                                <!-- NUBANK -->
                                <tr>
                                    <td>Nubank</td>
                                    <td>NuInvest</td>
                                    <td>Plataforma integrada ao ecossistema Nubank.</td>
                                    <td>
                                        <a href="https://nubank.com.br" target="_blank" rel="noopener noreferrer" class="btn-site">
                                            Visitar
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

            </div>


            <!-- =================================================
                 PAINEL LATERAL DE MERCADOS
            ================================================== -->

            <aside class="mercados-sidebar">
                <div class="mercados-header">
                    <h2>↗ Mercados</h2>
                    <span></span>
                </div>

                <!-- TRADINGVIEW MARKET OVERVIEW -->
                <script type="module" src="https://widgets.tradingview-widget.com/w/en/tv-market-overview.js"></script>
                <tv-market-overview symbol-sectors='[{"sectionName":"Crypto","symbols":["FX_IDC:USDBRL","FX_IDC:EURBRL","FX_IDC:BRLUSD","FX_IDC:BRLMXN","OANDA:EURUSD","FX_IDC:JPYVND","OANDA:GBPUSD","OANDA:AUDCAD","OANDA:CHFJPY"]}]' time-frame="1D" item-size="compact" theme="dark" transparent style="width: 100%; height: 650px"></tv-market-overview>
            </aside>

        </div>

    </main>


    <!-- =====================================================
         FOOTER DO SITE
    ====================================================== -->

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
                <p>&copy; <?= date('Y') ?> MONEY CODE. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>


    <!-- =====================================================
         SCRIPTS
    ====================================================== -->

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

</html