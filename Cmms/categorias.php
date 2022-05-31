<?php
// Import do arquivo de configuração do projeto
require_once('modulo/config.php');
// Essa variavel foi criada para diferenciar no action do formulário qual
// a ação deveria ser levada para a router (inserir ou editar).
// Nas condições abaixo mudamos o action da variacel para a ação de editar.
$form = (string) "router.php?componente=categorias&action=inserir";

$foto = (string) null;

// Valida se a utilização da variavel de sessão esta ativa no servidor
if (session_status()) {
    // Valida se a variavel de sessão dadosCategorias não esta vazia
    if (!empty($_SESSION['dadosCategoria'])) {
        $id             = $_SESSION['dadosCategoria']['id'];
        $nome           = $_SESSION['dadosCategoria']['nome'];
        $foto           = $_SESSION['dadosCategoria']['foto'];

        // Mudamos a ação do form para editar o registro no click do botão
        // da ação salvar.
        $form = "router.php?componente=categorias&action=editar&id=" . $id . "&foto=" . $foto;

        // Destroi uma variavel da memoria do servidor
        unset($_SESSION['dadosCategorias']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/d0d3619a1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSSCMS/reset.css">
    <link rel="stylesheet" href="./CSSCMS/autenticacao.css">
    <link rel="stylesheet" href="./CSSCMS/produtos.css">
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
                <a href="./dashboard.php">
                    <img src="./IMGs/coffee-cup.png" alt="" width="100px" height="100px">
                </a>
            </div>
        </div>
    </header>
    <main>
        <section class="menu-color">
            <div class="menu">
                <div class="administradores">
                    <div>
                        <a href="./produtos.php">
                            <img src="./IMGs/coffee (1).png" alt="">
                        </a>
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
        <section class="principal2">
            <div id="cadastro">
                <div id="cadastroTitulo">
                    <h1> Cadastro de Categorias </h1>
                </div>
                <div id="cadastroInformacoes">
                    <!-- Enviando variaveis para o router -->
                    <form action="<?= $form ?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <label> Nome: </label>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" value="<?= isset($nome) ? $nome : null ?>" placeholder="Digite sua Categoria" maxlength="100" required>
                            </div>
                        </div>
                </div>

                <div class="campos">
                    <div class="cadastroInformacoesPessoais">
                        <label> Escolha um arquivo : </label>
                    </div>
                    <div class="cadastroEntradaDeDados">
                        <input type="file" name="fleFoto" accept=".jpg, .png, .jpeg, .gif">
                    </div>
                </div>
                <div class="enviar">
                    <div class="enviar">
                        <input type="submit" name="btnEnviar" value="Salvar">
                    </div>
                </div>
                <div class="campos">
                    <img src="<?= DIRETORIO_FILE_UPLOAD . $foto ?>" alt="">
                </div>
            </div>
        </section>
        <section class="principal">
            <div id="consultaDeDados">
                <table id="tblConsulta">
                    <tr>
                        <td id="tblTitulo" colspan="6">
                            <h1> Consulta de Categorias</h1>
                        </td>
                    </tr>
                    <tr id="tblLinhas">
                        <td class="tblColunas destaque"> Nome </td>
                        <td class="tblColunas destaque"> Foto </td>
                        <td class="tblColunas destaque"> Ações </td>
                    </tr>
                    <?php
                    // Import do arquivo da controller para solicitar a listagem dos dados
                    require_once('./controller/controllerCategorias.php');
                    // Chama a função que vai retornar os dados de contatos
                    $listMensagem = listarCategorias();

                    if ($listMensagem = listarCategorias()) {

                        // Estrutura de repetição para retornar ps dados do array e printar na tela
                        foreach ($listMensagem as $item) {

                            // Variavel para carregar a foto que veio do BD
                            $foto = $item['foto'];
                    ?>

                            <tr id="tblLinhas">
                                <td class="tblColunas registros"><?= $item['nome'] ?></td>
                                <td class="tblColunas registros"><img src="<?= DIRETORIO_FILE_UPLOAD . $foto ?>" class="foto"></td>

                                <td class="tblColunas registros">
                                    <a href="router.php?componente=categorias&action=buscar&id=<?= $item['id'] ?>">
                                        <img src="IMGs/botao-editar.png" alt="Editar" title="Editar" class="editar">
                                    </a>
                                    <a onclick="return confirm('Deseja realmente excluir a <?= $item['nome'] ?> categoria?')" href="router.php?componente=categorias&action=deletar&id=<?= $item['id'] ?>&foto=<?= $foto ?>">
                                        <img src="IMGs/lixeira.png" alt="Excluir" title="Excluir" class="excluir">
                                    </a>
                                    <img src="IMGs/visualizar.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </section>
    </main>
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