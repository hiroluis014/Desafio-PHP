<?php
function consultarAssento($linha, $coluna) {
$matriz = [
[1, 0, 1, 0, 1],
[0, 1, 1, 0, 1],
[1, 1, 0, 0, 0],
[0, 0, 1, 0, 1],
[0, 1, 0, 1, 0],
];

if (!isset($matriz[$linha][$coluna])) {
    return "POSIÇÃO INVÁLIDA";
}
elseif ($matriz[$linha][$coluna] == 0) {
return "LIVRE"; 
}
else  {
return "OCUPADO"; 
}

}

function exibirSituacao($linha, $coluna) {
$situacao =  consultarAssento($linha, $coluna);
echo "Assento " ,$linha, $coluna, $situacao; 
}
exibirSituacao (2,3);

?>