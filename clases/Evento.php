<?php

class Evento {

    private $id, $descripcion, $dia, $hora, $cod_profesor;

    function __construct($id = null, $descripcion = null, $dia = null, $hora = null, $cod_profesor = null) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->dia = $dia;
        $this->hora = $hora;
        $this->cod_profesor = $cod_profesor;
    }

    function getId() {
        return $this->id;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getDia() {
        return $this->dia;
    }

    function getHora() {
        return $this->hora;
    }

    function getCod_profesor() {
        return $this->cod_profesor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setDia($dia) {
        $this->dia = $dia;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setCod_profesor($cod_profesor) {
        $this->cod_profesor = $cod_profesor;
    }

    function set($valores, $inicio = 0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }
    function getJson(){
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":"' . $valor . '",';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

    public function __toString() {
        $r = '';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r;
    }

    function read() {
        foreach ($this as $key => $valor) {
            $this->$key = Request::req($key);
        }
    }

}
