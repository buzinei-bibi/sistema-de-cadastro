<?php
// lista de clientes, montada com foreach a partir de dados/clientes.php

$titulo = 'clientes';
$pagina = 'clientes';
$raiz   = '../';

$clientes = require __DIR__ . '/../dados/clientes.php';

require __DIR__ . '/../includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">clientes / lista</p>
        <h1>clientes</h1>
        <p>quem já está cadastrado no sistema.</p>
    </div>
    <div class="acoes surge" style="--i: 1">
        <a class="botao" href="cadastro.php">novo cliente</a>
    </div>
</header>

<section class="comanda surge" style="--i: 2">
    <div class="lista-topo">
        <span><strong><?= count($clientes) ?></strong> clientes</span>
        <span>dados de exemplo</span>
    </div>

    <div class="tabela-caixa">
        <table class="tabela">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>nascimento</th>
                    <th>cpf</th>
                    <th>whatsapp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td class="id">#<?= str_pad($cliente['id'], 2, '0', STR_PAD_LEFT) ?></td>
                        <td class="forte"><?= e($cliente['nome']) ?></td>
                        <td class="numero"><?= data_br($cliente['nascimento']) ?></td>
                        <td class="numero"><?= mascara($cliente['cpf'], '###.###.###-##') ?></td>
                        <td class="numero"><?= formata_telefone($cliente['whatsapp']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
