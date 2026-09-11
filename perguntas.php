<?php
$perguntas = [

[
"pergunta" => "Qual é o seu principal objetivo ao investir?",
"opcoes" => [
    ["texto" => "Preservar meu patrimônio, com o menor risco possível", "pontos" => 1],
    ["texto" => "Obter uma rentabilidade um pouco maior que a poupança", "pontos" => 2],
    ["texto" => "Buscar um bom equilíbrio entre risco e retorno", "pontos" => 3],
    ["texto" => "Maximizar meus ganhos, mesmo assumindo mais risco", "pontos" => 4],
]
],

[
"pergunta" => "Se seus investimentos caíssem 10% em um mês, o que você faria?",
"opcoes" => [
    ["texto" => "Resgataria tudo imediatamente", "pontos" => 1],
    ["texto" => "Ficaria preocupado e resgataria parte do valor", "pontos" => 2],
    ["texto" => "Manteria o investimento e esperaria a recuperação", "pontos" => 3],
    ["texto" => "Aproveitaria para investir mais, comprando na baixa", "pontos" => 4],
]
],

[
"pergunta" => "Por quanto tempo pretende manter seu dinheiro investido?",
"opcoes" => [
    ["texto" => "Menos de 1 ano", "pontos" => 1],
    ["texto" => "De 1 a 3 anos", "pontos" => 2],
    ["texto" => "De 3 a 5 anos", "pontos" => 3],
    ["texto" => "Mais de 5 anos", "pontos" => 4],
]
],

[
"pergunta" => "Qual o seu nível de conhecimento sobre investimentos?",
"opcoes" => [
    ["texto" => "Nenhum ou muito básico", "pontos" => 1],
    ["texto" => "Conheço o básico (poupança, CDB)", "pontos" => 2],
    ["texto" => "Conheço bem (ações, fundos, Tesouro Direto)", "pontos" => 3],
    ["texto" => "Avançado (derivativos, mercado internacional)", "pontos" => 4],
]
],

[
"pergunta" => "Qual porcentagem da sua renda mensal você pretende investir?",
"opcoes" => [
    ["texto" => "Menos de 10%", "pontos" => 1],
    ["texto" => "Entre 10% e 20%", "pontos" => 2],
    ["texto" => "Entre 20% e 40%", "pontos" => 3],
    ["texto" => "Mais de 40%", "pontos" => 4],
]
],

[
"pergunta" => "Você possui uma reserva de emergência?",
"opcoes" => [
    ["texto" => "Não possuo", "pontos" => 1],
    ["texto" => "Estou construindo aos poucos", "pontos" => 2],
    ["texto" => "Sim, cobre de 3 a 6 meses de gastos", "pontos" => 3],
    ["texto" => "Sim, cobre mais de 6 meses de gastos", "pontos" => 4],
]
],

[
"pergunta" => "Como você reagiria a uma oportunidade de alto retorno, mas com alto risco?",
"opcoes" => [
    ["texto" => "Prefiro nem saber, risco me assusta", "pontos" => 1],
    ["texto" => "Analisaria com cautela, mas dificilmente investiria", "pontos" => 2],
    ["texto" => "Investiria uma pequena parte do meu dinheiro", "pontos" => 3],
    ["texto" => "Investiria sem medo, buscando o retorno", "pontos" => 4],
]
],

[
"pergunta" => "Qual frase mais combina com você?",
"opcoes" => [
    ["texto" => "Prefiro dormir tranquilo sabendo que meu dinheiro está seguro", "pontos" => 1],
    ["texto" => "Aceito pequenas oscilações se isso trouxer mais retorno", "pontos" => 2],
    ["texto" => "Estou disposto a correr riscos calculados por um retorno maior", "pontos" => 3],
    ["texto" => "Risco faz parte do jogo: quanto maior, melhor o potencial de ganho", "pontos" => 4],
]
],

];

$perfis = [
    "conservador" => [
        "nome" => "Conservador",
        "min" => 8,
        "max" => 14,
        "descricao" => "Você prioriza a segurança do seu dinheiro e prefere evitar oscilações, mesmo que isso signifique um retorno menor.",
        "sugestoes" => ["Poupança", "Tesouro Selic", "CDB de liquidez diária", "Fundos DI"]
    ],
    "moderado" => [
        "nome" => "Moderado",
        "min" => 15,
        "max" => 22,
        "descricao" => "Você busca um equilíbrio entre segurança e rentabilidade, aceitando um pouco de risco para ganhar mais no longo prazo.",
        "sugestoes" => ["Tesouro IPCA+", "CDB e LCI/LCA de prazos maiores", "Fundos Multimercado", "Fundos Imobiliários"]
    ],
    "arrojado" => [
        "nome" => "Arrojado",
        "min" => 23,
        "max" => 32,
        "descricao" => "Você tem tolerância alta a risco e busca maximizar seus retornos, mesmo diante de oscilações mais fortes no curto prazo.",
        "sugestoes" => ["Ações", "Fundos de Ações", "ETFs", "Investimentos internacionais", "Criptomoedas"]
    ],
];
?>
