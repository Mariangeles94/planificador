<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$bd = new DataBase();
$sesion = new Session();
$gestorProfesor = new ManageProfesor($bd);
$gestorEvento = new ManageEvento($bd);
$nombre = Request::req("nombre");
$usuario = $gestorProfesor->get($nombre);
$dia = Request::req("dia");
$hora = Request::req("hora");
$no = json_encode(array('insert' => -1));

if($sesion->isLogged()){
    $cod_profesor = $usuario->getId();
    $descripcion = $usuario->getMateria();
    $evento = new Evento(null, $descripcion, $dia, $hora, $cod_profesor);
    $r = $gestorEvento->insert($evento);
    $bd->close();
    $respuesta  = json_encode(array('insert' => $r));
    echo $respuesta;
}else{
    echo $no;
}

