<?php
include("../class/conexao.php");
final class classDelete extends classConexao{
    private $con;
    
    
    public function delete(){

        try{
            $data = (object) ['msg' => "", 'status' => ""]; 
            $this->con = $this->conectaDB();

            $id = $_POST["id"];
            
            $deleteDB=$this->con->prepare("DELETE FROM cliente WHERE id=?");
            $deleteDB->execute(array($id));
            $data->status = "success";
            $data->msg = "Deletado com sucesso!";
            echo json_encode($data);

        }catch(PDOException $erro){
            $data->status = "error";
            $data->msg = $erro->getMessage();
            echo json_encode($data);
        }

    }

}

$del = new classDelete;
$del->delete();