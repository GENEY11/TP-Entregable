<?php
class ResponsableV{
    //Atributos
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    //Constructor
    public function __construct($nEmpleado,$nLicencia,$nom,$ape){
        $this -> numEmpleado = $nEmpleado;
        $this -> numLicencia = $nLicencia;
        $this -> nombre = $nom;
        $this -> apellido = $ape;
    }

    public function getNumEmpleado(){
        return $this->numEmpleado;
    }

    public function setNumEmpleado($numEmpleado){
        $this->numEmpleado = $numEmpleado;

        return $this;
    }

    public function getNumLicencia(){
        return $this->numLicencia;
    }

    public function setNumLicencia($numLicencia){
        $this->numLicencia = $numLicencia;

        return $this;
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

    public function __toString(){
        return $this -> getNumEmpleado() . $this -> getNumLicencia() . $this -> getNombre() . $this -> getApellido();
    }
}


?>