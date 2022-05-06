<?php

function inserirUsuarios($dadosUsuarios){

    // Validação para verificar se o objeto esta vazio 
    if(!empty($dadosUsuarios)){

        // Validação de caixa vazia dos elementos nome,
        if(!empty($dadosUsuarios['txtNome']) && !empty($dadosUsuarios['txtEmail']) && !empty($dadosUsuarios['txtSenha']))
            {

                // Criação do array de dados que será encaminhado a model
                // para inserir no banco de dados, é importante
                // criar este array conforme as necessidades de manipulação do BD
                // OBS: Criar as chaves do array conforme os nomes dos atributos do BD
                $arrayDados = array(
                    "nome"              => $dadosUsuarios['txtNome'],
                    "sobrenome"         => $dadosUsuarios['txtSobrenome'],
                    "email"             => $dadosUsuarios['txtEmail'],
                    "senha"             => $dadosUsuarios['txtSenha']
                );

                // Require do arquivo da model que faz a conexão direta com o BD
                require_once('./model/bd/usuarios.php');

                // Chama a função que fará o insert do BD (esta função está na model)
                if(insertUsuario($arrayDados))
                    return true;
                else
                    return array('idErro' => 1, 
                                 'message' => 'Não foi possível inserir os bancos de Dados');
            }
        else
            return array('idErro' =>2,
                         'message' => 'Existem campos obrigatórios que não foram preenchidos.');
    }
}

function listarUsuarios(){

    require_once('model/bd/usuarios.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllUsuarios();
    
    // Se não ter conteúdo ele irá retornar false
    if(!empty($dados))
        return $dados;
    else
        return false;
}

// Função para buscar um contato através do id do registro
function buscarUsuario($id){

    if($id != 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo de contato
        require_once('model/bd/usuarios.php');

        // Chama a função na model que vai buscar no BD
        $dados = selectByIdUsuario($id);

        // Valida se existem dados para serem desenvolvidos
        if(!empty($dados))
            return $dados;
        else
            return false;
    }else
        return array('idErro'   => 4,
                     'message'   => 'Não é possível buscar um registro sem informar um id válido');
}

function excluirUsuario($id){
    // Validação para verificar se o id tem um número válido
    if($id != 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo de contato
        require_once('model/bd/usuarios.php');

        // Chama a função da model e valida se o retorno foi verdadeiro ou falso
        if(deleteUsuario($id))
            return true;
        else
            return array('idErro'   => 3,
                         'message'  => 'O banco de Dados não pode excluir o registro.');
    }else {
        return array('idErro'   => 4,
                    'message'   => 'Não é possível excluir um registro sem informar um id válido');
    }
}

function atualizarUsuario($dadosUsuarios, $id){

    // Validação para verificar se o objeto esta vazio 
    if(!empty($dadosUsuarios)){

        // Validação de caixa vazia dos elementos nome,
        // celular e email, pois são campos obrigatórios no BD 
        if(!empty($dadosUsuarios['txtNome']) && !empty($dadosUsuarios['txtEmail']) && !empty($dadosUsuarios['txtSenha']))
            {
                // Validação para garantir que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id))
                {
                    // Criação do array de dados que será encaminhado a model
                    // para inserir no banco de dados, é importante
                    // criar este array conforme as necessidades de manipulação do BD
                    // OBS: Criar as chaves do array conforme os nomes dos atributos do BD
                    $arrayDados = array(
                        "id"            => $id,
                        "nome"          => $dadosUsuarios['txtNome'],
                        "sobrenome"     => $dadosUsuarios['txtSobrenome'],
                        "email"         => $dadosUsuarios['txtEmail'],
                        "senha"         => $dadosUsuarios['txtSenha']
                    );

                    // Require do arquivo da model que faz a conexão direta com o BD
                    require_once('./model/bd/usuarios.php');
                    // Chama a função que fará o update do BD (esta função está na model)
                    if (uptadeUsuario($arrayDados))
                        return true;
                    else
                        return array('idErro' => 1,
                                    'message' => 'Não foi possível atualizar os dados no Banco de Dados');
                } else
                    return array('idErro'   => 4,
                             'message'   => 'Não é possível editar um registro sem informar um id válido');
            } else
                return array('idErro' =>2,
                         'message' => 'Existem campos obrigatórios que não foram preenchidos.');
    }
}

?>