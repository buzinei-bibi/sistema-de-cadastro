<?php
// recebe o formulário de clientes/cadastro.php, valida e mostra o resultado

require_once __DIR__ . '/../includes/funcoes.php';

// se alguém abrir esta página direto (sem enviar o formulário), volta para o cadastro.
// header() precisa vir antes de qualquer html
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./cadastro.php');
    exit;
}

$opcoes = require __DIR__ . '/../dados/opcoes.php';

// campo() faz trim($_POST['x'] ?? ''): tira os espaços e, se o campo não veio, vira string vazia
$nome            = mb_strtoupper(campo('nome'));
$data_nascimento = campo('data_nascimento');
$cpf             = so_numeros(campo('cpf'));      // "123.456.789-00" vira "12345678900"
$email           = campo('email');
$whatsapp        = so_numeros(campo('whatsapp'));
$cep             = so_numeros(campo('cep'));
$logradouro      = campo('logradouro');
$numero          = campo('numero');
$complemento     = campo('complemento');
$bairro          = campo('bairro');
$cidade          = campo('cidade');
$estado          = campo('estado');

// em vez de parar no primeiro erro (exit), guardo todos num vetor e mostro de uma vez
$erros = [];

// validar os dados

if ($nome === '') {
    $erros[] = "o campo 'nome' é obrigatório";
} else {
    // explode separa o texto em partes usando o espaço.
    // vetor = uma variável com várias partições
    $partes = explode(' ', $nome);
    if (count($partes) < 2) {
        $erros[] = "informe 'nome' e 'sobrenome'";
    }
}

if ($data_nascimento === '') {
    $erros[] = "o campo 'data de nascimento' é obrigatório";
} else {
    // strtotime converte a data em segundos, aí dá para comparar com hoje
    $nascimento = strtotime($data_nascimento);
    $hoje = strtotime(date('Y-m-d'));
    if ($nascimento > $hoje) {
        $erros[] = 'a data de nascimento não pode ser depois de hoje';
    }
}

if ($cpf === '') {
    $erros[] = "o campo 'cpf' é obrigatório";
} elseif (strlen($cpf) !== 11) {
    $erros[] = 'o cpf precisa ter 11 dígitos';
}

if ($email === '') {
    $erros[] = "o campo 'e-mail' é obrigatório";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'esse e-mail não parece válido';
}

// whatsapp é opcional: só confere se foi preenchido
if ($whatsapp !== '' && strlen($whatsapp) !== 10 && strlen($whatsapp) !== 11) {
    $erros[] = 'o whatsapp precisa ter 10 ou 11 dígitos, contando o ddd';
}

if ($cep === '') {
    $erros[] = "o campo 'cep' é obrigatório";
} elseif (strlen($cep) !== 8) {
    $erros[] = 'o cep precisa ter 8 dígitos';
}

if ($logradouro === '') {
    $erros[] = "o campo 'rua / avenida' é obrigatório";
}

if ($numero === '') {
    $erros[] = "o campo 'número' é obrigatório";
}

if ($bairro === '') {
    $erros[] = "o campo 'bairro' é obrigatório";
}

if ($cidade === '') {
    $erros[] = "o campo 'cidade' é obrigatório";
}

if (!in_array($estado, $opcoes['estados'])) {
    $erros[] = 'escolha um estado da lista';
}

// tudo certo? monta o recibo.
// próximo passo: aqui é onde os dados seriam salvos no banco de dados

$titulo = count($erros) ? 'erro no cadastro' : 'cliente cadastrado';
$pagina = 'clientes';
$raiz   = '../';

require __DIR__ . '/../includes/cabecalho.php';

if (count($erros) > 0) {
    $voltar = 'cadastro.php';
    require __DIR__ . '/../includes/erros.php';
} else {
    // implode junta as partes do endereço numa frase só, pulando as vazias (array_filter)
    $endereco = implode(', ', array_filter([$logradouro, $numero, $complemento, $bairro]));

    $recibo = [
        'titulo' => 'cliente cadastrado',
        'linhas' => [
            'nome'       => $nome,
            'nascimento' => data_br($data_nascimento),
            'cpf'        => mascara($cpf, '###.###.###-##'),
            'e-mail'     => $email,
            'whatsapp'   => $whatsapp === '' ? '' : formata_telefone($whatsapp),
            'endereço'   => $endereco,
            'cidade'     => "$cidade - $estado",
            'cep'        => mascara($cep, '#####-###'),
        ],
        'novo'  => 'cadastro.php',
        'lista' => 'lista.php',
    ];
    require __DIR__ . '/../includes/recibo.php';
}

require __DIR__ . '/../includes/rodape.php';
