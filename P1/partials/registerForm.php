<main>
	<h1>GestiÓn de Usuarios </h1>
	<form class="fom_usuario" action="?action=registrar" method="POST">

		<legend>Datos básicos</legend>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $userName ?>"
		 placeholder="Miguel" />
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
		 <br/>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>