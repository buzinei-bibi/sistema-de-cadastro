<?php
// funções pequenas usadas em várias páginas do sistema

// e() = "escapar": transforma < > " ' & em texto seguro antes de mostrar na tela.
// use sempre que o valor veio do usuário, para ninguém conseguir injetar html ou javascript na página
function e($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

// pega um campo do formulário já sem espaços nas pontas.
// trim() remove os espaços antes e depois; se o campo não veio, ?? '' devolve uma string vazia
function campo($nome)
{
    return trim($_POST[$nome] ?? '');
}

// deixa só os números: "(11) 91234-5678" vira "11912345678"
function so_numeros($texto)
{
    return preg_replace('/\D/', '', (string) $texto);
}

// encaixa os números num formato: mascara('12345678900', '###.###.###-##') = "123.456.789-00"
function mascara($numeros, $formato)
{
    $resultado = '';
    $posicao = 0;

    for ($i = 0; $i < strlen($formato); $i++) {
        if ($formato[$i] === '#') {
            $resultado .= $numeros[$posicao] ?? '';
            $posicao++;
        } else {
            $resultado .= $formato[$i];
        }
    }

    return $resultado;
}

// whatsapp com 11 números (celular) ou 10 (fixo)
function formata_telefone($numeros)
{
    return strlen($numeros) === 11
        ? mascara($numeros, '(##) #####-####')
        : mascara($numeros, '(##) ####-####');
}

// número como dinheiro: 1234.5 vira "R$ 1.234,50"
function moeda($valor)
{
    return 'R$ ' . number_format((float) $valor, 2, ',', '.');
}

// data no formato do banco (2006-02-22) para o brasileiro (22/02/2006)
function data_br($data)
{
    return $data === '' ? '' : date('d/m/Y', strtotime($data));
}

// classe css do carimbo de cada status de pedido
function classe_status($status)
{
    $classes = [
        'pendente'     => 'carimbo--pendente',
        'em andamento' => 'carimbo--andamento',
        'concluído'    => 'carimbo--concluido',
    ];

    return $classes[$status] ?? '';
}
