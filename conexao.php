<?php
    //conexao com o BD
    class Conexao{

        private $host = 'localhost';
        private $dbname = 'db_php_pdo';
        private $user = 'root';
        private $pass = '';//senha

        public function conectar(){
            try{
                //inicia a conexao
                $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user", "$this->pass");
                return $conexao;
            
            }catch(PDOException $e){
                echo '<p>ERROR! '.$e->getMessage().'</p>';
            }
        }
    }
?>