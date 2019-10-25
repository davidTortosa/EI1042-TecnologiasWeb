<?php
include("./gestionBD.php");

function handler($pdo,$table)
{
    if (count($_REQUEST) < 7) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
     $query = "UPDATE `A_cliente` SET `nombre`=?,`apellidos`=?,`email`=?,`dni`=?,`clave`=?,`foto_file`=? WHERE `client_id`=? ";
                       
    echo $query;
    try { 
        $a=array($_REQUEST['userName'], $_REQUEST['apellido'], $_REQUEST['email'],$_REQUEST['dni'], $_REQUEST['passwd'],$_REQUEST['foto'], $_REQUEST['id']  );
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($_REQUEST['userName'], $_REQUEST['apellido'], $_REQUEST['email'],$_REQUEST['dni'], $_REQUEST['passwd'],$_REQUEST['foto'], $_REQUEST['id']  ));
        if (1>$a)echo "Error al actualizar";
        else echo "se ha actualizado correctamente";
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = "A_cliente";
handler( $pdo,$table);
?>