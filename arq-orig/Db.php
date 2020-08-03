<?php

    class Db {
        
        private $con;
        
        public function __construct(){
            $this->con = new mysqli("localhost", "root", "", "cep");
            $this->con->set_charset("utf8");
        }
        
        public function query($sql){
            return $this->con->query($sql);
        }
    
    }