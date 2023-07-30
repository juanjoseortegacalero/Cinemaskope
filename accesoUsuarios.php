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
	* accesoUsuarios.php
	* Módulo secundario que muestra la página de acceso para los usuarios.
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
        <article>
            <div class="pelicula-principal" style="background: linear-gradient(rgba(0, 0, 0, .50) 0%, rgba(0,0,0,.50) 100%), url(img/fondo.jpg);">
			<div class="contenedor">
			<?php
			/** Si no existe la variable de sesión usuario. */
			if (!isset($_SESSION['usuario'])) {
				?>
                        <table>
                            <tr>
                                <td>
                                    <h1 class="display-4">Registrate</h1> 
                        <form action="registraUsuario.php" method="post"> 
                        <div class="form-group col-md-3">
                        <label for="nombre" class="col-form-label col-md-4">Nombre: </label> <div class="col-md-8">
                        <input type="text" name="nombre" value="" id="nombre" class="form-control"> </div> </div> 
                        <div class="row form-group">
                        <label for="email" class="col-form-label col-md-4">E-mail:</label> <div class="col-md-8">
                        <input type="email" name="email" value="" id="email" class="form-control"> </div> </div> 
                        <div class="row form-group">
                        <label for="contraseña" class="col-form-label col-md-4">Contraseña:</label> <div class="col-md-8">
                        <input type="password" class="form-control" id="contraseña" name="contraseña"> </div> </div>
                        
                        <input class="boton" type="submit" value="Registrar">
                        </form>
                                </td>
                                <td>
							&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp; 
						</td>
                                <td>
                        <h1 class="display-4">Inicia Sesión</h1> 
                        <form action="validaUsuario.php" method="post"> 
                        <div class="row form-group">
                        <label for="email" class="col-form-label col-md-4">E-mail:</label> <div class="col-md-8">
                        <input type="email" name="email" value="" id="email" class="form-control"> </div> </div> <div class="row form-group">
                        <label for="contraseña" class="col-form-label col-md-4">Contraseña:</label> <div class="col-md-8">
                        <input type="password" class="form-control" id="contraseña" name="contraseña"> </div> </div>
                        <input type="checkbox" 
													   name="recordar"
												<?php
												if (isset($_COOKIE['recordar'])) {
													echo 'checked';
												}
												else {
													echo '';
												}
												?>>Recordar este usuario<br>
                        <input class="boton" type="submit" value="Iniciar Sesión">
                        </form>
                                </td>
                            </tr>
                        </table>
				
				<?php
			}
			else {
				/** El usuario no ha sido validado. */
				echo "<h5>El usuario ya ha sido validado</h5>";
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
