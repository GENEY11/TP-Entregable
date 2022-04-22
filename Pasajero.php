<?php

class Pasajero{
    //Atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    //Constructor
    public function __construct($nom,$ape,$numDocumento,$tel){
        $this -> nombre = $nom;
        $this -> apellido = $ape;
        $this -> dni = $numDocumento;
        $this -> telefono = $tel;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;

        return $this;
    }

    public function getDni(){
        return $this->dni;
    }

    public function setDni($dni){
        $this->dni = $dni;

        return $this;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;

        return $this;
    }

    public function __toString(){
        return $this -> getNombre() . $this -> getApellido() . $this -> getDni() . $this -> getTelefono();
    }
    

    
}
?>