<?php
// mostra a lista de erros de validação.
// espera: $erros (vetor de textos) e $voltar (link do formulário)
?>
<section class="aviso comanda surge" role="alert">
    <div class="comanda__parte">
        <p class="trilha">não deu para salvar</p>
        <h1 class="aviso__titulo">faltou arrumar <?= count($erros) === 1 ? 'uma coisa' : count($erros) . ' coisas' ?></h1>

        <ul class="aviso__lista">
            <?php foreach ($erros as $erro): ?>
                <li><?= e($erro) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="comanda__corte" aria-hidden="true"></div>

    <div class="comanda__rodape">
        <span class="nota">o que você digitou continua no formulário</span>
        <!-- history.back() volta uma página, e o navegador mantém o que foi digitado -->
        <a class="botao" href="<?= e($voltar) ?>" onclick="history.back(); return false;">voltar e corrigir</a>
    </div>
</section>
