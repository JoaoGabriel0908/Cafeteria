<?php

// Essa variavel foi criada para diferenciar no action do formulário qual
// a ação deveria ser levada para a router (inserir ou editar).
// Nas condições abaixo mudamos o action da variacel para a ação de editar.
$form = (string) "router.php?componente=usuarios&action=inserir";

// Valida se a utilização da variavel de sessão esta ativa no servidor
if (session_status()) {
    // Valida se a variavel de sessão dadosCategorias não esta vazia
    if (!empty($_SESSION['dadosUsuario'])) {
        $id             = $_SESSION['dadosUsuario']['id'];
        $nome           = $_SESSION['dadosUsuario']['nome'];
        $sobrenome      = $_SESSION['dadosUsuario']['sobrenome'];
        $email          = $_SESSION['dadosUsuario']['email'];
        $senha          = $_SESSION['dadosUsuario']['senha'];

        // Mudamos a ação do form para editar o registro no click do botão
        // da ação salvar.
        $form = "router.php?componente=usuarios&action=editar&id=" . $id;

        // Destroi uma variavel da memoria do servidor
        // unset($_SESSION['dadosCategorias']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <img src="./IMGs/perfil.png" alt="">
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
                <h1> Cadastro de Usuários </h1>
            </div>
            <div id="cadastroInformacoes">
                <!-- Enviando variaveis para o router -->
                <form action="<?= $form ?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?= isset($nome) ? $nome : null ?>" placeholder="Digite seu nome" maxlength="100">
                        </div>
                    </div>
            </div>

            <div class="campos">
                <div class="cadastroInformacoesPessoais">
                    <label> Sobrenome : </label>
                </div>
                <div class="cadastroEntradaDeDados">
                    <input type="text" name="txtSobrenome" value="<?= isset($sobrenome) ? $sobrenome : null ?>" placeholder="Digite seu sobrenome" maxlength="100">
                </div>
            </div>

            <div class="campos">
                <div class="cadastroInformacoesPessoais">
                    <label> Email: </label>
                </div>
                <div class="cadastroEntradaDeDados">
                    <input type="tel" name="txtEmail" value="<?= isset($email) ? $email : null ?>" placeholder="Digite seu email">
                </div>
            </div>

            <div class="campos">
                <div class="cadastroInformacoesPessoais">
                    <label> Senha: </label>
                </div>
                <div class="cadastroEntradaDeDados">
                    <input type="tel" name="txtSenha" value="<?= isset($senha) ? $senha : null ?>" placeholder="Digite sua senha">
                </div>
            </div>

            <div class="enviar">
                <div class="enviar">
                    <input type="submit" name="btnEnviar" value="Salvar">
                </div>
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
                    <td class="tblColunas destaque"> Sobrenome </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Senha </td>
                </tr>
                <?php
                // Import do arquivo da controller para solicitar a listagem dos dados
                require_once('./controller/controllerUsuarios.php');
                // Chama a função que vai retornar os dados de contatos
                $listMensagem = listarUsuarios();

                // Estrutura de repetição para retornar ps dados do array e printar na tela
                foreach ($listMensagem as $item) {
                ?>

                    <tr id="tblLinhas">
                        <td class="tblColunas registros"><?= $item['nome'] ?></td>
                        <td class="tblColunas registros"><?= $item['sobrenome'] ?></td>
                        <td class="tblColunas registros"><?= $item['email'] ?></td>
                        <td class="tblColunas registros"><?= $item['senha'] ?></td>

                        <td class="tblColunas registros">
                            <a href="router.php?componente=usuarios&action=buscar&id=<?= $item['id'] ?>">
                                <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>
                            <a onclick="return confirm('Deseja realmente excluir a <?= $item['nome'] ?> categoria?')" href="router.php?componente=usuarios&action=deletar&id=<?= $item['id'] ?>">
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