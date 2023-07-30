<?php
/**
 * pelicula.php
 * Módulo secundario que implementa la clase valoracion.
 */

/** Incluye la clase. */
include 'capaDatos/bdvaloraciones.php';

/**
 * Declaración de la clase Valoracion.
 * */
class Valoracion{

    /**
	 * @var int ID de la valoración.
	 * @access private
	 */
	private int $idvaloracion;

    /**
	 * @var int ID de la película cuya valoración le pertenece.
	 * @access private
	 */
	private int $idpelicula;

    	/**
	 * @var string Dirección de correo electrónico del autor de la valoración.
	 * @access private
	 */
	private string $email;

    /**
	 * @var float Contenido del comentario.
	 * @access private
	 */
	private float $contenido;

	/**
	 * @var string Fecha de la valoración.
	 * @access private
	 */
	private string $fechaval;
	
	/**
	 * Método que inicializa el atributo idvaloracion.
	 *
	 * @access public
	 * @param int $idvaloracion ID de la valoración.
	 * @return void
	 */
	public function setIDValoracion($idvaloracion) : void {
		$this->idvaloracion = $idvaloracion;
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
	 * @param string $email Email del autor de la valoración.
	 * @return void
	 */
	public function setEmail($email) : void {
		$this->email = $email;
	}

    /**
	 * Método que inicializa el atributo valoracion.
	 *
	 * @access public
	 * @param float $valoracion La nota de la valoración.
	 * @return void
	 */
	public function setValoracion($valoracion) : void {
		$this->valoracion = $valoracion;
	}

	/**
	 * Método que inicializa el atributo fechaval.
	 *
	 * @access public
	 * @param string $fechaval Fecha de la valoracion.
	 * @return void
	 */
	public function setFechaval($fechaval) : void {
		$this->fechaval = $fechaval;
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
	 * Método que devuelve el valor del atributo valoracions.
	 *
	 * @access public
	 * @return string Valor de la valoración.
	 */
	public function getValoracion(): string {
		return $this->contenido;
	}
	
	/**
	 * Método que devuelve el valor del atributo fecha.
	 *
	 * @access public
	 * @return string Fecha del comentario.
	 */
	public function getFechaval(): string {
		return $this->fechaval;
	}
	
    /**
	 * Método que añade una nueva valoracion.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function almacenaValoracion() : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdvaloraciones = new BDValoraciones();
		/** Inicializa los atributos del objeto. */
                $bdvaloraciones->setIDPelicula($this->idpelicula);
		$bdvaloraciones->setEmail($this->email);
		$bdvaloraciones->setValoracion($this->valoracion);
		/** Inserta una nueva película y comprueba un posible error. */
		if ($bdvaloraciones->introValoracion()) {
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
	public function mostrarValoracion() : bool {
		/** @var BDPeliculas Instancia un objeto de la clase. */
		$bdvaloracion = new BDValoraciones();
		/** Inicializa los atributos del objeto. */
		$bdvaloracion->setIDPelicula($this->idpelicula);
		/** Elimina un usuario y comprueba un posible error. */
		if ($bdvaloracion->mediaValoraciones()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

}