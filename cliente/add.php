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

            $nome = $_POST["nome"];
            $idade = $_POST["idade"];
            $cpf = $_POST["cpf"];
            $sexo = $_POST["sexo"];
            $cidade = $_POST["cidade"];
            $estado = $_POST["estado"];
            
            $buscaDB=$this->con->prepare("SELECT id FROM cliente WHERE cpf = ?");
            $buscaDB->execute(array($cpf));

            $count = $buscaDB->rowCount();

            if($count > 0){
                //excessao a ser lançada caso o numero de linhas for maior que 0 - 
                //quer dizer que foi encontrado um cpf igual
                throw new Exception("CPF já cadastrado!");
            }

            $insertDB=$this->con->prepare("INSERT INTO cliente(nome,idade,cpf,sexo,cidade,estado) 
                                           VALUES(:nome,:idade,:cpf,:sexo,:cidade,:estado)");
                                           
            $insertDB->bindValue(":nome",$nome);
            $insertDB->bindValue(":idade",$idade);
            $insertDB->bindValue(":cpf",$cpf);
            $insertDB->bindValue(":sexo",$sexo);
            $insertDB->bindValue(":cidade",$cidade);
            $insertDB->bindValue(":estado",$estado);
            $result = $insertDB->execute();
            if( $result ){
                $data->status = "success";
                $data->msg = "Inserido com sucesso!";
                echo json_encode($data);
            }else{
                throw new Exception("insert failed");
            }
        }catch(Exception $e){
            $data->status = "error";
            $data->msg = $e->getMessage();
            echo json_encode($data);
        }

    }

}

$ex = new classInsert;
$ex->insert();