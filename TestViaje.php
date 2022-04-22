<?php
include("Viaje.php");
include("Pasajero.php");
include("ResponsableV.php");

/**
 * Funcion que muestra un menu de opciones
 * @return int
 */
function menu()
{
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
function cargarViaje()
{
    echo "Ingrese codigo del viaje :\n";
    $codigo = trim(fgets(STDIN));
    echo "Ingrese destino :\n";
    $lugar = trim(fgets(STDIN));
    echo "Ingrese el numero de empleado del responsable del viaje : \n";
    $numeroEmpleado = trim(fgets(STDIN));
    echo "Ingrese el numero de licencia : \n";
    $numeroLicencia = trim(fgets(STDIN));
    echo "Ingrese el nombre : \n";
    $nombreResponsable = trim(fgets(STDIN));
    echo "Ingrese el apellido : \n";
    $apellidoResponsable = trim(fgets(STDIN));
    $responsable = new ResponsableV($numeroEmpleado, $numeroLicencia, $nombreResponsable, $apellidoResponsable);
    echo "Ingrese cantidad maxima de pasajeros :\n";
    $cantidadMax = trim(fgets(STDIN));
    for ($i = 0; $i < $cantidadMax; $i++) {
        echo "Ingrese un pasajero (Nombre) : \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese un pasajero (Apellido) : \n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese un pasajero (DNI) : \n";
        $dni = trim(fgets(STDIN));
        echo "Ingrese el telefono";
        $telefono = trim(fgets(STDIN));
        $pasajeros[$i] = new Pasajero($nombre, $apellido, $dni, $telefono);
        echo "Desea ingresar un nuevo pasajero (Si/No)? \n";
        $resp = trim(fgets(STDIN));
        if ($resp == "No" || $resp == "no") {
            $i = $cantidadMax - 1;
        } elseif ($i == $cantidadMax - 1) {
            echo "No es posible ingresar otro pasajero, se ha completado el limite maximo. \n";
        }
    }
    $objViaje = new Viaje($codigo, $lugar, $cantidadMax, $pasajeros, $responsable);
    return $objViaje;
}
/**
 * Menu que sirve para distinguir que desea modificar de un viaje
 * @return int
 */
function menuModificar()
{
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
function modificarCodigo($objViajeCodigo)
{
    echo "Ingrese el nuevo codigo : \n";
    $nuevoCodigo = trim(fgets(STDIN));
    $objViajeCodigo->setCodigo($nuevoCodigo);
}

/**
 * Funcion que modifica el destino del viaje
 * @param Object $objViajeDestino
 * @return void
 */
function modificarDestino($objViajeDestino)
{
    echo "Ingrese el nuevo destino : \n";
    $nuevoDestino = trim(fgets(STDIN));
    $objViajeDestino->setDestino($nuevoDestino);
}

/**
 * Funcion que modifica la cantidad maxima permitida
 * @param Object $objViajeCantidad
 * @return void
 */
function modificarCantidadMaxima($objViajeCantidad)
{
    echo "Ingrese la nueva cantidad maxima : \n";
    $nuevaCantidad = trim(fgets(STDIN));
    $objViajeCantidad->setCantidad($nuevaCantidad);
}


/**
 * Funcion que modifica los datos de un pasajero
 * @param array $pasajeros
 * @return array
 */
function modifPasajero($objViajePasaj)
{
    echo "Ingrese el dato del asiento donde se ubica el pasajero \n";
    $asiento = trim(fgets(STDIN));
    echo "Ingrese el nombre \n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el apellido \n";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese el DNI \n";
    $dni = trim(fgets(STDIN));
    echo "Ingrese el telefono : \n";
    $telefono = trim(fgets(STDIN));
    $objViajePasaj->modificarPasajero($asiento, $nombre, $apellido, $dni, $telefono);
}

/**
 * Funcion que quita los datos de un pasajero
 * @param array $pasajeros
 * @return array
 */
function quitarPasajero($objViaje)
{
    echo "Ingrese dni del pasajero que desea eliminar :";
    $dni = trim(fgets(STDIN));
    $verif = $objViaje->quitarPasaj($dni);
    
    if ($verif == false) {
        echo "El dni ingresado no se encuentra \n";
    }
}
$objRespV = new ResponsableV(1, 1234, "Miguel", "Perez");
$objPasaj[0] = new Pasajero("Maxi", "Sanchez", 38254110, 4422536);
$objPasaj[1] = new Pasajero("Carla", "Garcia", 35222111, 44585856);
$objPasaj[2] = new Pasajero("Carlos", "Marquez", 36554211, 4478956);
$objPasaj[3] = new Pasajero("Maria", "Gonzales", 40155222, 4478956);

$objViaje = new Viaje(11, "Bariloche", 32, $objPasaj, $objRespV);

do {
    $opcion = menu();
    switch ($opcion) {
        case 1:
            $objViaje = cargarViaje();
            break;
        case 2:
            $respuesta = menuModificar();
            switch ($respuesta) {
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
                    modifPasajero($objViaje);
                    break;
                case 5:
                    if ($objViaje->verCupo()) {
                        echo "Ingrese un pasajero (Nombre) : ";
                        $nombre = trim(fgets(STDIN));
                        echo "Ingrese un pasajero (Apellido) : ";
                        $apellido = trim(fgets(STDIN));
                        echo "Ingrese un pasajero (DNI) : ";
                        $dni = trim(fgets(STDIN));
                        echo "Ingrese el telefono : ";
                        $telefono = trim(fgets(STDIN));
                        $pasajero = new Pasajero($nombre, $apellido, $dni, $telefono);
                        $objViaje->agregarPasajero($pasajero, $dni);
                    } else {
                        echo "No se pueden ingresar mas pasajeros \n";
                    }
                    break;
                case 6:
                    quitarPasajero($objViaje);
                    break;
            }
            break;
        case 3:
            echo $objViaje;
            break;
    }
} while ($opcion != 4);
