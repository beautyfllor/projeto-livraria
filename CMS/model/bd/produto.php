<?php
    /***********************************************************************
     * Objetivo: Arquivo responsável por manipular os dados dentro do BD
     *      (insert, update, select e delete). - "A model"
     * Autora: Florbela
     * Data: 13/05/2022
     * Versão: 1.0
     ***********************************************************************/

     //Import do arquivo que estabelece conexão com o BD
     require_once('conexaoMysql.php');

     //Função para listar todos os produtos do BD
     function selectAllProdutos() {

        //Abre a conexao com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = 'select * from tblprodutos order by idproduto desc';

        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result) {
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)) {

                //Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "id"    => $rsDados['idproduto'],
                    "nome"  => $rsDados['nome'],
                    "descricao" => $rsDados['descricao'],
                    "preco" => $rsDados['preco'],
                    "desconto" => $rsDados['desconto'],
                    "destaque" => $rsDados['destaque'],
                    "foto" => $rsDados['foto']
                );
                $cont++;
            }
            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }
    }

    //Função para excluir no BD
    function deleteProduto($id) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o BD
        $conexao = conexaoMysql();

        //Script para deletar um registro do BD
        $sql = "delete from tblprodutos where idproduto = ".$id;

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
    function insertProduto($dadosProduto) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o banco de dados
        $conexao = conexaoMysql();

        //Monta o script para enviar para o BD
        $sql = "insert into tblprodutos
                    (nome,
                    preco,
                    desconto,
                    destaque,
                    descricao)
                values
                    ('".$dadosProduto['nome']."',
                    '".$dadosProduto['preco']."',
                    '".$dadosProduto['desconto']."',
                    ".$dadosProduto['destaque'].",
                    '".$dadosProduto['descricao']."'
                );";

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

    //Função para buscar um produto no BD, através do id do registro
    function selectByIdProduto($id) {

        //Abre a conexao com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = "select * from tblprodutos where idproduto = ".$id;

        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result) {
            //Se houver dados... gera o array
            if($rsDados = mysqli_fetch_assoc($result)) {

                //Cria um array com os dados do BD
                $arrayDados = array(
                    "id" => $rsDados['idproduto'],
                    "nome" => $rsDados['nome'],
                    "preco" => $rsDados['preco'],
                    "desconto" => $rsDados['desconto'],
                    "destaque" => $rsDados['destaque'],
                    "descricao" => $rsDados['descricao']
                );
            }

            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }
    }

    //Função para realizar o update no BD
    function updateProduto($dadosProduto) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o banco de dados
        $conexao = conexaoMysql();
        
        //Monta o script para atualizar no BD
        $sql = "update tblprodutos set
                    nome = '".$dadosProduto['nome']."',
                    preco = '".$dadosProduto['preco']."',
                    desconto = '".$dadosProduto['desconto']."',
                    destaque = ".$dadosProduto['destaque'].",
                    descricao = '".$dadosProduto['descricao']."'
                where idproduto =".$dadosProduto['id'];

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