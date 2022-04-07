<?php
    /***********************************************************************
     * Objetivo: Arquivo responsável por manipular os dados dentro do BD
     *      (insert, update, select e delete). - "A model"
     * Autora: Florbela
     * Data: 07/04/2022
     * Versão: 1.0
     ***********************************************************************/

     //Import do arquivo que estabelece a conexão com o BD
     require_once('conexaoMysql.php');

     //Função para listar todos os contatos do BD
     function selectAllContatos() {
         //Abre a conexao com o BD
         $conexao = conexaoMysql();

         //Script para listar todos os dados do BD
         $sql = "select * from tblcontatos order by idcontato desc";

         //Executa o script sql no BD e guarda o retorno dos dados, se houver
         $result = mysqli_query($conexao, $sql);

         //Valida se o BD retornou registros
         if($result) {
             $cont = 0;
             while($rsDados = mysqli_fetch_assoc($result)){
                 //Cria um array com os dados do BD
                 $arrayDados[$cont] = array(
                     "id" => $rsDados['idcontato'],
                     "nome" => $rsDados['nome'],
                     "email" => $rsDados['email'],
                     "mensagem" => $rsDados['mensagem']
                 );
                 $cont++;
             }

             //Solicita o fechamento da conexão com o BD
             fecharConexaoMysql($conexao);

             return $arrayDados;
         }
     }

     //Função para excluir no BD
     function deleteContato($id) {

         //Declaração de variável para utilizar no return desta função
         $statusResposta = (boolean) false;

         //Abre a conexão com o BD
         $conexao = conexaoMysql();

         //Script para deletar um registro do BD
         $sql = "delete from tblcontatos where idcontato = ".$id;

         //Valida se o script está correto, sem erro de sintaxe e executa o BD
         if(mysqli_query($conexao, $sql)) {
             //Valida se o BD teve sucesso na execução do script
             if(mysqli_affected_rows($conexao))
                $statusResposta = true;
         }
         fecharConexaoMysql($conexao);
         return $statusResposta;
     }
?>