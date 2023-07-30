<?php
/**
 * comentario.php
 * Módulo secundario que implementa la clase comentario.
 */

/** Incluye la clase. */
include 'capaDatos/bdcomentarios.php';

/**
 * Declaración de la clase Comentario.
 * */
class Comentario{

    /**
	 * @var int ID del comentario.
	 * @access private
	 */
	private int $idcomentario;

    /**
	 * @var int ID de la película cuyo comentario le pertenece.
	 * @access private
	 */
	private int $idpelicula;

	/**
	 * @var string Dirección de correo electrónico del autor.
	 * @access private
	 */
	private string $email;

	/**
	 * @var string Fecha del comentario.
	 * @access private
	 */
	private string $fecha;

	/**
	 * @var string Contenido del comentario.
	 * @access private
	 */
	private string $contenido;

    /**
	 * Método que inicializa el atributo idcomentario.
	 *
	 * @access public
	 * @param int $idcomentario ID del comentario.
	 * @return void
	 */
	public function setIDComentario($idcomentario) : void {
		$this->idcomentario = $idcomentario;
	}

	/**
	 * Método que inicializa el atributo idpelicula.
	 *
	 * @access public
	 * @param int $idpelicula ID de la película.
	 * @return void
	 */
	public function setIDPelicula($idpelicula) : void {
		$this->idpelicula = $idpelicula;
	}

	/**
	 * Método que inicializa el atributo email.
	 *
	 * @access public
	 * @param string $email Email del autor.
	 * @return void
	 */
	public function setEmail($email) : void {
		$this->email = $email;
	}

	/**
	 * Método que inicializa el atributo fecha.
	 *
	 * @access public
	 * @param string $fecha Fecha del comentario.
	 * @return void
	 */
	public function setFecha($fecha) : void {
		$this->fecha = $fecha;
	}

	/**
	 * Método que inicializa el atributo nombre.
	 *
	 * @access public
	 * @param string $nombre Nombre del usuario.
	 * @return void
	 */
	public function setContenido($contenido) : void {
		$this->contenido = $contenido;
	}

	/**
	 * Método que devuelve el valor del atributo idcomentario.
	 *
	 * @access public
	 * @return int ID de los comentarios.
	 */
	public function getIDComentario() : int {
		return $this->idcomentario;
	}

	/**
	 * Método que devuelve el valor del atributo idpelicula.
	 *
	 * @access public
	 * @return int ID de las películas.
	 */
	public function getIDPelicula() : int {
		return $this->idpelicula;
	}

	/**
	 * Método que devuelve el valor del atributo email.
	 *
	 * @access public
	 * @return string Email del usuario.
	 */
	public function getEmail() : string {
		return $this->email;
	}

	/**
	 * Método que devuelve el valor del atributo fecha.
	 *
	 * @access public
	 * @return string Fecha del comentario.
	 */
	public function getFecha(): string {
		return $this->fecha;
	}
	
	/**
	 * Método que devuelve el valor del atributo cotenido.
	 *
	 * @access public
	 * @return string Contenido del comentario.
	 */
	public function getContenido(): string {
		return $this->contenido;
	}

    /**
	 * Método que añade un nuevo comentario.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function introComentario() : bool {
		/** @var BDComentarios Instancia un objeto de la clase. */
		$bdcomentario = new BDComentarios();
		/** Inicializa los atributos del objeto. */
                $bdcomentario->setIDPelicula($this->idpelicula);
		$bdcomentario->setEmail($this->email);
		$bdcomentario->setContenido($this->contenido);
		/** Inserta un nuevo comentario y comprueba un posible error. */
		if ($bdcomentario->almacenaComentario()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

    /**
	 * Método que muestra los comentarios en las páginas de su respectiva película.
	 *
	 * @access public
	 * @param int $idpelicula ID de la pelicula.
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function generarComentarios() : bool {
		/** @var BDComentarios Instancia un objeto de la clase. */
		$bdcomentario = new BDComentarios();
		/** Inicializa los atributos del objeto. */
		$bdcomentario->setIDPelicula($this->idpelicula);
		/** Modifica los datos del usuario y comprueba un posible error. */
		if ($bdcomentario->historialComentarios()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
         /**
	 * Método que muestra los comentarios en la página de usuario.
	 *
	 * @access public
	 * @param int $idpelicula ID de la pelicula.
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function generarComentariosU() : bool {
		/** @var BDComentarios Instancia un objeto de la clase. */
		$bdcomentario = new BDComentarios();
		/** Inicializa los atributos del objeto. */
		$bdcomentario->setEmail($this->email);
		/** Modifica los datos del usuario y comprueba un posible error. */
		if ($bdcomentario->historialComentariosU()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

    /**
	 * Método que elimina un comentario.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function eliminaComentario() : bool {
		/** @var BDComentarios Instancia un objeto de la clase. */
		$bdcomentario = new BDComentarios();
		/** Inicializa los atributos del objeto. */
		$bdcomentario->setIDComentario($this->idcomentario);
		/** Elimina un usuario y comprueba un posible error. */
		if ($bdcomentario->eliminaComentario()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
}