<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$no = json_encode(array('eventos' => false));
if($sesion->isLogged()){
    $bd = new DataBase();
    $gestor = new ManageEvento($bd);
    $eventos = $gestor->getListJson();
    echo '{"eventos":' .$eventos.'}';
    $bd->close();
}else {
 echo $no;   
}