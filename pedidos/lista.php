<?php
// lista de pedidos, montada com foreach a partir de dados/pedidos.php

$titulo = 'pedidos';
$pagina = 'pedidos';
$raiz   = '../';

$pedidos = require __DIR__ . '/../dados/pedidos.php';

// soma de todos os pedidos, para mostrar no topo da lista
$soma = 0;
foreach ($pedidos as $pedido) {
    $soma += $pedido['valor'] * $pedido['quantidade'];
}

require __DIR__ . '/../includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">pedidos / lista</p>
        <h1>pedidos</h1>
        <p>tudo o que saiu da cozinha, e o que ainda está saindo.</p>
    </div>
    <div class="acoes surge" style="--i: 1">
        <a class="botao" href="cadastro.php">novo pedido</a>
    </div>
</header>

<section class="comanda surge" style="--i: 2">
    <div class="lista-topo">
        <span><strong><?= count($pedidos) ?></strong> pedidos</span>
        <span>somando <strong><?= moeda($soma) ?></strong></span>
    </div>

    <div class="tabela-caixa">
        <table class="tabela">
            <thead>
                <tr>
                    <th>id</th>
                    <th>pedido</th>
                    <th>cliente</th>
                    <th class="direita">total</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $item): ?>
                    <tr>
                        <td class="id">#<?= str_pad($item['id'], 2, '0', STR_PAD_LEFT) ?></td>
                        <td class="forte">
                            <?= $item['quantidade'] ?>× <?= e($item['produto']) ?>
                            <span class="detalhe"><?= e($item['observacao']) ?></span>
                        </td>
                        <td class="suave"><?= e($item['cliente']) ?></td>
                        <td class="direita">
                            <span class="numero"><?= moeda($item['valor'] * $item['quantidade']) ?></span>
                            <span class="detalhe"><?= e($item['pagamento']) ?></span>
                        </td>
                        <td><span class="carimbo <?= classe_status($item['status']) ?>"><?= e($item['status']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
