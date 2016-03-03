(function () {
    var misEventos = [];
    var btEventoInsertar, btLogin, btlogout;
    btEventoInsertar = document.getElementById("btEventoInsertar");
    btLogin = document.getElementById("btlogin2");
    btlogout = document.getElementById("btlogout");
    login = document.getElementById("login");
    clave = document.getElementById("clave");
    var divLogin = document.getElementById('divLogin');
    var divRespuesta = document.getElementById('divRespuesta');
    var divEventos = document.getElementById('divEventos');
    var mensaje = document.getElementById("mensajeError");
    var mensajeInsertar = document.getElementById("mensajeInsertar");
    var formularioinsertar = $("#formularioinsertar");
    var nombre = document.getElementById("nombre");
    var apellidos = document.getElementById("apellidos");
    var materia = document.getElementById("materia");

    var hora = document.getElementById("hora");
    var dia = document.getElementById("dia");
    var calendario = document.getElementById("calendario");

    formularioinsertar.on('hidden.bs.modal', function () {
    });

    //Insertamos nuevo evento 
    btEventoInsertar.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.insert > 0) { //Mensaje de exito
                formularioinsertar.modal("toggle");
                var registro = {
                    "id": respuesta.insert,
                    "nombre": login.value,
                    "dia": dia.options[dia.selectedIndex].value,
                    "hora": hora.options[hora.selectedIndex].value
                };
                misEventos.push(registro);
                peticionEventos();
               
            } else {//Mensaje de error*/
                mensajeInsertar.textContent = "Algo falla al insertar el evento";
            }
        };
        var ajax = new Ajax();
        var datoNombre = encodeURI(login.value);
        var datoDia = encodeURI(dia.options[dia.selectedIndex].value);
        var datoHora = encodeURI(hora.options[hora.selectedIndex].value);
        ajax.setUrl("ajaxEventoInsert.php?nombre=" + datoNombre + "&dia=" + datoDia + "&hora=" + datoHora);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();

    }, false);

    btLogin.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (respuesta.login) {
                divLogin.classList.add("ocultar");
                divRespuesta.classList.remove("ocultar");
                btLogin.classList.add("ocultar");
                btlogout.classList.remove("ocultar");
                mensaje.classList.add("ocultar");
                peticionEventos();
            } else {
                mensaje.classList.remove("ocultar");
                divLogin.classList.remove("ocultar");
               divRespuesta.classList.add("ocultar");
            }
        };
        var ajax = new Ajax();
        var datoLogin = encodeURI(login.value);
        var datoClave = encodeURI(clave.value);
        ajax.setUrl("ajaxLogin.php?login=" + datoLogin + "&clave=" + datoClave);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }, false);

    btlogout.addEventListener("click", function () {
        var procesarRespuesta = function (respuesta) {
            if (!respuesta.login) {
                divLogin.classList.remove("ocultar");
                divRespuesta.classList.add("ocultar");
                btLogin.classList.remove("ocultar");
                btlogout.classList.add("ocultar");
                mensaje.classList.add("ocultar");
                login.value="";
                clave.value="";
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxLogout.php");
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    }, false);

    var procesarRespuesta = function (respuesta) {
        if (respuesta.login) {
            divLogin.classList.add("ocultar");
            divRespuesta.classList.remove("ocultar");
            btLogin.classList.add("ocultar");
            btlogout.classList.remove("ocultar");
            peticionEventos();
        }
    };
    var ajax = new Ajax();
    ajax.setUrl("ajaxLogueado.php");
    ajax.setRespuesta(procesarRespuesta);
    ajax.doPeticion();


    var peticionEventos = function () {
        var procesarRespuesta = function (respuesta) {
            misEventos = respuesta.eventos;//Es importante
            if (respuesta.eventos) {
                refrescoEventos(respuesta);
            } else {
                
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxEventos.php");
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    };
    function borrarElementoMisEventos(listaEventos, id){
        for (var i = 0; i < listaEventos.eventos.length; i++) {
            if(listaEventos.eventos[i].id == id){
                listaEventos.eventos[i].splice(i,1);//elimina un elemento
            }
        }
    }
    
    function borrarElemento(id){
        var procesarRespuesta = function (respuesta) {
            if(respuesta.delete > 0){
                //borrar del arra el elemento y refrescar
                borrarElementoMisEventos(respuesta, id);
                peticionEventos();
            }else{
                alert("La ciudad no se ha podido borrar");
            }
        };
        var ajax = new Ajax();
        ajax.setUrl("ajaxEventoDelete.php?id="+id);
        ajax.setRespuesta(procesarRespuesta);
        ajax.doPeticion();
    
    }
    function refrescoEventos(listaEventos) {
        var enlace;
        for (var i = 0; i < listaEventos.eventos.length; i++) {
            var idEvento = listaEventos.eventos[i].id;
            var dia = listaEventos.eventos[i].dia;
            var hora = listaEventos.eventos[i].hora;
            var asignatura = listaEventos.eventos[i].descripcion;
            var calendario = document.getElementById(dia + hora);
            calendario.textContent = "Reservado para " + asignatura ;
            calendario.style.backgroundColor = "white";
            calendario.style.borderColor = "#ccc";
//            enlace = document.createElement("a");
//            enlace.className = "borrar";
//            enlace.textContent = "borrar"
//            enlace.addEventListener("click", function(event) {
//                 event.preventDefault();
//            
//                borrarElemento(idEvento);
//            
//        }, false);
//           calendario.appendChild(enlace);
        }
    }




})();