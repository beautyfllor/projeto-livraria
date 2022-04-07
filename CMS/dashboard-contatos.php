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
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css" />
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
          <img
            src="./img/carrinho-de-compras 1.png"
            alt="Carrinho de compras"
          />
          <p>Adm. de produtos</p>
        </div>
        <div class="categorias">
          <img src="./img/categoria 1.png" alt="Categoria" />
          <p>Adm. de categorias</p>
        </div>
        <div class="contatos">
          <img
            src="./img/caderno-de-contatos 1.png"
            alt="Caderno de contatos"
          />
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
      <table id="tblContatos" class="tblContatos">
        <tr>
          <td id="tblTitulo" colspan="5">
            <h1>Contatos</h1>
          </td>
        </tr>
        <tr id="tblLinhas" class="tblLinhas">
          <td class="tblColunas-destaque">Nome</td>
          <td class="tblColunas-destaque">Email</td>
          <td class="tblColunas-destaque">Mensagem</td>
          <td class="tblColunas-destaque">Excluir</td>
        </tr>

        <?php
          //Import do arquivo da controller para solicitar a listagem dos dados
          require_once('controller/controllerContatos.php');

          //Chama a função que vai retornar os dados de contatos
          $listContato = listarContato();

          //Estrutura de repetição para retornar os dados do array e printar na tela
          foreach($listContato as $item) {
        ?>

        <tr id="tblLinhas">
          <td class="tblColunas-registros"><?=$item['nome']?></td>
          <td class="tblColunas-registros"><?=$item['email']?></td>
          <td class="tblColunas-registros"><?=$item['mensagem']?></td>
          <td class="tblColunas-registros">
            <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=contatos&action=deletar&id=<?= $item['id'] ?>">
              <img src="./img/excluir.png" alt="Excluir">
            </a>
          </td>
        </tr>

        <?php
          }
        ?>

      </table>
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
