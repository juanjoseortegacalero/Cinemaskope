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
	* accesoPelícula.php
	* Módulo secundario que permite acceder a las películas.
-->
<!DOCTYPE html>
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
                                echo '<a href="accesoPeliculas.php" class="activo">Acceso Películas</a>';
            		        echo '<a href="usuarioValidado.php">Usuario: ' . $_SESSION['usuario']->getNombre();'</a>$nbsp;'; 
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
		<div class="pelicula-principal" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/1.jpg);">
			<div class="contenedor">
				<h3 class="titulo">El poder del perro (2021)</h3>
				<p class="descripcion">
					Los acaudalados hermanos Phil y George Burbank son las dos caras de la misma moneda. Phil es elegante y cruel, mientras que George es impasible y amable. Cuando George se casa en secreto con una viuda del pueblo, Phil lleva a cabo una guerra sádica e implacable usando a su afeminado hijo, Peter, como peón.
				</p>
                               
                                <form action="pelicula1.php" method="post">
                                        <a ><input type="submit" name="1" value="ACCEDER A FICHA" class="boton"></a>
                                </form>
			</div>
		</div>

		<div class="peliculas-recomendadas contenedor">
			<div class="contenedor-titulo-controles">
				<h3>Populares</h3>
				<div class="indicadores"></div>
			</div>

			<div class="contenedor-principal">
				<button role="button" id="flecha-izquierda" class="flecha-izquierda"><i class="fas fa-angle-left"></i></button>

				<div class="contenedor-carousel">
					<div class="carousel">
						<div class="pelicula">
							<a href="pelicula1.php"><img src="img/1.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula2.php"><img src="img/2.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula3.php"><img src="img/3.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula4.php"><img src="img/4.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula5.php"><img src="img/5.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula1.php"><img src="img/1.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula2.php"><img src="img/2.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula3.php"><img src="img/3.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula1.php"><img src="img/1.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula2.php"><img src="img/2.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula3.php"><img src="img/3.jpg" alt=""></a>
						</div>
						<div class="pelicula">
							<a href="pelicula4.php"><img src="img/4.jpg" alt=""></a>
						</div>
				</div>

				<button role="button" id="flecha-derecha" class="flecha-derecha"><i class="fas fa-angle-right"></i></button>
			</div>
		</div>
		</div>
	</main>
        <footer class="footer text-faded text-center py-5">
            <div class="container"><h3 align="center" style="color: #FF0000;" >Copyright &copy; CinemaSkope 2022</h3></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!--Font Awesome -->
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="js/main.js"></script>
    </body>
</html>
