<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Previne o cache do HTML
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

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
    <title>Cartão | TI103</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style/style.css?v=<?= filemtime('style/style.css') ?>">
    <link rel="stylesheet" href="style/cartao.css?v=<?= filemtime('style/cartao.css') ?>">

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
        <a href="apostas.php" class="drawer-item">Apostas</a>
        <a href="cartao.php" class="drawer-item active">Cartão</a>
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
            <a href="cartao.php" class="navbar-item is-active">Cartão</a>
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

    <main class="cartoes-wrapper">
        <div class="cartoes-container">

            <section class="cartao-hero-premium">
                <div class="hero-info">
                    <span class="badge-fintech">Notícia em Destaque</span>
                    <h1>Tudo Sobre <span class="gradient-text">Cartões de Crédito</span></h1>
                    <p>
                        Acompanhe as principais novidades e estratégias do mercado financeiro. Aprenda a otimizar acúmulo de milhas, pontuações, limites e como utilizar o crédito a seu favor.
                    </p>
                    <div class="hero-actions">
                        <a href="#simulador" class="btn-primary-glow">Filtrar por Categoria</a>
                        <a href="#noticias" class="btn-secondary-glass">Ver Notícias</a>
                    </div>
                </div>

                <div class="hero-card-visual">
                    <div class="credit-card-3d">
                        <div class="card-chip"></div>
                        <div class="card-logo">MONEY CODE BLACK</div>
                        <div class="card-number">•••• •••• •••• 9842</div>
                        <div class="card-footer">
                            <div>
                                <small>TITULAR</small>
                                <span>MEMBRO VIP</span>
                            </div>
                            <div class="card-brand-symbol"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="fintech-stats">
                <div class="stat-card">
                    <span class="stat-icon"></span>
                    <h3>+210M</h3>
                    <p>Cartões Ativos no Brasil</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon"></span>
                    <h3>+5</h3>
                    <p>Bandeiras Principais</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon"></span>
                    <h3>24h</h3>
                    <p>Monitoramento Anti-fraude</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon"></span>
                    <h3>Bilhões</h3>
                    <p>Transações Anuais</p>
                </div>
            </section>

            <section id="simulador" class="categorias-cartao-section">
                <div class="categorias-header">
                    <h2>Categorias em Alta</h2>
                    <p>Filtre os artigos pelo seu objetivo financeiro principal:</p>
                </div>

                <div class="categorias-flex" role="tablist">
                    <button class="cat-pill active" data-category="all"> Todas</button>
                    <button class="cat-pill" data-category="anuidade"> Anuidade Zero</button>
                    <button class="cat-pill" data-category="milhas"> Acumular Milhas</button>
                    <button class="cat-pill" data-category="cashback"> Cashback Automático</button>
                    <button class="cat-pill" data-category="seguranca"> Virtuais & Anti-fraude</button>
                    <button class="cat-pill" data-category="premium"> Premium (Black e Infinite)</button>
                </div>
            </section>

            <section id="noticias" class="noticias-cartao-section">
                <div class="section-header">
                    <span class="sub-title">ATUALIZAÇÕES DO MERCADO</span>
                    <h2>Últimas Notícias</h2>
                </div>

                <div class="cartao-grid">

                    <article class="card-premium card-noticia"
                             data-titulo="Como aumentar o limite do cartão em 2026"
                             data-tag="Dicas"
                             data-categoria="premium"
                             data-imagem="https://images.pexels.com/photos/164501/pexels-photo-164501.jpeg?auto=compress&cs=tinysrgb&w=800">
                        
                        <div class="materia-completa" style="display: none;">
                            <p><strong>Aumentar o limite exige consistência e uma boa estratégia.</strong> Os algoritmos bancários modernos estão cada vez mais rigorosos, mas também mais inteligentes na hora de conceder crédito. O primeiro passo fundamental é manter um histórico limpo de pagamentos, sempre no dia do vencimento ou até de forma antecipada.</p>
                            <p>Outra tática essencial é a <em>centralização de movimentação</em>. Ao concentrar seus pagamentos, recebimento de salário e transações via PIX em uma única instituição, você constrói um relacionamento sólido. O banco passa a entender melhor a sua capacidade de pagamento real.</p>
                            <h3>O peso do Open Finance</h3>
                            <p>Ativar o Open Finance é um diferencial estratégico. Permitir que seu banco atual acesse o histórico positivo que você construiu em outras instituições financeiras força o algoritmo a reavaliar seu perfil de risco, gerando aumentos automáticos e substanciais de limite.</p>
                        </div>

                        <div class="card-image-wrap">
                            <span class="card-tag">Dicas</span>
                            <img src="https://images.pexels.com/photos/164501/pexels-photo-164501.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Aumentar Limite">
                        </div>
                        <div class="card-body">
                            <h3>Como aumentar o limite do cartão em 2026</h3>
                            <p>Entenda como os bancos analisam seu histórico financeiro para liberar limite.</p>
                            <div class="card-link">Ler matéria completa <span>→</span></div>
                        </div>
                    </article>

                    <article class="card-premium card-noticia"
                             data-titulo="Golpes com cartão e como se proteger"
                             data-tag="Segurança"
                             data-categoria="seguranca"
                             data-imagem="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=800&auto=format&fit=crop">
                        
                        <div class="materia-completa" style="display: none;">
                            <p>Com a popularização dos pagamentos por aproximação (NFC) e das carteiras digitais, a facilidade de compra aumentou, mas os riscos também evoluíram. O golpe da maquininha com visor quebrado ou adulterado fez milhares de vítimas no último ano.</p>
                            <p><strong>A regra de ouro:</strong> nunca entregue seu cartão na mão de terceiros e sempre confira o valor no visor antes de aproximar o celular ou o plástico.</p>
                            <h3>Cartões Virtuais Temporários</h3>
                            <p>Para compras online, a principal barreira de segurança é o cartão virtual. A maioria dos aplicativos bancários hoje permite gerar um cartão temporário que expira após 24 horas. Caso o site sofra um vazamento de dados, o número capturado pelos cibercriminosos já será inválido, protegendo o seu limite principal.</p>
                        </div>

                        <div class="card-image-wrap">
                            <span class="card-tag">Segurança</span>
                            <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?q=80&w=800&auto=format&fit=crop" alt="Golpes com Cartão">
                        </div>
                        <div class="card-body">
                            <h3>Principais golpes com cartão e prevenção</h3>
                            <p>Proteja-se contra clonagem, engenharia social e fraudes nas compras online.</p>
                            <div class="card-link">Ler matéria completa <span>→</span></div>
                        </div>
                    </article>

                    <article class="card-premium card-noticia"
                             data-titulo="Erros mais comuns no uso do cartão"
                             data-tag="Alerta"
                             data-categoria="anuidade"
                             data-imagem="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=800&auto=format&fit=crop">
                        
                        <div class="materia-completa" style="display: none;">
                            <p>O cartão de crédito é uma excelente ferramenta financeira, mas pode se tornar o vilão do seu orçamento se usado de forma incorreta. <strong>O erro número um:</strong> tratar o limite do cartão como uma extensão da sua renda ou salário.</p>
                            <h3>A armadilha do Rotativo</h3>
                            <p>Pagar apenas o valor mínimo da fatura é o atalho mais rápido para o superendividamento. Os juros do crédito rotativo no Brasil figuram entre os mais altos do mundo. Se você não consegue pagar o valor total, é financeiramente mais viável buscar um empréstimo pessoal com taxas menores para quitar a fatura do que entrar no rotativo.</p>
                            <p>Outro erro comum é parcelar compras de baixo valor do dia a dia (como supermercado ou farmácia), comprometendo a renda dos meses futuros com despesas corriqueiras.</p>
                        </div>

                        <div class="card-image-wrap">
                            <span class="card-tag">Alerta</span>
                            <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=800&auto=format&fit=crop" alt="Erros Comuns">
                        </div>
                        <div class="card-body">
                            <h3>Os erros mais comuns no uso do cartão</h3>
                            <p>Descubra as armadilhas financeiras mais frequentes e mantenha seu orçamento seguro.</p>
                            <div class="card-link">Ler matéria completa <span>→</span></div>
                        </div>
                    </article>

                    <article class="card-premium card-noticia"
                             data-titulo="Cartão sem anuidade vale a pena?"
                             data-tag="Análise"
                             data-categoria="anuidade premium"
                             data-imagem="https://images.pexels.com/photos/210574/pexels-photo-210574.jpeg?auto=compress&cs=tinysrgb&w=800">
                        
                        <div class="materia-completa" style="display: none;">
                            <p>Com a explosão dos bancos digitais, ter um cartão sem taxa de anuidade virou o padrão para muitos brasileiros. Mas será que fugir dessa tarifa é sempre a melhor escolha?</p>
                            <h3>Quando a anuidade se paga</h3>
                            <p>Para clientes com gastos mensais mais altos (geralmente acima de R$ 5.000), os cartões premium que cobram anuidade costumam devolver esse valor em benefícios. Estamos falando de <strong>seguros de viagem internacionais, acessos gratuitos a salas VIP em aeroportos e taxas agressivas de pontuação ou cashback.</strong></p>
                            <p>Além disso, a maioria dos bancos tradicionais oferece isenção total da anuidade caso o cliente atinja um teto de gastos mensais ou tenha valores investidos na instituição. Analise seu perfil antes de cancelar um cartão apenas por causa da taxa.</p>
                        </div>

                        <div class="card-image-wrap">
                            <span class="card-tag">Análise</span>
                            <img src="https://images.pexels.com/photos/210574/pexels-photo-210574.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Sem Anuidade">
                        </div>
                        <div class="card-body">
                            <h3>Cartão sem anuidade realmente compensa?</h3>
                            <p>Avalie o custo-benefício entre cartões simples e opções premium com benefícios.</p>
                            <div class="card-link">Ler matéria completa <span>→</span></div>
                        </div>
                    </article>

                    <article class="card-premium card-noticia"
                             data-titulo="Cashback vs Milhas em 2026"
                             data-tag="Economia"
                             data-categoria="cashback milhas"
                             data-imagem="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=800&auto=format&fit=crop">
                        
                        <div class="materia-completa" style="display: none;">
                            <p>A eterna dúvida dos consumidores: vale mais a pena receber dinheiro de volta na fatura ou acumular pontos para viajar? A resposta depende do seu perfil de gastos e disposição para gerenciar recompensas.</p>
                            <h3>A Praticidade do Cashback</h3>
                            <p>O <strong>cashback</strong> brilha pela sua transparência. Não há conversões ou prazos curtos de validade. Se o cartão oferece 1% e você gasta R$ 5.000, recebe R$ 50 direto na conta. Ideal para quem busca reduzir despesas diárias sem nenhum esforço de gestão.</p>
                            <h3>O Potencial das Milhas</h3>
                            <p>As <strong>milhas</strong> exigem planejamento e gestão de transferências bonificadas. Porém, para quem viaja com frequência, o retorno financeiro de emitir passagens aéreas pode ser até três vezes maior do que o cashback tradicional, especialmente em trechos internacionais.</p>
                        </div>

                        <div class="card-image-wrap">
                            <span class="card-tag">Economia</span>
                            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=800&auto=format&fit=crop" alt="Cashback ou Milhas">
                        </div>
                        <div class="card-body">
                            <h3>Cashback vs Milhas: Qual o melhor?</h3>
                            <p>Saiba qual recompensa se encaixa melhor na sua rotina de gastos diários.</p>
                            <div class="card-link">Ler matéria completa <span>→</span></div>
                        </div>
                    </article>

                    <article class="card-premium card-noticia"
                             data-titulo="Open Finance e o seu Score"
                             data-tag="Inovação"
                             data-categoria="premium seguranca"
                             data-imagem="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop">
                        
                        <div class="materia-completa" style="display: none;">
                            <p>O <strong>Open Finance</strong> transformou a forma como o mercado analisa o seu crédito. Antes, se você abrisse uma conta em um banco novo, começava com um perfil "zerado". Hoje, você pode portar todo o seu histórico positivo.</p>
                            <h3>Vantagens Imediatas</h3>
                            <p>Ao sharing seus dados bancários, você permite que instituições compitam por você. O resultado prático costuma ser a <em>liberação de melhores taxas de juros em empréstimos e o aumento automático do limite do seu cartão de crédito</em>.</p>
                            <p>O processo é 100% seguro, regulamentado pelo Banco Central, e você pode revogar a permissão de compartilhamento de dados a qualquer momento direto pelo aplicativo do seu banco.</p>
                        </div>

                        <div class="card-image-wrap">
                            <span class="card-tag">Inovação</span>
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop" alt="Open Finance">
                        </div>
                        <div class="card-body">
                            <h3>Open Finance e seu Score de Crédito</h3>
                            <p>Veja como a integração de dados bancários pode alavancar suas aprovações.</p>
                            <div class="card-link">Ler matéria completa <span>→</span></div>
                        </div>
                    </article>

                </div>
            </section>

            <section class="banner-responsavel">
                <div class="responsavel-icon">🛡️</div>
                <div>
                    <h3>Uso Consciente do Crédito</h3>
                    <p>O cartão de crédito deve ser utilizado como facilitador de pagamentos e controle financeiro. Evite tratá-lo como complemento de salário para manter a saúde das suas contas.</p>
                </div>
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

    <div class="modal-custom" id="modal" aria-hidden="true">
        <div class="modal-box">
            <button class="close-modal" id="close-modal" aria-label="Fechar">&times;</button>
            <div class="modal-img-container">
                <img id="modal-img" src="" alt="Notícia">
            </div>
            <div class="modal-content-custom">
                <span class="modal-badge" id="modal-tag">NOTÍCIA</span>
                <h2 id="modal-title"></h2>
                
                <div id="modal-text"></div> 
            </div>
        </div>
    </div>

    <script src="js/cartao.js?v=<?= filemtime('js/cartao.js') ?>"></script>



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