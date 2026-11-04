<?php
// opções fixas dos formulários.
// ficam num lugar só: o formulário usa para montar os <select>
// e o salvar.php usa para conferir se o valor enviado é válido (in_array)

return [
    'categorias' => ['hambúrguer', 'bebida', 'sobremesa', 'acompanhamento'],

    'pagamentos' => [
        'dinheiro'       => 'dinheiro',
        'pix'            => 'pix',
        'cartao_credito' => 'cartão de crédito',
        'cartao_debito'  => 'cartão de débito',
        'boleto'         => 'boleto',
    ],

    'descontos' => [0, 5, 10, 15, 20],

    'status' => ['pendente', 'em andamento', 'concluído'],

    'estados' => [
        'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA',
        'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO',
    ],
];
