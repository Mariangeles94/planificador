<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('delete' => -1));
if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageEvento($bd);
    $id = Request::req("id");
    $r = $gestor->delete($id);
    $bd->close();
    $respuesta  = '{"delete":'. $r .'}';
    echo $respuesta;
}else{
    echo $no;
}