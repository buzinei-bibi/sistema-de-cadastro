<p align="center">
  <img src="assets/img/logo.svg" alt="logo do sistema de cadastro" width="120">
</p>

# sistema de cadastro

sistema de gestão para uma lanchonete: reúne o cadastro de **clientes**, o cardápio de **produtos** e os **pedidos** num lugar só. cada formulário é conferido no servidor antes de ser aceito, os pedidos já saem com subtotal, desconto e total calculados, e as listas mostram estoque, valores e o status de cada pedido.

fiz o sistema para praticar php, então ele usa só os fundamentos da linguagem: formulários, validação no servidor e listas montadas com `foreach`.

> ainda não tem banco de dados. os formulários validam e mostram os dados recebidos, e as listas usam dados de exemplo que ficam na pasta `dados/`.

## como rodar

precisa ter o php instalado (versão 8 ou mais nova). dentro da pasta do projeto:

```bash
php -S localhost:8000
```

depois é só abrir [localhost:8000](http://localhost:8000) no navegador.

## o que tem em cada página

| página | o que faz |
| --- | --- |
| `index.php` | página inicial: apresenta o sistema e leva para cada cadastro |
| `como-funciona.php` | explica o caminho de um cadastro e tem um teste ao vivo do php respondendo |
| `clientes/cadastro.php` | formulário de cliente: dados pessoais, contato e endereço |
| `clientes/salvar.php` | valida o cliente (nome com sobrenome, cpf com 11 dígitos, e-mail válido...) |
| `clientes/lista.php` | tabela com os clientes |
| `produtos/cadastro.php` | formulário de produto: nome, categoria, preço e estoque |
| `produtos/salvar.php` | valida o produto (preço mínimo de R$ 1,00, categoria da lista...) |
| `produtos/lista.php` | tabela com os produtos |
| `pedidos/cadastro.php` | formulário de pedido, com sugestões e o total calculado na hora |
| `pedidos/salvar.php` | valida o pedido e calcula subtotal, desconto e total |
| `pedidos/lista.php` | tabela com os pedidos e o status de cada um |

## estrutura das pastas

```
sistema-de-cadastro/
├── index.php            página inicial
├── como-funciona.php    o caminho de um cadastro + teste ao vivo
├── clientes/            cadastro.php · salvar.php · lista.php
├── produtos/            cadastro.php · salvar.php · lista.php
├── pedidos/             cadastro.php · salvar.php · lista.php
├── dados/               dados de exemplo e opções dos formulários
│   ├── clientes.php
│   ├── produtos.php
│   ├── pedidos.php
│   └── opcoes.php       categorias, formas de pagamento, status, estados
├── includes/            pedaços que todas as páginas usam
│   ├── cabecalho.php    <head>, logo e menu
│   ├── logo.php         o logo em svg (acompanha o tema claro/escuro)
│   ├── rodape.php
│   ├── funcoes.php      e(), moeda(), mascara()...
│   ├── erros.php        tela de "faltou arrumar"
│   └── recibo.php       tela com os dados recebidos
└── assets/
    ├── css/estilo.css
    └── img/logo.svg     logo e ícone da aba
```

cada assunto tem as mesmas três páginas: **cadastro** (o formulário), **salvar** (recebe e valida) e **lista** (mostra os registros).

## o que aprendi

- como funcionam formulários e o envio de dados com `POST`
- como ler os dados com `$_POST` e limpar com `trim()`
- como validar no servidor: campos obrigatórios, tamanho mínimo, e-mail, datas, valores de uma lista (`in_array`)
- como juntar os erros num vetor e mostrar todos de uma vez
- como montar tabelas com `foreach` a partir de um array
- como reaproveitar código com `require` (cabeçalho, rodapé, funções)
- por que usar `htmlspecialchars()` antes de mostrar o que o usuário digitou

## próximos passos

- [ ] conectar a um banco de dados (mysql com pdo) para os cadastros ficarem salvos
- [ ] editar e excluir registros, completando o crud
- [ ] buscar o endereço pelo cep
- [ ] validar o cpf de verdade (dígitos verificadores)
