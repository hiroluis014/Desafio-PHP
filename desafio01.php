<?php
function localizarNumero($numero)
{
    $numeros = [10, 7, 15, 16, 21, 4, 11, 31, 25, 22, 29, 9, 26, 6, 14, 30, 8, 12, 24, 17, 5, 23, 3, 18, 13, 27, 2, 28, 1, 20, 19];
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



 















