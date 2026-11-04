<?php
// página inicial: apresenta o sistema e leva para cada cadastro

$titulo = 'início';
$pagina = 'inicio';
$raiz   = '';

// require devolve o array que está dentro de cada arquivo de dados
$clientes = require __DIR__ . '/dados/clientes.php';
$produtos = require __DIR__ . '/dados/produtos.php';
$pedidos  = require __DIR__ . '/dados/pedidos.php';

$blocos = [
    [
        'nome'  => 'clientes',
        'total' => count($clientes),
        'texto' => 'quem compra na lanchonete: nome, cpf, contato e endereço de entrega.',
        'cor'   => 'var(--ketchup)',
        'pasta' => 'clientes',
        'botao' => 'novo cliente',
    ],
    [
        'nome'  => 'produtos',
        'total' => count($produtos),
        'texto' => 'o cardápio: categoria, preço, estoque e se o item está à venda.',
        'cor'   => 'var(--mostarda-viva)',
        'pasta' => 'produtos',
        'botao' => 'novo produto',
    ],
    [
        'nome'  => 'pedidos',
        'total' => count($pedidos),
        'texto' => 'quem pediu, o quê, como pagou e em que etapa o pedido está.',
        'cor'   => 'var(--picles)',
        'pasta' => 'pedidos',
        'botao' => 'novo pedido',
    ],
];

$etapas = [
    [
        'rotulo' => 'preencha',
        'titulo' => 'escolha um cadastro',
        'texto'  => 'cada formulário é dividido em partes curtas. no pedido, o sistema sugere clientes e produtos e mostra o total enquanto você digita.',
    ],
    [
        'rotulo' => 'o sistema confere',
        'titulo' => 'nada entra errado',
        'texto'  => 'antes de aceitar, o servidor revisa tudo: campos obrigatórios, cpf, e-mail, cep, preço e quantidade. se algo falhar, ele lista tudo o que precisa corrigir de uma vez.',
    ],
    [
        'rotulo' => 'acompanhe',
        'titulo' => 'recibo e listas',
        'texto'  => 'com tudo certo, os dados aparecem num recibo. as listas mostram os registros com estoque, valores e o status de cada pedido.',
    ],
];

$recursos = [
    ['titulo' => 'validação no servidor', 'texto' => 'as regras rodam no php, então não dá para pular a conferência mexendo no navegador.'],
    ['titulo' => 'total automático', 'texto' => 'quantidade × valor, com desconto de até 20%, calculado na tela e conferido de novo no servidor.'],
    ['titulo' => 'dados formatados', 'texto' => 'cpf, whatsapp e cep podem ser digitados com ou sem pontuação; o sistema arruma na hora de mostrar.'],
    ['titulo' => 'status dos pedidos', 'texto' => 'cada pedido fica pendente, em andamento ou concluído, com um carimbo de cor diferente.'],
];

require __DIR__ . '/includes/cabecalho.php';
?>

<section class="capa">
    <div class="surge">
        <p class="trilha">gestão de lanchonete</p>
        <h1>sistema de <em>cadastro</em></h1>
    </div>
    <p class="surge" style="--i: 1">
        clientes, cardápio e pedidos de uma lanchonete num lugar só.
        cada cadastro passa por uma conferência antes de ser aceito,
        e os pedidos já saem com o total calculado.
    </p>
</section>

<section class="painel" aria-label="cadastros">
    <?php foreach ($blocos as $i => $bloco): ?>
        <article class="bloco comanda surge" style="--i: <?= $i + 2 ?>; --cor: <?= $bloco['cor'] ?>">
            <div class="bloco__topo">
                <span><?= $bloco['pasta'] ?>/</span>
                <span class="bloco__cor" aria-hidden="true"></span>
            </div>
            <span class="bloco__numero"><?= $bloco['total'] ?></span>
            <h2 class="bloco__nome"><?= $bloco['nome'] ?></h2>
            <p class="bloco__texto"><?= $bloco['texto'] ?></p>
            <div class="bloco__links">
                <a href="<?= $bloco['pasta'] ?>/cadastro.php"><?= $bloco['botao'] ?></a>
                <a href="<?= $bloco['pasta'] ?>/lista.php">ver lista →</a>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<section class="secao">
    <header class="secao__cabeca">
        <div>
            <p class="trilha">como funciona</p>
            <h2>do formulário à lista, em três passos</h2>
        </div>
        <a class="botao botao--fantasma" href="como-funciona.php">ver em detalhes</a>
    </header>

    <ol class="etapas">
        <?php foreach ($etapas as $etapa): ?>
            <li class="etapa comanda">
                <span class="etapa__rotulo"><?= $etapa['rotulo'] ?></span>
                <h3><?= $etapa['titulo'] ?></h3>
                <p><?= $etapa['texto'] ?></p>
            </li>
        <?php endforeach; ?>
    </ol>
</section>

<section class="secao">
    <header class="secao__cabeca">
        <div>
            <p class="trilha">detalhes</p>
            <h2>o que o sistema faz por você</h2>
        </div>
    </header>

    <ul class="recursos">
        <?php foreach ($recursos as $recurso): ?>
            <li class="recurso">
                <h3><?= $recurso['titulo'] ?></h3>
                <p><?= $recurso['texto'] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php require __DIR__ . '/includes/rodape.php'; ?>
