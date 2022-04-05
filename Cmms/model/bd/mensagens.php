<?php

require_once('conexaoMySql.php');

function deleteMensagem($id){

    // Declaração da Variavel para utilizar no return desta função
    $statusRepostas = (boolean) false;

    // Abre a conexão com o BD
    $conexao = conexaoMySql();

    // Script para deletar um registro do BD
    $sql = "delete from tblmensagens where idmensagens=".$id;

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

function selectAllMensagens()
{

    // Abre a conexão 
    $conexao = conexaoMySql();

    //Script para listar todos os dados do Banco de dados
    $sql = "select * from tblmensagens order by idmensagens desc";

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
            "nome"          => $rsDados['nome'],
            "email"         => $rsDados['email'],
            "mensagem"      => $rsDados['mensagem']
        );
        $cont++;
    }

    // Solicita o fechamento da conexão com o Banco de Dados
    fecharConexaoMysql($conexao);

    return $arrayDados;
}

}
?>