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
	* eliminaUsuario.php
	* Módulo secundario que elimina un usuario.
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
		<div class="contenedor" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/fondo.jpg);">
                    <img src="img/cinemaskope_logo.svg" href="index.php" alt="logo cinemaskope" width="25%">
			<nav>
                            <a href="index.php">Inicio</a>
                                <?php			
			if (isset($_SESSION['usuario'])) {
                                echo '<a href="accesoPeliculas.php">Acceso Peliculas</a>';
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
				<h3>Eliminar usuarios</h3>
			<?php
			/** Comprueba que la sesión esté iniciada. */
			if (isset($_SESSION['usuario'])) {
				/** Comprueba que se ha pulsado el botón Eliminar. */
				if (isset($_POST['eliminar'])) {
					/** @var Usuario Instancia un objeto de la clase Abonado. */
					$usuario = new Usuario();
					/** Inicializa los atributos del objeto. */
					$usuario->setEmail($_POST['email']);
					$usuario->setContraseña($_POST['contraseña']);
					$usuario->setNombre($_POST['nombre']);
					/** Comprueba la eliminación... */
					if ($usuario->eliminaUsuario()) {
						/** Muestra el mensaje de eliminación. */
						echo '<h4>El usuario está siendo eliminado...</h4>';
						/** Redirecciona al módulo de cerrar la sesión en 4 segundos. */
						header("refresh:2; url=cierraSesion.php");
					}
					else {
						/** Error en el archivo al eliminar el usuario. */
						echo '<h5>Error al eliminar el usuario</h5>';
					}
				}
				else {
					/** Datos del usuario inconsistentes. */
					echo '<h5>Debes validar un usuario para eliminarlo</h5>';
				}
			}
			else {
				/** El usuario no ha sido validado. */
				echo "<h5>El usuario no ha sido validado</h5>";
			}
			?>
                        </div>
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
	</body>
</html>
