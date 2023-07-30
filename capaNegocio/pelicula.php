<?php
/**
 * pelicula.php
 * Módulo secundario que implementa la clase pelicula.
 */

/** Incluye la clase. */
include 'capaDatos/bdpeliculas.php';

/**
 * Declaración de la clase Comentario.
 * */
class Pelicula{

    /**
	 * @var int ID de la película cuyo comentario le pertenece.
	 * @access private
	 */
	private int $idpelicula;

	/**
	 * @var string Nombre de la película.
	 * @access private
	 */
	private string $nombre;

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
	 * Método que inicializa el atributo nombre.
	 *
	 * @access public
	 * @param string $nombre Nombre de la pelicula.
	 * @return void
	 */
	public function setNombre($nombre) : void {
		$this->nombre = $nombre;
	}

	/**
	 * Método que inicializa el atributo fecha.
	 *
	 * @access public
	 * @param string $fecha Fecha de estreno de la película.
	 * @return void
	 */
	public function setFecha($fecha) : void {
		$this->fecha = $fecha;
	}

    /**
	 * Método que inicializa el atributo sinopsis.
	 *
	 * @access public
	 * @param string $sinopsis Sinopsis de la película.
	 * @return void
	 */
	public function setSinopsis($sinopsis) : void {
		$this->sinopsis = $sinopsis;
	} 

	/**
	 * Método que devuelve el valor del atributo idpelicula.
	 *
	 * @access public
	 * @return int ID de las peliculas.
	 */
	public function getIDPelicula() : int {
		return $this->idpelicula;
	}

	/**
	 * Método que devuelve el nombre de las películas.
	 *
	 * @access public
	 * @return string Nombre de las películas.
	 */
	public function getNombre() : string {
		return $this->nombre;
	}

	/**
	 * Método que devuelve el valor del atributo fecha.
	 *
	 * @access public
	 * @return string Fecha de estreno de la película.
	 */
	public function getFecha(): string {
		return $this->fecha;
	}

    /**
	 * Método que devuelve el valor del atributo sinopsis.
	 *
	 * @access public
	 * @return string Sinopsis de la película.
	 */
	public function getSinopsis(): string {
		return $this->sinopsis;
	}

    /**
	 * Método que añade una nueva película.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function almacenaPelicula() : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdpelicula = new BDPeliculas();
		/** Inicializa los atributos del objeto. */
		$bdpelicula->setNombre($this->nombre);
		$bdpelicula->setFecha($this->fecha);
		$bdpelicula->setSinopsis($this->sinopsis);
		/** Inserta una nueva película y comprueba un posible error. */
		if ($bdpelicula->introPelicula()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

    /**
	 * Método que modifica los datos de una película.
	 *
	 * @access public
	 * @param int $idpelicula ID de la pelicula.
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function modificaPelicula(int $idpelicula) : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdpelicula = new BDPeliculas();
		/** Inicializa los atributos del objeto. */
		$bdpelicula->setNombre($this->nombre);
		$bdpelicula->setFecha($this->fecha);
		$bdpelicula->setSinopsis($this->sinopsis);
		/** Modifica los datos del usuario y comprueba un posible error. */
		if ($bdusuario->editaPelicula($idpelicula)) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

    /**
	 * Método que elimina una pelicula.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function eliminaPelicula() : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdpelicula = new BDPeliculas();
		/** Inicializa los atributos del objeto. */
		$bdpelicula->setIDPelicula($this->idpelicula);
		/** Elimina un usuario y comprueba un posible error. */
		if ($bdpelicula->eliminaPelicula()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
       /**
	 * Método que muestra el nombre de una pelicula.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function mostrarNombre() : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdpelicula = new BDPeliculas();
		/** Inicializa los atributos del objeto. */
		$bdpelicula->setIDPelicula($this->idpelicula);
		/** Elimina un usuario y comprueba un posible error. */
		if ($bdpelicula->mostrarNombre()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
      /**
	 * Método que muestra ls sinopsis de una pelicula.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function mostrarSinopsis() : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdpelicula = new BDPeliculas();
		/** Inicializa los atributos del objeto. */
		$bdpelicula->setIDPelicula($this->idpelicula);
		/** Elimina un usuario y comprueba un posible error. */
		if ($bdpelicula->mostrarSinopsis()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
}