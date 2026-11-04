<?php
// formulário de pedido.
// as sugestões de cliente e produto vêm dos arquivos de dados

$titulo = 'novo pedido';
$pagina = 'pedidos';
$raiz   = '../';

$opcoes   = require __DIR__ . '/../dados/opcoes.php';
$clientes = require __DIR__ . '/../dados/clientes.php';
$produtos = require __DIR__ . '/../dados/produtos.php';

require __DIR__ . '/../includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">pedidos / novo</p>
        <h1>novo pedido</h1>
        <p>quem pediu, o que pediu e como vai pagar. o total aparece enquanto você preenche.</p>
    </div>
    <div class="acoes surge" style="--i: 1">
        <a class="botao botao--fantasma" href="lista.php">ver pedidos</a>
    </div>
</header>

<form method="POST" action="salvar.php" class="formulario comanda surge" style="--i: 2">
    <div class="comanda__parte">
        <h2>o pedido</h2>
        <p>comece a digitar para ver as sugestões.</p>

        <div class="campos">
            <div class="campo campo--metade campo--inteiro-celular">
                <label for="cliente">cliente</label>
                <input id="cliente" name="cliente" required minlength="3" list="lista-clientes" placeholder="nome do cliente" autocomplete="off">
                <!-- datalist: sugestões que aparecem enquanto digita -->
                <datalist id="lista-clientes">
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= e($cliente['nome']) ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <div class="campo campo--metade campo--inteiro-celular">
                <label for="produto">produto</label>
                <input id="produto" name="produto" required minlength="3" list="lista-produtos" placeholder="nome do produto" autocomplete="off">
                <datalist id="lista-produtos">
                    <?php foreach ($produtos as $item): ?>
                        <option value="<?= e($item['produto']) ?>" data-preco="<?= $item['preco'] ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <div class="campo">
                <label for="observacao">observação <small>· opcional</small></label>
                <textarea id="observacao" name="observacao" rows="2" maxlength="200" placeholder="ex.: sem cebola"></textarea>
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__parte">
        <h2>valores</h2>
        <p>escolhendo um produto da lista, o valor é preenchido sozinho.</p>

        <div class="campos">
            <div class="campo campo--terco">
                <label for="valor">valor unitário (R$)</label>
                <input id="valor" name="valor" type="number" step="0.01" min="0.01" required placeholder="0,00">
            </div>

            <div class="campo campo--terco">
                <label for="quantidade">quantidade</label>
                <input id="quantidade" name="quantidade" type="number" min="1" value="1" required>
            </div>

            <div class="campo campo--terco campo--inteiro-celular">
                <label for="desconto">desconto</label>
                <select id="desconto" name="desconto">
                    <?php foreach ($opcoes['descontos'] as $desconto): ?>
                        <option value="<?= $desconto ?>"><?= $desconto === 0 ? 'sem desconto' : $desconto . '%' ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo campo--metade campo--inteiro-celular">
                <label for="pagamento">forma de pagamento</label>
                <select id="pagamento" name="pagamento" required>
                    <option value="">selecione</option>
                    <?php foreach ($opcoes['pagamentos'] as $valor => $rotulo): ?>
                        <option value="<?= $valor ?>"><?= $rotulo ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo campo--metade campo--inteiro-celular">
                <label for="status">status</label>
                <select id="status" name="status">
                    <?php foreach ($opcoes['status'] as $status): ?>
                        <option value="<?= $status ?>"><?= $status ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__rodape">
        <div class="resumo">
            <span>total</span>
            <strong id="total" aria-live="polite">R$ 0,00</strong>
        </div>
        <button class="botao" type="submit">fazer pedido</button>
    </div>
</form>

<script>
    // um pouquinho de javascript só para ajudar quem preenche.
    // quem valida de verdade é o php, no salvar.php
    const campoProduto = document.getElementById('produto');
    const campoValor = document.getElementById('valor');
    const campoQuantidade = document.getElementById('quantidade');
    const campoDesconto = document.getElementById('desconto');
    const total = document.getElementById('total');

    function atualizarTotal() {
        const valor = parseFloat(campoValor.value) || 0;
        const quantidade = parseInt(campoQuantidade.value) || 0;
        const desconto = parseInt(campoDesconto.value) || 0;
        const resultado = valor * quantidade * (1 - desconto / 100);
        total.textContent = resultado.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    // escolheu um produto da lista? preenche o valor dele
    campoProduto.addEventListener('input', () => {
        const opcao = [...document.querySelectorAll('#lista-produtos option')]
            .find(o => o.value === campoProduto.value);
        if (opcao) {
            campoValor.value = Number(opcao.dataset.preco).toFixed(2);
            atualizarTotal();
        }
    });

    [campoValor, campoQuantidade, campoDesconto].forEach(c => c.addEventListener('input', atualizarTotal));
</script>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
