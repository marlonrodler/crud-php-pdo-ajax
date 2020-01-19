<?php
include("../class/conexao.php");
final class classSelect extends classConexao{
    private $con;
    



    public function selectFilter(){

        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $whereClause = "";
        $arrayValues = array();

        if(isset($_POST["search_term"]) && $_POST["search_term"] > " "){
            $whereClause = $whereClause . "nome LIKE ? OR idade LIKE ? OR cpf LIKE ? OR sexo LIKE ? OR cidade LIKE ? OR estado LIKE ?"; 
            $arrayValues[] = "%".$_POST["search_term"]."%";
            $arrayValues[] = "%".$_POST["search_term"]."%";
            $arrayValues[] = "%".$_POST["search_term"]."%";
            $arrayValues[] = "%".$_POST["search_term"]."%";
            $arrayValues[] = "%".$_POST["search_term"]."%";
            $arrayValues[] = "%".$_POST["search_term"]."%";
        }else{
            if(isset($_POST["search_name"]) && $_POST["search_name"] > " "){
                if($whereClause > " "){
                    $whereClause = $whereClause . " AND ";
                }
                $whereClause = $whereClause . "nome LIKE ? "; 
                $arrayValues[] = "%".$_POST["search_name"]."%";
            }
            if(isset($_POST["search_age"]) && $_POST["search_age"] > " "){
                if($whereClause > " "){
                    $whereClause = $whereClause . " AND ";
                }
                $whereClause = $whereClause . "idade LIKE ?"; 
                $arrayValues[] = "%".$_POST["search_age"]."%";
            }
            if(isset($_POST["search_cpf"]) && $_POST["search_cpf"] > " "){
                if($whereClause > " "){
                    $whereClause = $whereClause . " AND ";
                }
                $whereClause = $whereClause . "cpf LIKE ?"; 
                $arrayValues[] = "%".$_POST["search_cpf"]."%";
            }
            if(isset($_POST["search_gender"]) && $_POST["search_gender"] > " "){
                if($whereClause > " "){
                    $whereClause = $whereClause . " AND ";
                }
                $whereClause = $whereClause . "sexo LIKE ?"; 
                $arrayValues[] = "%".$_POST["search_gender"]."%";
            }
            if(isset($_POST["search_city"]) && $_POST["search_city"] > " "){
                if($whereClause > " "){
                    $whereClause = $whereClause . " AND ";
                }
                $whereClause = $whereClause . "cidade LIKE ?"; 
                $arrayValues[] = "%".$_POST["search_city"]."%";
            }
            if(isset($_POST["search_state"]) && $_POST["search_state"] > " "){
                if($whereClause > " "){
                    $whereClause = $whereClause . " AND ";
                }
                $whereClause = $whereClause . "estado LIKE ?"; 
                $arrayValues[] = "%".$_POST["search_state"]."%";
            }
        }

        if($whereClause > " "){
            $whereClause = "WHERE " . $whereClause;
        }
        $selectQuery = "SELECT * FROM cliente " . $whereClause;
        $listDB=$this->con->prepare($selectQuery);
        $listDB->execute($arrayValues);
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];

            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "Busca com sucesso!";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }

}

$ex = new classSelect;

$ex->selectFilter();

