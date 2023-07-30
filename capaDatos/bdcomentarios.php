<?php
/**
 * bdcomentarios.php
 * Módulo secundario que implementa la clase BDComentarios.
 */

/** Incluye la clase. */
include_once 'bdpagina.php';

/**
 * Declaración de la clase BDComentarios
 * */
class BDComentarios extends BDPagina{

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
	 * Método que inserta un nuevo comentario en la base de datos
	 *
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function almacenaComentario() : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"INSERT INTO Comentarios (idpelicula, email, contenido)
					VALUES (:idpelicula, :email, :contenido)");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':idpelicula', $this->idpelicula);
			$resultado->bindParam(':email', $this->email);
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
     * Método que muestra los comentarios en las páginas de su respectiva película.
     * @access public
     * @return bool
     */
      public function historialComentarios() : bool{
          if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
                        $final = $this->getPdocon()->prepare(
					"SELECT * FROM Comentarios WHERE idpelicula = '$this->idpelicula'");
                        $final->execute();
                        $results = $final->fetchAll(PDO::FETCH_OBJ);

                        foreach ($results as $result){
                        echo '<div class="fondo_mensaje esquinas">
	<div class="titular-comentario contenido-comentario esquinas">
		<table cellpadding="0" cellspacing=1">
			<tr>
				<td><b>'.$result -> email.'</b></td>
			</tr>
		</table>
	</div><div class="texto_mensaje" style="color: #000000;">'.$result -> contenido.'</div>'
                            . '<div class="texto_mensaje" style="color: #000000;">'.$result -> fecha.'</div></div>';
    
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
     * Método que muestra los comentarios en las páginas de su respectivo usuario autor.
     * @access public
     * @return bool
     */
        public function historialComentariosU() : bool{
          if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
                        $final = $this->getPdocon()->prepare(
					"SELECT * FROM Comentarios WHERE email = '$this->email'");
                        $final->execute();
                        $results = $final->fetchAll(PDO::FETCH_OBJ);

                        foreach ($results as $result){
                        echo '<div class="fondo_mensaje esquinas">
	<div class="titular-comentario contenido-comentario esquinas">
		<table cellpadding="0" cellspacing=1">
			<tr>
				<td><b>'.$result -> email.'</b></td>
			</tr>
		</table>
	</div><div class="texto_mensaje" style="color: #000000;">'.$result -> contenido.'</div>'
                            . '<div class="texto_mensaje" style="color: #000000;">'.$result -> fecha.'</div></div>';
    
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
	 * Método que elimina un comentario existente de la base de datos.
	 *
	 * @access public
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function eliminaComentario() : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"DELETE FROM Comentarios
					 WHERE idcomentario = :idcomentario");
			/** Vincula un parámetro al nombre de variable especificado. */
			$resultado->bindParam(':idcomentario', $this->idcomentario);
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
	 * Método que modifica el contenido de un comentario.
	 *
	 * @access public
	 * @param int $idcomentario Valor inicial del comentario.
	 * @return boolean True si tiene éxito y False en otro caso
	 */
	public function editaComentario($idcomentario) : bool {
		/** Comprueba si existe conexión con la base de datos. */
		if ($this->getPdocon()) {
			/** Prepara la sentencia SQL. */
			$resultado = $this->getPdocon()->prepare(
					"UPDATE Comentarios
					 SET contenido = :contenido
					 WHERE idcomentario = :idcomentario");
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
        
        
}