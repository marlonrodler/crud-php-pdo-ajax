<?php
include("../class/conexao.php");
final class classInsert extends classConexao{
    private $con;
    
    
    public function insert(){

        try{
            //criando um obj data recebendo msg e status em branco
            $data = (object) ['msg' => "", 'status' => ""]; 
            //executando a funçao que faz a conexão com o banco
            $this->con = $this->conectaDB();

            //recupera os valores passados no ajax
            $nome = $_POST["nome"];
            $idade = $_POST["idade"];
            $cpf = $_POST["cpf"];
            $sexo = $_POST["sexo"];
            $cidade = $_POST["cidade"];
            $estado = $_POST["estado"];


            //prepara a query para fazer o select na tabela cliente
            $buscaDB=$this->con->prepare("SELECT id FROM cliente WHERE cpf = ?");
            //executa a query com o array de cpf
            $buscaDB->execute(array($cpf));

            //count passa a valer o numero de qntd de cpf selecionado
            $count = $buscaDB->rowCount();

            //if comparando se o numero de cpf selecionado é maior que 0 (no caso se foi encontrado um cpf)
            if($count > 0){
                //excessao a ser lançada caso o numero de linhas for maior que 0 - 
                //quer dizer que foi encontrado um cpf igual
                throw new Exception("CPF já cadastrado!");
            }

            //preparando a query para fazer a inserção no banco
            $insertDB=$this->con->prepare("INSERT INTO cliente(nome,idade,cpf,sexo,cidade,estado) 
                                           VALUES(:nome,:idade,:cpf,:sexo,:cidade,:estado)");
                        
            //estou passando o valor correspondente 
            $insertDB->bindValue(":nome",$nome);
            $insertDB->bindValue(":idade",$idade);
            $insertDB->bindValue(":cpf",$cpf);
            $insertDB->bindValue(":sexo",$sexo);
            $insertDB->bindValue(":cidade",$cidade);
            $insertDB->bindValue(":estado",$estado);

            //a variável result recebe a execução da query
            $result = $insertDB->execute();

            //se o result ter recebido a execução do insertDB
            if( $result ){
                $data->status = "success";
                $data->msg = "Inserido com sucesso!";
                echo json_encode($data);
            }else{
                //excessao a ser lançada caso o result for falso (n conser valor)
                throw new Exception("insert failed");
            }
        }catch(Exception $e){
            $data->status = "error";
            $data->msg = $e->getMessage();
            echo json_encode($data);
        }

    }

}

$add = new classInsert;
$add->insert();