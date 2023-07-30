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
	* registraUsuario.php
	* Módulo secundario que registra un nuevo usuario.
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
				<a href="#" class="activo">Inicio</a>
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
			<h3>Registrar usuario</h3>
			<?php
			/** Si no existe la variable de sesión usuario. */
			if (!isset($_SESSION['usuario'])) {
				/** Si todos los campos del formulario tienen algún valor... */
				if (!empty($_POST['email']) && !empty($_POST['contraseña']) &&
					!empty($_POST['nombre'])) {
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
						print '<h5>' . $error . '</h5>';
					}
					/** Comprueba que haya errores en el email y en la contraseña. */
					if (!$errorEmail && !$errorContraseña) {
						/** Inicializa la propiedad del objeto nombre. */
						$usuario->setNombre($_POST['nombre']);
						/** Comprueba si existe el usuario. */
						if (!$usuario->existeUsuario()) {
							/** Intenta almacenar al usuario y comprueba error. */
							if ($usuario->almacenaUsuario()) {
								/** @var Usuario Crea la variable de sesión con un objeto
								 * que pertenece a la clase Usuario. */
								$_SESSION['usuario'] = $usuario;
								/** El usuario se ha registrado correctamente. */
								print '<h4>El usuario ha sido registrado con éxito</h4>';
								print '<h4>Accediendo a la página de usuario...</h4>';
								/** Redirecciona al módulo de usuario validado. */
								?>
								 <script text="javascript"> 
                                     setTimeout(redirigir,3000); 
                                     function redirigir(){ 
                                     window.location="usuarioValidado.php"; 
                                    } 
                                </script>
								<?php
								
							}
							else {
								/** Se ha producido un error al registrar el usuario. */
								echo '<h5>Error en la base de datos al almacenar el usuario</h5>';
							}
						}
						else {
							/** Se intenta registrar un usuario existente. */
							echo '<h5>El usuario ya existe en la base de datos</h5>';
						}

					}
					else {
						echo '<h5>No es posible registrar el usuario</h5>';
					}
				}
				else {
					/** Si algún campo del formulario no está inicializado... */
					if (isset($_POST['email']) || isset($_POST['contraseña']) ||
						isset($_POST['nombre'])) {
						echo "<h5>Error al dar de alta el usuario
								<br>Todos los campos son obligatorios</h5>";
					}
					else {
						/** Si se intenta acceder sin registrar un usuario... */
						echo "<h5>Debes registrar un usuario para acceder</h5>";
					}
				}
			}
			else {
				/** El usuario ya ha sido registrado. */
				echo "<h5>El usuario ya ha sido registrado</h5>";
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
</html>
