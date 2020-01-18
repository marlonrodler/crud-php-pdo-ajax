<?php
include("../class/conexao.php");
final class classInsert extends classConexao{
    private $con;
    
    
    public function insert(){
        error_reporting(0);
        ini_set("display_errors", 0 );

        try{
            $data = (object) ['msg' => "", 'status' => ""]; 
            $this->con = $this->conectaDB();

            $nome = $_POST["nome"];
            $idade = $_POST["idade"];
            $cpf = $_POST["cpf"];
            $sexo = $_POST["sexo"];
            $cidade = $_POST["cidade"];
            $estado = $_POST["estado"];
            
            $insertDB=$this->con->prepare("SELECT id FROM cliente WHERE cpf = ?");
            $insertDB->execute(array($cpf));

            $count = $insertDB->rowCount();

            if($count > 0){
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