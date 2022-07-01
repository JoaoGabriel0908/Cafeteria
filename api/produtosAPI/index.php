<?php

/******
 * $Request      - Recebe dados do corpo da requisição (JSON, FORM/DATA, XML, etc..) 
 * $Response     - Envia dados de retorno da API 
 * $Args         - Permite receber dados de atributos na API

 * Os métodos de requisição para uma API são
 * GET           - para buscar dados
 * POST          - para inseri um novo dado
 * DELETE        - para apagar dados
 * PUT/PATCH     - para editar um dado já existente
 *******/

// Import do arquivo autoload, que fara as instancias do Slin
require_once('vendor/autoload.php');

require_once('../Cmms/modulo/upload.php');

// Criando um objeto do slim chamado app, para configuar os Endpoints
$app = new \Slim\App();

// EndPoint: Requisição para listar todos os produtos
$app->get('/produto', function ($request, $response, $args) {

    require_once('../Cmms/modulo/config.php');
    // Import da controller de produtos, que fará a busca de dados
    require_once('../Cmms/controller/controllerProdutos.php');

    // Solicita od dados par controle
    if ($dados = listarProdutos()) {
        // Caso exista dados a serem retornados,informamos o Status 200 e
        // enviamos um JSON com todos os dados encontrados
        if ($dadosJSON = createJSON($dados)) {
            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write($dadosJSON);
        }
    } else {
        // Retorna um statusCode qu significa que a requisiçao foi aceita, porém sem conteúdo
        return $response->withStatus(204);
    }
    
});

// Executa todos os Endpoints
$app->run();