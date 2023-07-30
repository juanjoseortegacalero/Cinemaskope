<?php
/**
 * bdpeliculas.php
 * Módulo secundario que implementa la clase BDPelículas.
 */

/** Incluye la clase. */
include_once 'bdpagina.php';

/**
 * Declaración de la clase BDPeliculas
 * */
class BDPeliculas extends BDPagina {

	/**
	 * @var int ID de la película.
	 * @access private
	 */
	private int $idpelicula;

	/**
	 * @var string Nombre de la película.
	 * @access private
	 */
	private string $nombre;

	/**
	 * @var string Fecha de estreno de la película.
	 * @access private
	 */
	private string $fecha;
    
    /**
	 * @var string Sinopsis de la película.
	 * @access private
	 */
	private string $sinopsis;

    /**
	 * @var float Valoración de la película.
	 * @access private
	 */
	private float $valoracion;

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
	 * Método que inserta una nueva pelicula en la base de datos.
	 *
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function introPelicula() : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"INSERT INTO Peliculas (idpelicula, nombre, fecha, sinopsis, valoracion)
					VALUES (:idpelicula, :nombre, :sinopsis)");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':idpelicula', $this->idpelicula);
			$resultado->bindParam(':nombre', $this->nombre);
			$resultado->bindParam(':fecha', $this->fecha);
			$resultado->bindParam(':sinopsis', $this->sinopsis);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

	/**
	 * Método que elimina una película existente de la base de datos.
	 *
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function eliminaPelicula() : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"DELETE FROM Peliculas
					 WHERE idpelicula = :idpelicula");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':idpelicula', $this->idpelicula);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
	/**
	 * Método que modifica los datos de una pelicula.
	 *
	 * @access public
	 * @param int $idpelicula Valor inicial de la pelicula.
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function editaPelicula($idpelicula) : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"UPDATE Peliculas
					 SET nombre = :nombre,
					 SET fecha = :fecha,
					 SET sinopsis = :sinopsis
					 WHERE idpeliculas = :idpeliculas");
			/** Vincula los parámetros a los nombre de variables especificado. */
			$resultado->bindParam(':contenido', $this->contenido);
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($resultado->execute()) {
				/** Devuelve true si se ha conseguido. */
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
      /**
     * Método que muestra los nombres de las peliculas.
     * @access public
     * @return bool
     */
      public function mostrarNombre() : bool{
          if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
                        $final = $this->getPdocon()->prepare(
					"SELECT nombre FROM Peliculas WHERE idpelicula = '$this->idpelicula'");
                        $final->execute();
                        $results = $final->fetchAll(PDO::FETCH_COLUMN);
                        
                        foreach ($results as $result){
                         echo $result;
                         }

			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($final->execute()) {
				/** Devuelve true si se ha conseguido. */
                                
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
        }
       
      /**
     * Método que muestra las sinopsis de las peliculas.
     * @access public
     * @return bool
     */
      public function mostrarSinopsis() : bool{
          if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
                        $final = $this->getPdocon()->prepare(
					"SELECT sinopsis FROM Peliculas WHERE idpelicula = '$this->idpelicula'");
                        $final->execute();
                        $results = $final->fetchAll(PDO::FETCH_COLUMN);
                        
                        foreach ($results as $result){
                         echo $result;
                         }

			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($final->execute()) {
				/** Devuelve true si se ha conseguido. */
                                
				return true;
			}
		}
		/** Devuelve false si se ha producido un error. */
		return false;
        }
}