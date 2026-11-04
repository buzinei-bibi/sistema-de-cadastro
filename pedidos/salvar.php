<?php
// recebe o formulário de pedidos/cadastro.php, valida e mostra o resultado

require_once __DIR__ . '/../includes/funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./cadastro.php');
    exit;
}

$opcoes = require __DIR__ . '/../dados/opcoes.php';

$cliente    = campo('cliente');
$produto    = campo('produto');
$valor      = campo('valor');
$quantidade = campo('quantidade');
$desconto   = campo('desconto');
$pagamento  = campo('pagamento');
$observacao = campo('observacao');
$status     = campo('status');

$erros = [];

if ($cliente === '') {
    $erros[] = "o campo 'cliente' é obrigatório";
} elseif (mb_strlen($cliente) < 3) {
    $erros[] = "'cliente' precisa ter no mínimo 3 letras";
}

if ($produto === '') {
    $erros[] = "o campo 'produto' é obrigatório";
} elseif (mb_strlen($produto) < 3) {
    $erros[] = "'produto' precisa ter no mínimo 3 letras";
}

if ($valor === '') {
    $erros[] = "o campo 'valor' é obrigatório";
} elseif (!is_numeric($valor) || $valor < 0.01) {
    $erros[] = "o 'valor' precisa ser de no mínimo R$ 0,01";
}

if ($quantidade === '') {
    $erros[] = "o campo 'quantidade' é obrigatório";
} elseif (!is_numeric($quantidade) || $quantidade < 1) {
    $erros[] = "a 'quantidade' precisa ser de no mínimo 1";
}

// o desconto chega como texto ("10"), então (int) converte para número antes de comparar
if (!in_array((int) $desconto, $opcoes['descontos'])) {
    $erros[] = 'esse desconto não existe';
}

if ($pagamento === '') {
    $erros[] = "o campo 'forma de pagamento' é obrigatório";
} elseif (!array_key_exists($pagamento, $opcoes['pagamentos'])) {
    $erros[] = 'essa forma de pagamento não existe';
}

if (mb_strlen($observacao) > 200) {
    $erros[] = "'observação' pode ter no máximo 200 letras";
}

if (!in_array($status, $opcoes['status'])) {
    $erros[] = 'escolha um status da lista';
}

$titulo = count($erros) ? 'erro no pedido' : 'pedido feito';
$pagina = 'pedidos';
$raiz   = '../';

require __DIR__ . '/../includes/cabecalho.php';

if (count($erros) > 0) {
    $voltar = 'cadastro.php';
    require __DIR__ . '/../includes/erros.php';
} else {
    // conta do pedido
    $subtotal       = $valor * $quantidade;
    $valor_desconto = $subtotal * ((int) $desconto / 100);
    $total          = $subtotal - $valor_desconto;

    $recibo = [
        'titulo' => 'pedido feito',
        'linhas' => [
            'cliente'    => $cliente,
            'produto'    => $produto,
            'quantidade' => (int) $quantidade . ' × ' . moeda($valor),
            'subtotal'   => moeda($subtotal),
            'desconto'   => $desconto > 0 ? "$desconto% (− " . moeda($valor_desconto) . ')' : 'sem desconto',
            'pagamento'  => $opcoes['pagamentos'][$pagamento],
            'observação' => $observacao,
            'status'     => $status,
        ],
        'total' => ['total', moeda($total)],
        'novo'  => 'cadastro.php',
        'lista' => 'lista.php',
    ];
    require __DIR__ . '/../includes/recibo.php';
}

require __DIR__ . '/../includes/rodape.php';
