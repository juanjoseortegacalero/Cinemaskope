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
	* usuarioValidado.php
	* Módulo secundario que muestra el área privada del usuario.
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
                                echo '<a href="cierraSesion.php">Cerrar sesión</a>';
				echo '<a href="usuarioValidado.php">Usuario: ' .$_SESSION['usuario']->getNombre();'</a> $nbsp;'; 
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
                            <div class="row">
                            <div class="col-md-6">
				<h3>Area privada del usuario</h3>
			<?php
			/** Comprueba si el usuario ha iniciado sesión. */
			if (isset($_SESSION['usuario'])) {
				/** El usuario se ha registrado o validado correctamente. */
				echo '<h3>Bienvenido al área privada del usuario</h3>'
                            . '<h4><a href="gestionUsuario.php">Puedes modificar los valores de tu cuenta aquí</a></h4>';
			}
			else {
				/** El usuario no ha sido registrado o validado. */
				echo '<h5>El usuario no ha sido registrado o validado</h5>';
			}
			?>
                             </div> 
                            <div class="col-md-6">
                                <h3>Comentarios realizados con esta cuenta:</h3>
                                <?php
                                $usuario = $_SESSION['usuario']->getEmail();
                                    $comentario =new Comentario() ;
                                    $comentario->setEmail($usuario);
                                    $comentario->generarComentariosU();

                                    ?>
                            </div>
                        </div>
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
</html>