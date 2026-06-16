<?php
function localizarNumero($numero)
{
    $numeros = range(1, 31);
    shuffle($numeros);
    echo "Array gerado: ";
    print_r($numeros);
    echo "<br><br>";
    foreach ($numeros as $indice => $valor) {
        if ($valor == $numero) {
            return "O número $numero foi encontrado na posição (índice) $indice.";
        }
    }
    return "Número não encontrado no array.";
}

$numeroProcurado = 29;

echo localizarNumero($numeroProcurado);

?>


 















