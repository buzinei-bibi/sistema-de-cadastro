<?php
// lista de produtos, montada com foreach a partir de dados/produtos.php

$titulo = 'produtos';
$pagina = 'produtos';
$raiz   = '../';

$produtos = require __DIR__ . '/../dados/produtos.php';

require __DIR__ . '/../includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">produtos / lista</p>
        <h1>produtos</h1>
        <p>o cardápio da lanchonete, com preço e estoque.</p>
    </div>
    <div class="acoes surge" style="--i: 1">
        <a class="botao" href="cadastro.php">novo produto</a>
    </div>
</header>

<section class="comanda surge" style="--i: 2">
    <div class="lista-topo">
        <span><strong><?= count($produtos) ?></strong> produtos</span>
        <span>dados de exemplo</span>
    </div>

    <div class="tabela-caixa">
        <table class="tabela">
            <thead>
                <tr>
                    <th>id</th>
                    <th>produto</th>
                    <th>categoria</th>
                    <th class="direita">estoque</th>
                    <th class="direita">preço</th>
                    <th>situação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $item): ?>
                    <tr>
                        <td class="id">#<?= str_pad($item['id'], 2, '0', STR_PAD_LEFT) ?></td>
                        <td class="forte larga">
                            <?= e($item['produto']) ?>
                            <span class="detalhe"><?= e($item['descricao']) ?></span>
                        </td>
                        <td class="suave"><?= e($item['categoria']) ?></td>
                        <td class="numero direita"><?= $item['quantidade'] ?> un.</td>
                        <td class="numero direita"><?= moeda($item['preco']) ?></td>
                        <td>
                            <!-- operador ternário: condição ? se verdadeiro : se falso -->
                            <span class="carimbo <?= $item['ativo'] ? 'carimbo--concluido' : '' ?>">
                                <?= $item['ativo'] ? 'à venda' : 'pausado' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
