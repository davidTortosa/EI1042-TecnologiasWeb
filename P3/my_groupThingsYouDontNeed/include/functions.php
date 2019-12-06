<?php
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author  Lola <dllido@uji.es> 
 * * @copyright 2018 Lola
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 * */


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

function TYDN_Register_Form($MP_user , $user_email)
{//formulario registro amigos de $user_email
    ?>

    <h1 class="Kawaii">Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=my_datosTYDN&proceso=registrar" method="POST" enctype="multipart/form-data">
        <label for="clienteMail" class="labelTYDN">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" class="inputTYDN" value="<?php print $user_email?>"
        readonly />
        <br/>
        <legend class="legendTYDN">Datos básicos</legend>
        <label class="labelTYDN" for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid inputTYDN" size="20" maxlength="25" value="<?php print $MP_user["userName"] ?>"
        placeholder="Miguel Cervantes" />
        <br/>
        <label class="labelTYDN" for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid inputTYDN" size="20"  maxlength="25" value="<?php print $MP_user["email"] ?>"
        placeholder="kiko@ic.es" />
        <br/>
        <br/>
        <!-- CAMPO FOTO -->
        <img id="img_foto" src="" width="100" height="100">
        <input type="file" name="foto" id="foto" class="item_requerid inputTYDN" size="20" maxlength="25" value="<?php print $MP_user["foto"] ?>"
        placeholder="Lucas" />
        <br/>
        <br/>
        <input type="submit" class="paracetamol" value="Enviar">
        <input type="reset" class="ibuprofeno" value="Deshacer">
    </form>
    <script type="text/javascript"  defer charset="utf-8">

function mostrarFoto(file, imagen) {
    //carga la imagen de file en el elemento src imagen
        var reader = new FileReader();
        reader.addEventListener("load", function () {
            imagen.src = reader.result;
        });
        reader.readAsDataURL(file);
    }

    function ready() {
        var fichero = document.querySelector("#foto");
        var imagen  = document.querySelector("#img_foto");
    //escuchamos evento selección nuevo fichero.
        fichero.addEventListener("change", function (event) {
            mostrarFoto(this.files[0], imagen);
        });
    }

    ready();
</script>
<?php
}

//CONTROLADOR
//Esta función realizará distintas acciones en función del valor del parámetro
//$_REQUEST['proceso'], o sea se activara al llamar a url semejantes a 
//https://host/wp-admin/admin-post.php?action=my_datos&proceso=r 
function hook_css() {
    ?>
        <style>
            .fom_usuario {
               // background-image : url(https://media1.tenor.com/images/9ee571803fdbea520d723280a6c2c573/tenor.gif);
                width:100%;
                height:100%;
            }
            .labelTYDN{
                color: #F08080 !important;
                
            }
            .legendTYDN{
                color: #F08080 !important;
                text-decoration: underline overline wavy white;
                font-size: 20px;
                padding-bottom:10px;
            }
            
            .inputTYDN{
                border: none !important;
                border-bottom: 2px solid #FFCCFF !important;
                color: white !important;
                background:none !important;
            }
            
            .inputTYDN:focus {
                background-color: RGBA(255, 204, 255,0.5) !important;
            }
            
            .paracetamol{
                border-radius: 12px !important;
                background-color: #FFCCFF !important;
                padding: 0.5em 1.5em !important;

            }
            .ibuprofeno{
                border-radius: 12px !important;
                background-color: #FFCCFF !important;
                color:black !important;

            }

            .Kawaii{
                background-image: url(https://data.whicdn.com/images/298275521/superthumb.png?t=1506741451) !important;
                height: 200px !important;
                text-align: center !important;
                color: black !important;
                padding-top:50px !important;
            }

           
        </style>
    <?php
 }
 
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

    get_header();
    echo '<div class="wrap">';

    switch ($_REQUEST['proceso']) {
        case "registro":
            $MP_user=null; //variable a rellenar cuando usamos modificar con este formulario
            TYDN_Register_Form($MP_user,$user_email);
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
            if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
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
                    echo "<td><a href='admin-post.php?action=my_datosTYDN&proceso=modificar&id=$id'> Modificar </a></td>";
                    print "</tr>";
                }
                print "</table></div>";
            } 
            else{echo "No existen valores";}
            break;

            case "modificar":
                TYDN_modify_user();
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

    get_footer();
}

function TYDN_modify_user(){
    global $table, $valor;
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 

    $campo = 'person_id';
    $valor=0;
    if ((isset($_REQUEST['id']))){

        $valor = $_REQUEST['id'];
    }
    else{
        wp_redirect(admin_url( 'admin-post.php?action=my_datosTYDN&proceso=listar'));
    }

    $query = "SELECT * FROM $table WHERE $campo =?";
    $a=array($valor);
    
    $consult = $MP_pdo->prepare($query);
    $a=$consult->execute($a);
    $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
    $dir='/wp-content/fotillos/'.$rows[0]['foto_file'];
?>

    <h1 class="Kawaii">Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=my_datosTYDN&proceso=modificar_usuario&person_id=<?php echo $valor;?>" method="POST" enctype="multipart/form-data">
        <label for="clienteMail" class="labelTYDN">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" class="inputTYDN" value="<?php print $rows[0]['clienteMail']?>"
        readonly />
        <br/>
        <legend class="legendTYDN">Datos básicos</legend>
        <label class="labelTYDN" for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid inputTYDN" size="20" maxlength="25" value="<?php print $rows[0]['nombre'] ?>"
        placeholder="Miguel Cervantes" />
        <br/>
        <label class="labelTYDN" for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid inputTYDN" size="20"  maxlength="25" value="<?php print $rows[0]['email'] ?>"
        placeholder="kiko@ic.es" />
        <br/>
        <br/>
        <!-- CAMPO FOTO -->
        <img id="img_foto" src="" width="100" height="100">
        <input type="file" name="foto" id="foto" class="item_requerid inputTYDN" size="20" maxlength="25" value="<?php print $rows[0]['foto_file'] ?>"
        placeholder="Lucas" />
        <br/>
        <br/>
        <input type="submit" class="paracetamol" value="Actualizar">
        <input type="reset" class="ibuprofeno" value="Deshacer">
    </form>
    <script type="text/javascript"  defer charset="utf-8">
        var image = '<?php echo $dir; ?>';
        document.getElementById('img_foto').src = image ;
    </script>
    <?php
}
//add_action('admin_post_nopriv_my_datos', 'my_datos');
//add_action('admin_post_my_datos', 'my_datos'); //no autentificados
?>
