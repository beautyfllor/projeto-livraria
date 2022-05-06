<?php
    /***********************************************************************
     * Objetivo: Arquivo responsável por manipular os dados dentro do BD
     *      (insert, update, select e delete). - "A model"
     * Autora: Florbela
     * Data: 14/04/2022
     * Versão: 1.0
     ***********************************************************************/

    //Import do arquivo que estabelece a conexão com o BD
    require_once('conexaoMysql.php');

    //Função para listar todas as categorias do BD
    function selectAllCategorias() {
        //Abre a conexao com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = 'select * from tblcategorias order by idcategoria desc';

        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result) {
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)) {
                //Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "id" => $rsDados['idcategoria'],
                    "nome" => $rsDados['nome']
                );
                $cont++;
            }
            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }
    }

    //Função para excluir no BD
    function deleteCategoria($id) {
        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o BD
        $conexao = conexaoMysql();

        //Script para deletar um registro do BD
        $sql = "delete from tblcategorias where idcategoria = ".$id;

        //Valida se o script está correto, sem erro de sintaxe e executa o BD
        if(mysqli_query($conexao, $sql)) {
            //Valida se o BD teve sucesso na execução do script
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }
        fecharConexaoMysql($conexao);
        
        return $statusResposta;
    }

    //Função para realizar o insert no BD
    function insertCategoria($dadosCategoria) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o banco de dados
        $conexao = conexaoMysql();

        //Monta o script para enviar para o BD
        $sql = "insert into tblcategorias
                    (nome)
                values
                    ('".$dadosCategoria['nome']."');";

        //Validação para verificar se o script 'sql' está certo
        if(mysqli_query($conexao, $sql)) {
            //Validação para verificar se uma linha foi acrescentada no BD
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        return $statusResposta;
    }

    //Função para buscar uma categoria no BD, através do id do registro
    function selectByIdCategoria($id) {
      
        //Abre a conexao com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = "select * from tblcategorias where idcategoria = ".$id;
        
        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result) {
            //Se houver dados... gera o array
            if($rsDados = mysqli_fetch_assoc($result)) {

                //Cria um array com os dados do BD
                $arrayDados = array(
                    "id"   => $rsDados['idcategoria'],
                    "nome" => $rsDados['nome']
                );
            }

            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }
    }

    //Função para realizar o update no BD
    function updateCategoria($dadosCategoria) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o banco de dados
        $conexao = conexaoMysql();

        //Monta o script para atualizar no BD
        $sql = "update tblcategorias set
                    nome = '".$dadosCategoria['nome']."'
                where idcategoria =".$dadosCategoria['id'];

        //Validação para verificar se o script 'sql' está certo
        if(mysqli_query($conexao, $sql)) {
            
            //Validação para verificar se uma linha foi acrescentada no BD
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }

        //Solicita o fechamento da conexão com o BD
        fecharConexaoMysql($conexao);

        return $statusResposta;
    }
?>