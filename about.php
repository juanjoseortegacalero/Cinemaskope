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
	* index.php
	* Módulo principal.
-->
<!DOCTYPE html>
<html lang="es">
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
				<h3 id="bienvenida" class="titulo">Contacto</h3>
				<p class="descripcion">
				    Me llamo Juan José Ortega Calero y soy el desarrollador que hizo esta web como Trabajo Final.
					Recién graduado en Desarrollo de Aplicaciones Web. Soy un chico joven amante del
					trabajo en equipo, organizado y atento al detalle.
					Después de terminar mis estudios estoy dispuesto a aprender cosas nuevas y
					enfrentar nuevos retos. 
					<br>
					Teléfono: <strong>658 700 821</strong><br>
					E-mail: <strong><a href="mailto: juanjoseortegacalero@gmail.com">juanjoseortegacalero@gmail.com</a></strong><br>
					LinkedIn: <strong><a href="https://www.linkedin.com/in/juan-jos%C3%A9-ortega-calero-044516250/">https://www.linkedin.com/in/juan-jos%C3%A9-ortega-calero-044516250/</a></strong><br>
					Dirección: <strong>C/ Socuellamos, Nº 63, 1ºDR, Villarrobledo (02600)</strong><br>

					</p>
				</div>	
                                
		</div>
		</div>
	</main>
        <footer>
            <div class="container"><h3 align="center" style="color: #FF0000;" >Copyright &copy; CinemaSkope 2022</h3></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/main.js"></script>
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script> 
</body>
</html>