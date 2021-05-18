<?php

/**
 * Class UsuarioPDO
 *
 * Clase cuyos metodos hacen consultas a la tabla T01_Usuario de la base de datos
 * 
 * @author Cristina Nuñez y Javier Nieto
 * @since 1.0
 * @copyright 2020-2021 Cristina Nuñez y Javier Nieto
 * @version 1.0
 */
class UsuarioPDO{
    
    /**
     * Método validarUsuario()
     * 
     * Método que valida si existe un determinado usuario y password en la base de datos.
     * Si existe el usuario actualiza la última conexión y el número de conexiones de ese usuario y lo devuelve.
     * Si no existe el usuario devuelve null.
     * 
     * @param string $codUsuario código del usuario
     * @param string $password password del usuario
     * @return null|\Usuario devuelve un objeto de tipo Usuario con los datos guardados en la base de datos y null si no se ha encontrado el usuario en la BBDD
     */
    public static function validarUsuario($codUsuario, $password){
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oUsuario = null; 

        //Comprueba que el usuario y el password introducido existen en la base de datos
        $sentenciaSQL = "Select * from T01_Usuario where T01_CodUsuario=? and T01_Password=?";
        //Encripta el password pasado como parámetro
        $passwordEncriptado=hash("sha256", ($codUsuario.$password));
        //Guardo en la variable resultadoConsulta el resultado de la consulta con los parámetros pasados
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$codUsuario,$passwordEncriptado]); 
        
        //Si la consulta me devuelve algún resultado lo guardo en una variable para instanciar un nuevo objeto Usuario con esos datos
        if($resultadoConsulta->rowCount()>0){ 
            $oRegistroUsuario = $resultadoConsulta->fetchObject();
            $oUsuario = new Usuario($oRegistroUsuario->T01_CodUsuario, $oRegistroUsuario->T01_Password, $oRegistroUsuario->T01_DescUsuario, $oRegistroUsuario->T01_NumConexiones, $oRegistroUsuario->T01_FechaHoraUltimaConexion, $oRegistroUsuario->T01_Perfil, $oRegistroUsuario->T01_ImagenUsuario);
        }
        
        return $oUsuario;
    }


    /**
     * Método altaUsuario()
     * 
     * Método que da de alta en la base de datos a un nuevo usuario
     * 
     * @param string $codUsuario código del usuario
     * @param string $password password del usuario
     * @param string $descUsuario descripción del usuario
     * @return null|\Usuario devuelve un objeto de tipo Usuario con los datos guardados en la base de datos y null si no se ha podido dar de alta
     */
    public static function altaUsuario($codUsuario, $password, $descUsuario){
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oUsuario = null;

        $sentenciaSQL = "Insert into T01_Usuario (T01_CodUsuario, T01_DescUsuario, T01_Password , T01_NumConexiones, T01_FechaHoraUltimaConexion) values (?,?,?,1,?)";
        //Encripta el password pasado como parámetro
        $passwordEncriptado=hash("sha256", ($codUsuario.$password));
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$codUsuario, $descUsuario, $passwordEncriptado,  time()]);

        if($resultadoConsulta){
            $oUsuario = self::buscarUsuarioPorCod($codUsuario);
        }

        return $oUsuario;
    }

    
    /**
     * Método registrarUltimaConexion()
     *
     * Método que actualiza la fechaHoraUltimaConexion y el número de conexiones del usuario pasado como parámetro
     * 
     * @param  string $codUsuario codigo del usuario al que queremos actualizar la ultima conexion
     * @return null|\Usuario devuelve un objeto de tipo Usuario con los datos guardados en la base de datos y null si no se ha podido actualizar la ultima conexion
     */
    public static function registrarUltimaConexion($codUsuario){
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oUsuario = null;

        $sentenciaSQLActualizacionFechaConexion = "Update T01_Usuario set T01_NumConexiones = T01_NumConexiones+1, T01_FechaHoraUltimaConexion=? where T01_CodUsuario=?";
        $resultadoActualizacionFechaConexion = DBPDO::ejecutaConsulta($sentenciaSQLActualizacionFechaConexion, [time(),$codUsuario]);
        
        if($resultadoActualizacionFechaConexion){
            $oUsuario = self::buscarUsuarioPorCod($codUsuario);
        }

        return $oUsuario;
    }

    
    /**
     * Método modificarUsuario()
     *
     * Método que modifica el valor de la descripción del usuario. 
     * Si el valor del parámetro de la imagen no es null modifica también la imagen de perfil del usuario.
     * 
     * @param  string $codUsuario código del usuario que queremos modificar
     * @param  string $descUsuario nueva descripción del usuario
     * @param  string $imagenPerfil nueva imagen de perfil
     * @return null|\Usuario devuelve un objeto de tipo Usuario con los datos guardados en la base de datos y null si no se ha podido modificar
     */
    public static function modificarUsuario($codUsuario,$descUsuario,$imagenPerfil){
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oUsuario = null;

        $sentenciaSQL = "Update T01_Usuario set T01_DescUsuario=?". (($imagenPerfil!=null) ? ", T01_ImagenUsuario=?" : "") . " where T01_CodUsuario=?";

        if($imagenPerfil!=null){
            $parametros = [$descUsuario, $imagenPerfil, $codUsuario];
        }else{
            $parametros = [$descUsuario, $codUsuario];
        }
        
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, $parametros); 
        
        if($resultadoConsulta){
            $oUsuario = self::buscarUsuarioPorCod($codUsuario);
        }

        return $oUsuario;
    }

    
    /**
     * Método cambiarPassword()
     * 
     * Método que cambia el password del usuario pasado como parámetro
     *
     * @param  string $codUsuario código del usuario al que queremos cambiar el password
     * @param  string $passwordNueva nueva password que se quiere poner al usuario
     * @return null|\Usuario devuelve un objeto de tipo Usuario con los datos guardados en la base de datos y null si no se ha podido modificar el password
     */
    public static function cambiarPassword($codUsuario, $passwordNueva){
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oUsuario = null;

        $sentenciaSQL = "Update T01_Usuario set T01_Password=? where T01_CodUsuario=?";
        //Encripta el password pasado como parametro
        $passwordEncriptado = hash("sha256", $codUsuario.$passwordNueva);
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$passwordEncriptado,$codUsuario]);

        if($resultadoConsulta){
            $oUsuario = self::buscarUsuarioPorCod($codUsuario);
        }

        return $oUsuario;
    }

        
    /**
     * Método borrarUsuario()
     * 
     * Método que elimina un usuario de la base de datos
     *
     * @param  string $codUsuario código del usuario que queremos borrar
     * @return boolean true si se ha borrado el usuario y false en caso contrario
     */
    public static function borrarUsuario($codUsuario){
        //Inicializamos la variable usuarioEliminado a false
        $usuarioEliminado = false; 

        $sentenciaSQL = "Delete from T01_Usuario where T01_CodUsuario=?";
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$codUsuario]);

        // Si se ha realizado la consulta correctamente cambiamos el valor de $usuarioEliminado a true
        if($resultadoConsulta){ 
            $usuarioEliminado = true;
        }

        return $usuarioEliminado;
    }


    /**
     * Método validarCodNoExiste()
     * 
     * Método que comprueba si un usuario existe o no en la base de datos 
     * 
     * @param string $codUsuario código de usuario que queremos comprobar
     * @return boolean devuelve true si no existe y false en caso contrario
     */
    public static function validarCodNoExiste($codUsuario){
        //Inicializo la variable booleana a true
        $usuarioNoExiste = true; 
        
        //Comprueba que el usuario introducido existe en la base de datos
        $sentenciaSQL = "Select * from T01_Usuario where T01_CodUsuario=?";
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$codUsuario]);
        
        //Si la consulta me devuelve algun resultado cambiamos el valor de $usuarioNoExiste a false
        if($resultadoConsulta->rowCount()>0){ 
            $usuarioNoExiste = false;
        }
        
        return $usuarioNoExiste;
    }

        
    /**
     * Método buscarUsuarioPorCod()
     *
     * Método que obtiene todos los datos de un usuario de la base de datos
     * 
     * @param  string $codUsuario código del usuario del que queremos obtener los datos
     * @return null|\Usuario devuelve un objeto de tipo Usuario con los datos guardados en la base de datos y null si no se ha encontrado el usuario en la BBDDs
     */
    public static function buscarUsuarioPorCod($codUsuario){
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oUsuario = null; 

        $sentenciaSQLDatosUsuario = "Select * from T01_Usuario where T01_CodUsuario=?";
        $resultadoDatosUsuario = DBPDO::ejecutaConsulta($sentenciaSQLDatosUsuario, [$codUsuario]);
        
        //Si la consulta me devuelve algún resultado lo guardo en una variable para instanciar un nuevo objeto Usuario con esos datos
        if($resultadoDatosUsuario->rowCount()>0){
            $oUsuarioConsulta = $resultadoDatosUsuario->fetchObject();
            $oUsuario = new Usuario($oUsuarioConsulta->T01_CodUsuario, $oUsuarioConsulta->T01_Password, $oUsuarioConsulta->T01_DescUsuario, $oUsuarioConsulta->T01_NumConexiones, $oUsuarioConsulta->T01_FechaHoraUltimaConexion, $oUsuarioConsulta->T01_Perfil, $oUsuarioConsulta->T01_ImagenUsuario);
        }

        return $oUsuario;

    }
}