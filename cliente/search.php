<?php
include("../class/conexao.php");
final class classSelect extends classConexao{
    private $con;
    
    public function select(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        
        $listDB=$this->con->prepare("SELECT * FROM cliente ORDER BY nome ASC");
        $listDB->execute();
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "select with success";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }
    
    public function selectByTerm(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_term"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE nome LIKE ? OR idade LIKE ? OR cpf LIKE ? OR sexo LIKE ? OR cidade LIKE ? OR estado LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term,$term,$term,$term,$term,$term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByTerm";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }


    public function selectByName(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_name"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE nome LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByName";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }


    public function selectByAge(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_age"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE idade LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByAge";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }


    public function selectByCpf(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_cpf"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE cpf LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByCpf";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }


    public function selectByGender(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_gender"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE sexo LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByGender";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }


    public function selectByCity(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_city"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE cidade LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByCity";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }


    public function selectByState(){
        $data = (object) ['msg' => "", 'status' => "", 'clientes' => array()]; 

        $this->con = $this->conectaDB();
        
        $term = "%".$_POST["search_state"]."%";

        $listDB=$this->con->prepare("SELECT * FROM cliente  WHERE estado LIKE ? ORDER BY nome ASC");
        $listDB->execute(array($term));
        
        while($linha_resul = $listDB->fetch(PDO::FETCH_ASSOC)){
            $cliente = (object) ['id'     => $linha_resul['id'], 
                                 'nome'   => $linha_resul['nome'], 
                                 'idade'  => $linha_resul['idade'], 
                                 'cpf'    => $linha_resul['cpf'],
                                 'sexo'   => $linha_resul['sexo'], 
                                 'cidade' => $linha_resul['cidade'], 
                                 'estado' => $linha_resul['estado']
                                ];
            // echo "ID: " . $linha_resul['id'] . "<br>";
            // echo "Nome: " . $linha_resul['nome'] . "<br>";
            // echo "Nota: " . $linha_resul['nota'] . "<br><br>";
            $data->clientes[] = $cliente;
        }

        $data->status = "success";
        $data->msg = "selectByState";
        $myJSON = json_encode($data); 

        echo $myJSON;  
        
    }




}

$ex = new classSelect;

if(isset($_POST["search_term"]) && $_POST["search_term"] > " "){
    $ex->selectByTerm();
}else if(isset($_POST["search_name"]) && $_POST["search_name"] > " "){
    $ex->selectByName();
}else if(isset($_POST["search_age"]) && $_POST["search_age"] > " "){
    $ex->selectByAge();
}else if(isset($_POST["search_cpf"]) && $_POST["search_cpf"] > " "){
    $ex->selectByCpf();
}else if(isset($_POST["search_gender"]) && $_POST["search_gender"] > " "){
    $ex->selectByGender();
}else if(isset($_POST["search_city"]) && $_POST["search_city"] > " "){
    $ex->selectByCity();
}else if(isset($_POST["search_state"]) && $_POST["search_state"] > " "){
    $ex->selectByState();
}else{
    $ex->select();
}

