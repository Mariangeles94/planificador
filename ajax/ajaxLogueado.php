<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$ok = json_encode(array('login' => true, "usuario" =>$sesion->getUser()));
$no = json_encode(array('login' => false));

if($sesion->isLogged()){
    echo $ok;
}else{
    echo $no;
}