<?php
// formulário de cadastro de produto (o cardápio da lanchonete)

$titulo = 'novo produto';
$pagina = 'produtos';
$raiz   = '../';

$opcoes = require __DIR__ . '/../dados/opcoes.php';

require __DIR__ . '/../includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">produtos / novo</p>
        <h1>novo produto</h1>
        <p>um item do cardápio: o que é, quanto custa e quantos tem no estoque.</p>
    </div>
    <div class="acoes surge" style="--i: 1">
        <a class="botao botao--fantasma" href="lista.php">ver produtos</a>
    </div>
</header>

<form method="POST" action="salvar.php" class="formulario comanda surge" style="--i: 2">
    <div class="comanda__parte">
        <h2>o produto</h2>
        <p>nome e descrição aparecem no cardápio.</p>

        <div class="campos">
            <div class="campo">
                <label for="nome_produto">nome do produto</label>
                <input id="nome_produto" name="nome_produto" required minlength="3" placeholder="ex.: x-salada">
            </div>

            <div class="campo">
                <label for="descricao">descrição <small>· opcional, até 200 letras</small></label>
                <textarea id="descricao" name="descricao" maxlength="200" rows="3" placeholder="ingredientes, tamanho ou detalhes do prato..."></textarea>
            </div>

            <div class="campo campo--metade campo--inteiro-celular">
                <label for="categoria">categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="">selecione</option>
                    <?php foreach ($opcoes['categorias'] as $categoria): ?>
                        <option value="<?= $categoria ?>"><?= $categoria ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="campo campo--metade campo--inteiro-celular">
                <label for="produto_ativo">está à venda?</label>
                <select id="produto_ativo" name="produto_ativo" required>
                    <option value="sim">sim, disponível</option>
                    <option value="não">não, indisponível</option>
                </select>
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__parte">
        <h2>preço e estoque</h2>
        <p>o preço mínimo é R$ 1,00.</p>

        <div class="campos">
            <div class="campo campo--metade">
                <label for="preco">preço (R$)</label>
                <input id="preco" name="preco" type="number" step="0.01" min="1" required placeholder="0,00">
            </div>

            <div class="campo campo--metade">
                <label for="quantidade">quantidade</label>
                <input id="quantidade" name="quantidade" type="number" min="1" required placeholder="0">
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__rodape">
        <span class="nota">o php confere tudo de novo antes de aceitar</span>
        <button class="botao" type="submit">cadastrar produto</button>
    </div>
</form>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
