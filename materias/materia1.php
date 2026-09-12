<?php
$conn = new mysqli("localhost", "orangedi_PI", "1234567890", "orangedi_PI");
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

session_start();
$isLogged = isset($_SESSION['usuario_id']);
$primeiroNome = $_SESSION['usuario_nome'] ?? 'Usuário';

$materia_id = "sindrome-fomo";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome'] ?? '');
    $comentario = trim($_POST['comentario'] ?? '');

    if (!empty($nome) && !empty($comentario)) {
        $stmt = $conn->prepare("INSERT INTO comentarios (materia_id, nome, comentario) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $materia_id, $nome, $comentario);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: " . $_SERVER['PHP_SELF'] . "?sucesso=1#comentarios");
            exit();
        } else {
            $mensagem = "<p style='color: #ff4d4d;'>Erro ao salvar comentário: " . $conn->error . "</p>";
        }
        $stmt->close();
    } else {
        $mensagem = "<p style='color: #ff4d4d;'>Por favor, preencha todos os campos!</p>";
    }
}

if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    $mensagem = "<p style='color: #00f2ff;'>Comentário enviado com sucesso!</p>";
}

$stmt_select = $conn->prepare("SELECT nome, comentario, DATE_FORMAT(data_criacao, '%d/%m/%Y às %H:%i') as data_formatada FROM comentarios WHERE materia_id = ? ORDER BY id DESC");
$stmt_select->bind_param("s", $materia_id);
$stmt_select->execute();
$resultado = $stmt_select->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Síndrome de FOMO: O Impacto no Consumo Digital | MONEY CODE</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">

<style>
    :root {
        --bg-page: #0b1d33;
        --bg-card: #132a4a;
        --bg-card-hover: #1a375f;
        --gold: #ffc700;
        --accent-cyan: #00D1FF;
        --text-main: #ffffff;
        --text-muted: #94a3b8;
        --border-color: rgba(255, 255, 255, 0.08);

        --bg-primary: #0A2540;
        --accent: #00d1ff;
        --text: #e2e8f0;
    }

    * { box-sizing: border-box; }

    body {
        background-color: var(--bg-page) !important;
        color: var(--text-main) !important;
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

.navbar {
    background: var(--bg-primary) !important;
    padding: 0.8rem 1.5rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    z-index: 100;
}

.logo {
    color: var(--accent);
    font-size: 1.8rem;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    display: inline-block;
}

.logo:hover {
    transform: rotate(10deg) scale(1.08);
}

.navbar-item {
    color: var(--text) !important;
    transition: color 0.25s ease, transform 0.25s ease;
    position: relative;
    padding: 0.5rem 0.75rem;
}

.navbar-item:hover,
.navbar-item.is-active,
.navbar-link:hover {
    background-color: transparent !important;
    color: var(--accent) !important;
    transform: translateY(-2px);
}

.navbar-item::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 4px;
    left: 50%;
    background: var(--accent);
    transition: width 0.3s ease, left 0.3s ease;
}

.navbar-item:hover::after {
    width: 80%;
    left: 10%;
}

.mobile-toggle {
    display: none;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 8px;
    flex-direction: column;
    justify-content: space-around;
    height: 42px;
    width: 42px;
    touch-action: manipulation;
}

.mobile-toggle span {
    display: block;
    height: 3px;
    width: 100%;
    background: var(--accent);
    border-radius: 2px;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    z-index: 998;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
    will-change: opacity, visibility;
}

.mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
}

.mobile-drawer {
    position: fixed;
    top: 0;
    right: -300px;
    width: 290px;
    height: 100%;
    background: var(--bg-primary);
    border-left: 1px solid var(--border-color);
    z-index: 999;
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    padding: 24px 20px;
    box-shadow: -5px 0 25px rgba(0,0,0,0.6);
    will-change: transform;
}

.mobile-drawer.active {
    transform: translateX(-300px);
}

.drawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255,255,255,0.12);
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.drawer-close {
    background: transparent;
    border: none;
    color: var(--accent);
    font-size: 2.2rem;
    cursor: pointer;
    line-height: 1;
    padding: 0 8px;
    touch-action: manipulation;
}

.drawer-body {
    display: flex;
    flex-direction: column;
    gap: 8px;
    overflow-y: auto;
}

