<?php

class ManageEvento {

    private $bd = null;
    private $tabla = "evento";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($id) {
        $parametros = array();
        $parametros['id'] = $id;
        $this->bd->select($this->tabla, "*", "id=:id", $parametros);
        $fila = $this->bd->getRow();
        $evento = new Evento();
        $evento->set($fila);
        return $evento;
    }

    function delete($id) {
        $parametros = array();
        $parametros['id'] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteEventos($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Evento $evento) {
        return $this->delete($evento->getId());
    }

    function set(Evento $evento) {
        $parametrosSet = array();
        $parametrosSet['descripcion'] = $evento->getDescripcion();
        $parametrosSet['dia'] = $evento->getDia();
        $parametrosSet['hora'] = $evento->getHora();
        $parametrosSet['cod_profesor'] = $evento->getCod_profesor();

        $parametrosWhere = array();
        $parametrosWhere['id'] = $evento->getId();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Evento $evento) {
        $parametrosSet = array();
        $parametrosSet['descripcion'] = $evento->getDescripcion();
        $parametrosSet['dia'] = $evento->getDia();
        $parametrosSet['hora'] = $evento->getHora();
        $parametrosSet['cod_profesor'] = $evento->getCod_profesor();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constant::NRPP, $condicion = "1=1", $parametros = array()) {
        $ordenPredeterminado = "$orden, dia, id";
        if ($orden === "" || $orden === null) {
            $ordenPredeterminado = "dia, id";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", $condicion, $parametros, $ordenPredeterminado, "$registroInicial, $nrpp");
        $r = array();
        while ($fila = $this->bd->getRow()) {
            $evento = new Evento();
            $evento->set($fila);
            $r[] = $evento;
        }
        return $r;
    }


    function getListJson($pagina = 1, $orden = "", $nrpp = Constant::NRPP, $condicion = "1=1", $parametros = array()) {
        $list = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($list as $objeto) {
            $r .= $objeto->getJson() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "id, dia", array(), "id");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

}
