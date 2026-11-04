<?php
// mostra os dados que chegaram, no formato de um recibo.
// espera: $recibo = [
//   'titulo' => 'cliente cadastrado',
//   'linhas' => ['rótulo' => 'valor', ...],
//   'total'  => ['rótulo', 'valor'],   (opcional)
//   'novo'   => link para cadastrar outro,
//   'lista'  => link da lista,
// ]
?>
<section class="recibo-caixa">
    <div class="recibo surge">
        <span class="recibo__carimbo" aria-hidden="true">recebido</span>

        <header class="recibo__cabeca">
            <p class="recibo__marca">sistema de cadastro</p>
            <h1 class="recibo__titulo"><?= e($recibo['titulo']) ?></h1>
            <p class="recibo__data"><?= date('d/m/Y · H:i') ?></p>
        </header>

        <dl class="recibo__linhas">
            <?php foreach ($recibo['linhas'] as $rotulo => $valor): ?>
                <div class="recibo__linha">
                    <dt><?= e($rotulo) ?></dt>
                    <dd><?= $valor === '' ? '—' : e($valor) ?></dd>
                </div>
            <?php endforeach; ?>
        </dl>

        <?php if (!empty($recibo['total'])): ?>
            <div class="recibo__total">
                <span><?= e($recibo['total'][0]) ?></span>
                <strong><?= e($recibo['total'][1]) ?></strong>
            </div>
        <?php endif; ?>

        <p class="recibo__aviso">* ainda sem banco de dados: os dados aparecem aqui, mas não ficam guardados</p>
    </div>
</section>

<div class="acoes acoes--centro surge" style="--i: 3">
    <a class="botao" href="<?= e($recibo['novo']) ?>">cadastrar outro</a>
    <a class="botao botao--fantasma" href="<?= e($recibo['lista']) ?>">ver a lista</a>
</div>
