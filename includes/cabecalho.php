<?php
// cabeçalho que todas as páginas usam.
// antes de incluir este arquivo, cada página define:
//   $titulo -> texto da aba do navegador
//   $pagina -> qual item do menu fica marcado
//   $raiz   -> caminho até a pasta principal ('' na raiz, '../' dentro de uma pasta)

require_once __DIR__ . '/funcoes.php';

$titulo = $titulo ?? 'início';
$pagina = $pagina ?? '';
$raiz   = $raiz ?? '';

$menu = [
    'inicio'     => ['início', 'index.php'],
    'clientes'   => ['clientes', 'clientes/lista.php'],
    'produtos'   => ['produtos', 'produtos/lista.php'],
    'pedidos'    => ['pedidos', 'pedidos/lista.php'],
    'como'       => ['como funciona', 'como-funciona.php'],
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titulo) ?> · sistema de cadastro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=DM+Mono:wght@400;500&family=Instrument+Sans:wght@400..700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="<?= $raiz ?>assets/img/logo.svg">
    <link rel="stylesheet" href="<?= $raiz ?>assets/css/estilo.css">
</head>

<body>
    <header class="topo">
        <div class="topo__dentro">
            <a class="marca" href="<?= $raiz ?>index.php">
                <?php require __DIR__ . '/logo.php'; ?>
                <span class="marca__texto">
                    <span class="marca__nome">sistema de cadastro</span>
                    <span class="marca__apoio">gestão de lanchonete</span>
                </span>
            </a>

            <nav class="menu" aria-label="menu principal">
                <?php foreach ($menu as $chave => [$rotulo, $link]): ?>
                    <a class="menu__link" href="<?= $raiz . $link ?>" <?= $chave === $pagina ? 'aria-current="page"' : '' ?>><?= $rotulo ?></a>
                <?php endforeach; ?>
            </nav>
        </div>
    </header>

    <main class="pagina">
