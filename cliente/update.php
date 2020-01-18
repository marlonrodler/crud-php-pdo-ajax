<?php
include("../class/conexao.php");
final class classUpdate extends classConexao{
    private $con;
    

    public function update(){
        try{
            $data = (object) ['msg' => "", 'status' => ""]; 

            
            $this->con = $this->conectaDB();

            $id = $_POST['id'];
            $nome = $_POST["nome"];
            $idade = $_POST["idade"];
            $cpf = $_POST["cpf"];
            $sexo = $_POST["sexo"];
            $cidade = $_POST["cidade"];
            $estado = $_POST["estado"];        

            
            $listDB=$this->con->prepare("UPDATE cliente SET nome = :nome, 
                                                            idade = :idade, 
                                                            cpf = :cpf, 
                                                            sexo = :sexo, 
                                                            cidade = :cidade, 
                                                            estado = :estado WHERE id = :id");
            $listDB->execute(array(
                                    ':id'   => $id,
                                    ':nome' => $nome,
                                    ':idade' => $idade,
                                    ':cpf' => $cpf,
                                    ':sexo' => $sexo,
                                    ':idade' => $idade,
                                    ':cidade' => $cidade,
                                    ':estado' => $estado
                                ));

            $data->status = "success";
            $data->msg = "Alterado com sucesso!";
            echo json_encode($data); 

        }catch(PDOException $erro){
            $data->status = "error";
            $data->msg = $erro->getMessage();
            echo json_encode($data);
        }
        
    }

}

$ex = new classUpdate;
$ex->update();