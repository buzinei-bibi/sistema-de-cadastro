<?php
// formulário de cadastro de cliente.
// os dados vão para salvar.php (action do form), que valida tudo

$titulo = 'novo cliente';
$pagina = 'clientes';
$raiz   = '../';

$opcoes = require __DIR__ . '/../dados/opcoes.php';

require __DIR__ . '/../includes/cabecalho.php';
?>

<header class="cabeca">
    <div class="surge">
        <p class="trilha">clientes / novo</p>
        <h1>cadastro de cliente</h1>
        <p>preencha os dados de quem vai comprar na lanchonete. campos com “opcional” podem ficar vazios.</p>
    </div>
    <div class="acoes surge" style="--i: 1">
        <a class="botao botao--fantasma" href="lista.php">ver clientes</a>
    </div>
</header>

<form method="POST" action="salvar.php" class="formulario comanda surge" style="--i: 2">
    <div class="comanda__parte">
        <h2>dados pessoais</h2>
        <p>nome completo, com sobrenome.</p>

        <div class="campos">
            <div class="campo">
                <label for="nome">nome completo</label>
                <input id="nome" name="nome" required autocomplete="name" placeholder="nome e sobrenome">
            </div>

            <div class="campo campo--metade">
                <label for="data_nascimento">data de nascimento</label>
                <input id="data_nascimento" name="data_nascimento" type="date" required max="<?= date('Y-m-d') ?>">
            </div>

            <div class="campo campo--metade">
                <label for="cpf">cpf</label>
                <input id="cpf" name="cpf" required inputmode="numeric" placeholder="000.000.000-00" maxlength="14">
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__parte">
        <h2>contato</h2>
        <p>para avisar quando o pedido sair.</p>

        <div class="campos">
            <div class="campo campo--metade campo--inteiro-celular">
                <label for="email">e-mail</label>
                <input id="email" name="email" type="email" required autocomplete="email" placeholder="seu@email.com">
            </div>

            <div class="campo campo--metade campo--inteiro-celular">
                <label for="whatsapp">whatsapp <small>· opcional</small></label>
                <input id="whatsapp" name="whatsapp" type="tel" inputmode="tel" autocomplete="tel" placeholder="(11) 91234-5678">
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__parte">
        <h2>endereço</h2>
        <p>onde a entrega vai chegar.</p>

        <div class="campos">
            <div class="campo campo--terco campo--inteiro-celular">
                <label for="cep">cep</label>
                <input id="cep" name="cep" required inputmode="numeric" autocomplete="postal-code" placeholder="00000-000" maxlength="9">
            </div>

            <div class="campo campo--dois-tercos">
                <label for="logradouro">rua / avenida</label>
                <input id="logradouro" name="logradouro" required autocomplete="address-line1" placeholder="rua, avenida, etc.">
            </div>

            <div class="campo campo--terco">
                <label for="numero">número</label>
                <input id="numero" name="numero" required placeholder="123">
            </div>

            <div class="campo campo--dois-tercos campo--metade-celular">
                <label for="complemento">complemento <small>· opcional</small></label>
                <input id="complemento" name="complemento" placeholder="bloco, apartamento, etc.">
            </div>

            <div class="campo campo--terco campo--inteiro-celular">
                <label for="bairro">bairro</label>
                <input id="bairro" name="bairro" required placeholder="seu bairro">
            </div>

            <div class="campo campo--terco">
                <label for="cidade">cidade</label>
                <input id="cidade" name="cidade" required autocomplete="address-level2" placeholder="sua cidade">
            </div>

            <div class="campo campo--terco">
                <label for="estado">estado</label>
                <select id="estado" name="estado" required>
                    <option value="">uf</option>
                    <?php foreach ($opcoes['estados'] as $uf): ?>
                        <option value="<?= $uf ?>"><?= $uf ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__rodape">
        <span class="nota">o php confere tudo de novo antes de aceitar</span>
        <button class="botao" type="submit">cadastrar cliente</button>
    </div>
</form>

<?php require __DIR__ . '/../includes/rodape.php'; ?>
