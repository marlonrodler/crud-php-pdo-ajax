<?php
include("../class/conexao.php");
final class classDelete extends classConexao{
    private $con;
    
    
    public function delete(){
        error_reporting(0);
        ini_set("display_errors", 0 );

        try{
            $data = (object) ['msg' => "", 'status' => ""]; 
            $this->con = $this->conectaDB();

            $id = $_POST["id"];
            
            $insertDB=$this->con->prepare("DELETE FROM cliente WHERE id=?");
            $insertDB->execute(array($id));
            $data->status = "success";
            $data->msg = "delete with success";
            echo json_encode($data);

        }catch(PDOException $erro){
            $data->status = "error";
            $data->msg = $erro->getMessage();
            echo json_encode($data);
        }

    }

}

$ex = new classDelete;
$ex->delete();