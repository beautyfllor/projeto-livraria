<?php
    /****************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de contatos.
     *  Obs:. Este arquivo fará a ponte entre a View e a Model. -  Aciona a model
     * Autora: Florbela
     * Data: 07/04/2022
     * Versão: 1.0
     ****************************************************************************/

     //Função para solicitar os dados da model e encaminhar a lista de contatos para a View
     function listarContato() {
         //Import do arquivo que vai buscar os dados
         require_once('model/bd/contato.php');

         //Chama a função que vai listar os dados no BD
         $dados = selectAllContatos();

         //Verifica se os contatos retornados pela função 'selectAllContatos' estão vazios
         if(!empty($dados))
            return $dados;
        else   
            return false;
     }
     //Função para realizar a exclusão de um contato
     function excluirContato($id) {
        //Validação para verificar se o id é um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Import do arquivo de contato - model
            require_once('model/bd/contato.php');

            //Chama a função da model e valida se o retorno foi true ou false
            if(deleteContato($id))
                return true;
            else
                return array('idErro' => 1,
                            "message" => "O banco de dados não pode excluir o registro."
                );
        } else
            return array('idErro' => 2,
                        "message" => "Não é possível excluir um registro sem informar um id válido."
            );
     }
?>