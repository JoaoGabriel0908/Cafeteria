<?php

function listarUsuarios (){

require_once('model/bd/usuarios.php');

// Chama a função que vai buscar os dados no BD
$dados = selectAllUsuarios();

// Se não ter conteúdo ele irá retornar false
if(!empty($dados))
    return $dados;
else
    return false;
}

?>