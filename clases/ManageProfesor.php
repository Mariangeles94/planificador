<?php

class ManageProfesor {
    private $bd = null;
    private $tabla = "profesor";
    
    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }
    
    function get($nombre){
        $parametros = array();
        $parametros['nombre'] = $nombre;
        $this->bd->select($this->tabla, "*", "nombre=:nombre", $parametros);
        $fila=$this->bd->getRow();
        $profesor = new Profesor();
        $profesor->set($fila);
        return $profesor;
    }
    
    function delete($id){
        $parametros = array();
        $parametros['id'] = $id;
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function deleteProfesor($parametros){
        return $this->bd->delete($this->tabla, $parametros);
    }
    
    function erase(Profesor $profesor){
        return $this->delete($profesor->getId());
    }
    
    function set(Profesor $profesor){
        $parametrosSet=array();
        $parametrosSet['nombre']=$profesor->getNombre();
        $parametrosSet['clave'] = $profesor->getClave();
        $parametrosSet['apellidos']=$profesor->getApellidos();
        $parametrosSet['prioridad']=$profesor->getPrioridad();
        $parametrosSet['materia']=$profesor->getMateria();
        
        $parametrosWhere = array();
        $parametrosWhere['id'] = $profesor->getId();
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }
    
    function insert(Profesor $profesor){
        $parametrosSet=array();
        $parametrosSet['nombre']=$profesor->getNombre();
        $parametrosSet['clave'] = $profesor->getClave();
        $parametrosSet['apellidos']=$profesor->getApellidos();
        $parametrosSet['prioridad']=$profesor->getPrioridad();
        $parametrosSet['materia']=$profesor->getMateria();
        
        return $this->bd->insert($this->tabla, $parametrosSet);
    }
    
    function getList($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        $ordenPredeterminado = "$orden, nombre, id";
        if($orden==="" || $orden === null){
            $ordenPredeterminado = "nombre, id";
        }
         $registroInicial = ($pagina-1)*$nrpp;
         $this->bd->select($this->tabla, "*", $condicion, $parametros , $ordenPredeterminado , "$registroInicial, $nrpp");
         $r=array();
         while($fila =$this->bd->getRow()){
             $profesor = new Profesor();
             $profesor->set($fila);
             $r[]=$profesor;
         }
         return $r;
    }
    
    function getListJson($pagina=1, $orden="", $nrpp=Constant::NRPP, $condicion ="1=1", $parametros = array()){
        $lista = $this->getList($pagina, $orden, $nrpp, $condicion, $parametros);
        $r = "[ ";
        foreach ($lista as $objeto){
            $r .= $objeto->getJson() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }
    
     function getValuesSelect(){
        $this->bd->query($this->tabla, "id, nombre", array(), "id");
        $array = array();
        while($fila=$this->bd->getRow()){
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }
    
    function count($condicion="1 = 1", $parametros = array()){
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

}
