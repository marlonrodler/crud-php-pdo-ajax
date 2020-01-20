<?php
include("../class/conexao.php");
final class classSelectId extends classConexao{
    private $con;
    

    public function selectId(){
        $data = (object) ['msg' => "", 'status' => "", 'cliente' => null]; 

        $id = $_POST["id"];

        $this->con = $this->conectaDB();
        
        $listDB=$this->con->prepare("SELECT * FROM cliente WHERE id = ?");
        $listDB->execute(array($id));
        
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){

            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            $data->cliente = $cliente;

        }
        
        $data->status = "success";
        $data->msg = "Selecionado com sucesso!";
        echo json_encode($data); 
        
    }

}

$slf = new classSelectId;
$slf->selectId();