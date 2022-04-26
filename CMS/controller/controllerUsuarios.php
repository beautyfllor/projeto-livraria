<?php
     /****************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de usuários.
     *  Obs:. Este arquivo fará a ponte entre a View e a Model. -  Aciona a model
     * Autora: Florbela
     * Data: 26/04/2022
     * Versão: 1.0
     ****************************************************************************/

    //Função para solicitar os dados da model e encaminhar a lista de usuários para a View
    function listarUsuario() {
        //Import do arquivo que vai buscar os dados
        require_once('model/bd/usuario.php');

        //Chama a função que vai listar os dados no BD
        $dados = selectAllUsuarios();

        //Verifica se os usuários retornados pela função 'selectAllUsuarios' estão vazios
        if(!empty($dados))
            return $dados;
        else
            return false;
    }

    
?>