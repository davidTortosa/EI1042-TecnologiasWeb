<main>
    <h1>Gestion de Usuarios </h1>
    <?php
    include("../includes/gestionBD.php");
    
    if(isset($_GET['client_id'])){
        $table = "A_cliente";
        $rows = select_update($pdo,$table,$_GET['client_id']);

    ?>
        <form class="fom_usuario" action="?action=update2" method="POST">

		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $rows[0]["nombre"]; ?>"
		 placeholder="Miguel Cervantes" />
		<br/>
		<label for="apellido">Apellidos</label>
		<br/>
		<input type="text" name="apellido" class="item_requerid" size="20" maxlength="25" value="<?php print $rows[0]["apellidos"] ?>"
		 placeholder="El rumano" />
		<br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $rows[0]["email"] ?>"
		 placeholder="kiko@ic.es" />
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $rows[0]["clave"] ?>"
		/>
		<br/>
			<label for="dni">DNI</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="20" maxlength="25" value="<?php print $rows[0]["dni"] ?>"
		 placeholder="696969696P" />
		<br/>
		<label for="foto">Foto file</label>
		<br/>
		<input type="text" name="foto" class="item_requerid" size="20" maxlength="25" value="<?php print $rows[0]["foto_file"] ?>"
		 placeholder="hentai-chan.jpeg" />
		 
		 <input type="hidden" name="id" class="item_requerid" size="20" maxlength="25" value="<?php print $rows[0]["client_id"] ?>"
		 placeholder="hentai-chan.jpeg" />
		 
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>
	<?php
        }
        
    else{
        print('nuevo usuario');
    ?>
	
	<form class="fom_usuario" action="?action=registrar" method="POST">

		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $userName ?>"
		 placeholder="Miguel Cervantes" />
		<br/>
		<label for="apellido">Apellidos</label>
		<br/>
		<input type="text" name="apellido" class="item_requerid" size="20" maxlength="25" value="<?php print $apellido ?>"
		 placeholder="El rumano" />
		<br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $email ?>"
		 placeholder="kiko@ic.es" />
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $passwd ?>"
		/>
		<br/>
			<label for="dni">DNI</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="20" maxlength="25" value="<?php print $dni ?>"
		 placeholder="696969696P" />
		<br/>
		<label for="foto">Foto file</label>
		<br/>
		<input type="text" name="foto" class="item_requerid" size="20" maxlength="25" value="<?php print $foto ?>"
		 placeholder="hentai-chan.jpeg" />
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
	<?php
    }
    ?>
</main>