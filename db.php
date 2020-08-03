<?php 
    class Db{
        private $conn;
        public function __construct(){
            $this->con = new mysqli("localhost", "root", "", "cep-devmedia");
            $this->con->set_charset("utf-8");
        }

        public function query($sql){
            return $this->con->query($sql);
        }
    }