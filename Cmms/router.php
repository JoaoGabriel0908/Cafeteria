<?php

$action = (string) null;
$componente = (string) null;

// Validação para verificar se a requisicão é um POST 
if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){

    // Recebendo dados via URL para saber quem está solicitando 
    // e qual ação será realizada
    $componente = strtoupper($_GET['componente']);
    $action = strtoupper($_GET['action']);

        switch($componente)
            {
                case 'CONTATOS';
                    // Import da controller contatos
                    require_once('./controller/controllerMensagens.php');

                    if($action == 'DELETAR')
                        {
                        // Recebe o id do registro que deverá ser excluído,
                        // que foi enviado pela URL do link da imagem do exluir
                        // que foi adicionado na Index.
                        $idContato = $_GET['id'];

                        // Chama a função de excluir na controller
                        $resposta = excluirMensagem($idContato);

                        if(is_bool($resposta))
                        {
                            if($resposta){
                                echo(" <script>
                                 alert('Registro exluído com sucesso!');
                                 window.location.href = 'contatos.php'; 
                            </script> ");
                            }
                        }elseif(is_array($resposta))
                        {
                            echo("<script>
                                alert('".$resposta['message']."');
                                window.history.back();
                            </script>");
                        };
                    }
                break;

                // Estrutura para mexer na Categorias
                case 'CATEGORIAS';

                    require_once('./controller/controllerCategorias.php');

                    // Validação para verificar o tipo de ação que será realizada
                    if($action == 'INSERIR')
                    {

                        if(isset($_FILES) && !empty($_FILES))
                        {
                            // Chama a função de inserir na controller
                            $resposta = inserirCategorias($_POST, $_FILES);
                        } else {
                            $resposta = inserirCategorias($_POST, null);
                        }

                        // Valida o tipo de dado que retornou
                        if(is_bool($resposta)) // Se for boleano:
                        {
                            // Verifica se o retorno foi verdadeiro
                            if($resposta)

                            echo(" <script>
                                    alert('Registro inserindo com sucesso!');
                                    window.location.href = 'categorias.php'; 
                                </script> ");
                            }

                            // Se o retorno for array significa que houve um erro no processo de inserção
                            elseif(is_array($resposta))
                            echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                    }
                    elseif($action == 'DELETAR')
                    {
                        // Recebe o id do registro que deverá ser excluído,
                            // que foi enviado pela URL do link da imagem do exluir
                            // que foi adicionado na Index.
                            $idCategoria = $_GET['id'];

                            // Chama a função de excluir na controller
                            $resposta = excluirCategoria($idCategoria);

                            if(is_bool($resposta))
                            {
                                if($resposta){
                                    echo(" <script>
                                    alert('Registro exluído com sucesso!');
                                    window.location.href = 'categorias.php'; 
                                </script> ");
                                }
                            }elseif(is_array($resposta))
                            {
                                echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                            }
                    }
                    elseif($action == 'BUSCAR')
                    {
                        // Recebe o id do registro que deverá ser excluído,
                            // que foi enviado pela URL do link da imagem do exluir
                            // que foi adicionado na Index.
                            $idCategoria = $_GET['id'];

                            // Chama a função de excluir na controller
                            $dados = buscarCategoria($idCategoria);
                            
                            // Ativa a utilização de variavel de sessão no servidor
                            session_start();

                            // Guarda em uma variavel de sessão os dados que o BD retornou 
                            // para a busca do ID
                                // Obs: Essa variável de sessão será utilizada na index.php,
                                // para colocar os dados na caixa de texto 
                            $_SESSION['dadosCategoria'] = $dados;
                            
                        /* Utilizando o header também poderemos chamar a index.php,
                        Porém haverá um ação de carregamento no navegador
                        (piscando a tela)*/
                        // header('location: index.php');

                        // Utilizando o require iremos apenas importar a tela da index.php,
                        // Assim não havendo um novo carregamento da página
                        require_once('categorias.php');
                    }
                    elseif($action == 'EDITAR')
                    {
                        // Recebe o id que foi encaminhado no action do form pela URL
                        $idCategoria = $_GET['id'];

                        // Chama a função de editar na controller 
                        $resposta = atualizarCategoria($_POST, $idCategoria);

                        // Valida o tipo de dado que retornou
                        if(is_bool($resposta)) // Se for boleano:
                        {
                            // Verifica se o retorno foi verdadeiro
                            if($resposta)

                            echo(" <script>
                                    alert('Registro atualizado com sucesso!');
                                    window.location.href = 'categorias.php'; 
                                </script> ");
                            }

                            // Se o retorno for array significa que houve um erro no processo de inserção
                            elseif(is_array($resposta))
                            echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                    }
                break;

                case 'USUARIOS';
                
                    require_once('./controller/controllerUsuarios.php');

                    // Validação para verificar o tipo de ação que será realizada
                    if($action == 'INSERIR')
                    {
                        $resposta = inserirUsuarios($_POST, null);

                        // Valida o tipo de dado que retornou
                        if(is_bool($resposta)) // Se for boleano:
                        {
                            // Verifica se o retorno foi verdadeiro
                            if($resposta)

                            echo(" <script>
                                    alert('Registro inserindo com sucesso!');
                                    window.location.href = 'usuarios.php'; 
                                </script> ");
                            }

                            // Se o retorno for array significa que houve um erro no processo de inserção
                            elseif(is_array($resposta))
                            echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                    }
                    elseif($action == 'DELETAR')
                    {
                        // Recebe o id do registro que deverá ser excluído,
                            // que foi enviado pela URL do link da imagem do exluir
                            // que foi adicionado na Index.
                            $idUsuario = $_GET['id'];

                            // Chama a função de excluir na controller
                            $resposta = excluirUsuario($idUsuario);

                            if(is_bool($resposta))
                            {
                                if($resposta){
                                    echo(" <script>
                                    alert('Registro exluído com sucesso!');
                                    window.location.href = 'usuarios.php'; 
                                </script> ");
                                }
                            }elseif(is_array($resposta))
                            {
                                echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                            }
                    }
                    elseif($action == 'BUSCAR')
                    {
                        // Recebe o id do registro que deverá ser excluído,
                            // que foi enviado pela URL do link da imagem do exluir
                            // que foi adicionado na Index.
                            $idUsuario = $_GET['id'];

                            // Chama a função de excluir na controller
                            $dados = buscarUsuario($idUsuario);
                            
                            // Ativa a utilização de variavel de sessão no servidor
                            session_start();

                            // Guarda em uma variavel de sessão os dados que o BD retornou 
                            // para a busca do ID
                                // Obs: Essa variável de sessão será utilizada na index.php,
                                // para colocar os dados na caixa de texto 
                            $_SESSION['dadosUsuario'] = $dados;
                            
                        /* Utilizando o header também poderemos chamar a index.php,
                        Porém haverá um ação de carregamento no navegador
                        (piscando a tela)*/
                        // header('location: index.php');

                        // Utilizando o require iremos apenas importar a tela da index.php,
                        // Assim não havendo um novo carregamento da página
                        require_once('usuarios.php');
                    }
                    elseif($action == 'EDITAR')
                    {
                        // Recebe o id que foi encaminhado no action do form pela URL
                        $idUsuario = $_GET['id'];

                        // Chama a função de editar na controller 
                        $resposta = atualizarUsuario($_POST, $idUsuario);

                        // Valida o tipo de dado que retornou
                        if(is_bool($resposta)) // Se for boleano:
                        {
                            // Verifica se o retorno foi verdadeiro
                            if($resposta)

                            echo(" <script>
                                    alert('Registro atualizado com sucesso!');
                                    window.location.href = 'usuarios.php'; 
                                </script> ");
                            }

                            // Se o retorno for array significa que houve um erro no processo de inserção
                            elseif(is_array($resposta))
                            echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                    }
                break;

                case 'PRODUTOS';

                    require_once('./controller/controllerProdutos.php');

                    // Validação para verificar o tipo de ação que será realizada
                    if($action == 'INSERIR')
                    {

                        if(isset($_FILES) && !empty($_FILES))
                        {
                            // Chama a função de inserir na controller
                            $resposta = inserirProdutos($_POST, $_FILES);
                        } else {
                            $resposta = inserirProdutos($_POST, null);
                        }

                        // Valida o tipo de dado que retornou
                        if(is_bool($resposta)) // Se for boleano:
                        {
                            // Verifica se o retorno foi verdadeiro
                            if($resposta)

                            echo(" <script>
                                    alert('Registro inserindo com sucesso!');
                                    window.location.href = 'produtos.php'; 
                                </script> ");
                            }

                            // Se o retorno for array significa que houve um erro no processo de inserção
                            elseif(is_array($resposta))
                            echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                    }
                    elseif($action == 'DELETAR')
                    {
                        // Recebe o id do registro que deverá ser excluído,
                            // que foi enviado pela URL do link da imagem do exluir
                            // que foi adicionado na Index.
                            $idproduto = $_GET['id'];

                            // Chama a função de excluir na controller
                            $resposta = excluirProdutos($idproduto);

                            if(is_bool($resposta))
                            {
                                if($resposta){
                                    echo(" <script>
                                    alert('Registro exluído com sucesso!');
                                    window.location.href = 'produtos.php'; 
                                </script> ");
                                }
                            }elseif(is_array($resposta))
                            {
                                echo("<script>
                                    alert('".$resposta['message']."');
                                    window.history.back();
                                </script>");
                            }
                    }
                    
                break;
        }
    }
                
?>