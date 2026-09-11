document.addEventListener("DOMContentLoaded", function () {

    let indice = 0;
    let pontuacaoTotal = 0;

    // Embaralhar (Fisher-Yates)
    function embaralhar(lista) {
        for (let i = lista.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [lista[i], lista[j]] = [lista[j], lista[i]];
        }
        return lista;
    }

    // Criar jogo a partir das perguntas originais (injetadas pelo PHP)
    function criarJogo() {
        let novoJogo = JSON.parse(JSON.stringify(perguntas));

        novoJogo.forEach(pergunta => {
            pergunta.opcoes = embaralhar(pergunta.opcoes);
        });

        return embaralhar(novoJogo);
    }

    let jogo = criarJogo();

    // Elementos
    const inicio = document.getElementById("inicio");
    const quiz = document.getElementById("quiz");
    const resultado = document.getElementById("resultado");

    const perguntaTela = document.getElementById("pergunta");
    const opcoesTela = document.getElementById("opcoes");

    const contador = document.getElementById("contador");

    const progresso = document.getElementById("progresso");

    const proximo = document.getElementById("proximo");

    let respostaSelecionada = null;

    // Iniciar
    document.getElementById("btnIniciar").onclick = function () {
        inicio.style.display = "none";
        quiz.style.display = "block";
        carregarPergunta();
    };

    // Carregar pergunta
    function carregarPergunta() {
        respostaSelecionada = null;
        proximo.style.display = "none";

        contador.innerHTML = (indice + 1) + "/" + jogo.length;
        progresso.style.width = ((indice) / jogo.length) * 100 + "%";

        perguntaTela.innerHTML = jogo[indice].pergunta;

        opcoesTela.innerHTML = "";

        jogo[indice].opcoes.forEach((opcao) => {
            const botao = document.createElement("button");
            botao.className = "opcao";
            botao.innerHTML = opcao.texto;
            botao.onclick = function () {
                selecionar(opcao, botao);
            };
            opcoesTela.appendChild(botao);
        });
    }

    // Selecionar resposta (sem certo/errado, só marca a escolha)
    function selecionar(opcao, botao) {
        const botoes = document.querySelectorAll(".opcao");
        botoes.forEach(b => b.classList.remove("selecionada"));

        botao.classList.add("selecionada");
        respostaSelecionada = opcao;

        proximo.style.display = "block";
    }

    // Próxima pergunta
    proximo.onclick = function () {
        if (!respostaSelecionada) return;

        pontuacaoTotal += respostaSelecionada.pontos;
        indice++;

        if (indice < jogo.length) {
            carregarPergunta();
        } else {
            finalizar();
        }
    };

    // Resultado final
    function finalizar() {
        quiz.style.display = "none";
        resultado.style.display = "block";

        progresso.style.width = "100%";

        let perfilChave = Object.keys(perfis).find(chave => {
            const p = perfis[chave];
            return pontuacaoTotal >= p.min && pontuacaoTotal <= p.max;
        });

        if (!perfilChave) {
            // fallback de segurança caso a pontuação fique fora das faixas
            perfilChave = pontuacaoTotal <= perfis.conservador.max
                ? "conservador"
                : pontuacaoTotal <= perfis.moderado.max
                    ? "moderado"
                    : "arrojado";
        }

        const perfil = perfis[perfilChave];

        document.getElementById("perfilNome").innerHTML = perfil.nome;
        document.getElementById("perfilDescricao").innerHTML = perfil.descricao;
        document.getElementById("perfilSugestoes").innerHTML =
            "Investimentos que combinam com você: " + perfil.sugestoes.join(", ");
    }

    // Reiniciar
    function reiniciar() {
        indice = 0;
        pontuacaoTotal = 0;

        resultado.style.display = "none";
        quiz.style.display = "block";

        jogo = criarJogo();

        carregarPergunta();
    }

    document.getElementById("btnReiniciar").onclick = reiniciar;

});