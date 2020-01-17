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
            
            $insertDB=$this->con->prepare("INSERT INTO cliente(nome,idade,cpf,sexo,cidade,estado) VALUES(:nome,:idade,:cpf,:sexo,:cidade,:estado)");
            $insertDB->bindValue(":nome",$nome);
            $insertDB->bindValue(":idade",$idade);
            $insertDB->bindValue(":cpf",$cpf);
            $insertDB->bindValue(":sexo",$sexo);
            $insertDB->bindValue(":cidade",$cidade);
            $insertDB->bindValue(":estado",$estado);
            $insertDB->execute();
            $data->status = "success";
            $data->msg = "insert with success";
            echo json_encode($data);

        }catch(PDOException $erro){
            $data->status = "error";
            $data->msg = $erro->getMessage();
            echo json_encode($data);
        }

    }

}

$ex = new classInsert;
$ex->insert();