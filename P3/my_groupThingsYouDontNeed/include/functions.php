<?php
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author aterina Alarcón Marín, David Tortosa Escudero <al364403@uji.es>  <al361904@uji.es>
 * *
 * * @copyright 2019 kitpru
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 3
 * */

 

//header('Content-type: application/json');
//Estas 2 instrucciones me aseguran que el usuario accede a través del WP. Y no directamente
if ( ! defined( 'WPINC' ) ) exit;

if ( ! defined( 'ABSPATH' ) ) exit;

//Funcion instalación plugin. Crea tabla
function TYDN_CrearT($tabla){
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query="CREATE TABLE IF NOT EXISTS $tabla (person_id INT(11) NOT NULL AUTO_INCREMENT, nombre VARCHAR(100),  email VARCHAR(100),  foto_file VARCHAR(25), clienteMail VARCHAR(100),  PRIMARY KEY(person_id))";
    $consult = $MP_pdo->prepare($query);
    $consult->execute (array());
}


//CONTROLADOR
//Esta función realizará distintas acciones en función del valor del parámetro
//$_REQUEST['proceso'], o sea se activara al llamar a url semejantes a 
//https://host/wp-admin/admin-post.php?action=my_datos&proceso=r 
 
function TYDN_my_datos()
{ 
    global $user_ID , $user_email,$table, $fotoURL; //FOTOURL

    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    wp_get_current_user();
    if ('' == $user_ID) {
                //no user logged in
                exit;
    }
    
    
    
    if (!(isset($_REQUEST['action'])) or !(isset($_REQUEST['proceso']))) { print("Opciones no correctas $user_email"); exit;}

    ?> 
    <head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
    </head>
    <?php
    if (!(isset($_REQUEST['partial']))) {
       get_header();
    }
    //get_header();
    echo '<div class="wrap">';

    switch ($_REQUEST['proceso']) {
        case "registro":
            $MP_user=null; //variable a rellenar cuando usamos modificar con este formulario
            include_once(plugin_dir_path(__FILE__) . '../templates/registro.php');
            break;

        case "registrar":
            if (count($_REQUEST) < 3) {
                print ("No has rellenado el formulario correctamente");
                return;
            }
            
            $query = "INSERT INTO $table (nombre, email,clienteMail, foto_file) VALUES (?,?,?,?)";    


            $foto="";
            $route = realpath(dirname(getcwd()));

            if(array_key_exists('foto', $_FILES) && $_POST['email']) {
              $foto = $route."/wp-content/fotillos/".$_FILES['foto']['name'];
               if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto))
                 { echo "foto subida con éxito";}
        
        }
   

            $a=array($_REQUEST['userName'], $_REQUEST['email'],$_REQUEST['clienteMail'], $_FILES['foto']['name']);
            //HASTA AQUI FOTO?
            //$pdo1 = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=my_datosTYDN&proceso=listar'));
            break;

        case "listar":
            //Listado amigos o de todos si se es administrador.
            $a=array();
            if (current_user_can('administrator')) {$query = "SELECT     * FROM       $table ";}
            else {$campo="clienteMail";
                $query = "SELECT     * FROM  $table      WHERE $campo =?";
                $a=array( $user_email);
 
            }


            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($rows)) {/* Creamos un listado como una tabla HTML */
                print '<div><table><th>';
                foreach ( array_keys($rows[0])as $key) {
                    echo "<td>", $key,"</td>";
                }
                print "</th>";
                foreach ($rows as $row) {
                    print "<tr>";
                    $i=0;
                    $id='';
                    foreach ($row as $key => $val) {
                        if($i==0 && $val!=null){
                            $id=$val;
                        }
                        
                        if($i==3 && $val!=null){
                            $src = '/wp-content/fotillos/'.$val;
                            echo  "<td><img src=$src border='0' width='100' height='100'></td>";
                        }else{
                        echo "<td>", $val, "</td>";
                        }
                        
                        $i++;
                    }
                    echo "<td><a class='btn peach-gradient' href='admin-post.php?action=my_datosTYDN&proceso=modificar&id=$id'> Modificar </a></td>";
                    print "</tr>";
                }
                print "</table></div>";
            } 
            else{echo "No existen valores";} 
            break;

            case "modificar":
                include_once(plugin_dir_path(__FILE__) . '../templates/update.php');
            break;

            case "modificar_usuario":
                //TODO : ACABAR
                $id = $_REQUEST['person_id'];

                $query="";
                $arr=array();

                if($_FILES['foto']['name']){

                    $query = "UPDATE $table SET nombre = ? , email = ?, foto_file=? WHERE person_id =?";
                    $arr=array($_REQUEST['userName'], $_REQUEST['email'], $_FILES['foto']['name'], $id);
                    
                    $foto="";
                    $route = realpath(dirname(getcwd()));

                    $foto = $route."/wp-content/fotillos/".$_FILES['foto']['name'];
                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto))
                      { echo "foto subida con éxito";}

                } else {
                    
                    $query = "UPDATE $table SET nombre = ? , email = ? WHERE person_id =?";
                    $arr=array($_REQUEST['userName'], $_REQUEST['email'], $id);
                }
                
                $consult = $MP_pdo->prepare($query);
                $arr=$consult->execute($arr);
                $rows=$consult->fetchAll(PDO::FETCH_ASSOC);

                wp_redirect(admin_url( 'admin-post.php?action=my_datosTYDN&proceso=listar'));
                 

            break;
            
            case "listarJSON":
                $a=array();
                    if (current_user_can('administrator')) {$query = "SELECT     * FROM       $table ";}
                    else {$campo="clienteMail";
                        $query = "SELECT     * FROM  $table      WHERE $campo =?";
                        $a=array( $user_email);
         
                    }
                    $consult = $MP_pdo->prepare($query);
                    $a=$consult->execute($a);
                    $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
                if (!(isset($_REQUEST['partial']))) {
                    echo json_encode($rows);
                }
                else{
                    header('Content-type: application/json');
                    echo json_encode($rows);
                }
                
                
            break;

        default:
            print "Opción no correcta";
        
    }
    echo "</div>";
    // get_footer ademas del pie de página carga el toolbar de administración de wordpres si es un 
    //usuario autentificado, por ello voy a borrar la acción cuando no es un administrador para que no aparezca.
    if (!current_user_can('administrator')) {

        // for the admin page
        remove_action('admin_footer', 'wp_admin_bar_render', 1000);
        // for the front-end
        remove_action('wp_footer', 'wp_admin_bar_render', 1000);
    }
    if (!(isset($_REQUEST['partial']))) {
       get_footer();
       echo "</div>";
   }

    //get_footer();
}


//add_action('admin_post_nopriv_my_datos', 'my_datos');
//add_action('admin_post_my_datos', 'my_datos'); //no autentificados
?>
