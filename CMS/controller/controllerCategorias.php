<?php
    /****************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de categorias.
     *  Obs:. Este arquivo fará a ponte entre a View e a Model. -  Aciona a model
     * Autora: Florbela
     * Data: 14/04/2022
     * Versão: 1.0
     ****************************************************************************/

     //Função para solicitar os dados da model e encaminhar a lista de categorias para a View
     function listarCategoria() {
        //Import do arquivo que vai buscar os dados
        require_once('model/bd/categoria.php');

        //Chama a função que vai listar os dados no BD
        $dados = selectAllCategorias();

        //Verifica se as categorias retornadas pela função 'selectAllCategorias' estão vazios
        if(!empty($dados))
            return $dados;
        else 
            return false;
     }

     //Função para realizar a exclusão de uma categoria
     function excluirCategoria($id) {
        //Validação para verificar se o id é um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

             //Import do arquivo de categoria - model
             require_once('model/bd/categoria.php');

             //Chama a função da model e valida se o retorno foi true ou false
             if(deleteCategoria($id))
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

     //Função para receber dados da Wiew e encaminhar para a Model (inserir)
     function inserirCategoria($dadosCategoria) {
         //Validação para verificar se o objeto está vazio
         if(!empty($dadosCategoria)) {
             //Validação de caixa vazia do elemento nome pois é obrigatório no BD
             if(!empty($dadosCategoria['txtNome'])) { /*O que fica no colchete é o 'name' da input*/
                 //Criação de um array de dados que será encaminhado a model para inserir no BD
                $arrayDados = array(
                    "nome" => $dadosCategoria['txtNome']
                );

                //Import do arquivo de modelagem para manipular o BD
                require_once('model/bd/categoria.php');

                    //Chamando a função que fará o insert no BD (esta função está na model)
                    if(insertCategoria($arrayDados))
                        return true;
                    else
                        return array('idErro' => 1, 
                                    'message' => 'Não foi possível inserir os dados no Banco de Dados.'
                        );
             } else
                return array('idErro' => 2, 
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.'
                );
         }
     }

     //Função para buscar uma categoria através do id do registro
     function buscarCategoria($id) {

        //Validação para verificar se o id é um núemro válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Import do arquivo de categoria - model
            require_once('model/bd/categoria.php');

            //Chama a função na model que vai buscar no BD
            $dados = selectByIdCategoria($id);
           
            //Valida se existe dados para serem devolvidos
            if(!empty($dados))
                return $dados;
            else
                return false;
        } else {
            return array('idErro' => 4, 
                        "message" => "Não é possível buscar um registro sem informar um id válido.");
        }
     }

     //Função para receber dados da Wiew e encaminhar para a Model (atualizar)
     function atualizarCategoria($dadosCategoria, $id) {
         //Validação para verificar se o objeto está vazio
         if(!empty($dadosCategoria)){
             //Validação de caixa vazia do elemento nome, pois é obrigatório no BD
             if(!empty($dadosCategoria['txtNome'])) {

                //Validação para garantir que o id seja válido
                if(!empty($id) && $id != 0 && is_numeric($id)) {
                    //Criação de um array de dados que será encaminhado a model para inserir no BD
                    $arrayDados = array(
                        "id"   => $id,
                        "nome" => $dadosCategoria['txtNome']
                    );

                    //Import do arquivo de modelagem para manipular o BD
                    require_once('model/bd/categoria.php');

                    //Chamando a função que fará o insert no BD (esta função está na model)
                    if(updateCategoria($arrayDados))
                        return true;
                    else
                        return array('idErro' => 1, 
                                    'message' => 'Não foi possível atualizar os dados no Banco de Dados.'
                        );
                } else
                    return array('idErro' => 4, 
                                "message" => "Não é possível editar um registro sem informar um id válido."        
                    );
             } else 
                return array('idErro' => 2, 
                            'message' => 'Existem campos obrigatórios que não foram preenchidos.'
                );
         }
     }
?>