<?php
// Import do arquivo de configuração do projeto
require_once('modulo/config.php');
// Essa variavel foi criada para diferenciar no action do formulário qual
// a ação deveria ser levada para a router (inserir ou editar).
// Nas condições abaixo mudamos o action da variacel para a ação de editar.
$form = (string) "router.php?componente=produtos&action=inserir";

// Variavel para carregar o nome da foto do banco de dados
$foto = (string) null;

// Valida se a utilização da variavel de sessão esta ativa no servidor
    if(session_status()){
        // Valida se a variavel de sessão dadosContato não esta vazia
        if(!empty($_SESSION['dadosProduto'])){
            $id             = $_SESSION['dadosProduto']['id'];
            $nome           = $_SESSION['dadosProduto']['nome'];
            $preco       = $_SESSION['dadosProduto']['preco'];
            $descricao        = $_SESSION['dadosProduto']['descricao'];
            $foto          = $_SESSION['dadosProduto']['foto'];
            $destaque        = $_SESSION['dadosProduto']['destaque'];
            $desconto           = $_SESSION['dadosProduto']['desconto'];
            // Mudamos a ação do form para editar o registro no click do botão
            // da ação salvar.
            $form = "router.php?componente=produtos&action=editar&id=".$id."&foto=".$foto;

            // Destroi uma variavel da memoria do servidor
            unset($_SESSION['dadosProduto']);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSSCMS/reset.css">
    <link rel="stylesheet" href="./CSSCMS/produtos.css">
    <link rel="stylesheet" href="./CSSCMS/autenticacao.css">
    <title>Dashboard</title>
</head>

<body>
    <header>
        <div class="container-inicio">
            <div class="container-texto">
                <h1>C M S</h1>
                <p class="nomeProjeto">Cafeteria</p>
                <p class="gerenciamento">Gerenciamento de Conteúdo do Site</p>
            </div>
            <div class="imagem">
                <a href="dashboard.php">
                    <img src="./IMGs/coffee-cup.png" alt="" width="100px" height="100px">
                </a>
            </div>
        </div>
    </header>
    <section class="menu-color">
        <div class="menu">
            <div class="administradores">
                <div>
                    <img src="./IMGs/coffee (1).png" alt="">
                    <p>Adm. de Produtos</p>
                </div>
                <div>
                    <a href="./categorias.php">
                        <img src="./IMGs/coffee.png" alt="">
                    </a>
                    <p>Adm. de Categorias</p>
                </div>
                <div>
                    <a href="./contatos.php">
                        <img src="./IMGs/livros-de-contato.png" alt="">
                    </a>
                    <p>Contatos</p>
                </div>
                <div>
                    <a href="./usuarios.php">
                        <img src="./IMGs/perfil.png" alt="">
                    </a>
                    <p>Usuários</p>
                </div>
            </div>
            <div class="logout">
                <p class="bem-vindo">Bem-Vindo Nome do Usuário</p>
                <img src="./IMGs/sair.png" alt="">
                <p>Logout</p>
            </div>
        </div>
    </section>
    <section>
        <div id="cadastro">
            <div id="cadastroTitulo">
                <h1> Cadastro de Produtos </h1>
            </div>
            <div id="cadastroInformacoes">

                <!-- Enviando variaveis para o router -->

                <!-- enctype="multipart/form-data" 
                    Essa opção é obrgatória para enviar 
                    arquivos do formulário em HTML para o servidor 
                -->
                <form action="<?= $form ?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtnome" value="<?= isset($nome) ? $nome : null ?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Preço: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input oninput="v_ = this.value; if(v_.length > 5){ this.value = v_.slice(0, 5); }" onblur="v_ = this.value; if(!~v_.indexOf('.'))
                            { vl_ = v_.length; z_ = vl_ == 1 ? '0.00' : ( vl_ == 3 ? '0' : (vl_ == 2 ? '00' : ''));this.value = v_.length < 5 && v_ != '100' ? 
                            (((v_[0] ? v_[0] : '')+(v_[1] ? v_[1]+'.' : '')+(v_[2] ? v_[2] : '')+(v_[3] ? v_[3] : '')+(v_[4] ? v_[4] : '')+z_)):('100.00')};" 
                            type="number" id="teste" step=".01" min=".01" max="100" name="txtpreco" value="<?= isset($preco) ? $preco : null ?>">

                            <!-- <input type="number" name="txtpreco" value="<?= isset($preco) ? $preco : null ?>"> -->
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Destaque: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="radio" name="txtdestaque" value="<?= isset($destaque)?$destaque:null?>">
                            <input type="radio" name="txtdestaque" value="<?=isset($destaque)?$destaque:null?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Porcentual de Desconto: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="number" name="txtdesconto" value="<?= isset($desconto) ? $desconto : null ?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Escolha um arquivo: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="fleFoto" accept=".jpg, .png, .jpeg, .gif"> 
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Descrição: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtdescricao" cols="50" rows="7"><?= isset($descricao) ? $obs : null ?></textarea>
                        </div>
                    </div>
                    <div class="campos">
                        <img src="<?= DIRETORIO_FILE_UPLOAD . $foto ?>" alt="">
                    </div>

            </div>
            <div class="enviar">
                <div class="enviar">
                    <input type="submit" name="btnEnviar" value="Salvar">
                </div>
            </div>
            </form>
        </div>
        </div>
    </section>
    <section class="principal">
        <div id="consultaDeDados">
            <table id="tblConsulta">
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Produtos</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Preço </td>
                    <td class="tblColunas destaque"> Descrição </td>
                    <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Destaque </td>
                    <td class="tblColunas destaque"> Desconto </td>
                </tr>

                <?php
                // Import do arquivo da controller para solicitar a listagem dos dados
                require_once('./controller/controllerProdutos.php');
                // Chama a função que vai retornar os dados de contatos
                $listProdutos = listarProdutos();

                // Estrutura de repetição para retornar ps dados do array e printar na tela
                foreach ($listProdutos as $item) {
                ?>

                    <tr id="tblLinhas">
                        <td class="tblColunas registros"><?= $item['nome'] ?></td>
                        <td class="tblColunas registros"><?= $item['preco'] ?></td>
                        <td class="tblColunas registros"><?= $item['descricao'] ?></td>
                        <td class="tblColunas registros"><?= $item['foto'] ?></td>
                        <td class="tblColunas registros"><?= $item['destaque'] ?></td>
                        <td class="tblColunas registros"><?= $item['desconto'] ?></td>

                        <td class="tblColunas registros">
                            <a href="router.php?componente=produtos&action=buscar&id=<?= $item['id'] ?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>
                            <a onclick="return confirm('Deseja realmente excluir este <?= $item['nome'] ?> contato?')" href="router.php?componente=produtos&action=deletar&id=<?= $item['id'] ?>">
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                            </a>
                            <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </section>
    <footer>
        <div class="copyright">
            &copy; Copyright 2021
            <p>Todos os direitos reservados - Política de Privacidade</p>
        </div>
        <div class="desenvolvido">
            <p>Desenvolvido por : João Gabriel</p>
            <p>Versão 1.0.0</p>
        </div>
    </footer>
</body>

</html>