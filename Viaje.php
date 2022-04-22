<?php
class Viaje {
    //Atributos
    private $codigo;
    private $destino;
    private $cantMaxima;
    private $objPasajeros;
    private $objResponsableV;

    //Constructor
    public function __construct($codigoViaje,$destinoViaje,$cantidadMaxima,$pasajerosViaje,$responsableViaje){
        $this->codigo = $codigoViaje;
        $this->destino = $destinoViaje;
        $this->cantMaxima = $cantidadMaxima;
        $this->objPasajeros = $pasajerosViaje;
        $this->objResponsableV = $responsableViaje;
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

    public function getObjPasajeros(){
        return $this->objPasajeros;
    }

    public function getObjResponsableV(){
        return $this->objResponsableV;
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

    public function setObjPasajeros($pasajerosViaje){
        $this->objPasajeros = $pasajerosViaje;
    }

    public function setObjResponsableV($responsableViaje){
        $this->objResponsableV = $responsableViaje;
    }
    

    //Otras funciones
    /**
     * Funcion que recibe el dato de un pasajero y lo agrega a la lista de pasajeros
     * @param Object $pasajerosViaje
     * @param int $documento
     */
    public function agregarPasajero($pasajerosViaje,$documento){
        $verif=false;
        $indice = count($this->getObjPasajeros());
        for($i=0;$i<$indice;$i++){
            $pasajero = $this->getObjPasajeros();
            if($pasajero [$i] -> getDni() == $documento){
                $verif = true;
                $i = $indice - 1;
            }
        }
        if($verif==false){
        $this->objPasajeros [$indice] = $pasajerosViaje;
        }
    }
    /**
     *Funcion que quita un pasajero
     * @return boolean 
     */
    public function quitarPasaj($documento){
        $esta = false;
        $pasaj = $this -> getObjPasajeros();

        for($i=0;$i<count($pasaj);$i++){
            $docum = $pasaj[$i] -> getDni();
            if($documento == $docum){
                $esta=true;
                array_splice($pasaj,$i,1);
                $i=count($pasaj)-1;
            }
            
        }
        $this ->setObjPasajeros($pasaj);

        return $esta;
    }
    
    /**
     * Funcion que verifica si el viaje llego a su limite de pasajeros
     * @return boolean
     */
    public function verCupo(){
        $verif = false;
        if(count($this->getObjPasajeros())<$this->getCantMaxima()){
            $verif = true;
        }
        return $verif;
    }
    /**
     * Funcion que modifica el dato de un pasajero
     * @param Object $pasajero
     * @param int $asiento
     */
    public function modificarPasajero ($lugar,$nom,$ape,$dni,$tel){
        $listaP = $this -> getObjPasajeros();
        // $listaP [$lugar] = $this->setObjPasajeros($pasajero);
        $listaP [$lugar-1] -> setNombre($nom);
        $listaP [$lugar-1] -> setApellido($ape);
        $listaP [$lugar-1] -> setDni($dni);
        $listaP [$lugar-1] -> setTelefono($tel);
    }
    /**
     * Funcion que trasforma el arreglo de pasajeros en un string para poder ser mostrado en el metodo toString
     * @return String
     */
    private function convertir(){
        
         $lista = "";
         $listaPasajeros = $this->getObjPasajeros();
         for($i=0;$i<count($listaPasajeros);$i++){
            $lista = $lista . $listaPasajeros [$i] -> getNombre() . " / ". $listaPasajeros [$i] -> getApellido() . " / " . $listaPasajeros [$i] -> getDni() . " / " . $listaPasajeros [$i] -> getTelefono() . "\n";
         }
         return $lista;
    }
    /**
     * Funcion que transforma el responsable del viaje en un String
     * @return String
     */
    private function pasarAString(){
        $objResp = $this->getObjResponsableV();
        $cadena = $objResp -> getNumEmpleado() . " / " . $objResp -> getNumLicencia() . " / " . $objResp -> getNombre() . " / " . $objResp -> getApellido() . "\n";

        return $cadena;
    }

    //Metodo toString
    public function __toString(){
        return "Cogido : ".$this->getCodigo() . "\n" . "Destino : ". $this->getDestino() . "\n" . "Cantidad Maxima : ". $this->getCantMaxima() . "\n". "Responsable del viaje : \n". $this->pasarAString()  ."Lista de Pasajeros : \n" . $this -> convertir();
    }
    
}
