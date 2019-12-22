<?php
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

<h1 class="Kawaii">Modificar usuario </h1>
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
        <img id="img_foto" src="<?php print $dir?>" width="100" height="100">
        <input type="file" name="foto" id="foto" class="item_requerid inputTYDN" size="20" maxlength="25" value=""
        placeholder="Lucas" />
        <br/>
        <br/>
        <input type="submit" class="paracetamol" value="Actualizar">
        <input type="reset" class="ibuprofeno" value="Deshacer">
    </form>