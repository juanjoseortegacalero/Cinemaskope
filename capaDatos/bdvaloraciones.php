<?php
/**
 * bdvaloraciones.php
 * Módulo secundario que implementa la clase BDValoraciones.
 */

/** Incluye la clase. */
include_once 'bdpagina.php';

/**
 * Declaración de la clase BDValoraciones
 * */
class BDValoraciones extends BDPagina{

    /**
	 * @var int ID de la valoración.
	 * @access private
	 */
	private int $idvaloracion;

    /**
	 * @var int ID de la película cuya valoraci le pertenece.
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
	 * Método que inicializa el atributo idvaloración.
	 *
	 * @access public
	 * @param int $idvaloracion ID de la valoración.
	 * @return void
	 */
	public function setIDValoracion($idvaloracion) : void {
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
	 * Método que devuelve el valor del atributo idvaloracion.
	 *
	 * @access public
	 * @return int ID de las valoraciones.
	 */
	public function getIDValoracion() : int {
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
	 * @return string Fecha de la valoración.
	 */
	public function getFechaval(): string {
		return $this->fechaval;
	}
	
	/**
	 * Método que inserta una nueva valoración en la base de datos
	 *
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function introValoracion() : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"INSERT INTO Valoraciones (idpelicula, email, valoracion)
					VALUES (:idpelicula, :email, :valoracion)");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':idpelicula', $this->idpelicula);
			$resultado->bindParam(':email', $this->email);
			$resultado->bindParam(':valoracion', $this->valoracion);
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
	 * Método que muestra la media de las valoraciones
	 *
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
         public function mediaValoraciones() : bool{
          if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
                        $final = $this->getPdocon()->prepare(
					"SELECT round(AVG(valoracion), 2) FROM Valoraciones WHERE idpelicula = '$this->idpelicula'");
                        $final->execute();
                        $results = $final->fetchAll(PDO::FETCH_COLUMN);
                        
                         foreach ($results as $result){
                         echo $result;
                         }
                        }
                        
                        
			/** Ejecuta la sentencia preparada y comprueba un posible error. */
			if ($final->execute()) {
				/** Devuelve true si se ha conseguido. */
                                
				return true;
			}
                    /** Devuelve false si se ha producido un error. */
                    return false;
		}
}