<?php

/**
 * Class Usuario
 *
 * Clase que se va a utilizar para crear un objeto de la clase Usuario
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.0
 * @copyright 16-01-2021
 * @version 1.0
 */
class Usuario {
    
    /**
     * Codigo del usuario 
     * 
     * @var string 
     */
    private $codUsuario;
    
    /**
     * Password del usuario 
     * 
     * @var string  
     */
    private $password;
    
    /**
     * Descripcion del usuario 
     * 
     * @var string 
     */
    private $descUsuario;
    
    /**
     * Numero de conexiones que ha realizado el usuario 
     * 
     * @var int 
     */
    private $numConexiones;
    
    /**
     * Ultima fecha y hora de la ultima conexion en formato timestamp 
     * 
     * @var int 
     */
    private $fechaHoraUltimaConexion;
    
    /**
     * Tipo de perfil del usuario (usuario, administrador) 
     * 
     * @var string 
     */
    private $perfil;
    
    /**
     * Datos de la imagen en formato binario de la base de datos
     * 
     * @var string 
     */
    private $imagenPerfil;
    
    /**
     * Metodo magico __construct()
     * 
     * Metodo magico del constructor de la clase Usuario
     * 
     * @param string $codUsuario codigo del usuario
     * @param string $password password del usuario
     * @param string $descUsuario descripcion del usuario
     * @param int $numConexiones numero de conexiones del usuario
     * @param int $fechaHoraUltimaConexion fecha y hora de la ultima conexion del usuario en formato timestamp
     * @param string $perfil tipo de perfil del usuario
     * @param string $imagenPerfil imagen de perfil del usuario imagen en formato binario de la base de datos
     */
    function __construct($codUsuario, $password, $descUsuario, $numConexiones, $fechaHoraUltimaConexion, $perfil, $imagenPerfil) {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numConexiones = $numConexiones;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->perfil = $perfil;
        $this->imagenPerfil = $imagenPerfil;
    }
    
    /**
     * Metodo getCodUsuario()
     * 
     * Metodo que devuelve el codigo del usuario
     * 
     * @return string codigo del usuario
     */
    function getCodUsuario() {
        return $this->codUsuario;
    }

    /**
     * Metodo getPassword()
     * 
     * Metodo que devuelve el password del usuario
     * 
     * @return string password del usuario
     */
    function getPassword() {
        return $this->password;
    }

    /**
     * Metodo getDescUsuario()
     * 
     * Metodo que que devuelve la descripcion del usuario
     * 
     * @return string descripcion del usuario
     */
    function getDescUsuario() {
        return $this->descUsuario;
    }

    /**
     * Metodo getNumConexiones()
     * 
     * Metodo que devuelve el numero de conexiones del usuario
     * 
     * @return int numero de conexiones del usuario
     */
    function getNumConexiones() {
        return $this->numConexiones;
    }

    /**
     * Metodo getFechaHoraUltimaConexion()
     * 
     * Metodo que devuelve la fecha y hora de la ultima conexion del usuario en formato timestamp
     * 
     * @return int ultima fecha y hora de la ultima conexion en formato timestamp
     */
    function getFechaHoraUltimaConexion() {
        return $this->fechaHoraUltimaConexion;
    }

    /**
     * Metodo getPerfil()
     * 
     * Metodo que devuelve el tipo de perfil del usuario
     * 
     * @return string tipo de perfil del usuario
     */
    function getPerfil() {
        return $this->perfil;
    }

    /**
     * Metodo getImagenPerfil()
     * 
     * Metodo que devuelve la imagen en formato binario de la base de datos
     * 
     * @return string imagen en formato binario
     */
    function getImagenPerfil() {
        return $this->imagenPerfil;
    }
    
    /**
     * Metodo setCodUsuario()
     * 
     * Metodo que cambia el valor del atributo $codUsuario
     * 
     * @param string $codUsuario nuevo codigo del usuario
     */
    function setCodUsuario($codUsuario) {
        $this->codUsuario = $codUsuario;
    }

    /**
     * Metodo setPassword()
     * 
     * Metodo que cambia el valor del atributo $password
     * 
     * @param string $password nueva password del usuario
     */
    function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Metodo setDescUsuario()
     * 
     * Metodo que cambia el valor del atributo $descUsuario
     * 
     * @param string $descUsuario nueva descripcion del usuario
     */
    function setDescUsuario($descUsuario) {
        $this->descUsuario = $descUsuario;
    }

    /**
     * Metodo setNumConexiones()
     * 
     * Metodo que cambia el valor del atributo $numConexiones
     * 
     * @param int $numConexiones nuevo numero de conexiones del usuario
     */
    function setNumConexiones($numConexiones) {
        $this->numConexiones = $numConexiones;
    }

    /**
     * Metodo setFechaHoraUltimaConexion()
     * 
     * Metodo que cambia el valor del atributo $fechaHoraUltimaConexion
     * 
     * @param int $fechaHoraUltimaConexion nueva fecha y hora en formato timestamp
     */
    function setFechaHoraUltimaConexion($fechaHoraUltimaConexion) {
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
    }

    /**
     * Metodo setPerfil()
     * 
     * Metodo que cambia el valor del atributo $perfil
     * 
     * @param string $perfil nuevo tipo de perfil
     */
    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    /**
     * Metodo setImagenPerfil()
     * 
     * Metodo que cambia el valor del atributo $imagenPerfil
     * 
     * @param string $imagenPerfil nueva imagen de perfil en formato binario 
     */
    function setImagenPerfil($imagenPerfil) {
        $this->imagenPerfil = $imagenPerfil;
    }
}