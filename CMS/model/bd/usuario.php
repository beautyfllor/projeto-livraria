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
?>