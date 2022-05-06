<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSSCMS/reset.css">
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
    <section class="principal">
        <p>Titulo da Sessão</p>
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