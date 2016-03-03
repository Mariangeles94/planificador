<?php
require '../clases/AutoCarga.php';
header('Contet-Type: application/json');
$sesion = new Session();
$bd = new DataBase();
$gestorProfesor = new ManageProfesor($bd);
$ok = json_encode(array('login' => true));
$no = json_encode(array('login' => false));
$login = Request::req("login");
$clave = Request::req("clave");
$usuario = $gestorProfesor->get($login);
if($login != null && $clave != null){
    if($usuario->getNombre() === $login && $usuario->getClave() === $clave){
        echo $ok;
        $sesion->setUser($usuario);
        $sesion->set("_usuario", $login);
}else{
    echo $no;
    $sesion->destroy();
}
}else{
    echo $no;
    $sesion->destroy();
}