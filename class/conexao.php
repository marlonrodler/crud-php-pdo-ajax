<?php

abstract class classConexao{
    public function conectaDB(){
        try{
            $con=new PDO("mysql:host=localhost;dbname=loja_json","root","");
            return $con;
        }catch(PDOException $erro){
            echo $erro->getMessage();
        }
    }
}