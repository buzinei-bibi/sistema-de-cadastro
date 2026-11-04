<?php
// pedidos de exemplo (ainda sem banco de dados)

return [
    [
        'id'         => 1,
        'cliente'    => 'buzina de bibi',
        'produto'    => 'x-salada',
        'valor'      => 20.00,
        'quantidade' => 1,
        'pagamento'  => 'cartão de débito',
        'observacao' => 'sem cebola',
        'status'     => 'em andamento',
    ],
    [
        'id'         => 2,
        'cliente'    => 'buzinei',
        'produto'    => 'x-bacon',
        'valor'      => 15.00,
        'quantidade' => 2,
        'pagamento'  => 'pix',
        'observacao' => 'sem maionese',
        'status'     => 'pendente',
    ],
    [
        'id'         => 3,
        'cliente'    => 'buzinando',
        'produto'    => 'x-tudo',
        'valor'      => 30.00,
        'quantidade' => 1,
        'pagamento'  => 'dinheiro',
        'observacao' => 'sem ketchup',
        'status'     => 'concluído',
    ],
];
