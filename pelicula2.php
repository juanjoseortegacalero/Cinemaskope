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
	* pelicula.php
	* Módulo secundario que muestra la ficha de la película.
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
                                echo '<a href="accesoPeliculas.php">Acceso Películas</a>';
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
		<div class="pelicula-principal" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/2.jpg);">
			<div class="contenedor">
				<h3 class="titulo"><?php
                                    $pelicula = new Pelicula() ;
                                    $idpelicula=2;
                                    $pelicula->setIDPelicula($idpelicula);
                                    $pelicula->mostrarNombre();

                                    ?></h3>
				<p class="descripcion">
                                    <?php
                                    $pelicula = new Pelicula() ;
                                    $idpelicula=2;
                                    $pelicula->setIDPelicula($idpelicula);
                                    $pelicula->mostrarSinopsis();

                                    ?>
                                </p>
                                
				<button role="button" class="boton">Valoración
                                    <?php
                                    include_once 'capaDatos/bdvaloraciones.php';
                                    $valoraciones =new Valoracion() ;
                                    $pelicula=2;
                                    $valoraciones->setIDPelicula($pelicula);
                                    $valoraciones->mostrarValoracion();

                                    ?>
                                </button>
                                      <?php

                        if (isset($_POST['enviarval']))
                        {
                        /** @var string Almacena el valor de la variable del formulario */
                        $contenido = $_POST["valoracion"];
                        /** @var string Almacena el valor de la variable del formulario */
                        $email = $_SESSION['usuario']->getEmail();
                        /** @var string Almacena el valor de la variable del formulario */
                        $pelicula = 2; 
                        
                        {   
                            /** Realiza la operación y muestra el resultado. */
                            $valoracion = new Valoracion();
                                 /** Inicializa los atributos del objeto. */
                                        /** @var float Almacena el valor de la variable del formulario */
                                        $valoracion->setEmail($email);
                                        $valoracion->setIDPelicula($pelicula);
                                        $valoracion->setValoracion($_POST["valoracion"]);
                                        
                             $valoracion->almacenaValoracion();
                        }

                        }
                        ?>   
                                <!-- Muestra el formulario. -->
                                <form action="pelicula2.php" method="post">
                                        <p>Envía una valoración:</p>
                                        <input type= "number" step="0.1" min="0" max="5" name= "valoracion">
                                        <input type="submit" name="enviarval" value="Enviar">
                                </form>
                                <h3>Comentarios</h3>
                                            <?php

                        if (isset($_POST['enviarcom']))
                        {
                        /** @var string Almacena el valor de la variable del formulario */
                        $contenido = $_POST["contenido"];
                        /** @var string Almacena el valor de la variable del formulario */
                        $email = $_SESSION['usuario']->getEmail();
                        /** @var string Almacena el valor de la variable del formulario */
                        $pelicula = 2; 
                        
                        {   
                            /** Realiza la operación y muestra el resultado. */
                            $comentario = new Comentario();
                                 /** Inicializa los atributos del objeto. */
                                        /** @var float Almacena el valor de la variable del formulario */
                                        $comentario->setEmail($email);
                                        $comentario->setIDPelicula($pelicula);
                                        $comentario->setContenido($_POST['contenido']);
                                        
                             $comentario->introComentario();
                        }

                        }
                        ?>   
                                <!-- Muestra el formulario. -->
                                <form action="pelicula2.php" method="post">
                                        <p>Envía tu comentario:</p>
                                        <input type= "text" name= "contenido" autocomplete="off" maxlength="5000" size="40">
                                        <input type="submit" name="enviarcom" value="Enviar">
                                </form>
                                <!-- Muestra los comentarios. -->
                            <div class="contenedor-principal">
                                <?php
                                $pelicula = 2;
                                    $comentario =new Comentario() ;
                                    $comentario->setIDPelicula($pelicula);
                                    $comentario->generarComentarios();

                                    ?>
                            </div>
                                
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
        <!-- Core theme JS-->
        <script src="js/main.js"></script>
    </body>
</html>
