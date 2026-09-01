<?php
$pessoas = [];


function validarCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11) {
        return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $soma = 0;

        for ($i = 0; $i < $t; $i++) {
            $soma += $cpf[$i] * (($t + 1) - $i);
        }

        $digito = ((10 * $soma) % 11) % 10;

        if ($cpf[$t] != $digito) {
            return false;
        }
    }

    return true;
}


function validarEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}



function formatarCPF($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    return substr($cpf, 0, 3) . '.' .
           substr($cpf, 3, 3) . '.' .
           substr($cpf, 6, 3) . '-' .
           substr($cpf, 9, 2);
}


function cadastrarPessoa(&$pessoas, $dados)
{
    if (empty($dados['nome'])) {
        return "O nome é obrigatório.";
    }

    if (!validarCPF($dados['cpf'])) {
        return "CPF inválido.";
    }

    if (!validarEmail($dados['email'])) {
        return "E-mail inválido.";
    }

    foreach ($pessoas as $pessoa) {
        if ($pessoa['cpf'] == $dados['cpf']) {
            return "Este CPF já está cadastrado.";
        }
    }

    $novaPessoa = [
        'id' => count($pessoas) + 1,
        'nome' => $dados['nome'],
        'cpf' => $dados['cpf'],
        'email' => $dados['email'],
        'telefone' => $dados['telefone'],
        'cidade' => $dados['cidade'],
        'estado' => $dados['estado'],
        'categoria' => $dados['categoria'],
        'status' => 'Ativo',
        'data_cadastro' => date('d/m/Y H:i:s')
    ];

    $pessoas[] = $novaPessoa;

    return "Pessoa cadastrada com sucesso!";
}


function listarPessoas($pessoas)
{
    if (empty($pessoas)) {
        echo "Nenhuma pessoa cadastrada.\n";
        return;
    }

    foreach ($pessoas as $pessoa) {
        echo "=====================================\n";
        echo "ID: " . $pessoa['id'] . "\n";
        echo "Nome: " . $pessoa['nome'] . "\n";
        echo "CPF: " . formatarCPF($pessoa['cpf']) . "\n";
        echo "E-mail: " . $pessoa['email'] . "\n";
        echo "Telefone: " . $pessoa['telefone'] . "\n";
        echo "Cidade: " . $pessoa['cidade'] . "\n";
        echo "Estado: " . $pessoa['estado'] . "\n";
        echo "Categoria: " . $pessoa['categoria'] . "\n";
        echo "Status: " . $pessoa['status'] . "\n";
        echo "Data do cadastro: " . $pessoa['data_cadastro'] . "\n";
    }
}


function buscarPessoa($pessoas, $nome)
{
    $encontradas = [];

    foreach ($pessoas as $pessoa) {
        if (stripos($pessoa['nome'], $nome) !== false) {
            $encontradas[] = $pessoa;
        }
    }

    return $encontradas;
}


function atualizarStatus(&$pessoas, $id, $novoStatus)
{
    foreach ($pessoas as &$pessoa) {
        if ($pessoa['id'] == $id) {
            $pessoa['status'] = $novoStatus;

            return "Status atualizado com sucesso!";
        }
    }

    return "Pessoa não encontrada.";
}


function excluirPessoa(&$pessoas, $id)
{
    foreach ($pessoas as $indice => $pessoa) {
        if ($pessoa['id'] == $id) {
            unset($pessoas[$indice]);

            $pessoas = array_values($pessoas);

            return "Pessoa excluída com sucesso!";
        }
    }

    return "Pessoa não encontrada.";
}


$pessoa1 = [
    'nome' => 'João da Silva',
    'cpf' => '52998224725',
    'email' => 'joao@email.com',
    'telefone' => '99999-9999',
    'cidade' => 'São Luís',
    'estado' => 'MA',
    'categoria' => 'Tecnologia'
];

$pessoa2 = [
    'nome' => 'Maria Santos',
    'cpf' => '11144477735',
    'email' => 'maria@email.com',
    'telefone' => '98888-8888',
    'cidade' => 'Imperatriz',
    'estado' => 'MA',
    'categoria' => 'Administração'
];

$pessoa3 = [
    'nome' => 'Carlos Oliveira',
    'cpf' => '12345678909',
    'email' => 'carlos@email.com',
    'telefone' => '97777-7777',
    'cidade' => 'Teresina',
    'estado' => 'PI',
    'categoria' => 'Programação'
];


echo cadastrarPessoa($pessoas, $pessoa1) . "\n";
echo cadastrarPessoa($pessoas, $pessoa2) . "\n";
echo cadastrarPessoa($pessoas, $pessoa3) . "\n";



echo "\n";
echo "========== LISTA DE PESSOAS ==========\n";

listarPessoas($pessoas);


echo "\n";
echo "========== RESULTADO DA BUSCA ==========\n";

$resultadoBusca = buscarPessoa($pessoas, "Maria");

foreach ($resultadoBusca as $pessoa) {
    echo "Pessoa encontrada: " . $pessoa['nome'] . "\n";
}

echo "\n";
echo atualizarStatus($pessoas, 1, "Inativo") . "\n";

echo "\n";
echo "========== LISTA ATUALIZADA ==========\n";

listarPessoas($pessoas);


echo "\n";
echo excluirPessoa($pessoas, 2) . "\n";


echo "\n";
echo "========== LISTA FINAL ==========\n";

listarPessoas($pessoas);

?>
