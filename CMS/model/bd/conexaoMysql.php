<?php
     /**********************************************************************
     * Objetivo: Arquivo para criar a conexão com o banco de dados Mysql.
     * Autora: Florbela
     * Data: 07/04/2022
     * Versão: 1.0
     **********************************************************************/

     //Constantes para estabeleecer a conexão com o banco de dados (local do BD, usuário, senha e database)
     const SERVER = 'localhost';
     const USER = 'root';
     const PASSWORD = 'bcd127';
     const DATABASE = 'dblivraria';

     //Abre a conexão com o banco de dados Mysql
     function conexaoMysql() {
         $conexao = array();

         //Se a conexão for estabelecida com o BD, iremos ter um array de dados sobre a conexão
        $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

        //Validação para verificar se a conexão foi realizada com sucesso
        if($conexao)
            return $conexao;
        else
            return false;
     }

     //Fecha a conexão com o BD mySQL
     function fecharConexaoMysql($conexao) {
         mysqli_close($conexao);
     }
?>