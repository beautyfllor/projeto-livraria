<?php
    $form = (string) "router.php?component=categorias&action=inserir";

    //Valida se a utilização de variáveis de sessão está ativa no servidor
    if(session_status()) {
        //Valida se a variável de sessão dadosCategoria não está vazia
        if(!empty($_SESSION['dadosCategoria'])) {
          $id = $_SESSION['dadosCategoria']['id'];
          $nome = $_SESSION['dadosCategoria']['nome'];

          //Mudamos a ação do form para editar o registro no click do botão salvar
          $form = (string) "router.php?component=categorias&action=editar&id=".$id;

          //Destrói uma variável da memória do servidor
          unset($_SESSION['dadosCategoria']);
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
    <link rel="stylesheet" type="text/css" href="./css/dashboard-categorias.css" />
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
          <img
            src="./img/carrinho-de-compras 1.png"
            alt="Carrinho de compras"
          />
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
        <div class="containerInserirCategoria">
            <form action="<?=$form?>" name="frmInserirCategoria" method="POST">
                <input type="text" name="txtNome" value="<?= isset($nome)?$nome:null ?>" placeholder="Digite o nome da categoria">
                <div class="button">
                    <input type="submit" name="btnCadastrar" value="Cadastrar">
                </div>
            </form>
        </div>
        <div id="ConsultaDeDados">
            <table id="tblCategorias">
                <tr>
                    <td id="tblTitulo">
                        <h1>Categorias</h1>
                    </td>                    
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas-destaque">Nome</td>
                    <td class="tblColunas-destaque">Opções</td>
                </tr>

                <?php
                    //Import do arquivo da controller para solicitar a listagem dos dados
                    require_once('controller/controllerCategorias.php');

                    //Chama a função que vai retornar os dados de categorias
                    $listCategoria = listarCategoria();

                    //Estrutura de repetição para retornar os dados do array e printar na tela
                    foreach($listCategoria as $item) {
                ?>

                <tr id="tblLinhas">
                    <td class="tblColunas-registros"><?=$item['nome']?></td>
                    <td class="tblColunas-registros">
                        <a href="router.php?component=categorias&action=buscar&id=<?=$item['id']?>">
                            <img src="./img/editar.png" alt="Editar">
                        </a>
                        <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=categorias&action=deletar&id=<?= $item['id'] ?>">
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