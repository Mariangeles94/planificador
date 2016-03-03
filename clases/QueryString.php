<?php

class QueryString {
   private $params; //array para meter todos los parametros que llega a la clase
   private $borrado;

    function __construct() {
        $this->params = $_GET;
    }

    function get($nombre) {
        //devolver el valor del elemento que le estoy pasando
        return $this->params[$nombre];
    }

    function getParamsWithout($parametrosDelete){
        //elimina los parametros
        return $this->getParams(array(), $parametrosDelete);
    }

    function getParams($parametrosAdd = array(), $parametrosDelete = array()) {
        // Parametros a añadir y parametros a quitar y devuelve la cadena
        $copia = $this->params;
        foreach ($parametrosDelete as $parametro => $valor) {
            unset($copia[$parametro]);
        }
        foreach ($parametrosAdd as $parametro => $valor) {
            $copia[$parametro] = $valor;
        }
        $r="";
        foreach ($copia as $parametro => $valor) {
            $r .= $parametro . "=" . urlencode($valor) . "&"; //url encode para que los valores puedan viajar en la url
        }
        return substr($r, 0, -1);
        
    }

    function set($nombre, $valor) {
        //añadir nuevos parametros
        $this->params[$nombre] = $valor;
    }

    function delete($nombre) {
        //borra elementos del queryString
        unset($this->params[$nombre]);
    }

    function __toString() {
        //Devuelve el string de los parametros sin la interrogación, concatenados con &
        
    }
}
