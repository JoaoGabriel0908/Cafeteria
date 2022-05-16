<?php

require_once('conexaoMySql.php');

// Função para realizar o insert no BD
function insertUsuario($dadosUsuario){

    $statusRepostas = (boolean) false;

    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Montando o script para enviar para o BD
    $sql = "insert into tblusuario
            (nome,
             sobrenome,
             email,
             senha)
        values
            ('".$dadosUsuario['nome']."',
            '".$dadosUsuario['sobrenome']."',
            '".$dadosUsuario['email']."',
            '".$dadosUsuario['senha']."');";

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

// Função para listar todos os contatos do BD
function selectAllUsuarios(){

    // Abre a conexão 
    $conexao = conexaoMySql();

    //Script para listar todos os dados do Banco de dados
    $sql = "select * from tblusuario order by idusuario desc";

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
                "id"            => $rsDados['idusuario'],
                "nome"          => $rsDados['nome'],
                "sobrenome"     => $rsDados['sobrenome'],
                "email"         => $rsDados['email'],
                "senha"         => $rsDados['senha']
            );

            $cont++;
        }

        // Solicita o fechamento da conexão com o Banco de Dados
        fecharConexaoMysql($conexao);

        return $arrayDados;
    }

}

// Função para buscar um contato no BD através do id do registro
function selectByIdUsuario($id)
{

    // Abre a conexão 
    $conexao = conexaoMySql();

    //Script para listar as informações dos contatos
    $sql = "select * from tblusuario where idusuario =".$id;
    
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

function deleteUsuario($id)
{
    // Declaração da Variavel para utilizar no return desta função
    $statusRepostas = (boolean) false;

    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Script para deletar um registro do BD
    $sql = "delete from tblusuario where idusuario=".$id;

    // Valida se o script está correto, sem erro de sintaxe e executa o BD
    if(mysqli_query($conexao, $sql))
    {
        // Valida se o BD teve sucesso na execução do exscript
        if(mysqli_affected_rows($conexao))
            $statusRepostas = true;
    }
    fecharConexaoMysql($conexao);
    return $statusRepostas;
}

function uptadeUsuario($dadosUsuario)
{

    $statusRepostas = (boolean) false;

    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Montando o script para enviar para o BD
    $sql = "update tblusuario set
                nome           = '".$dadosUsuario['nome']."',
                sobrenome      = '".$dadosUsuario['sobrenome']."',
                email          = '".$dadosUsuario['email']."',
                senha          = '".$dadosUsuario['senha']."'

            where idusuario =".$dadosUsuario['id'];
             
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
?>