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
    <title>Portal de Investimentos VIP - MONEY CODE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bulma & Fontes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome para Ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Seus CSS originais -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/cmenvestir.css">

    <style>
        /* ==========================================
           COMPONENTES DO PORTAL DE NOTÍCIAS
           ========================================== */
        
        /* Barra de Progresso de Leitura */
        #progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #c6b946, #00d1ff);
            width: 0%;
            z-index: 9999;
            transition: width 0.1s ease;
            box-shadow: 0 0 10px rgba(0, 209, 255, 0.5);
        }

        /* Ajuste do Navbar Mobile */
        @media screen and (max-width: 1023px) {
            .navbar-brand {
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 100% !important;
            }
        }

        /* Efeito de Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Badges Flutuantes na Imagem (Foco em Notícias) */
        .badge-flutuante {
            position: absolute;
            background: rgba(7, 19, 34, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(198, 185, 70, 0.4);
            color: #fff;
            padding: 0.8rem 1.2rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            z-index: 10;
            animation: floatSutil 4s ease-in-out infinite;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .badge-flutuante i { color: #c6b946; }
        .badge-1 { top: 10%; left: -5%; animation-delay: 0s; }
        .badge-2 { bottom: 15%; right: -5%; animation-delay: 2s; border-color: #00d1ff; }
        .badge-2 i { color: #00d1ff; }

        @keyframes floatSutil {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Tags de Categoria nos Cards (Cara de Portal) */
        .tag-categoria {
            position: absolute;
            top: 15px;
            left: 15px;
            background: #00d1ff;
            color: #071322;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            z-index: 4;
            box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        }

        /* Newsletter Box Glassmorphism (Substituindo o Simulador) */
        .newsletter-glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            margin-top: 5rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5), inset 0 0 0 1px rgba(0, 209, 255, 0.2);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .newsletter-glass::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(0, 209, 255, 0.05) 0%, transparent 60%);
            z-index: 0; pointer-events: none;
        }

        .newsletter-content { position: relative; z-index: 1; max-width: 600px; margin: 0 auto; }
        
        .input-newsletter {
            background: rgba(7, 19, 34, 0.6) !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            color: #fff !important;
            border-radius: 30px !important;
            padding-left: 1.5rem;
            height: 50px;
        }
        
        .input-newsletter::placeholder { color: #a0aec0; }
        .input-newsletter:focus { border-color: #00d1ff !important; box-shadow: 0 0 10px rgba(0,209,255,0.3) !important; }

        @media screen and (max-width: 768px) {
            .badge-flutuante { display: none; }
            .newsletter-glass { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body class="has-background-dark-blue">
    <!-- Barra de Progresso de Leitura -->
    <div id="progress-bar"></div>

    <!-- OVERLAY E MENU MOBILE ESTILO DRAWER -->
    <div class="mobile-menu-overlay" id="mobileOverlay"></div>
    
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <span class="logo">₿ MONEY CODE</span>
            <button class="drawer-close" id="drawerClose" aria-label="Fechar Menu">&times;</button>
        </div>
        <div class="drawer-body">
            <a href="index.php" class="drawer-item">Início</a>
            <a href="apostas.php" class="drawer-item">Apostas</a>
            <a href="cartao.php" class="drawer-item">Cartão</a>
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

    <!-- NAVBAR DESKTOP -->
    <nav class="navbar main-navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a href="index.php" class="navbar-item">
                <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 55px; width: auto;">
            </a>
            <button class="mobile-toggle" id="mobileToggle" aria-label="Abrir menu">
                <span></span><span></span><span></span>
            </button>
        </div>
        <div class="navbar-menu is-hidden-touch">
            <div class="navbar-start">
                <a href="apostas.php" class="navbar-item">Apostas</a>
                <a href="cartao.php" class="navbar-item">Cartão</a>
                <a href="consumoDigital.php" class="navbar-item">Consumo Digital</a>
                <a href="investimentos.php" class="navbar-item is-active">Investimentos</a>
                <a href="bolsa-de-valor.php" class="navbar-item">Bolsa de Valores</a>
            </div>
            <div class="navbar-end">
            <?php if ($isLogged): ?>
                <div class="navbar-item px-0">
                    <a href="perfil.php" class="usuario-logado text-gold has-text-weight-semibold px-3 py-2">
                        <i class="fas fa-user-circle mr-2"></i>Olá, <?= htmlspecialchars($primeiroNome, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </div>
                <div class="navbar-item px-0">
                    <a href="logout.php" class="has-text-danger has-text-weight-semibold px-3 py-2">Sair</a>
                </div>
            <?php else: ?>
                <div class="navbar-item">
                    <a class="button btn-login-blue" href="login.html">Login <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL (PORTAL DE NOTÍCIAS) -->
    <section class="section main-content-section">
        <div class="container is-max-widescreen">
            
            <!-- Hero / Destaque - Notícia Principal -->
            <div class="destaque-hero">
                <div class="destaque-texto reveal">
                    <span class="tag-destaque"><i class="fas fa-star mr-2"></i> MATÉRIA DE CAPA</span>
                    <h1 class="titulo-destaque">Qual a importância de investir seu dinheiro hoje?</h1>
                    <p class="resumo-destaque">
                        Investir é o melhor caminho para os empreendedores aumentarem suas chances de sucesso. 
                        Nossa nova reportagem explora como a inflação corrói o poder de compra e por que deixar o dinheiro na conta corrente não é mais uma opção segura.
                    </p>
                    <div class="is-flex is-align-items-center" style="gap: 15px; flex-wrap: wrap;">
                        <a href="https://www.caixa.gov.br/educacao-financeira/empresa/por-que-investir/Paginas/default.aspx" class="button btn-amarelo-destaque" target="_blank">
                            Ler Artigo Completo <i class="fas fa-book-open ml-2"></i>
                        </a>
                        <span class="has-text-grey is-size-7"><i class="far fa-clock mr-1"></i> 5 min de leitura • Especialistas</span>
                    </div>
                </div>
                
                <div class="destaque-imagem reveal" id="parallaxImage">
                    <div class="badge-flutuante badge-1"><i class="fas fa-chart-line"></i> Tendências 2026</div>
                    <div class="badge-flutuante badge-2"><i class="fas fa-comment-dollar"></i> Opinião de Especialista</div>
                    <img src="imagens/investimento/investimentos.avif" alt="Gráfico de Crescimento - Notícia Principal">
                </div>
            </div>

            <!-- Grade de Últimas Notícias -->
            <div id="noticias" class="ultimas-noticias mt-6 pt-6 reveal">
                <div class="is-flex is-justify-content-space-between is-align-items-flex-end mb-4">
                    <h2 class="titulo-secao-azul m-0"><i class="far fa-newspaper mr-2"></i> Últimas Publicações</h2>
                    <a href="#" class="has-text-grey-light is-size-7 is-hidden-mobile" style="transition: color 0.3s;" onmouseover="this.style.color='#00d1ff'" onmouseout="this.style.color=''">Ver todo o acervo <i class="fas fa-chevron-right"></i></a>
                </div>
                
                <div class="columns is-multiline is-mobile grid-noticias">
                    
                    <div class="column is-4-desktop is-12-mobile">
                        <div class="card-noticia">
                            <span class="tag-categoria">Bolsa de Valores</span>
                            <img src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?q=80&w=600&auto=format&fit=crop" alt="Bolsa de Valores">
                            <div class="card-noticia-overlay">
                                <h3>Como dar os primeiros passos na Bolsa de Valores com segurança</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-4-desktop is-12-mobile">
                        <div class="card-noticia">
                            <span class="tag-categoria" style="background: #c6b946;">Renda Fixa</span>
                            <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?q=80&w=600&auto=format&fit=crop" alt="Renda Fixa">
                            <div class="card-noticia-overlay">
                                <h3>Renda Fixa vs Variável: A guerra dos juros na economia atual</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="column is-4-desktop is-12-mobile">
                        <div class="card-noticia">
                            <span class="tag-categoria" style="background: #a855f7; color: #fff;">Web 3.0</span>
                            <img src="https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?q=80&w=600&auto=format&fit=crop" alt="Criptomoedas">
                            <div class="card-noticia-overlay">
                                <h3>O futuro do Bitcoin e os impactos da regulamentação no mercado</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Novo: Caixa de Newsletter VIP -->
            <div class="newsletter-glass reveal">
                <div class="newsletter-content">
                    <h2 class="title is-3 has-text-white mb-3"><i class="fas fa-envelope-open-text" style="color: #00d1ff;"></i> Fique à frente do mercado</h2>
                    <p class="has-text-grey-light mb-5 is-size-5">Receba análises diárias, relatórios exclusivos e as notícias que realmente importam direto no seu e-mail.</p>
                    
                    <form action="#" method="POST" class="is-flex is-flex-direction-column is-align-items-center" style="gap: 15px;">
                        <div class="field w-100" style="width: 100%;">
                            <div class="control has-icons-left">
                                <input class="input input-newsletter" type="email" placeholder="Seu melhor e-mail corporativo ou pessoal" required>
                                <span class="icon is-small is-left" style="color: #00d1ff;">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="button btn-login-blue is-fullwidth" style="height: 50px; font-size: 1.1rem;">
                            Quero receber os relatórios <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                        <p class="is-size-7 has-text-grey mt-2"><i class="fas fa-lock mr-1"></i> Respeitamos sua privacidade. Zero spam.</p>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer reveal">
        <div class="footer-container">
            <div class="footer-brand">
                <a href="index.php" class="footer-logo">
                    <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 55px; width: auto;">
                </a>
                <p>Plataforma de inteligência e portal de notícias financeiras. A informação exata para você tomar as melhores decisões sobre investimentos e mercado econômico.</p>
            </div>

            <div class="footer-nav">
                <h4>Editorias</h4>
                <ul>
                    <li><a href="apostas.php">Apostas e Mercado</a></li>
                    <li><a href="cartao.php">Cartões e Crédito</a></li>
                    <li><a href="consumoDigital.php">Consumo Digital</a></li>
                    <li><a href="investimentos.php">Investimentos</a></li>
                </ul>
            </div>

            <div class="footer-nav">
                <h4>Links Úteis</h4>
                <ul>
                    <li><a href="#noticias">Últimas Notícias</a></li>
                    <li><a href="#">Análises de Especialistas</a></li>
                    <li><a href="#">Entrevistas Exclusivas</a></li>
                    <li><a href="investimento.php">Descubra seu Perfil</a></li>
                </ul>
            </div>

            <div class="footer-info">
                <h4>Transparência</h4>
                <p>Conteúdo estritamente jornalístico, informativo e educacional. Não realizamos recomendações diretas de compra ou venda de ativos.</p>
                <div class="security-tags">
                    <span><i class="fas fa-lock"></i> Conexão Criptografada</span>
                    <span><i class="fas fa-shield-alt"></i> Atualizado em 2026</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p>© 2026 MONEY CODE — Todos os direitos reservados.</p>
                <div class="footer-legal-links">
                    <a href="#">Termos de Uso Editorial</a>
                    <span>•</span>
                    <a href="#">Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- SCRIPTS DE INTERATIVIDADE -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // 1. MENU MOBILE DRAWER
            const mobileToggle = document.getElementById('mobileToggle');
            const drawerClose = document.getElementById('drawerClose');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const mobileDrawer = document.getElementById('mobileDrawer');

            function toggleDrawer(open) {
                const isOpen = open !== undefined ? open : !mobileDrawer.classList.contains('active');
                mobileDrawer.classList.toggle('active', isOpen);
                mobileOverlay.classList.toggle('active', isOpen);
                document.body.style.overflow = isOpen ? 'hidden' : '';
            }

            if (mobileToggle) mobileToggle.addEventListener('click', () => toggleDrawer(true));
            if (drawerClose) drawerClose.addEventListener('click', () => toggleDrawer(false));
            if (mobileOverlay) mobileOverlay.addEventListener('click', () => toggleDrawer(false));

            // 2. BARRA DE PROGRESSO DE LEITURA
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                document.getElementById('progress-bar').style.width = scrolled + "%";
            });

            // 3. SCROLL REVEAL ANIMAÇÃO (Aparecer itens ao rolar)
            const reveals = document.querySelectorAll('.reveal');
            function revealOnScroll() {
                const windowHeight = window.innerHeight;
                const elementVisible = 100;
                reveals.forEach((reveal) => {
                    const elementTop = reveal.getBoundingClientRect().top;
                    if (elementTop < windowHeight - elementVisible) {
                        reveal.classList.add('active');
                    }
                });
            }
            window.addEventListener('scroll', revealOnScroll);
            revealOnScroll(); // Trigger inicial

            // 4. PARALLAX 3D NO HERO IMAGE (Apenas Desktop)
            const heroImg = document.getElementById('parallaxImage');
            if(window.innerWidth > 768 && heroImg) {
                document.addEventListener('mousemove', (e) => {
                    const x = (window.innerWidth - e.pageX * 2) / 90;
                    const y = (window.innerHeight - e.pageY * 2) / 90;
                    heroImg.style.transform = `perspective(1000px) rotateX(${y}deg) rotateY(${-x}deg)`;
                });
            }
        });
    </script>
</body>
</html>