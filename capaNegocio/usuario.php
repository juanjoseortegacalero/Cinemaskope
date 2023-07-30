<?php
/**
 * usuario.php
 * Módulo secundario que implementa la clase Usuario.
 */

/** Incluye la clase. */
include 'capaDatos/bdusuarios.php';

/**
 * Declaración de la clase Usuario
*/
class Usuario {

	/**
	 * @var string Dirección de correo electrónico del usuario.
	 * @access private
	 */
	private string $email;

	/**
	 * @var string Contraseña del usuario.
	 * @access private
	 */
	private string $contraseña;

	/**
	 * @var string Nombre completo del usuario.
	 * @access private
	 */
	private string $nombre;

	/**
	 * Método que inicializa el atributo $email.
	 *
	 * @access public
	 * @param string $email Email del usuario.
	 * @return array[]:string Array de errores.
	 */
	public function setEmail(string $email) : array {
		/** @var array[]:string  Array vacío, supone que no hay errores. */
		$error = array();
		/** @var string Sanea la dirección de correo. */
		$emailSaneado = filter_var($email, FILTER_SANITIZE_EMAIL);
		/** Valida la dirección de correo. */
		if (!filter_var($emailSaneado, FILTER_VALIDATE_EMAIL)) {
			/** Almacena el error en al array de errores. */
			$error[] = 'El email no es posible sanearlo y debe tener un formato válido';
		}
		/** Comprueba si no hay errores. */
		if (!$error) {
			/** Inicializa el valor de la propiedad. */
			$this->email = $emailSaneado;
		}
		/** Devuelve el array de errores. */
		return $error;
	}

	/**
	 * Método que inicializa el atributo contraseña.
	 *
	 * @access public
	 * @param string $contraseña Contraseña del usuario.
	 * @return array[]:string Array de errores.
	 */
	public function setContraseña(string $contraseña) : array {
		/** @var array[]:string  Array vacío, supone que no hay errores. */
		$error = array();
		/** Comprueba la longitud de la contraseña. */
		if (strlen($contraseña) < 5 ) {
			/** Almacena el error en al array de errores. */
			$error[] = 'La contraseña debe tener al menos 5.';
		}
		/** Comprueba que todos los caracteres sean alfanuméricos. */
		if (!ctype_alnum($contraseña)) {
			/** Almacena el error en al array de errores. */
			$error[] = 'La contraseña debe contener sólo caracteres alfanuméricos.';
		}
		/** @var boolean Bandera de control de que al menos haya una letra mayúscula. */
		$errorMayuscula = false;
		/** @var integer Posición inicial del string. */
		$i = 0;
		/** Recorre el string comprobando uno a uno todos los caracteres,
		 *  hasta que se encuentra un error o hasta el final si no hay error. */
		while ($i < strlen($contraseña) && !$errorMayuscula) {
			/** Comprueba que contiene al menos una letra mayúscula. */
			if (ctype_upper($contraseña[$i])) {
				/** Existe una letra mayúscula. */
				$errorMayuscula = true;
			}
			/** Avanza a la siguiente posición del string. */
			$i++;
		}
		/** Comprueba si no contiene al menos una letra mayúscula. */
		if (!$errorMayuscula) {
			/** Almacena el error en al array de errores. */
			$error[] = 'La contraseña debe tener al menos una letra mayúscula.';
		}
		/** Comprueba si no hay errores. */
		if (!$error) {
			/** Inicializa el valor de la propiedad. */
			$this->contraseña = $contraseña;
		}
		/** Devuelve el indicador de error. */
		return ($error);
	}

	/**
	 * Método que inicializa el atributo $nombre.
	 *
	 * @access public
	 * @param string $nombre Nombre del usuario.
	 * @return void
	 */
	public function setNombre(string $nombre) : void {
		/** Inicializa la propiedad. */
		$this->nombre = $nombre;               
                
	}

	/**
	 * Método que devuelve el valor del atributo $email.
	 *
	 * @access public
	 * @return string Email del usuario.
	 */
	public function getEmail() : string {
		/** Devuelve el valor de la propiedad. */
		return $this->email;
	}

	/**
	 * Método que devuelve el valor del atributo $contraseña.
	 *
	 * @access public
	 * @return string Contraseña del usuario.
	 */
	public function getContraseña() : string {
		/** Devuelve el valor de la propiedad. */
		return $this->contraseña;
	}

	/**
	 * Método que devuelve el valor del atributo $nombre.
	 *
	 * @access public
	 * @return string Nombre del usuario.
	 */
	public function getNombre() : string {
		/** Devuelve el valor de la propiedad. */
		return $this->nombre;
	}

	/**
	 * Método que comprueba si existe el usuario.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function existeUsuario() : bool {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Inicializa los atributos del objeto. */
		$bdusuario->setEmail($this->email);
		$bdusuario->setContraseña($this->contraseña);
		$bdusuario->setNombre($this->nombre);
		/** Comprueba si existe el usuario. */
		if ($bdusuario->existeUsuario()) {
			/** El usuario existe. */
			return true;
		}
		/** El usuario no existe. */
		return false;
	}

	/**
	 * Método que añade un nuevo usuario.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function almacenaUsuario() : bool {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Inicializa los atributos del objeto. */
		$bdusuario->setEmail($this->email);
		$bdusuario->setContraseña($this->contraseña);
		$bdusuario->setNombre($this->nombre);
		/** Inserta un nuevo usuario y comprueba un posible error. */
		if ($bdusuario->altaUsuario()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

	/**
	 * Método que valida un usuario.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function validaUsuario() : bool {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Inicializa los atributos del objeto. */
		$bdusuario->setEmail($this->email);
		$bdusuario->setContraseña($this->contraseña);
		/** Comprueba si existe y gestiona un posible error. */
		if ($bdusuario->validaUsuario()) {
			/** Inicializa los atributos del objeto con los datos almacenados. */
			$this->nombre = $bdusuario->getNombre();
			$this->email = $bdusuario->getEmail();
			$this->contraseña = $bdusuario->getContraseña();
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

	/**
	 * Método que modifica los datos de un usuario.
	 *
	 * @access public
	 * @param string $emailOriginal Email original del usuario.
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function modificaUsuario(string $emailOriginal) : bool {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Inicializa los atributos del objeto. */
		$bdusuario->setEmail($this->email);
		$bdusuario->setContraseña($this->contraseña);
		$bdusuario->setNombre($this->nombre);
		/** Modifica los datos del usuario y comprueba un posible error. */
		if ($bdusuario->modificaUsuario($emailOriginal)) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}

	/**
	 * Método que elimina un usuario.
	 *
	 * @access public
	 * @return boolean	True en caso afirmativo
	 * 					False en caso contrario.
	 */
	public function eliminaUsuario() : bool {
		/** @var BDUsuarios Instancia un objeto de la clase. */
		$bdusuario = new BDUsuarios();
		/** Inicializa los atributos del objeto. */
		$bdusuario->setEmail($this->email);
		/** Elimina un usuario y comprueba un posible error. */
		if ($bdusuario->eliminaUsuario()) {
			/** Devuelve true si se ha conseguido. */
			return true;
		}
		/** Devuelve false si se ha producido un error. */
		return false;
	}
}
