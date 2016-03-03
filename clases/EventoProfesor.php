<?php
class EventoProfesor {
   private $evento, $profesor;
   function __construct($evento = null, $profesor = null) {
       $this->evento = $evento;
       $this->profesor = $profesor;
   }
   function getEvento() {
       return $this->evento;
   }

   function getProfesor() {
       return $this->profesor;
   }

   function setEvento($evento) {
       $this->evento = $evento;
   }

   function setProfesor($profesor) {
       $this->profesor = $profesor;
   }


}
