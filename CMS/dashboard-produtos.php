<?php
  $form = (string) "router.php?component=produtos&action=inserir";


//        //Mudamos a ação do form para editar o registro no click do botão salvar
//        $form = (string) "router.php?component=usuarios&action=editar&id=".$id;

//        //Destrói uma variável da memória do servidor
//        unset($_SESSION['dadosUsuario']);
//      }
//   }
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link rel="stylesheet" type="text/css" href="./css/dashboard-produtos.css" />
    <title>CMS</title>
  </head>
  <body>
    <header>
      <div class="text">
        <div class="cms-livraria">
          <p class="pCms">CMS</p>
          <p class="pLivraria">Livraria da Flor</p>
        </div>
        <div class="gerenciamento">
          <p>Gerecenciamento de Conteúdo do Site</p>
        </div>
      </div>
      <div class="iconBook">
        <img src="./img/book.png" alt="Livro" />
      </div>
    </header>
    <div class="nav">
      <div class="sub-nav">
        <div class="produtos">
          <a href="dashboard-produtos.php">
            <img src="./img/carrinho-de-compras 1.png" alt="Carrinho de compras"/>
          </a>
          <p>Adm. de produtos</p>
        </div>
        <div class="categorias">
            <a href="dashboard-categorias.php">
                <img src="./img/categoria 1.png" alt="Categoria" />
            </a>
            <p>Adm. de categorias</p>
        </div>
        <div class="contatos">
            <a href="dashboard-contatos.php">
                <img src="./img/caderno-de-contatos 1.png" alt="Caderno de contatos"/>
            </a>
            <p>Contatos</p>
        </div>
        <div class="usuarios">
          <a href="dashboard-usuarios.php">
            <img src="./img/usuario-de-perfil 1.png" alt="Usuário" />
          </a>
          <p>Adm. de usuários</p>
        </div>
      </div>
      <div class="right">
        <p class="welcome">Bem-vindo, user</p>
        <div class="img">
            <img src="./img/logout.png" alt="Logout" />
        </div>
        <p class="logout">Logout</p>
      </div>
    </div>
    <div class="content">
        <div class="containerForm">
            <form action="<?=$form?>" name="frmProdutos" method="POST">
                <div class="container-produtos">
                    <label class="labelNome">Nome:</label>
                    <input type="text" name="txtNome">
                    <label class="labelDescricao">Descrição:</label>
                    <textarea name="txtDescricao" cols="30" rows="10"></textarea>
                    <label class="labelPreco">Preço:</label>
                    <input type="number" name="txtPreco">
                    <label class="labelDesconto">Desconto:</label>
                    <input type="number" name="txtDesconto">
                    <label class="labelDestaque">Destaque:</label>
                    <input type="checkbox" name="txtDestaque">
                    <input type="file" name="fleFoto" accept=".jpg, .png, .jpeg, .gif">
                </div>
            </form>
        </div>
    </div>
    <footer>
      <div class="copyright">
        <p>© Copyright 2022</p>
        <p>Todos os direitos reservados - Política de Privacidade</p>
      </div>
      <div class="versao">
        <p>Desenvolvido por Florbela</p>
        <p>Versão 1.0.0</p>
      </div>
    </footer>
  </body>
</html>
