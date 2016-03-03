<?php

class Profesor {

    private $id, $nombre, $clave, $apellidos, $prioridad, $materia;

    function __construct($id = null, $nombre = null, $clave=null, $apellidos = null, $prioridad = null, $materia = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->apellidos = $apellidos;
        $this->prioridad = $prioridad;
        $this->materia = $materia;
    }
    function getClave() {
        return $this->clave;
    }

    function getPrioridad() {
        return $this->prioridad;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }

        function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

   

    function getMateria() {
        return $this->materia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
    function setMateria($materia) {
        $this->materia = $materia;
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
