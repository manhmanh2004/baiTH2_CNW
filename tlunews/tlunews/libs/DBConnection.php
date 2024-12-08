<?php 
    class DBConnection{
        private $host ;
        private $user ; 
        private $password ;
        private $dbname ;
        private $conn ;

        public function __construct(){
            $this->host = DB_HOST ;
            $this->user = DB_USER ;
            $this->password = DB_PASS ;
            $this->dbname = DB_NAME ;
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