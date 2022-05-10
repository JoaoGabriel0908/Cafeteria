<?php

function inserirProdutos($dadosProduto, $file){

    $nomeFoto = (string) null;
    $destaque = (int) 0;

    // Validação para verificar se o objeto esta vazio 
    if(!empty($dadosProduto)){

        // Validação de caixa vazia dos elementos nome,
        if(!empty($dadosProduto['txtnome']) && !empty($dadosProduto['txtpreco']))
            {
                // Validação para identificar se chegou um arquivo para upload
                if($file['fleFoto']['name'] != null)
                {
                    // Import da função de upload
                    require_once('modulo/upload.php');
                    // Chama a função de upload
                    $nomeFoto = uploadFile($file['fleFoto']);

                    // Chama a função de upload
                    if(is_array($nomeFoto))
                    {
                        // Caso aconteça algum erro no processo de upload, a função irá retornar
                        // um array com a possivel mensagem de erro. Esse array será retornado para
                        // a router e ela irá exibir a mensagem na para o usuário
                        return $nomeFoto;    
                    }
                 } 
                    if($dadosProduto['chbdestaque']){
                            
                        if($dadosProduto['chbdestaque'] == 'on'){
                            $destaque = 1;
                        }
                    }else {
                        return array('idErro' => 1, 
                                 'message' => 'ERRO');   
                    }
                    // Criação do array de dados que será encaminhado a model
                    // para inserir no banco de dados, é importante
                    // criar este array conforme as necessidades de manipulação do BD
                    // OBS: Criar as chaves do array conforme os nomes dos atributos do BD
                    $arrayDados = array(
                    "nome"                  => $dadosProduto['txtnome'],
                    "preco"                 => $dadosProduto['txtpreco'],
                    "descricao"             => $dadosProduto['txtdescricao'],
                    "foto"                  => $nomeFoto,
                    "destaque"              => $destaque,
                    "desconto"              => $dadosProduto['numdesconto']
                );
                
                // Require do arquivo da model que faz a conexão direta com o BD
                require_once('./model/bd/todosProdutos.php');
                
                // Chama a função que fará o insert do BD (esta função está na model)
                if(insertProduto($arrayDados)){
                    return true;
                }
                else 
                    return array('idErro' => 1, 
                                 'message' => 'Não foi possível inserir os dados no banco');             
                
            }else 
            return array('idErro' =>2,
                         'message' => 'Existem campos obrigatórios que não foram preenchidos.');
    
    }
}

// Função para excluir no BD
function excluirProdutos($id){
// Validação para verificar se o id tem um número válido
if($id != 0 && !empty($id) && is_numeric($id))
{
    // Import do arquivo de contato
    require_once('model/bd/todosProdutos.php');

    // Chama a função da model e valida se o retorno foi verdadeiro ou falso
    if(deleteProduto($id))
        return true;
    else
        return array('idErro'   => 3,
                     'message'  => 'O banco de Dados não pode excluir o registro.');
}else {
    return array('idErro'   => 4,
                'message'   => 'Não é possível excluir um registro sem informar um id válido');
}
}
// Função para buscar um contato através do id do registro
function buscarProduto($id){

    if($id != 0 && !empty($id) && is_numeric($id))
    {
        // Import do arquivo de contato
        require_once('model/bd/produtos.php');

        // Chama a função na model que vai buscar no BD
        $dados = selectByIdProduto($id);

        // Valida se existem dados para serem desenvolvidos
        if(!empty($dados))
            return $dados;
        else
            return false;
    }else
        return array('idErro'   => 4,
                     'message'   => 'Não é possível buscar um registro sem informar um id válido');
}


function listarProdutos (){

require_once('model/bd/todosProdutos.php');

// Chama a função que vai buscar os dados no BD
$dados = selectAllProdutos();

// Se não ter conteúdo ele irá retornar false
if(!empty($dados))
    return $dados;
else
    return false;
}
