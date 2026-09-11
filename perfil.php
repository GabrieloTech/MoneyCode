<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se o usuário não estiver logado, redireciona para a página de login
if (!isset($_SESSION['login']) && !isset($_SESSION['nome']) && !isset($_SESSION['usuario_nome']) && !isset($_SESSION['email'])) {
    header("Location: login.html");
    exit;
}

// Definição da variável de controle de login que faltava
$isLogged = true; // Se passou da verificação acima, o usuário está logado.

$nomeCompleto = $_SESSION['nome'] ?? $_SESSION['usuario_nome'] ?? $_SESSION['login'] ?? 'Usuário';
$primeiroNome = explode(' ', trim($nomeCompleto))[0];
$emailUsuario = $_SESSION['email'] ?? $_SESSION['login'] ?? '';

// Pega as iniciais do usuário para gerar o avatar dinâmico
$iniciais = '';
$partesNome = explode(' ', trim($nomeCompleto));
if (count($partesNome) >= 2) {
    $iniciais = mb_strtoupper(mb_substr($partesNome[0], 0, 1) . mb_substr(end($partesNome), 0, 1));
} else {
    $iniciais = mb_strtoupper(mb_substr($nomeCompleto, 0, 2));
}

// Tratamento de mensagens via GET (status)
$mensagem = '';
$tipoAlerta = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'sucesso':
            $mensagem = 'Perfil e credenciais atualizados com sucesso!';
            $tipoAlerta = 'is-success';
            break;
        case 'erro_email_existente':
            $mensagem = 'O e-mail informado já está em uso por outra conta.';
            $tipoAlerta = 'is-danger';
            break;
        case 'erro':
            $mensagem = 'Ocorreu um erro ao atualizar o perfil. Tente novamente.';
            $tipoAlerta = 'is-danger';
            break;
    }
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Painel / Perfil - MONEY CODE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Pré-conexão e Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="style/style.css" as="style">
    
    <!-- Bulma & Fontes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Customizado -->
    <link rel="stylesheet" href="style/style.css">

    <style>
        .profile-hero {
            background: linear-gradient(135deg, rgba(20,20,20,0.9), rgba(10,10,10,0.95));
            border-bottom: 1px solid rgba(255, 215, 0, 0.15);
            padding: 2.5rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        .profile-avatar {
            width: 85px;
            height: 85px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #0f0f0f;
            font-size: 2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(255, 215, 0, 0.25);
            transition: transform 0.3s ease;
        }
        .profile-avatar:hover {
            transform: scale(1.05);
        }
        .input, .textarea {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #fff !important;
            transition: all 0.3s ease;
        }
        .input:focus {
            border-color: #FFD700 !important;
            box-shadow: 0 0 0 0.125em rgba(255, 215, 0, 0.25) !important;
            background-color: rgba(255, 255, 255, 0.08) !important;
        }
        .input::placeholder {
            color: rgba(255, 255, 255, 0.3) !important;
        }
        .card-profile-edit {
            border: 1px solid rgba(255, 255, 255, 0.07);
            background: rgba(18, 18, 18, 0.7);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
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
        <a href="index.php" class="logo">
            <img src="imagens/logo/logo.png" alt="MONEY CODE" style="max-height: 40px; width: auto;">
        </a>
        <button class="drawer-close" id="drawerClose" aria-label="Fechar Menu">&times;</button>
    </div>
    <div class="drawer-body">
        <a href="index.php" class="drawer-item">Início</a>
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
            <a href="perfil.php" class="drawer-item active">Meu Perfil / Editar</a>
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

    <!-- CONTEÚDO PRINCIPAL DO PERFIL -->
    <section class="section pt-6 pb-6">
        <div class="container" style="max-width: 750px;">
            
            <!-- TOPO / HEADER DO PERFIL COM AVATAR -->
            <div class="profile-hero is-flex is-align-items-center is-flex-wrap-wrap" style="gap: 20px;">
                <div class="profile-avatar">
                    <?= htmlspecialchars($iniciais, ENT_QUOTES, 'UTF-8') ?>
                </div>
                <div>
                    <span class="tag tag-yellow mb-1">CONTA VERIFICADA</span>
                    <h1 class="title is-3 text-gold mb-1"><?= htmlspecialchars($nomeCompleto, ENT_QUOTES, 'UTF-8') ?></h1>
                    <p class="has-text-grey-light is-size-6"><?= htmlspecialchars($emailUsuario, ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </div>

            <!-- MENSAGENS DE FEEDBACK -->
            <?php if (!empty($mensagem)): ?>
                <div class="notification <?= $tipoAlerta ?> is-light mb-5" style="border-radius: 8px;">
                    <button class="delete" onclick="this.parentElement.style.display='none'"></button>
                    <strong><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></strong>
                </div>
            <?php endif; ?>

            <!-- FORMULÁRIO DE EDIÇÃO -->
            <div class="card-profile-edit p-5 p-6-desktop">
                <h2 class="title is-5 text-gold mb-4 is-flex is-align-items-center" style="gap: 8px;">
                    ⚙️ Configurações da Conta
                </h2>
                
                <form action="atualizar_perfil.php" method="POST" id="formPerfil">
                    
                    <div class="field mb-4">
                        <label class="label has-text-white is-size-7 text-uppercase has-text-weight-bold">Nome Completo</label>
                        <div class="control has-icons-left">
                            <input class="input" type="text" name="nome" id="inputNome" value="<?= htmlspecialchars($nomeCompleto, ENT_QUOTES, 'UTF-8') ?>" required>
                            <span class="icon is-small is-left has-text-grey">👤</span>
                        </div>
                    </div>

                    <div class="field mb-4">
                        <label class="label has-text-white is-size-7 text-uppercase has-text-weight-bold">E-mail de Acesso</label>
                        <div class="control has-icons-left">
                            <input class="input" type="email" name="email" id="inputEmail" value="<?= htmlspecialchars($emailUsuario, ENT_QUOTES, 'UTF-8') ?>" required>
                            <span class="icon is-small is-left has-text-grey">✉️</span>
                        </div>
                    </div>

                    <hr class="has-background-grey-dark my-5" style="opacity: 0.3;">

                    <h3 class="title is-6 text-gold mb-2">Segurança e Credenciais</h3>
                    <p class="has-text-grey is-size-7 mb-4">Preencha o campo abaixo apenas caso deseje modificar sua senha atual.</p>
                    
                    <div class="field mb-5">
                        <label class="label has-text-white is-size-7 text-uppercase has-text-weight-bold">Nova Senha</label>
                        <div class="control has-icons-left">
                            <input class="input" type="password" name="nova_senha" placeholder="••••••••••••">
                            <span class="icon is-small is-left has-text-grey"></span>
                        </div>
                    </div>

                    <div class="field is-grouped is-flex-wrap-wrap" style="gap: 12px;">
                        <div class="control">
                            <button type="submit" class="button btn-cadastrar px-5 has-text-weight-bold">Salvar Alterações</button>
                        </div>
                        <div class="control">
                            <a href="index.php" class="button is-dark has-text-grey-light" style="border: 1px solid rgba(255,255,255,0.1);">Voltar ao Início</a>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </section>

    <!-- RODAPÉ -->
    <footer class="site-footer mt-6">
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
                    <li><a href="bolsa-de-valor.php">Bolsa de Valores</a></li>
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

    <!-- JS PARA MENU MOBILE E INTERATIVIDADE -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileToggle = document.getElementById('mobileToggle');
            const drawerClose = document.getElementById('drawerClose');
            const mobileOverlay = document.getElementById('mobileOverlay');
            const mobileDrawer = document.getElementById('mobileDrawer');

            function openDrawer() {
                mobileDrawer.classList.add('active');
                mobileOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeDrawer() {
                mobileDrawer.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            if (mobileToggle) mobileToggle.addEventListener('click', openDrawer);
            if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
            if (mobileOverlay) mobileOverlay.addEventListener('click', closeDrawer); // Correção aqui

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && mobileDrawer.classList.contains('active')) {
                    closeDrawer();
                }
            });

            // Interatividade extra: atualiza dinamicamente as iniciais do avatar se o usuário digitar no campo nome
            const inputNome = document.getElementById('inputNome');
            const avatarBox = document.querySelector('.profile-avatar');

            if (inputNome && avatarBox) {
                inputNome.addEventListener('input', (e) => {
                    const val = e.target.value.trim();
                    if (val.length > 0) {
                        const partes = val.split(' ');
                        let inc = '';
                        if (partes.length >= 2 && partes[1].length > 0) {
                            inc = (partes[0][0] + partes[1][0]).toUpperCase();
                        } else {
                            inc = partes[0].substring(0, 2).toUpperCase();
                        }
                        avatarBox.textContent = inc;
                    }
                });
            }
        });
    </script>
</body>
</html>