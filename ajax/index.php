<?php
require '../clases/Autocarga.php';
$bd = new DataBase();
$gestor = new ManageEvento($bd);
$id = Request::get("id");
$evento = $gestor->get($id);
$sesion = new Session();
$dias = ['L', 'M', 'X', 'J', 'V'];
$horas = ['8:15-9:15', '9:15-10:15', '10:15-11:15', '11:15-12:45', '12:45-13:45', '13:45-14:45'];
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>IES Zaidin Vergeles</title>
        <meta name="description" content="">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../estilo/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="../estilo/vendor/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../estilo/estilo.css">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="../js/scripts.js"></script>
    </head>
    <body>

        <!-- Modal -------------------------------------------------->
        <div class="modal fade" modal-form id="formularioinsertar" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <form id="formInsertar">
                            <label for="dia">Día</label>
                            <select name="dia" id="dia">
                                <option value='L'>Lunes</option>
                                <option value='M'>Martes</option>
                                <option value='X'>Miercoles</option>
                                <option value='J'>Jueves</option>
                                <option value='V'>Viernes</option>
                            </select>
                            <label for="hora">Hora</label>
                            <select name="hora" id="hora">
                                <option value='8:15-9:15'>8:15-9:15</option>
                                <option value='9:15-10:15'>9:15-10:15</option>
                                <option value='10:15-11:15'>10:15-11:15</option>
                                <option value='11:15-12:45'>11:15-12:45</option>
                                <option value='12:45-13:45'>12:45-13:45</option>
                                <option value='13:45-14:45'>13:45-14:45</option>
                            </select>

                        </form>
                        <div id="mensajeInsertar"></div>
                        <div class="modal-footer">
                            <button  id="btEventoInsertar" type="button" class="btn btn-default">Añadir evento</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>  

                </div>
            </div>
        </div>
        <!-- Modal content FIN--------------------------------------------------->  



        <div class="navbar navbar-inverse navbar-fixed-top" >
            <div class="container" >
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="nav" >

                    <form class="navbar-form navbar-right"> 
                        <div class="form-group">
                            <input type="text" name="user" id="login" value="" placeholder="Username" class="form-control">
                        </div>                        
                        <div class="form-group">
                            <input type="password"  name="password" id="clave" value="" placeholder="Password" class="form-control">
                        </div>
                        <button id="btlogin2" type="button" class="btn btn-success">acceder</button>
                        <button id="btlogout" type="button" class="ocultar btn btn-success" data-target="#formularioInsertar">Cerrar sesión</button>
                    </form>
                </div><!--/.navbar-collapse -->
            </div>
        </div>
        <div class="ocultar"  id="mensajeError"><p>Fallo al iniciar sesión.</p></div>
        <div class="jumbotron">
            <div class="container" >
                <div  id="divLogin" >
                    <h1>Bienvenido a IES Zaidin Vergeles</h1>
                </div>
                <div class="row ocultar" id="divRespuesta" >
                    <div id="box">
                        <main id="center">
                            <h1>Calendario Aula 108</h1> 
                            <div class="row" id="divEventos" >
                                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#formularioinsertar">Reservar</button>
                            </div><br/>
                            <table id="calendario" class="table1">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Lunes</th>
                                        <th scope="col">Martes</th>
                                        <th scope="col">Miercoles</th>
                                        <th scope="col">Jueves</th>
                                        <th scope="col">Viernes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($j = 0; $j < 6; $j++) { ?>
                                        <tr>
                                            <th scope="row"><?= $horas[$j] ?></th>
                                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                                <td id="<?= $dias[$i] . $horas[$j] ?>"></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </main>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr>
            <footer>
                <p>&copy; IES Zaidin Vergeles</p>
            </footer>
        </div>
        <script src="../js/vendor/jquery-1.11.1.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/ajax.js"></script>
        <script src="../js/codigoLogin.js"></script>
    </body>
</html>