<?php
// como funciona: explica o caminho de um cadastro e tem um teste ao vivo.
// (este arquivo começou como o meu primeiro.php: um formulário, duas variáveis e um echo)

$titulo = 'como funciona';
$pagina = 'como';
$raiz   = '';

$nome    = '';
$idade   = '';
$enviado = false;
$erros   = [];

// $_POST só tem dados depois que o formulário é enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enviado = true;
    $nome    = trim($_POST['nome'] ?? '');  // variável string
    $idade   = trim($_POST['idade'] ?? ''); // chega como texto; o php converte quando precisa

    if ($nome === '') {
        $erros[] = "o campo 'nome' é obrigatório";
    }

    if ($idade === '' || !is_numeric($idade) || $idade < 0) {
        $erros[] = "a 'idade' precisa ser um número";
    }
}

$caminho = [
    [
        'rotulo' => 'navegador',
        'titulo' => 'o formulário',
        'texto'  => 'a página cadastro.php mostra os campos em html. o próprio navegador já barra o básico, como campo vazio ou e-mail sem @.',
    ],
    [
        'rotulo' => 'envio',
        'titulo' => 'os dados viajam',
        'texto'  => 'ao clicar em enviar, o formulário manda tudo por post para salvar.php, o endereço que está no action.',
    ],
    [
        'rotulo' => 'servidor',
        'titulo' => 'o php confere',
        'texto'  => 'salvar.php lê cada campo em $_POST, tira os espaços com trim() e testa as regras. cada problema vira um item numa lista de erros.',
    ],
    [
        'rotulo' => 'resposta',
        'titulo' => 'recibo ou correção',
        'texto'  => 'se a lista de erros estiver vazia, o php monta o recibo. se não, mostra tudo o que precisa arrumar, e o formulário continua preenchido.',
    ],
];

$arquivos = [
    ['nome' => 'cadastro.php', 'texto' => 'o formulário de cada assunto (clientes, produtos e pedidos).'],
    ['nome' => 'salvar.php', 'texto' => 'recebe o formulário, confere as regras e responde.'],
    ['nome' => 'lista.php', 'texto' => 'monta a tabela com foreach, linha por linha.'],
    ['nome' => 'dados/', 'texto' => 'os registros de exemplo e as opções dos selects.'],
    ['nome' => 'includes/', 'texto' => 'o que se repete: cabeçalho, rodapé, funções, recibo.'],
];

require __DIR__ . '/includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">como funciona</p>
        <h1>do formulário à lista</h1>
        <p>o caminho que um cadastro faz, do clique em “enviar” até aparecer na tela.</p>
    </div>
</header>

<ol class="etapas etapas--quatro surge" style="--i: 1">
    <?php foreach ($caminho as $passo): ?>
        <li class="etapa comanda">
            <span class="etapa__rotulo"><?= $passo['rotulo'] ?></span>
            <h3><?= $passo['titulo'] ?></h3>
            <p><?= e($passo['texto']) ?></p>
        </li>
    <?php endforeach; ?>
</ol>

<section class="secao">
    <header class="secao__cabeca">
        <div>
            <p class="trilha">teste aqui</p>
            <h2>veja o php respondendo</h2>
            <p class="secao__texto">o mesmo caminho, em miniatura: este formulário envia para a própria página.</p>
        </div>
    </header>

    <div class="duas-colunas">
        <form method="POST" action="#teste" class="comanda" id="teste">
            <div class="comanda__parte">
                <h2>se apresente</h2>
                <p>digite qualquer coisa, ou deixe em branco para ver o erro.</p>

                <div class="campos">
                    <div class="campo campo--dois-tercos">
                        <label for="nome">nome</label>
                        <input id="nome" name="nome" value="<?= e($nome) ?>" placeholder="digite seu nome">
                    </div>
                    <div class="campo campo--terco">
                        <label for="idade">idade</label>
                        <input id="idade" name="idade" value="<?= e($idade) ?>" inputmode="numeric" placeholder="0">
                    </div>
                </div>
            </div>

            <div class="comanda__corte" aria-hidden="true"></div>

            <div class="comanda__rodape">
                <span class="nota">sem conferência no navegador, de propósito</span>
                <button class="botao" type="submit">enviar</button>
            </div>
        </form>

        <div class="painel-php comanda" aria-live="polite">
            <div class="painel-php__parte">
                <span class="etapa__rotulo">o que chegou em $_POST</span>
                <?php if ($enviado): ?>
                    <pre class="codigo">[
  'nome'  => '<?= e($nome) ?>',
  'idade' => '<?= e($idade) ?>',
]</pre>
                <?php else: ?>
                    <p class="nota">nada ainda. envie o formulário.</p>
                <?php endif; ?>
            </div>

            <div class="comanda__corte" aria-hidden="true"></div>

            <div class="painel-php__parte">
                <span class="etapa__rotulo">a resposta do php</span>
                <?php if (!$enviado): ?>
                    <p class="nota">a resposta aparece aqui.</p>
                <?php elseif (count($erros) > 0): ?>
                    <ul class="aviso__lista">
                        <?php foreach ($erros as $erro): ?>
                            <li><?= e($erro) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <!-- o ponto (.) junta textos; e() deixa o texto seguro para mostrar -->
                    <p class="resposta">
                        <?php echo 'olá, <b>' . e($nome) . '</b>! você tem <b>' . (int) $idade . '</b> anos.'; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="secao">
    <header class="secao__cabeca">
        <div>
            <p class="trilha">por dentro</p>
            <h2>onde fica cada coisa</h2>
        </div>
    </header>

    <ul class="recursos recursos--arquivos">
        <?php foreach ($arquivos as $arquivo): ?>
            <li class="recurso">
                <h3 class="mono"><?= $arquivo['nome'] ?></h3>
                <p><?= $arquivo['texto'] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <p class="observacao">
        fiz este sistema para praticar php. por isso ele ainda não usa banco de dados:
        os cadastros são conferidos e mostrados, mas não ficam guardados.
    </p>
</section>

<?php require __DIR__ . '/includes/rodape.php'; ?>
