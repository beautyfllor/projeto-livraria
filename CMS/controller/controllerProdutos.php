<?php
    /****************************************************************************
     * Objetivo: Arquivo responsável pela manipulação de dados de usuários.
     *  Obs:. Este arquivo fará a ponte entre a View e a Model. -  Aciona a model
     * Autora: Florbela
     * Data: 13/05/2022
     * Versão: 1.0
     ****************************************************************************/

    //Função para solicitar os dados da model e encaminhar a lista de produtos para a View
    function listarProduto() {

        //Import do arquivo que vai buscar os dados
        require_once('model/bd/produto.php');

        //Chama a função que vai listar os dados no BD
        $dados = selectAllProdutos();

        //Verifica se os produtos retornados pela função 'selectAllProdutos' estão vazios
        if(!empty($dados))
            return $dados;
        else
            return false;
    }

    //Função para realizar a exclusão de um produto
    function excluirProduto($id) {

        //Validação para verificar se o id é um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Import do arquivo de produto - model
            require_once('model/bd/produto.php');

            //Chama a função da model e valida se o retorno foi true ou false
            if(deleteProduto($id))
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
    function inserirProduto($dadosProduto) {

        //Validação para verificar se o objeto está vazio
        if(!empty($dadosProduto)) {
            //Validação de caixa vazia dos elementos, pois são obrigatórios no BD
            if(!empty($dadosProduto['txtNome']) && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['txtDesconto']) && !empty($dadosProduto['rdoDestaque']) && !empty($dadosProduto['txtDescricao'])) {

                //Criação de um array de dados que será encaminhado a model para inserir no BD
                $arrayDados = array(
                    "nome"  => $dadosProduto['txtNome'],
                    "preco" => $dadosProduto['txtPreco'],
                    "desconto" => $dadosProduto['txtDesconto'],
                    "destaque" => $dadosProduto['rdoDestaque'],
                    "descricao" => $dadosProduto['txtDescricao']
                );

                //Import do arquivo de modelagem para manipular o BD
                require_once('model/bd/produto.php');

                //Chamando a função que fará o insert no BD (esta função está na model)
                if(insertProduto($arrayDados))
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

    //Função para buscar um usuário através do id do registro
    function buscarProduto($id) {

        //Validação para verificar se o id é um número válido
        if($id != 0 && !empty($id) && is_numeric($id)) {

            //Import do arquivo de produto - model
            require_once('model/bd/produto.php');

            //Chama a função na model que vai buscar no BD
            $dados = selectByIdProduto($id);

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
    function atualizarProduto($dadosProduto, $id) {
        //Validação para verificar se o objeto está vazio
        if(!empty($dadosProduto)){
           //Validação de caixa vazia dos elementos, pois são obrigatórios no BD
           if(!empty($dadosProduto['txtNome']) && !empty($dadosProduto['txtPreco']) && !empty($dadosProduto['txtDesconto'])  && !empty($dadosProduto['rdoDestaque']) && !empty($dadosProduto['txtDescricao'])) {
               
                //Validação para garantir que o id seja válido
               if(!empty($id) && $id != 0 && is_numeric($id)) {

                   //Criação de um array de dados que será encaminhado a model para inserir no BD
                   $arrayDados = array(
                       "id" => $id,
                       "nome" => $dadosProduto['txtNome'],
                       "preco" => $dadosProduto['txtPreco'],
                       "desconto" => $dadosProduto['txtDesconto'],
                       "destaque" => $dadosProduto['rdoDestaque'],
                       "descricao" => $dadosProduto['txtDescricao']
                   );

                   //Import do arquivo de modelagem para manipular o BD
                   require_once('model/bd/produto.php');

                   //Chamando a função que fará o insert no BD (esta função está na model)
                   if(updateProduto($arrayDados))
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