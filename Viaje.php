<?php
class Viaje {
    //Atributos
    private $codigo;
    private $destino;
    private $cantMaxima;
    private $pasajeros;

    //Constructor
    public function __construct($codigoViaje,$destinoViaje,$cantidadMaxima,$pasajerosViaje){
        $this->codigo = $codigoViaje;
        $this->destino = $destinoViaje;
        $this->cantMaxima = $cantidadMaxima;
        $this->pasajeros = $pasajerosViaje;
    }

    //Metodos de acceso
    public function getCodigo(){
        return $this->codigo;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCantMaxima(){
        return $this->cantMaxima;
    }

    public function getPasajeros(){
        return $this->pasajeros;
    }

    //Metodos de seteo
    public function setCodigo($codigoViaje){
        $this->codigo = $codigoViaje;
    }

    public function setDestino($destinoViaje){
        $this->destino = $destinoViaje;
    }

    public function setCantidad($cantidadMaxima){
        $this->cantMaxima = $cantidadMaxima;
    }

    public function setPasajeros($pasajerosViaje){
        $this->pasajeros = $pasajerosViaje;
    }
    

    //Otras funciones
    /**
     * Funcion que recibe el dato de un pasajero y lo agrega a la lista de pasajeros
     * @param array $pasajerosViaje
     */
    public function agregarPasajero($pasajerosViaje){
        $indice = count($this->getPasajeros());
        $this->pasajeros [$indice] = $pasajerosViaje;
    }
    
    /**
     * Funcion que verifica si el viaje llego a su limite de pasajeros
     * @return boolean
     */
    public function verCupo(){
        $verif = false;
        if(count($this->getPasajeros())<$this->getCantMaxima()){
            $verif = true;
        }
        return $verif;
    }
    /**
     * Funcion que trasforma el arreglo de pasajeros en un string para poder ser mostrado en el metodo toString
     * @return String
     */
    private function convertir(){
        
        $lista = "";
        $listaPasajeros = $this->getPasajeros();
        for($i=0;$i<count($listaPasajeros);$i++){
            foreach($listaPasajeros [$i] as $indice => $dato){
                $lista = $lista . $dato . " - ";
            }
            $lista = $lista . "\n";
        }
        return $lista;
    }

    //Metodo toString
    public function __toString(){
        return "Cogido : ".$this->getCodigo() . "\n" . "Destino : ". $this->getDestino() . "\n" . "Cantidad Maxima : ". $this->getCantMaxima() . "\n". "Lista de Pasajeros : \n" . $this->convertir();
    }
    
}



?>