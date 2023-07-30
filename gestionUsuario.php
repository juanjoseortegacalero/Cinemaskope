<?php
/** Incluye las clases. */
include 'capaNegocio/usuario.php';
include 'capaNegocio/pelicula.php';
include 'capaNegocio/valoracion.php';
include 'capaNegocio/comentario.php';

/** Inicia sesión. */
session_start();
?>

<!--
	* gestionaUsuario.php
	* Módulo secundario que modifica o elimina un usuario.
-->
<!DOCTYPE html>
<html>
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
	<title>Cinemaskope</title>
    </head>
    <body>
        <header>
		<div class="contenedor">
                    <img src="img/cinemaskope_logo.svg" href="index.php" alt="logo cinemaskope" width="25%">
			<nav>
                            <a href="index.php">Inicio</a>
                                <?php			
			if (isset($_SESSION['usuario'])) {
                                echo '<a href="accesoPeliculas.php">Acceso Películas</a>';
      				echo '<a href="usuarioValidado.php">Usuario: ' . $_SESSION['usuario']->getNombre();'</a>&nbsp;';
                                echo '<a href="cierraSesion.php">Cerrar sesión</a>';
			}
			else {
                                echo '<a href="accesoUsuarios.php">Iniciar Sesión</a> &nbsp;';
			}
			?>
                            <a href="about.php">Contacto</a>
			</nav>
		</div>
	</header>
        <main>
		<div class="pelicula-principal" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/fondo.jpg);">
			<div class="contenedor">
			<h3>Modficar valores:</h3>
			<?php
			/** Comprueba que la sesión esté iniciada. */
			if (isset($_SESSION['usuario'])) {
				/** Si todos los campos del formulario tienen algún valor... */
				if (!empty($_POST['email']) && !empty($_POST['contraseña']) &&
					!empty($_POST['nombre'])) {
					/** Si se ha seleccionado el botón Modificar. */
					if (isset($_POST['modificar'])) {
						echo '<h4>El usuario está siendo modificado</h4>';
						/** @var Usuario Instancia un objeto de la clase. */
						$usuario = new Usuario();
						/** @var array[]:string Valida e inicializa la propiedad del objeto. */
						$errorEmail = $usuario->setEmail($_POST['email']);
						/** Recorre el array de errores. */
						foreach ($errorEmail as $error) {
							/** Muestra posibles errores del email. */
							echo '<h5>' . $error . '</h5>';
						}
						/** @var array[]:string Valida e inicializa la propiedad del objeto. */
						$errorContraseña = $usuario->setContraseña($_POST['contraseña']);
						/** Recorre el array de errores. */
						foreach ($errorContraseña as $error) {
							/** Muestra posibles errores de la contraseña. */
							echo '<h5>' . $error . '</h5>';
						}
						/** Comprueba que haya errores en el email y en la contraseña. */
						if (!$errorEmail && !$errorContraseña) {
							/** Inicializa la propiedad del objeto nombre. */
							$usuario->setNombre($_POST['nombre']);
							/** Si no se ha modificado el email del usuario... */
							if ($_POST['email'] == $_POST['email_original']) {
								/** Intenta modificar los datos del usuario. */
								if ($usuario->modificaUsuario($_POST['email_original'])) {
									/** Actualiza los valores en la varible de sesión. */
									$_SESSION['usuario']->setContraseña($_POST['contraseña']);
									$_SESSION['usuario']->setNombre($_POST['nombre']);
									/** Datos del usuario modificados correctamente. */
									echo '<h4>Los datos del usuario han sido modificados con éxito</h4>';
								}
								else {
									/** Error al modificar los datos del usuario. */
									echo '<h5>Error al modificar los datos del usuario</h5>';
									/** Se reestablecen los valores iniciales de las propiedades. */
									$usuario->setEmail($_POST['email_original']);
									$usuario->setContraseña($_POST['contraseña_original']);
								}
							}
							else {
								/** Si se ha modificado el email del usuario se ha de
								  comprobar si existe algún usuario con ese email. */
								if (!$usuario->existeUsuario()) {
									/** No existe ningún usuario con ese email. */
									if ($usuario->modificaUsuario($_POST['email_original'])) {
										/** Actualiza los valores en la varible de sesión. */
										$_SESSION['usuario']->setEmail($_POST['email']);
										$_SESSION['usuario']->setContraseña($_POST['contraseña']);
										$_SESSION['usuario']->setNombre($_POST['nombre']);
										/** Datos del usuario modificados correctamente. */
										echo '<h4>Los datos del usuario han sido modificado con éxito</h4>';
									}
									else {
										/** Error al modificar los datos del usuario. */
										echo '<h5>Error al modificar los datos del usuario</h5>';
										/** Se reestablecen los valores iniciales de las propiedades. */
										$usuario->setEmail($_POST['email_original']);
										$usuario->setContraseña($_POST['contraseña_original']);
									}
								}
								else {
									/** Ya existe un usuario con ese email. */
									echo '<h5>No es posible modificar los datos del usuario
									<br>Existe otro usuario con el mismo email</h5>';
									$usuario->setEmail($_POST['email_original']);
									$usuario->setContraseña($_POST['contraseña_original']);
								}
							}
						}
						else {
							/** Error en el email o en la contraseaña. */
							echo '<h5>No es posible modificar el usuario</h5>';
						}
					}
					/** Si se ha seleccionado el botón Eliminar. */
					if (isset($_POST['eliminar'])) {
						/** Comprueba si se ha cambiado algún dato del formulario. */
						if (($_POST['email'] == $_POST['email_original']) &&
							($_POST['contraseña'] == $_POST['contraseña_original']) &&
							($_POST['nombre'] == $_SESSION['usuario']->getNombre())) {
							echo '<h4>El usuario está siendo eliminado</h4>';
							/** Muestra un formulario de confirmación. */
							?>
							<form action="eliminaUsuario.php" method="post">
								<table>
									<tr>
										<td class="centra">
											<label>¿Estás seguro de eliminar el usuario
												<?php echo $_POST['nombre']; ?>?</label>
										</td>
									</tr>
									<tr>
										<td class="centra">
											<br>
											<input type="hidden" name="email"
												   value="<?php echo $_POST['email']; ?>">
											<input type="hidden" name="contraseña" 
												   value="<?php echo $_POST['contraseña']; ?>">
											<input type="hidden" name="nombre" 
												   value="<?php echo $_POST['nombre']; ?>">
											<input class="boton" type="submit" 
												   name="eliminar"
												   value="Eliminar">
											<input class="boton" type="button"
												   value="Cancelar"
												   onClick="javascript:window.history.back();">
										</td>
									</tr>
								</table>
							</form>
							<?php
						}
						else {
							echo '<h5>No es posible eliminar el usuario
							<br>Se han modificado sus datos</h5>';
						}
					}
				}
				else {
					/** Si algún campo del formulario no está inicializado... */
					if (isset($_POST['email']) || isset($_POST['contraseña']) ||
						isset($_POST['nombre'])) {
						echo "<h5>Todos los campos son obligatorios</h5>";
						echo '<nav><a href="javascript:window.history.back();">
							Volver a la página anterior</a></nav>';
					}
					else {
						/** Muestra el formulario de gestión de sus datos. */
						?>
						<form action="gestionUsuario.php" method="post">
							<table>
								<tr>
									<td><label>Email: </label></td>
									<td>
										<input type="text" name="email" 
											   value="<?php echo $_SESSION['usuario']->getEmail(); ?>" 
											   size="50">
									</td>
								</tr>
								<tr>
									<td><label>Contraseña: </label></td>
									<td>
										<input type="text" name="contraseña" 
											   value="<?php echo $_SESSION['usuario']->getContraseña(); ?>" 
											   size="15">
									</td>
								</tr>
								<tr>
									<td><label>Nombre: </label></td>
									<td>
										<input type="text" name="nombre" 
											   value="<?php echo $_SESSION['usuario']->getNombre(); ?>" 
											   size="30">
									</td>
								</tr>
								<tr>
									<td colspan="2" class="centra">
										<br>
										<input type="hidden" name="email_original" 
											   value="<?php echo $_SESSION['usuario']->getEmail(); ?>">
										<input type="hidden" name="contraseña_original" 
											   value="<?php echo $_SESSION['usuario']->getContraseña(); ?>">
										<input class="boton" type="submit" 
											   name="modificar"
											   value="Modificar">
										<input class="boton" type="submit" 
											   name="eliminar"
											   value="Eliminar">
										<input class="boton" type="button" 
											   value="Cancelar" 
											   onClick="location.href =
															   'usuarioValidado.php'">
									</td>
								</tr>
							</table>
						</form>
					   <?php
					}
				}
			}
			else {
				/** El usuario no ha sido validado. */
				echo "<h5>El usuario no ha sido validado correctamente</h5>";
			}
			?>
		</div>
	</main>
     	</body>
       <footer class="footer text-faded text-center py-5">
          <div class="container"><h3 align="center" style="color: #FF0000;" >Copyright &copy; CinemaSkope 2022</h3></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</html>
