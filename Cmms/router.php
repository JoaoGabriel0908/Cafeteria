<?php

$action = (string) null;
$componente = (string) null;

// Validação para verificar se a requisicão é um POST 
if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){

    // Recebendo dados via URL para saber quem está solicitando 
    // e qual ação será realizada
    $componente = strtoupper($_GET['componente']);
    $action = strtoupper($_GET['action']);

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
                                 window.location.href = 'index.php'; 
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
                }
                
?>