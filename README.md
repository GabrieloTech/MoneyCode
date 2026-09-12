# 💰 MoneyCode

> **Projeto Acadêmico Colaborativo** — Uma aplicação web interativa desenvolvida em PHP e JavaScript com foco em educação e conscientização financeira, construída de forma conjunta por toda a turma.

---

## 📌 Sobre o Projeto

O **MoneyCode** é uma plataforma web desenvolvida como projeto acadêmico prático para promover a **educação financeira**. A aplicação aborda temas fundamentais do mercado financeiro e hábitos de consumo modernos, como riscos de apostas virtuais, uso consciente de cartão de crédito, investimentos, bolsa de valores e consumo digital.

Todo o projeto foi planejado, estruturado e codificado de forma **colaborativa em equipe**, simulando um ambiente real de desenvolvimento de software onde os alunos atuaram na criação das páginas, integração com banco de dados em PHP, desenvolvimento de rotas e estilização.

---

## ✨ Principais Recursos e Módulos

### 👤 Autenticação e Gestão de Usuários
- **Cadastro e Login (`cadastro.html`, `login.html`):** Autenticação e entrada de novos usuários na plataforma.
- **Perfil do Usuário (`perfil.php`, `atualizar_perfil.php`):** Gerenciamento de informações pessoais e atualização de dados.
- **Sessão Segura (`banco_de_dados/valida.php`, `logout.php`):** Controle de acesso e encerramento de sessão.

### 📚 Conteúdo Educativo e Temático
- **🎰 Riscos e Apostas (`apostas.php`):** Conscientização sobre os perigos e impactos financeiros de apostas online/casinos virtuais.
- **💳 Cartão de Crédito (`cartao.php`):** Guia prático de uso consciente e planejamento de limites.
- **📈 Bolsa de Valores & Investimentos (`bolsa-de-valor.php`, `investimento.php`, `investimentos.php`, `cmenvestir.php`):** Introdução ao mercado de ações e estratégias de investimento.
- **📱 Consumo Digital (`consumoDigital.php`):** Dicas sobre compras online, assinaturas e controle de impulsos.
- **📖 Trilha de Matérias (`materias/materia1.php` a `materia6.php`):** Artigos educativos sequenciais abrangendo conceitos de finanças.

### 💬 Interatividade e Comentários
- **Sistema de Comentários Dinâmico (`materias/script.js`):** Permite aos usuários interagir nas matérias adicionando opiniões e feedback via manipulação do DOM.

---

## 🛠️ Tecnologias Utilizadas

- **Linguagem Principal Server-side:** PHP 8+
- **Front-end:** HTML5, CSS3, JavaScript (ES6+)
- **Banco de Dados:** MySQL (Scripts PHP em `banco_de_dados/`)
- **Versionamento & Governança:** Git e GitHub (Trabalho colaborativo e integração contínua)
- **Ferramenta de Desenvolvimento:** VS Code e IDE

---

## 📁 Estrutura de Pastas e Arquivos

```text
MONEY CODE/
├── assets/images/           # Imagens institucionais e identidades do sistema
├── banco_de_dados/          # Scripts PHP de integração e manipulação de BD
│   ├── salvar.php           # Inserção e gravação de dados
│   └── valida.php           # Validação e segurança de autenticação
├── imagens/                 # Imagens das matérias e categorias (aposta, cartão, etc.)
├── js/                      # Scripts específicos por módulo
│   ├── cartao.js            # Comportamentos da seção de cartões
│   └── investimento.js      # Calculadoras/lógicas de investimento
├── materias/                # Módulos de conteúdo educativo estendido
│   ├── materia1.php ... materia6.php
│   └── script.js            # Lógica interativa de comentários
├── style/                   # Arquivos de estilização (CSS)
├── apostas.php              # Página temática sobre apostas
├── atualizar_perfil.php     # Lógica de atualização de perfil do usuário
├── bolsa-de-valor.php       # Conteúdo sobre o mercado de ações
├── cadastro.html            # Tela de cadastro de novos usuários
├── cartao.php               # Conteúdo sobre cartão de crédito
├── cmenvestir.php           # Guia "Como Começar a Investir"
├── consumoDigital.php       # Dicas sobre consumo digital responsável
├── index.php                # Página principal (Dashboard/Home)
├── investimento.php         # Módulo básico de investimentos
├── investimentos.php        # Visão geral de investimentos
├── login.html               # Tela de autenticação de usuários
├── logout.php               # Encerramento de sessão do usuário
├── perfil.php               # Painel de perfil do usuário
└── README.md                # Documentação oficial do projeto
```

---

## 🤝 Colaboração Acadêmica

Este projeto representa o esforço conjunto e a cooperação de toda a turma. A divisão de tarefas garantiu que cada aluno contribuísse em etapas cruciais:

1. **Modelagem de Dados & Backend:** Configuração das tabelas MySQL e desenvolvimento dos scripts PHP de autenticação (`valida.php`, `salvar.php`).
2. **Desenvolvimento Web Front-end:** Implementação das telas HTML/PHP e estilos gráficos.
3. **Criação de Conteúdo Pedagógico:** Redação e estruturação dos materiais sobre conscientização financeira e investimentos.
4. **Interatividade em JS:** Manipulação do DOM para inserção dinâmica de comentários e calculadoras financeiras.
5. **Revisão e Integração Git:** Gerenciamento de branchs e integração de código via GitHub.

---

## 🚀 Como Executar o Projeto Localmente

### Pré-requisitos
- Servidor Web local com suporte a **PHP** e **MySQL** (ex: [XAMPP](https://www.apachefriends.org/), WAMP, Laragon ou Docker).

### Passo a Passo

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/GabrieloTech/MoneyCode.git
   ```

2. **Mova o projeto para o diretório do servidor web:**
   - Se utilizar XAMPP, copie a pasta `MoneyCode` para a pasta `htdocs` (ex: `C:\xampp\htdocs\MoneyCode`).

3. **Inicie os serviços:**
   - Abra o painel do seu servidor local (XAMPP/WAMP) e inicie os módulos **Apache** e **MySQL**.

4. **Acesse no navegador:**
   - Abra o seu navegador e acesse: `http://localhost/MoneyCode/index.php` ou `http://localhost/MoneyCode/login.html`.

---

## 📜 Licença

Projeto desenvolvido com propósitos puramente educacionais e acadêmicos.

---

<p align="center">
  Desenvolvido com coração e cooperação por toda a turma TI103 Senac Santo André | <b>MoneyCode 2026</b>
</p>
