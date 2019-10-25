<?php
include("./gestionBD.php");



try {
    
    $table="A_cliente";
    creatablaUsuarios($pdo,$table);
    //  esta no me interesa   insertar($pdo,$table,'user3');
    $a=consultar($pdo,$table);
    if (1>$a) {echo "InCorrecto1";return ;}
    var_dump($a);
    //var_dump($a[count($a)-1]['client_id']);
    
        // obtener el cliente id pasado por url
    if(isset($_GET['client_id'])){

         if (is_array($a)) {
            print '<table><thead>';
            foreach ( array_keys($a[0])as $key) {
            echo "<th>", $key,"</th>";
        }
        print "</thead>";
        foreach ($a as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                echo "<td>", $val, "</td>";
            }
            print "</tr>";
        }
        print "</table>";
    }
        borrar($pdo,$table,$_GET["client_id"]);
    }
    else {
    borrar($pdo,$table,$a[count($a)-1]['client_id']);
    $a=consultar($pdo,$table);
    echo count($a);
    if (1>$a) echo "InCorrecto1";
	//unset ($pdo);
    }
 	} 
    catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    exit;
  }

 ?>