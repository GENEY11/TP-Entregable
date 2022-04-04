<?php
include ("Viaje.php");

/**
 * Funcion que muestra un menu de opciones
 * @return int
 */
function menu(){
    echo "Elija una de las siguientes opciones \n";
    echo "1 - Cargar informacion de un viaje \n";
    echo "2 - Modificar datos de un viaje \n";
    echo "3 - Ver datos de un viaje \n";
    echo "4 - Salir \n";
    $opcion = trim(fgets(STDIN));
    return $opcion;
}

/**
 * Funcion que cargar los datos de un viaje
 * @return Object
 */
function cargarViaje(){
    echo "Ingrese codigo del viaje :\n";
    $codigo = trim(fgets(STDIN));
    echo "Ingrese destino :\n";
    $lugar = trim(fgets(STDIN));
    echo "Ingrese cantidad maxima de pasajeros :\n";
    $cantidadMax = trim(fgets(STDIN));
    for($i=0;$i<$cantidadMax;$i++){
        echo "Ingrese un pasajero (Nombre) : \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese un pasajero (Apellido) : \n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese un pasajero (DNI) : \n";
        $dni = trim(fgets(STDIN));
        $pasajeros [$i] = ["Nombre"=>$nombre,"Apellido"=>$apellido,"DNI"=>$dni];
        echo "Desea ingresar un nuevo pasajero (Si/No)? \n";
        $resp = trim(fgets(STDIN));
        if($resp == "No" || $resp == "no" ){
            $i=$cantidadMax-1;
        }elseif($i==$cantidadMax-1){
            echo "No es posible ingresar otro pasajero, se ha completado el limite maximo. \n";
        }
    }
    $objViaje = new Viaje($codigo,$lugar,$cantidadMax,$pasajeros);
    return $objViaje;
}
/**
 * Menu que sirve para distinguir que desea modificar de un viaje
 * @return int
 */
function menuModificar(){
    echo "Elija una opcion : \n";
    echo "1 - Modificar codigo del viaje. \n";
    echo "2 - Modificar destino del viaje. \n";
    echo "3 - Modificar cantidad maxima del viaje. \n";
    echo "4 - Modificar datos de un pasajero. \n";
    echo "5 - Agregar datos de un pasajero. \n";
    echo "6 - Eliminar datos de un pasajero. \n";
    $resp = trim(fgets(STDIN));
    return $resp;
}

/**
 * Funcion que modifica el codigo del viaje
 * @param Object $objViajeCodigo
 * @return void
 */
function modificarCodigo ($objViajeCodigo){
    echo "Ingrese el nuevo codigo : \n";
    $nuevoCodigo = trim(fgets(STDIN));
    $objViajeCodigo->setCodigo($nuevoCodigo);
}

/**
 * Funcion que modifica el destino del viaje
 * @param Object $objViajeDestino
 * @return void
 */
function modificarDestino ($objViajeDestino){
    echo "Ingrese el nuevo destino : \n";
    $nuevoDestino = trim(fgets(STDIN));
    $objViajeDestino->setDestino($nuevoDestino);
}

/**
 * Funcion que modifica la cantidad maxima permitida
 * @param Object $objViajeCantidad
 * @return void
 */
function modificarCantidadMaxima ($objViajeCantidad){
    echo "Ingrese la nueva cantidad maxima : \n";
    $nuevaCantidad = trim(fgets(STDIN));
    $objViajeCantidad->setCantidad($nuevaCantidad);
}


/**
 * Funcion que modifica los datos de un pasajero
 * @param array $pasajeros
 * @return array
 */
function modificarPasajero($pasajeros){
    echo "Ingrese el dato del asiento donde se ubica el pasajero \n";
    $asiento = trim(fgets(STDIN));
    echo "Ingrese el nombre \n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido \n";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese el DNI \n";
    $dni = trim(fgets(STDIN));
    $reemplazo = ["Nombre"=>$nombre,"Apellido"=>$apellido,"DNI"=>$dni];
    $pasajeros [$asiento-1]=$reemplazo;
    //array_splice($pasajeros,$asiento-1,1,$reemplazo);
    return $pasajeros;
}

/**
 * Funcion que quita los datos de un pasajero
 * @param array $pasajeros
 * @return array
 */
function quitarPasajero($pasajeros){
    $esta = false;
    echo "Ingrese dni del pasajero que desea eliminar :";
    $dni = trim(fgets(STDIN));
    for($i=0;$i<count($pasajeros);$i++){
        if($dni==$pasajeros[$i]["DNI"]){
            array_splice($pasajeros,$i,1);
            $esta = true;
            $i = count($pasajeros)-1;
        }
        
    }
    if($esta == false){
        echo "El dni ingresado no se encuentra \n";
    }
    return $pasajeros;
}

do{
    $opcion = menu();
    switch($opcion){
        case 1:
            $objViaje=cargarViaje();
            break;
        case 2:
            $respuesta = menuModificar();
            switch($respuesta){
                case 1:
                    modificarCodigo($objViaje);
                    break;
                case 2:
                    modificarDestino($objViaje);
                    break;
                case 3:
                    modificarCantidadMaxima($objViaje);
                    break;
                case 4:
                    $pasaj = $objViaje->getPasajeros();
                    $nuevo = (modificarPasajero($pasaj));
                    $objViaje -> setPasajeros($nuevo);
                    break;
                case 5:
                    if($objViaje->verCupo()){
                        echo "Ingrese un pasajero (Nombre) : ";
                        $nombre = trim(fgets(STDIN));
                        echo "Ingrese un pasajero (Apellido) : ";
                        $apellido = trim(fgets(STDIN));
                        echo "Ingrese un pasajero (DNI) : ";
                        $dni = trim(fgets(STDIN));
                        $pasajero = ["Nombre"=>$nombre,"Apellido"=>$apellido,"DNI"=>$dni];
                        $objViaje -> agregarPasajero($pasajero);
                    
                    }else{
                        echo "No se pueden ingresar mas pasajeros \n";
                    }
                    break;
                case 6:
                    $pasajer = $objViaje->getPasajeros();
                    $nuevo = quitarPasajero($pasajer);
                    //Hacer una funcion en la clase que agrege un nuevo array de pasajeros
                    $objViaje -> setPasajeros($nuevo);
                    break;
            }
            break;
        case 3:
            echo $objViaje;
            break;
    }

}while($opcion!=4);
?>