.drawer-item {
    color: #ffffff;
    font-weight: 600;
    font-size: 1.05rem;
    padding: 12px 14px;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.2s ease, color 0.2s ease;
    display: block;
}

.drawer-item:hover, .drawer-item.active {
    background: rgba(198, 185, 70, 0.15);
    color: var(--gold);
}

.drawer-divider {
    background-color: rgba(255,255,255,0.1);
    height: 1px;
    border: none;
    margin: 12px 0;
}

@media (max-width: 1023px) {
    .mobile-toggle {
        display: flex;
    }
}

    .text-gold { color: var(--gold) !important; }

    .btn-cadastrar {
        background-color: var(--accent-cyan) !important;
        color: #0b1d33 !important;
        border: none !important;
        font-weight: 700;
        border-radius: 20px !important;
        padding-left: 22px !important;
        padding-right: 22px !important;
    }

    .btn-cadastrar:hover { background-color: #00c4d4 !important; color: #0b1d33 !important; }

    .materia-container {
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        box-sizing: border-box;
    }

    h1, h2, h3, h4 { color: var(--text-main) !important; margin-top: 1.5rem; margin-bottom: 1rem; }
    h1 { font-size: 2.2rem; font-weight: 800; line-height: 1.2; }
    h2 { font-size: 1.5rem; font-weight: 700; color: var(--accent-cyan) !important; }
    p, span, li { color: var(--text-main); line-height: 1.7; font-size: 1.05rem; }
    .subtitulo { color: var(--text-muted) !important; font-size: 1.2rem; margin-bottom: 1.5rem; }
    .materia-meta { display: flex; gap: 15px; color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; }
    .categoria { background-color: var(--gold) !important; color: #0b1d33 !important; font-weight: 700; padding: 4px 10px; border-radius: 6px; display: inline-block; text-transform: uppercase; font-size: 0.75rem; margin-bottom: 1rem; }

    .fomo-box-destaque {
        background: rgba(0, 242, 255, 0.05);
        border-left: 4px solid var(--accent-cyan);
        padding: 1.2rem 1.5rem;
        margin: 1.8rem 0;
        border-radius: 0 10px 10px 0;
        font-style: italic;
    }

    .fomo-box-destaque p { font-size: 1.15rem; color: var(--accent-cyan); margin: 0; }
    .imagem-principal-wrap, .imagem-topico-wrap { width: 100%; margin: 1.5rem 0; }
    .imagem-principal-wrap img, .imagem-topico-wrap img { width: 100%; max-height: 520px; object-fit: cover; border-radius: 16px; border: 1px solid var(--border-color); display: block; }
    .imagem-topico-wrap img { max-height: 350px; }

    .topico-fomo {
        background-color: rgba(11, 29, 51, 0.4);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 1.5rem 0;
    }

    .topico-fomo ul { padding-left: 1.2rem; margin-top: 0.5rem; }
    .topico-fomo li { margin-bottom: 0.5rem; }

    .veja-tambem { margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--border-color); }
    .veja-tambem-titulo { font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; }
    .veja-tambem-titulo::before { content: ''; display: inline-block; width: 4px; height: 20px; background-color: var(--accent-cyan); border-radius: 2px; }
    .carrossel-wrapper { position: relative; width: 100%; overflow: hidden; border-radius: 12px; }
    .carrossel-container { display: flex; transition: transform 0.6s ease-in-out; gap: 1.5rem; }

    .card-veja-tambem {
        flex: 0 0 calc(25% - (1.5rem * 3 / 4));
        box-sizing: border-box;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease;
    }

    .card-veja-tambem:hover { transform: translateY(-4px); }
    .card-veja-tambem .thumb-wrapper { aspect-ratio: 1 / 1; width: 100%; overflow: hidden; border-radius: 12px; border: 1px solid var(--border-color); background-color: rgba(11, 29, 51, 0.6); margin-bottom: 0.75rem; }
    .card-veja-tambem img { width: 100%; height: 100%; object-fit: cover; border: none; border-radius: 0; transition: transform 0.3s ease; }
    .card-veja-tambem:hover img { transform: scale(1.05); }
    .card-veja-tambem .data { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.4rem; }
    .card-veja-tambem .titulo-materia { font-size: 0.95rem; font-weight: 700; color: var(--accent-cyan) !important; line-height: 1.35; margin: 0; }

    .btn-carrossel {
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        background: rgba(11, 29, 51, 0.85);
        border: 1px solid var(--border-color);
        color: var(--accent-cyan);
        width: 40px; height: 40px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        font-size: 1.2rem;
        z-index: 10;
        transition: all 0.2s ease;
    }

    .btn-carrossel:hover { background-color: var(--accent-cyan); color: #0b1d33; box-shadow: 0 0 12px rgba(0, 242, 255, 0.5); }
    .btn-anterior { left: 5px; }
    .btn-proximo { right: 5px; }

    .carrossel-indicadores { display: flex; justify-content: center; gap: 8px; margin-top: 1.2rem; }
    .dot { width: 10px; height: 10px; background-color: rgba(255, 255, 255, 0.2); border-radius: 50%; cursor: pointer; transition: background-color 0.3s ease, transform 0.3s ease; }
    .dot.ativo { background-color: var(--accent-cyan); transform: scale(1.2); }

    .comentarios {
        max-width: 100%; width: 100%;
        margin: 40px auto 0 auto;
        padding: 40px;
        background-color: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
    }

    .comentarios form { width: 100%; }
    .comentarios h2 { text-align: center; margin-bottom: 25px; font-size: 1.8rem; font-weight: 700; }
    .comentarios label { display: block; margin-top: 18px; margin-bottom: 8px; font-weight: 600; font-size: 1.05rem; color: var(--text-main); }

    .comentarios input, .comentarios textarea {
        width: 100%; padding: 15px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        background-color: rgba(11, 29, 51, 0.6);
        color: var(--text-main);
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .comentarios input:focus, .comentarios textarea:focus { outline: none; border-color: var(--accent-cyan); box-shadow: 0 0 10px rgba(0, 242, 255, 0.3); }
    .comentarios textarea { resize: vertical; min-height: 120px; }

    .comentarios button {
        margin-top: 25px; width: 100%; padding: 15px;
        border: none; border-radius: 10px;
        background-color: var(--accent-cyan);
        color: #0b1d33; font-weight: 700; font-size: 1.1rem;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .comentarios button:hover { transform: translateY(-2px); box-shadow: 0 0 20px rgba(0, 242, 255, 0.5); }

    .comentario {
        background-color: rgba(11, 29, 51, 0.6);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 15px 20px;
        margin-top: 15px;
    }

    .comentario h3 { margin: 0 0 4px 0; font-size: 1.1rem; color: var(--accent-cyan) !important; }
    .comentario .data-comentario { font-size: 0.8rem; color: var(--text-muted); margin-bottom: 8px; display: block; }
    .comentario p { margin: 0; font-size: 0.95rem; }

    @media (max-width: 900px) { .card-veja-tambem { flex: 0 0 calc(33.333% - (1.5rem * 2 / 3)); } }
    @media (max-width: 600px) { 
        .materia-container { margin: 1rem; padding: 1.5rem; } 
        .card-veja-tambem { flex: 0 0 calc(50% - (1.5rem / 2)); } 
        .comentarios { padding: 25px; } 
    }
</style>
</head>

<body>

    <div class="mobile-menu-overlay" id="mobileOverlay"></div>

    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-header">
            <a href="../index.php">
                <img src="../imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 40px; width: auto;">
            </a>
            <button class="drawer-close" id="drawerClose" aria-label="Fechar Menu">&#10005;</button>
        </div>
        <div class="drawer-body">
            <a href="../index.php" class="drawer-item active">Início</a>
            <a href="../apostas.php" class="drawer-item">Apostas</a>
            <a href="../cartao.php" class="drawer-item">Cartão</a>
            <a href="../consumoDigital.php" class="drawer-item">Consumo Digital</a>
            <a href="../investimentos.php" class="drawer-item">Investimentos</a>
            <a href="../bolsa-de-valor.php" class="drawer-item">Bolsa de Valores</a>
            
            <hr class="drawer-divider">

            <?php if ($isLogged): ?>
                <a href="../perfil.php" class="drawer-item text-gold">Olá, <?= htmlspecialchars($primeiroNome, ENT_QUOTES, 'UTF-8') ?></a>
                <a href="../logout.php" class="drawer-item" style="color: #ff4d4d;">Sair</a>
            <?php else: ?>
                <a href="../login.html" class="drawer-btn-login">Entrar</a>
            <?php endif; ?>
        </div>
    </div>

    <header>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a href="../index.php" class="navbar-item">
                    <img src="../imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 55px; width: auto;">
                </a>
                <button class="mobile-toggle" id="mobileToggle" aria-label="Abrir menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            <div class="navbar-menu is-hidden-touch">
                <div class="navbar-start">
                    <a href="../apostas.php" class="navbar-item">Apostas</a>
                    <a href="../cartao.php" class="navbar-item">Cartão</a>
                    <a href="../consumoDigital.php" class="navbar-item is-active">Consumo Digital</a>
                    <a href="../investimentos.php" class="navbar-item">Investimentos</a>
                    <a href="../bolsa-de-valor.php" class="navbar-item">Bolsa de Valores</a>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <?php if ($isLogged): ?>
                            <div class="is-flex is-align-items-center" style="gap: 15px;">
                                <a href="../perfil.php" class="usuario-logado text-gold has-text-weight-semibold">
                                    Olá, <?= htmlspecialchars($primeiroNome, ENT_QUOTES, 'UTF-8') ?>
                                </a>
                                <a href="../logout.php" class="has-text-danger has-text-weight-semibold">
                                    Sair
                                </a>
                            </div>
                        <?php else: ?>
                            <a class="button btn-cadastrar" href="../login.html">Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="materia-container">

        <header class="materia-header">
            <span class="categoria">Consumo Digital</span>
            <h1>Síndrome de FOMO: Como o medo de ficar de fora afeta seus gastos no mundo digital</h1>
            <p class="subtitulo">Entenda o mecanismo psicológico por trás de compras por impulso, jogos e tendências das redes sociais.</p>

            <div class="materia-meta">
                <span>Por Redação Money Code</span>
                <span>19 de Agosto de 2026</span>
                <span>5 min de leitura</span>
            </div>
        </header>

        <div class="imagem-principal-wrap">
            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1200&auto=format&fit=crop" alt="Pessoa ansiosa usando smartphone no escuro">
        </div>

        <article class="materia-corpo">
            <p>
                A aceleração digital e a hiperconexão criaram o ambiente ideal para a proliferação da chamada <strong>Síndrome de FOMO</strong> (da sigla em inglês <em>Fear Of Missing Out</em>, ou "Medo de Ficar de Fora"). O conceito descreve a ansiedade persistente de que outros estejam tendo experiências gratificantes das quais você não faz parte, impulsionando um desejo compulsivo de se manter conectado e consumir continuamente.
            </p>

            <div class="fomo-box-destaque">
                <p>"O FOMO transforma a necessidade humana de pertencimento em gatilhos diretos para compras impulsivas e desnecessárias."</p>
            </div>

            <h2>O que ativa o FOMO no ambiente online?</h2>
            <p>
                As plataformas digitais usam arquiteturas de escolha projetadas para explorar vieses cognitivos. A sensação de urgência é alimentada por estratégias deliberadas do mercado digital:
            </p>

            <div class="imagem-topico-wrap">
                <img src="https://images.unsplash.com/photo-1508962914676-134849a727f0?q=80&w=1000&auto=format&fit=crop" alt="Redes sociais em tela de smartphone">
            </div>

            <div class="topico-fomo">
                <h3>1. Redes Sociais e Estilo de Vida Ostentação</h3>
                <ul>
                    <li><strong>A imunidade da ilusão:</strong> A exposição constante de viagens, produtos de luxo e eventos exclusivos gera uma falsa impressão de escassez social, incentivando o usuário a gastar acima do seu orçamento para manter uma imagem similar.</li>
                    <li><strong>Algoritmos de Recomendação:</strong> Exibem anúncios personalizados com base no comportamento de navegação no momento exato de maior vulnerabilidade do usuário.</li>
                </ul>
            </div>

            <div class="topico-fomo">
                <h3>2. Jogos Digitais e Conteúdos Exclusivos</h3>
                <ul>
                    <li><strong>Ofertas com Tempo Limitado:</strong> Promoções com contadores regressivos (<em>"disponível apenas pelas próximas 2 horas"</em>) forçam decisões rápidas sem reflexão.</li>
                    <li><strong>Passes de Batalha e Cosméticos:</strong> A ideia de que um item exclusivo de um jogo nunca mais poderá ser adquirido cria um forte gatilho de urgência financeira.</li>
                </ul>
            </div>

            <div class="imagem-topico-wrap">
                <img src="https://images.unsplash.com/photo-1621416894569-0f39ed31d247?q=80&w=1000&auto=format&fit=crop" alt="Especulação financeira em ativos digitais">
            </div>

            <div class="topico-fomo">
                <h3>3. O FOMO no Mercado Financeiro</h3>
                <ul>
                    <li><strong>Especulação e Criptoativos:</strong> O medo de perder a "próxima grande alta" de uma ação ou ativo digital leva investidores iniciantes a tomarem decisões sem análise técnica, frequentemente resultando em perdas expressivas.</li>
                </ul>
            </div>

            <h2>Como proteger suas finanças contra a ansiedade digital</h2>
            <p>
                Para evitar armadilhas financeiras motivadas pelo FOMO, considere adotar algumas estratégias práticas de autocontrole:
            </p>
            <ul>
                <li><strong>Regra das 24 Horas:</strong> Diante de uma compra não planejada, espere um dia completo antes de finalizar o pagamento para avaliar se o desejo é real ou passageiro.</li>
                <li><strong>Desative Notificações de Promoções:</strong> Reduza o volume de e-mails, notificações de apps e alertas de redes sociais que tentam capturar sua atenção com apelos de urgência.</li>
                <li><strong>Defina um Orçamento para Lazer Digital:</strong> Estipule um valor mensal fixo dedicado ao consumo de entretenimento ou compras por impulso. Se o limite acabar, aguarde o mês seguinte.</li>
            </ul>
        </article>

        <section class="veja-tambem">
            <div class="veja-tambem-titulo">Veja também:</div>

            <div class="carrossel-wrapper" id="carrosselWrapper">
                <button class="btn-carrossel btn-anterior" id="btnAnterior" aria-label="Anterior">&#10094;</button>
                <button class="btn-carrossel btn-proximo" id="btnProximo" aria-label="Próximo">&#10095;</button>

                <div class="carrossel-container" id="carrosselContainer">
                    <a href="materia3.php" class="card-veja-tambem">
                        <div class="thumb-wrapper">
                            <img src="https://images.pexels.com/photos/26922999/pexels-photo-26922999.jpeg" alt="Pessoa jogando no celular">
                        </div>
                        <span class="data">21 de agosto de 2026</span>
                        <h3 class="titulo-materia">Jogos Gacha: Como induzem o consumo desenfreado em jogadores</h3>
                    </a>

                    <a href="materia2.php" class="card-veja-tambem">
                        <div class="thumb-wrapper">
                            <img src="https://plus.unsplash.com/premium_photo-1670863088251-500151f2117b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fGNvbXByYXMlMjBhcGxpY2F0aXZvfGVufDB8fDB8fHww" alt="Estratégias para compras no celular">
                        </div>
                        <span class="data">15 de agosto de 2026</span>
                        <h3 class="titulo-materia"> 5 estratégias para evitar compras por impulso em aplicativos</h3>
                    </a>

                    <a href="materia4.php" class="card-veja-tambem">
                        <div class="thumb-wrapper">
                            <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=600" alt="Redes Sociais e Algoritmos">
                        </div>
                        <span class="data">10 de agosto de 2026</span>
                        <h3 class="titulo-materia">O impacto dos algoritmos nas suas decisões de compras</h3>
                    </a>

                    <a href="materia5.php" class="card-veja-tambem">
                        <div class="thumb-wrapper">
                            <img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&w=600" alt="Padrões Obscuros no Web Design">
                        </div>
                        <span class="data">05 de agosto de 2026</span>
                        <h3 class="titulo-materia">Padrões Obscuros: como interfaces te induzem a gastar</h3>
                    </a>

                    <a href="materia6.php" class="card-veja-tambem">
                        <div class="thumb-wrapper">
                            <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=600" alt="Gestão de assinaturas">
                        </div>
                        <span class="data">01 de agosto de 2026</span>
                        <h3 class="titulo-materia">Gestão de assinaturas: como cortar serviços não ultilizados</h3>
                    </a>
                </div>
            </div>

            <div class="carrossel-indicadores" id="carrosselDots"></div>
        </section>

        <section class="comentarios" id="comentarios">
            <h2>Deixe seu comentário</h2>

            <?php 
            if (!empty($mensagem)) {
                echo "<div style='text-align: center; margin-bottom: 15px;'>$mensagem</div>";
            }
            ?>

            <form action="" method="POST" id="formComentario">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

                <label for="comentario">Comentário:</label>
                <textarea id="comentario" name="comentario" rows="4" placeholder="Escreva seu comentário..." required></textarea>

                <button type="submit">Enviar comentário</button>
            </form>

            <div id="listaComentarios">
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while ($linha = $resultado->fetch_assoc()) {
                        echo "<div class='comentario'>";
                        echo "<h3>" . htmlspecialchars($linha['nome']) . "</h3>";
                        echo "<span class='data-comentario'>" . htmlspecialchars($linha['data_formatada']) . "</span>";
                        echo "<p>" . nl2br(htmlspecialchars($linha['comentario'])) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p style='margin-top: 20px; color: var(--text-muted); text-align: center;'>Seja o primeiro a comentar!</p>";
                }
                ?>
            </div>
        </section>

    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const mobileToggle = document.getElementById("mobileToggle");
            const drawerClose = document.getElementById("drawerClose");
            const mobileDrawer = document.getElementById("mobileDrawer");
            const mobileOverlay = document.getElementById("mobileOverlay");

            function openDrawer() {
                mobileDrawer.classList.add("active");
                mobileOverlay.classList.add("active");
            }

            function closeDrawer() {
                mobileDrawer.classList.remove("active");
                mobileOverlay.classList.remove("active");
            }

            if (mobileToggle) mobileToggle.addEventListener("click", openDrawer);
            if (drawerClose) drawerClose.addEventListener("click", closeDrawer);
            if (mobileOverlay) mobileOverlay.addEventListener("click", closeDrawer);

            const container = document.getElementById("carrosselContainer");
            const wrapper = document.getElementById("carrosselWrapper");
            const cards = document.querySelectorAll(".card-veja-tambem");
            const btnAnterior = document.getElementById("btnAnterior");
            const btnProximo = document.getElementById("btnProximo");
            const dotsContainer = document.getElementById("carrosselDots");

            let indiceAtual = 0;
            let autoPlayTimer = null;
            const TEMPO_TRANSICAO = 3000;

            function obterItensPorPagina() {
                if (window.innerWidth <= 600) return 2;
                if (window.innerWidth <= 900) return 3;
                return 4;
            }

            function maxIndice() {
                return Math.max(0, cards.length - obterItensPorPagina());
            }

            function criarDots() {
                dotsContainer.innerHTML = "";
                const totalPaginas = maxIndice() + 1;

                for (let i = 0; i < totalPaginas; i++) {
                    const dot = document.createElement("div");
                    dot.classList.add("dot");
                    if (i === 0) dot.classList.add("ativo");

                    dot.addEventListener("click", () => {
                        moverPara(i);
                        reiniciarAutoPlay();
                    });

                    dotsContainer.appendChild(dot);
                }
            }

            function atualizarDots() {
                const dots = document.querySelectorAll(".dot");
                dots.forEach((dot, idx) => {
                    dot.classList.toggle("ativo", idx === indiceAtual);
                });
            }

            function moverPara(indice) {
                const max = maxIndice();
                if (indice < 0) indice = max;
                if (indice > max) indice = 0;

                indiceAtual = indice;
                const larguraCard = cards[0].getBoundingClientRect().width;
                const gap = 24;
                const deslocamento = indiceAtual * (larguraCard + gap);

                container.style.transform = `translateX(-${deslocamento}px)`;
                atualizarDots();
            }

            function proximoSlide() {
                moverPara(indiceAtual + 1);
            }

            function anteriorSlide() {
                moverPara(indiceAtual - 1);
            }

            function iniciarAutoPlay() {
                pararAutoPlay();
                autoPlayTimer = setInterval(proximoSlide, TEMPO_TRANSICAO);
            }

            function pararAutoPlay() {
                if (autoPlayTimer) clearInterval(autoPlayTimer);
            }

            function reiniciarAutoPlay() {
                pararAutoPlay();
                iniciarAutoPlay();
            }

            if (btnProximo) {
                btnProximo.addEventListener("click", () => {
                    proximoSlide();
                    reiniciarAutoPlay();
                });
            }

            if (btnAnterior) {
                btnAnterior.addEventListener("click", () => {
                    anteriorSlide();
                    reiniciarAutoPlay();
                });
            }

            criarDots();
            iniciarAutoPlay();
        });
    </script>
</body>

</html>