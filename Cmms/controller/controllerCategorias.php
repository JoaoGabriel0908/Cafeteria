<?php

// Import do arquivo de configurção do projeto
require_once('./modulo/config.php');

function inserirCategorias($dadosCategorias, $file)
{

    $nomeFoto = (string) null;

    // Validação para verificar se o objeto esta vazio 
    if (!empty($dadosCategorias)) {

        // Validação de caixa vazia dos elementos nome,
        if (!empty($dadosCategorias['txtNome'])) {
            // Validação para identificar se chegou um arquivo para upload
            if ($file['fleFoto']['name'] != null) {
                // Import da função de upload
                require_once('modulo/upload.php');
                $nomeFoto = uploadFile($file['fleFoto']);

                // Chama a função de upload
                if (is_array($nomeFoto)) {
                    // Caso aconteça algum erro no processo de upload, a função irá retornar
                    // um array com a possivel mensagem de erro. Esse array será retornado para
                    // a router e ela irá exibir a mensagem na para o usuário
                    return $nomeFoto;
                }
            }
            // Criação do array de dados que será encaminhado a model
            // para inserir no banco de dados, é importante
            // criar este array conforme as necessidades de manipulação do BD
            // OBS: Criar as chaves do array conforme os nomes dos atributos do BD
            $arrayDados = array(
                "nome"          => $dadosCategorias['txtNome'],
                "foto"          => $nomeFoto
            );

            // Require do arquivo da model que faz a conexão direta com o BD
            require_once('./model/bd/categoriasCafe.php');
            // Chama a função que fará o insert do BD (esta função está na model)
            if (insertCategoria($arrayDados)){
                    return true;
                }else
                return array(
                    'idErro' => 1,
                    'message' => 'Não foi possível inserir os bancos de Dados'
                );
        } else
            return array(
                'idErro' => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos.'
            );
    }
}

function listarCategorias()
{

    require_once('model/bd/categoriasCafe.php');

    // Chama a função que vai buscar os dados no BD
    $dados = selectAllCategorias();

    // Se não ter conteúdo ele irá retornar false
    if (!empty($dados))
        return $dados;
    else
        return false;
}
// Função para buscar um contato através do id do registro
function buscarCategoria($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {
        // Import do arquivo de contato
        require_once('model/bd/categoriasCafe.php');

        // Chama a função na model que vai buscar no BD
        $dados = selectByIdCategoria($id);

        // Valida se existem dados para serem desenvolvidos
        if (!empty($dados))
            return $dados;
        else
            return false;
    } else
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível buscar um registro sem informar um id válido'
        );
}

function atualizarCategoria($dadosCategorias, $arrayDados)
{

    $statusUpload = (bool) false;

    // Recebe o id anviado peloas ArraDados
    $id = $arrayDados['id'];

    // Recebe a foto enviada pelo arratDados (nome da foto que ja exsitia no BD)
    $foto = $arrayDados['foto'];

    // Recebe o objeto de array referente a nova foto que poderá ser enviada ao servidor
    $file = $arrayDados['file'];

    // Validação para verificar se o objeto esta vazio 
    if (!empty($dadosCategorias)) {

        // Validação de caixa vazia dos elementos nome,
        // celular e email, pois são campos obrigatórios no BD 
        if (!empty($dadosCategorias['txtNome'])) {

            // Validação para garantir que o id seja válido
            if (!empty($id) && $id != 0 && is_numeric($id)) {

                // Validação para identificar se será enviado ao servidor uma nova foto
                if ($file['fleFoto']['name'] != null) {

                    // Import da função de upload para emviar a nova foto ao servidor
                    require_once('modulo/upload.php');

                    // Chama a função de upload
                    $novaFoto = uploadFile($file['fleFoto']);
                    // Faz a alteração quando inserida uma nova foto
                    $statusUpload = true;
                } else {
                    // Permanece a mesma foto no BD
                    $novaFoto = $foto;
                }
                // Criação do array de dados que será encaminhado a model
                // para inserir no banco de dados, é importante
                // criar este array conforme as necessidades de manipulação do BD
                // OBS: Criar as chaves do array conforme os nomes dos atributos do BD
                $arrayDados = array(
                    "id"            => $id,
                    "nome"          => $dadosCategorias['txtNome'],
                    "foto"          => $novaFoto
                );

                // Require do arquivo da model que faz a conexão direta com o BD
                require_once('./model/bd/categoriasCafe.php');
                
                // Chama a função que fará o update do BD (esta função está na model)
                if (uptadeCategoria($arrayDados)) {

                    // Validação para verificar se será necessário apagar a foto antiga
                    // Essa variavel foi ativada na linha 102, quando realizamos o upload 
                    // de uma nova foto para o servidor.
                    if ($statusUpload) {
                        // Apaga a foto antiga da pasta do servidor
                        unlink(DIRETORIO_FILE_UPLOAD.$foto);
                    }
                    return true;
                } else
                    return array(
                        'idErro' => 1,
                        'message' => 'Não foi possível atualizar os dados no Banco de Dados'
                    );
            } else
                return array(
                    'idErro'   => 4,
                    'message'   => 'Não é possível editar um registro sem informar um id válido'
                );
        } else
            return array(
                'idErro' => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos.'
            );
    }
}

function excluirCategoria($arrayDados)
{

    // Recebe o id do registro que será excluído
    $id = $arrayDados['id'];

    // Recebe o nome da foto que será excluída da pasta do servidor
    $foto = $arrayDados['foto'];

    // Validação para verificar se o id tem um número válido
    if ($id != 0 && !empty($id) && is_numeric($id)) {

        // Import do arquivo de contato
        require_once('model/bd/categoriasCafe.php');
        require_once('modulo/config.php');

        // Chama a função da model e valida se o retorno foi verdadeiro ou falso
        if (deleteCategoria($id)) {

            // Validação para caso a foto não exista com o registro
            if ($foto != null) {

                if (unlink(DIRETORIO_FILE_UPLOAD . $foto)) {
                    return true;
                } else
                    return array(
                        'idErro'   => 5,
                        'message'      => 'O registro do Banco de Dados foi excluído com sucesso,
                                            porém a imagem não foi excluída do diretório do servidor!'
                    );
            } else
                return true;
        } else
            return array(
                'idErro'   => 3,
                'message'  => 'O banco de Dados não pode excluir o registro.'
            );
    } else {
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível excluir um registro sem informar um id válido'
        );
    }
}
