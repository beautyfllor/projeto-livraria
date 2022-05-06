<?php
    /***********************************************************************
     * Objetivo: Arquivo responsável por manipular os dados dentro do BD
     *      (insert, update, select e delete). - "A model"
     * Autora: Florbela
     * Data: 26/04/2022
     * Versão: 1.0
     ***********************************************************************/

    //Import do arquivo que estabelece conexão com o BD
    require_once('conexaoMysql.php');

    //Função para listar todas as categorias do BD
    function selectAllUsuarios() {
        //Abre a conexao com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = 'select * from tblusuarios order by idusuario desc';

        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result) {
            $cont = 0;
            while($rsDados = mysqli_fetch_assoc($result)) {
                //Cria um array com os dados do BD
                $arrayDados[$cont] = array(
                    "id"    => $rsDados['idusuario'],
                    "nome"  => $rsDados['nome'],
                    "login" => $rsDados['login'],
                    "senha" => $rsDados['senha']
                );
                $cont++;
            }
            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);



            return $arrayDados;
        }
    }

    //Função para excluir no BD
    function deleteUsuario($id) {
        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o BD
        $conexao = conexaoMysql();

        //Script para deletar um registro do BD
        $sql = "delete from tblusuarios where idusuario = ".$id;

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
    function insertUsuario($dadosUsuario) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o banco de dados
        $conexao = conexaoMysql();

        //Monta o script para enviar para o BD
        $sql = "insert into tblusuarios
                    (nome,
                    login,
                    senha)
                values
                    ('".$dadosUsuario['nome']."',
                    '".$dadosUsuario['login']."',
                    '".$dadosUsuario['senha']."');";

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

    //Função para buscar um usuário no BD, através do id do registro
    function selectByIdUsuario($id) {

        //Abre a conexao com o BD
        $conexao = conexaoMysql();

        //Script para listar todos os dados do BD
        $sql = "select * from tblusuarios where idusuario = ".$id;

        //Executa o script sql no BD e guarda o retorno dos dados, se houver
        $result = mysqli_query($conexao, $sql);

        //Valida se o BD retornou registros
        if($result) {
            //Se houver dados... gera o array
            if($rsDados = mysqli_fetch_assoc($result)) {

                //Cria um array com os dados do BD
                $arrayDados = array(
                    "id" => $rsDados['idusuario'],
                    "nome" => $rsDados['nome'],
                    "login" => $rsDados['login'],
                    "senha" => $rsDados['senha']
                );
            }

            //Solicita o fechamento da conexão com o BD
            fecharConexaoMysql($conexao);

            return $arrayDados;
        }
    }

    //Função para realizar o update no BD
    function updateUsuario($dadosUsuario) {

        //Declaração de variável para utilizar no return desta função
        $statusResposta = (boolean) false;

        //Abre a conexão com o banco de dados
        $conexao = conexaoMysql();
        
        //Monta o script para atualizar no BD
        $sql = "update tblusuarios set
                    nome = '".$dadosUsuario['nome']."',
                    login = '".$dadosUsuario['login']."',
                    senha = '".md5($dadosUsuario['senha'])."'
                where idusuario =".$dadosUsuario['id'];

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