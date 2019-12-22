
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