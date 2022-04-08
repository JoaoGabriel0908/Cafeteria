<?php
// Import do arquivo que vai buscar os dados no BD
require_once('model/bd/mensagens.php');

function excluirMensagem ($id){

    // Validação para verificar se o id tem um número válido
    if($id != 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo de contato
        require_once('model/bd/contato.php');

        // Chama a função da model e valida se o retorno foi verdadeiro ou falso
        if(deleteMensagem($id))
            return true;
        else
            return array('idErro'   => 3,
                         'message'  => 'O banco de Dados não pode excluir o registro.');
    }else {
        return array('idErro'   => 4,
                    'message'   => 'Não é possível excluir um registro sem informar um id válido');
    }
}
function listarMensagens (){

// Chama a função que vai buscar os dados no BD
$dados = selectAllMensagens();

// Se não ter conteúdo ele irá retornar false
if(!empty($dados))
    return $dados;
else
    return false;
}
?>