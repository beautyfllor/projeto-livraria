<?php
  $form = (string) "router.php?component=produtos&action=inserir";

  //Variável para carregar o nome da foto do BD
  $foto = (string) null;

  //Valida se a utilização de variáveis de sessão está ativa no servidor
  if(session_status()) {
    //Valida se a variável de sessão dadosProduto não está vazia
    if(!empty($_SESSION['dadosProduto'])) {
      $id = $_SESSION['dadosProduto']['id'];
      $nome = $_SESSION['dadosProduto']['nome'];
      $preco = $_SESSION['dadosProduto']['preco'];
      $desconto = $_SESSION['dadosProduto']['desconto'];
      $destaque = $_SESSION['dadosProduto']['destaque'];
      $descricao = $_SESSION['dadosProduto']['descricao'];
      $foto = $_SESSION['dadosProduto']['foto'];

      //Mudamos a ação do form para editar o registro no click do botão salvar
      $form = (string) "router.php?component=produtos&action=editar&id=".$id."&foto=".$foto;

      //Destrói uma variável da memória do servidor
      unset($_SESSION['dadosProduto']);
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
                  <input type="text" value="<?= isset($nome)?$nome:null?>" name="txtNome">
                  <label class="labelPreco">Preço:</label>
                  <input type="number" value="<?= isset($preco)?$preco:null?>" name="txtPreco">
                  <label class="labelDesconto">Desconto:</label>
                  <input type="number" value="<?= isset($desconto)?$desconto:null?>" name="txtDesconto">
                  <label class="labelDestaque">Destaque:</label>
                  <div class="radios">
                    <input type="radio" name="rdoDestaque" value="true">
                    <p class="pSim">Sim</p>
                    <input type="radio" name="rdoDestaque" value="false">
                    <p class="pNão">Não</p>
                  </div>
                  <label class="labelDescricao">Descrição:</label>
                  <textarea name="txtDescricao" cols="30" rows="10"><?= isset($descricao)?$descricao:null?></textarea>
                  <input type="file" name="fleFoto" accept=".jpg, .png, .jpeg, .gif">
                  <div class="button">
                    <input type="submit" name="Salvar" value="Salvar">
                  </div>
                </div>
            </form>
        </div>
        <div id="ConsultaDeDados">
          <table id="tblProdutos">
            <tr>
              <td id="tblTitulo">
                <h1>Produtos</h1>
              </td>
            </tr>
            <tr id="tblLinhas">
            <td class="tblColunas-destaque">Nome</td>
            <td class="tblColunas-destaque">Preço</td>
            <td class="tblColunas-destaque">Desconto</td>
            <td class="tblColunas-destaque">Destaque</td>
            <td class="tblColunas-destaque">Descrição</td>
            <td class="tblColunas-destaque">Foto</td>
            <td class="tblColunas-destaque">Opções</td>
            </tr>

            <?php
            //Import do arquivo da controller para solicitar a listagem dos dados
            require_once('controller/controllerProdutos.php');

            //Chama a função que vai retornar os dados de produtos
            $listProduto = listarProduto();

            //Estrutura de repetição para retornar os dados do array e printar na tela
            foreach($listProduto as $item) {
          ?>

          <tr id="tblLinhas">
            <td class="tblColunas-registros"><?=$item['nome']?></td>
            <td class="tblColunas-registros"><?=$item['preco']?></td>
            <td class="tblColunas-registros"><?=$item['desconto']?></td>
            <td class="tblColunas-registros"><?=$item['destaque'] == 1?"Em destaque!":null?></td>
            <td class="tblColunas-registros"><?=$item['descricao']?></td>
            <!-- Fazer aqui a 'foto'. -->
            <td class="tblColunas-registros">
              <a href="router.php?component=produtos&action=buscar&id=<?= $item['id'] ?>">
                <img src="./img/editar.png" alt="Editar">
              </a>
              <a onclick="return confirm('Deseja realmente excluir esse item?');" href="router.php?component=produtos&action=deletar&id=<?= $item['id'] ?>">
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
