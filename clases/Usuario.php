<?php

class Usuario {
        private $login, $clave;
        
        function __construct($login, $clave) {
            $this->login = $login;
            $this->clave = $clave;
        }

        public function getLogin() {
            return $this->login;
        }

        public function getClave() {
            return $this->clave;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function setClave($clave) {
            $this->clave = $clave;
        }
        
     public function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' .$indice . '":' . json_encode($valor). ','; //Se codifican algunos caracteres
        }
        $r = substr($r, 0,-1);
        $r .='}';
        return $r;
    }
}

