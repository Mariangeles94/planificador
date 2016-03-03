<?php

class Pager {
     private $registros, $rpp, $paginaActual;

    function __construct($registros, $rpp = Constant::NRPP, $paginaActual = 1) {
        if($rpp===null){
            $rpp = Constant::NRPP;
        }
        
        if($paginaActual === null){
            $paginaActual = 1;
        }
        
        $this->registros = $registros;
        $this->rpp = $rpp;
        $this->paginaActual = $paginaActual;
    }
        
    public function getRegistros() {
       return $this->registros;
    }

    public function getRpp() {
       return $this->rpp;
    }

    public function getPaginaActual() {
       return $this->paginaActual;
    }

    
    function getPrimera(){
        return 1;
    }

    function getAnterior(){
           return max(1, $this->paginaActual-1);
    }

    function getSelect($id, $name = null){
        if($name === null){
           $name = $id;
        }
        $array = array(10=>"10 rpp", 50=>"50 rpp", 100=>"100 rpp",);
        Util::getSelect($name, $array, $this->rpp, false, "", $id);
    }

    function getSiguiente(){
           return min($this->getPaginas(), $this->paginaActual+1);
    }

 /* function getUltima(){
        return $this->getPaginas();
    } */
    
    function getPaginas(){
        return ceil($this->registros / $this->rpp);
    }
    
    public function setRegistros($registros) {
        $this->registros = $registros;
    }

    public function setRpp($rpp) {
        $this->rpp = $rpp;
    }

    public function setPaginaActual($paginaActual) {
        $this->paginaActual = $paginaActual;
    }

    function getEnlacesPaginas($rango, $enlace, $nombreParametroPagina, $pagina = 0){

    }
}
