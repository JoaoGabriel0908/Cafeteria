<?php

require_once('conexaoMySql.php');

// Função para realizar o insert no BD
function insertProduto($dadosProduto)
{

    $statusRepostas = (boolean) false;

    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Montando o script para enviar para o BD
    $sql = "insert into tblproduto
            (nome,
             preco,
             descricao,
             foto,
             destaque,
             desconto)
        values
            ('".$dadosProduto['nome']."',
            '".$dadosProduto['preco']."',
            '".$dadosProduto['descricao']."',
            '".$dadosProduto['foto']."',
            '".$dadosProduto['destaque']."',
            '".$dadosProduto['desconto']."');";

        echo($sql);

    // Comando que executa o script no banco de dados
        // Validação para verificar se o script sql está correto 
    if (mysqli_query($conexao, $sql)){
        
        // Validação para verificar se uma linha foi acrescentada no BD
        if(mysqli_affected_rows($conexao))
            $statusRepostas =  true;

    fecharConexaoMysql($conexao);
    return $statusRepostas;
    }

}

function selectAllProdutos()
{

    // Abre a conexão 
    $conexao = conexaoMySql();

    //Script para listar todos os dados do Banco de dados
    $sql = "select * from tblproduto order by idproduto desc";

    // Executa o Script para listar todos os dados do Banco de dados
    $result = mysqli_query($conexao, $sql);

    if($result)
    {
        // Mysql_fetch_assoc() - Permite converter os dados do BD
            // em um array para manipulação
        // Nesta repetição estamos, convertendo os dados do BD em um array ($rsDados),
            // além de o próprio while conseguir gerenciar a Quantidade de 
            // vezes que deverá ser feita a repetição.
            $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result))
        {
            // Cria um array com os dados do BD baseado em índice e em chave
            $arrayDados[$cont] = array(
                "id"            => $rsDados['idproduto'],
                "nome"          => $rsDados['nome'],
                "preco"         => $rsDados['preco'],
                "descricao"     => $rsDados['descricao'],
                "foto"          => $rsDados['foto'],
                "destaque"      => $rsDados['destaque'],
                "desconto"      => $rsDados['desconto']
            );
            $cont++;
        }

        // Solicita o fechamento da conexão com o Banco de Dados
        fecharConexaoMysql($conexao);

        return $arrayDados;
    }
}

// Função para buscar um contato no BD através do id do registro
function selectByIdProduto($id)
{

    // Abre a conexão 
    $conexao = conexaoMySql();

    //Script para listar as informações dos contatos
    $sql = "select * from tblproduto where idproduto =".$id;
    
    // Executa o Script para listar todos os dados do Banco de dados
    $result = mysqli_query($conexao, $sql);

    if($result)
    {
        // Mysql_fetch_assoc() - Permite converter os dados do BD
            // em um array para manipulação
        // Nesta repetição estamos, convertendo os dados do BD em um array ($rsDados),
            // além de o próprio while conseguir gerenciar a Quantidade de 
            // vezes que deverá ser feita a repetição.
        if ($rsDados = mysqli_fetch_assoc($result))
        {
            // Cria um array com os dados do BD baseado em índice e em chave
            $arrayDados = array(
                "id"            => $rsDados['idusuario'],
                "nome"          => $rsDados['nome'],
                "sobrenome"     => $rsDados['sobrenome'],
                "email"         => $rsDados['email'],
                "senha"         => $rsDados['senha']
            );
        }
    }
        // Solicita o fechamento da conexão com o Banco de Dados
        fecharConexaoMysql($conexao);

        return $arrayDados;

}

?>