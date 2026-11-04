<?php
// recebe o formulário de produtos/cadastro.php, valida e mostra o resultado

require_once __DIR__ . '/../includes/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./cadastro.php');
    exit;
}

$opcoes = require __DIR__ . '/../dados/opcoes.php';

// os nomes aqui precisam ser iguais ao name="" dos campos do formulário
$produto    = campo('nome_produto');
$descricao  = campo('descricao');
$categoria  = campo('categoria');
$preco      = campo('preco');
$quantidade = campo('quantidade');
$ativo      = campo('produto_ativo');

$erros = [];

if ($produto === '') {
    $erros[] = "o campo 'nome do produto' é obrigatório";
} elseif (mb_strlen($produto) < 3) {
    $erros[] = "'nome do produto' precisa ter no mínimo 3 letras";
}

// mb_strlen conta letras com acento como 1 (strlen contaria 2)
if (mb_strlen($descricao) > 200) {
    $erros[] = "'descrição' pode ter no máximo 200 letras";
}

if ($categoria === '') {
    $erros[] = "o campo 'categoria' é obrigatório";
} elseif (!in_array($categoria, $opcoes['categorias'])) {
    $erros[] = 'essa categoria não existe';
}

if ($preco === '') {
    $erros[] = "o campo 'preço' é obrigatório";
} elseif (!is_numeric($preco) || $preco < 1) {
    $erros[] = "o 'preço' precisa ser de no mínimo R$ 1,00";
}

if ($quantidade === '') {
    $erros[] = "o campo 'quantidade' é obrigatório";
} elseif (!is_numeric($quantidade) || $quantidade < 1) {
    $erros[] = "a 'quantidade' precisa ser de no mínimo 1";
}

if (!in_array($ativo, ['sim', 'não'])) {
    $erros[] = 'diga se o produto está à venda ou não';
}

$titulo = count($erros) ? 'erro no cadastro' : 'produto cadastrado';
$pagina = 'produtos';
$raiz   = '../';

require __DIR__ . '/../includes/cabecalho.php';

if (count($erros) > 0) {
    $voltar = 'cadastro.php';
    require __DIR__ . '/../includes/erros.php';
} else {
    $recibo = [
        'titulo' => 'produto cadastrado',
        'linhas' => [
            'produto'    => $produto,
            'descrição'  => $descricao,
            'categoria'  => $categoria,
            'preço'      => moeda($preco),
            'quantidade' => (int) $quantidade . ' un.',
            'à venda'    => $ativo,
        ],
        'novo'  => 'cadastro.php',
        'lista' => 'lista.php',
    ];
    require __DIR__ . '/../includes/recibo.php';
}

require __DIR__ . '/../includes/rodape.php';
