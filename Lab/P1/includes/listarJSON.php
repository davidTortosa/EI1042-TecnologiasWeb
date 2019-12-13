<?php
    //view_form.php

/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Listado de JSON
 * *
 * * @author Caterina Alarcón Marín <al364403@uji.es>  David Tortosa Escudero <al361904@uji.es>
 * * @copyright 2019 kitpru
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2

 * */

include("./gestionBD.php");
header('Content-type: application/json');


$table = "A_cliente";

try{ 
    $rows=consultar($pdo,$table);
    echo json_encode($datos);
}
catch (PDOException $e) {
echo "HA habido un fallito: " . $e->getMessage() . "\n";
exit;
}


 ?>