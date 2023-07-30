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
	* cerrarSesion.php
	* Módulo secundario que cierra la sesión.
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
                    <img src="img/cinemaskope_logo.svg" alt="logo cinemaskope" width="25%">
			<nav>
				<a href="index.php">Inicio</a>
                                <?php			
			if (isset($_SESSION['usuario'])) {
				
			}
			else {
                                echo '<a href="accesoUsuarios.php">Iniciar Sesión</a> &nbsp;';
			}
			?>
                                <a href="about.php">Contacto</a>
			</nav>
		</div>
	</header>	
        <article>
             <div class="pelicula-principal" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/fondo.jpg);">
			<div class="contenedor">
			<h3>Cierra sesión</h3>
			<?php
			/** Comprueba que la sesión esté iniciada. */
			if (isset($_SESSION['usuario'])) {
				echo "<h4>La sesión actual ha sido cerrada</h4>";
				echo '<h4>Adiós ' . $_SESSION['usuario']->getNombre() . '</h4>';
				/** Elimina todas las variables de sesión. */
				$_SESSION = array();
				/** Finaliza la sesión actual. */
				session_destroy();
			}
			else {
				/** El usuario no ha sido validado. */
				echo "<h5>El usuario no ha sido validado</h5>";
			}
			?>
                    </div>
                </div> 
		</article>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><h3 align="center" style="color: #FF0000;" >Copyright &copy; CinemaSkope 2022</h3></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
