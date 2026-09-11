<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. Inicia a sessão PRIMEIRO (antes de qualquer include ou saída)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Define os cabeçalhos HTTP logo em seguida
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// 3. Inclui os arquivos necessários
include("perguntas.php");

$isLogged = isset($_SESSION['login']) || isset($_SESSION['nome']);
$nomeCompleto = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? $_SESSION['login'] ?? 'Usuário';
$primeiroNome = explode(' ', trim($nomeCompleto))[0];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>TI103</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bulma -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">

    <!-- css -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/investimento.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">


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

    <!-- FAIXA DE PLANTÃO ANIMADA -->
    <div class="news-ticker">
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

    <section class="section">
        <div class="container post-container">
            <div class="container">
                <!-- Bloco Superior: Imagem Lado a Lado com a Introdução -->
                <div class="columns is-vcentered">
                    <!-- Imagem -->
                    <div class="column is-5">
                        <figure class="image">
                            <img class="post-image"
                                src="imagens/investimento/tela.png"
                                alt="Investimentos" style="border-radius: 15px;">
                        </figure>
                    </div>

                    <!-- Conteúdo Inicial -->
                    <div class="column is-7">
                        <h1 class="title has-text-white">Quais os principais tipos de investimentos?</h1>
                        <p class="is-size-7 has-text-grey">
                            Por Admin • 23 Abril 2026 • 5 min de leitura
                        </p>

                        <div class="content mt-4">
                            <p>
                                Para quem está começando a investir, o processo pode parecer difícil e confuso,
                                pois existem diversos tipos de investimentos à disposição.
                                No entanto, vamos te ajudar para que você encontre ótimas alternativas para valorizar
                                seu dinheiro.
                            </p>
                            <p>
                                Atualmente, os principais tipos de investimentos são:
                            </p>
                            <ul class="lista-investimentos">
                                <li>Tesouro Direto</li>
                                <li>CDB</li>
                                <li>LCI e LCA</li>
                                <li>CRI e CRA</li>
                                <li>LC</li>
                                <li>Ações de empresas</li>
                                <li>Fundos Imobiliários</li>
                                <li>Fundos de Investimentos</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Seção de Blocos de Investimentos -->
                <div class="mt-6">
                    <h2 class="title is-4 has-text-white mb-5">Detalhes dos Investimentos</h2>
                    
                    <div class="columns is-multiline">
                        <!-- Bloco 1: Tesouro Direto -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-fixa">Renda Fixa</span>
                                <h3 class="card-investimento-title">Tesouro Direto</h3>
                                <p class="card-investimento-text">
                                    Títulos públicos em que você empresta dinheiro ao governo em troca de juros. É considerado de baixo risco.
                                </p>
                                <a href="https://www.tesourotransparente.gov.br/temas/divida-publica-federal/tesouro-direto" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 2: CDB -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-fixa">Renda Fixa</span>
                                <h3 class="card-investimento-title">CDB</h3>
                                <p class="card-investimento-text">
                                    Você empresta dinheiro ao banco e recebe juros por isso. Pode ter diferentes formas de rentabilidade.
                                </p>
                                <a href="https://www.c6bank.com.br/blog/o-que-e-cdb" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 3: LCI e LCA -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-fixa">Renda Fixa</span>
                                <h3 class="card-investimento-title">LCI e LCA</h3>
                                <p class="card-investimento-text">
                                    Títulos de renda fixa ligados aos setores imobiliário e do agronegócio. Para pessoa física, são geralmente isentos de Imposto de Renda.
                                </p>
                                <a href="https://feito.itau.com.br/lci-lca/" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 4: CRI e CRA -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-fixa">Renda Fixa</span>
                                <h3 class="card-investimento-title">CRI e CRA</h3>
                                <p class="card-investimento-text">
                                    Títulos ligados aos setores imobiliário e do agronegócio, que podem oferecer bons retornos, mas apresentam mais riscos.
                                </p>
                                <a href="https://blog.itau.com.br/artigos/cra-e-cri" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 5: LC -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-fixa">Renda Fixa</span>
                                <h3 class="card-investimento-title">LC</h3>
                                <p class="card-investimento-text">
                                    Título emitido por instituições financeiras que paga juros ao investidor.
                                </p>
                                <a href="https://www.santander.com.br/blog/letra-de-cambio" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 6: Ações -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-variavel">Renda Variável</span>
                                <h3 class="card-investimento-title">Ações</h3>
                                <p class="card-investimento-text">
                                    Pequenas partes de empresas. O investidor pode ganhar com a valorização das ações e com dividendos, mas existe maior risco.
                                </p>
                                <a href="https://www.b3.com.br/pt_br/produtos-e-servicos/negociacao/renda-variavel/acoes.htm" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 7: Fundos Imobiliários -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-renda-variavel">FIIs</span>
                                <h3 class="card-investimento-title">Fundos Imobiliários</h3>
                                <p class="card-investimento-text">
                                    Reúnem dinheiro de vários investidores para aplicar no mercado imobiliário. Podem gerar rendimentos periódicos.
                                </p>
                                <a href="https://www.santander.com.br/blog/como-investir-em-fundos-imobiliarios" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                        <!-- Bloco 8: Fundos de Investimentos -->
                        <div class="column is-4">
                            <div class="card-investimento">
                                <span class="tag-categoria categoria-misto">Fundos</span>
                                <h3 class="card-investimento-title">Fundos de Investimentos</h3>
                                <p class="card-investimento-text">
                                    Reúnem recursos de vários investidores, que são administrados por um gestor e aplicados em diferentes ativos.
                                </p>
                                <a href="https://www.santander.com.br/blog/fundos-de-investimentos" class="card-investimento-link">Saber mais →</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section quiz-section">
        <hr class="divisor">
        <div class="container">
            <h1 class="title">Descubra seu perfil de investidor</h1>
            <div class="quiz-box">
                <div id="inicio">
                    <ul>
                        <li> 8 perguntas</li>
                        <li> Sem tempo limite, responda com calma</li>
                        <li> No final você descobre se é Conservador, Moderado ou Arrojado</li>
                    </ul>
                    <button id="btnIniciar">Começar Questionário</button>
                </div>

                <!-- QUIZ -->
                <div id="quiz" style="display:none;">
                    <h1>Qual o seu perfil de investidor?</h1>
                    <div class="info">
                        <div class="card">
                            Pergunta <span id="contador">1/8</span>
                        </div>
                    </div>
                    <div class="barra">
                        <div id="progresso"></div>
                    </div>
                    <h2 id="pergunta"></h2>
                    <div id="opcoes"></div>
                    <button id="proximo" style="display:none;">Próxima pergunta →</button>
                </div>

                <!-- RESULTADO -->
                <div id="resultado" style="display:none;">
                    <h1>Seu Perfil de Investidor</h1>
                    <h2 id="perfilNome"></h2>
                    <p id="perfilDescricao"></p>
                    <p id="perfilSugestoes"></p>
                    <button id="btnReiniciar">Refazer questionário</button>
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
                <p>© 2026 PROJETO TI03 — Todos os direitos reservados.</p>
                <div class="footer-legal-links">
                    <a href="#">Termos de Uso</a>
                    <span>•</span>
                    <a href="#">Privacidade</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Garante que não quebre o JS se as variáveis do perguntas.php estiverem vazias
        const perguntas = <?php echo json_encode($perguntas ?? [], JSON_UNESCAPED_UNICODE); ?>;
        const perfis = <?php echo json_encode($perfis ?? [], JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="js/investimento.js"></script>
</body>
</html>