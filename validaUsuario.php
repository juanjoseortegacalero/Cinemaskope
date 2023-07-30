<?php
/** Incluye las clases. */
include 'capaNegocio/usuario.php';
include 'capaNegocio/pelicula.php';
include 'capaNegocio/valoracion.php';
include 'capaNegocio/comentario.php';

/** Inicia sesión. */
session_start();

/** Si hemos marcado la casilla de verificación... */
if (isset($_POST['recordar'])) {
	/** Crea las cookies. */
	setcookie('email', $_POST['email'], time() + (60 * 60 * 24 * 90));
	setcookie('contraseña', $_POST['contraseña'], time() + (60 * 60 * 24 * 90));
	setcookie('recordar', 'on', time() + (60 * 60 * 24 * 90));
}
else {
	/** En caso contrario, borra las cookies. */
	setcookie('email', '', time() - 3600);
	setcookie('contraseña', '', time() - 3600);
	setcookie('recordar', '', time() - 3600);
}
?>

<!--
	* validaUsuario.php
	* Módulo secundario que valida o autentifica un usuario.
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
                                echo '<a href="accesoUsuarios.php" class="activo">Iniciar Sesión</a> &nbsp;';
			}
			?>
                                <a href="about.php">Contacto</a>
			</nav>
		</div>
	</header>
        <main>
		<div class="pelicula-principal" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/fondo.jpg);">
			<div class="contenedor">
			<h3>Validar usuario</h3>
			<?php
			/** Si no existe la variable de sesión usuario. */
			if (!isset($_SESSION['usuario'])) {
				/** Si todos los campos del formulario tienen algún valor... */
				if (!empty($_POST['email']) && !empty($_POST['contraseña'])) {
					/** @var Usuario Instancia un objeto de la clase. */
					$usuario = new Usuario();
					/** Inicializa los atributos del objeto. */
					$usuario->setEmail($_POST['email']);
					$usuario->setContraseña($_POST['contraseña']);
					/** Valida el email y la contraseña del usuario. */
					if ($usuario->validaUsuario()) {
						/** @var Usuario Crea la variable de sesión con un objeto
						 * que pertenece a la clase Usuario. */
						$_SESSION['usuario'] = $usuario;
						/** El usuario se ha validado correctamente. */
						echo '<h4>El usuario ha sido validado con éxito</h4>';
						echo '<a href="usuarioValidado.php">Usuario: ' . $_SESSION['usuario']->getNombre();'</a>&nbsp;';
					}
					else {
						/** No es posible validar el usuario. */
						echo "<h5>Error al validar el usuario
								<br>El email o la contraseña del usuario no son
								correctos</h5>";
					}
				}
				else {
					/** Si algún campo del formulario no está inicializado... */
					if (isset($_POST['email']) || isset($_POST['contraseña'])) {
						echo "<h5>Error al validar el usuario
								<br>Todos los campos son obligatorios</h5>";
					}
					else {
						echo "<h5>Debes validar un usuario para acceder</h5>";
					}
				}
			}
			else {
				/** El usuario ya ha sido validado. */
				echo "<h5>El usuario ya ha sido validado</h5>";
			}
			?>
                </div>
        </main>
        <footer class="footer text-faded text-center py-5">
        <div class="container"><h3 align="center" style="color: #FF0000;" >Copyright &copy; CinemaSkope 2022</h3></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
	</body>
</html>
