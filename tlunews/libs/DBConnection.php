<?php 
    class DBConnection{
        private $host ;
        private $user ; 
        private $password ;
        private $dbname ;
        private $conn ;

        public function __construct(){
            $this->host = "localhost" ;
            $this->user = "root" ;
            $this->password = "" ;
            $this->dbname = "tintuc" ;
            try {
                //buoc1 : ket noi data
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->password);
            } catch (PDOException $e) {
                //$this->conn =null;
                echo $e->getMessage();
            }
        }
        public function getCon(){
            return $this->conn ;
        }
    }

?>