<?php
  $form = (string) "router.php?component=usuarios&action=inserir";

  //Valida se a utilização de variáveis de sessão está ativa no servidor
  if(session_status()) {
     //Valida se a variável de sessão dadosUsuario não está vazia
     if(!empty($_SESSION['dadosUsuario'])) {
       $id = $_SESSION['dadosUsuario']['id'];
       $nome = $_SESSION['dadosUsuario']['nome'];
       $login = $_SESSION['dadosUsuario']['login'];
       $senha = $_SESSION['dadosUsuario']['senha'];

       //Mudamos a ação do form para editar o registro no click do botão salvar
       $form = (string) "router.php?component=usuarios&action=editar&id=".$id;

       //Destrói uma variável da memória do servidor
       unset($_SESSION['dadosUsuario']);
     }
  }
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
    <link rel="stylesheet" type="text/css" href="./css/dashboard-usuarios.css" />
    <title>CMS</title>
  </head>
  <body>
    <header>
      <div class="text">
        <div class="cms-livraria">
            <a href="dashboard.php" class="aCms">
                <p class="pCms">CMS</p>
            </a>
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
          <img src="./img/usuario-de-perfil 1.png" alt="Usuário" />
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
        <form action="<?=$form?>" name="frmUsuario" method="POST">
          <div class="container-login-senha">
            <label class="labelNome">Nome:</label>
            <input type="text" class="nome" name="txtNome" value="<?= isset($nome)?$nome:null?>" placeholder="Digite o nome">
            <label class="labelLogin">Login:</label>
            <input type="text" class="login" name="txtLogin" value="<?= isset($login)?$login:null?>" placeholder="Digite o login">
            <label class="labelSenha">Senha:</label>
            <input type="password" class="senha" name="txtSenha" placeholder="Digite a senha">
            <div class="button">
              <input type="submit" name="Salvar" value="Salvar">
            </div>
          </div>
        </form>
      </div>
      <div id="ConsultaDeDados">
        <table id="tblUsuarios">
          <tr>
            <td id="tblTitulo">
              <h1>Usuários</h1>
            </td>
          </tr>
          <tr id="tblLinhas">
            <td class="tblColunas-destaque">Nome</td>
            <td class="tblColunas-destaque">Login</td>
            <td class="tblColunas-destaque">Opções</td>
          </tr>

          <?php
            //Import do arquivo da controller para solicitar a listagem dos dados
            require_once('controller/controllerUsuarios.php');

            //Chama a função que vai retornar os dados de usuários
            $listUsuario = listarUsuario();

            //Estrutura de repetição para retornar os dados do array e printar na tela
            foreach($listUsuario as $item) {
          ?>

          <tr id="tblLinhas">
              <td class="tblColunas-registros"><?=$item['nome']?></td>
              <td class="tblColunas-registros"><?=$item['login']?></td>
              <td class="tblColunas-registros">
                <a href="router.php?component=usuarios&action=buscar&id=<?= $item['id'] ?>">
                  <img src="./img/editar.png" alt="Editar">
                </a>
                <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=usuarios&action=deletar&id=<?= $item['id'] ?>">
                  <img src="./img/excluir.png" alt="Excluir">
                </a>
              </td>
          </tr>

          <?php
            }
          ?>

        </table>
      </div>
    </div>
  </body>
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
</html>
