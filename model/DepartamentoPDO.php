<?php

/**
 * Class DepartamentoPDO
 *
 * Clase cuyos métodos se encargan de realizar consultas a la tabla T02_Departamento de la base de datos.
 * 
 * @author Beatriz Merino Macía
 * @since 1.0 Version 
 * @copyright Copyright (c) 2020 - 2021, Beatriz Merino Macía
 * @version 1.4
 */

class DepartamentoPDO {
    
    /**
     * Método buscaDepartamentoPorCod()
     *
     * Método que obtiene todos los datos de un departamento de la base de datos
     * 
     * @param  string $codigo código del departamento del que queremos obtener los datos
     * @return null|\Departamento devuelve un objeto de tipo Departamento con los datos guardados en la base de datos y null si no se ha encontrado el departamento en la BBDD
     */
    public static function buscaDepartamentoPorCod($codigo) {
        //Inicializo la variable que tendrá el objeto de clase usuario en el caso de que se encuentre en la base de datos
        $oDepartamento = null; 
        
        $consulta = "SELECT * FROM T02_Departamento WHERE T02_CodDepartamento=?";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codigo]);

        //Si la consulta me devuelve algún resultado lo guardo en una variable para instanciar un nuevo objeto Departamento con esos datos
        if ($resultado->rowCount() > 0) {
            $oDepartamentoConsulta = $resultado->fetchObject();
            $oDepartamento = new Departamento($oDepartamentoConsulta->T02_CodDepartamento, $oDepartamentoConsulta->T02_DescDepartamento, $oDepartamentoConsulta->T02_FechaCreacionDepartamento, $oDepartamentoConsulta->T02_VolumenNegocio, $oDepartamentoConsulta->T02_FechaBajaDepartamento);
        }
        
        //Devuelvo el objeto
        return $oDepartamento;
    }

    /**
     * Método buscaDepartamentosPorDesc()
     *
     * Método que obtiene todos los datos departamentos de la base de datos
     * 
     * @param  string $busqueda descripción del departamento a buscar
     * @return null|\array devuelve un array de objetos de tipo Departamento con los datos guardados en la base de datos y null si no se ha encontrado ninguno
     */
    public static function buscaDepartamentosPorDesc($busqueda) {

        $consulta = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE CONCAT('%', ?, '%')";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$busqueda]);

        //Si hay algún resultado lo almacena en la variable
        if ($resultado->rowCount() > 0) {
            $departamento = $resultado->fetchObject();
            //Variable para el número del departamento del array equivalente a la posición del array
            $numDepartamento = 0;

            //Mientras haya departamentos 
            while ($departamento) { 
                // Instanciamos un objeto Departamento con los datos devueltos por la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
                //Añade el objeto Departamento en el array en la posición indicada
                $aDepartamentos[$numDepartamento] = $oDepartamento;
                //Incrementa la posición del array
                $numDepartamento++;
                //Avanza el puntero al siguiente departamento
                $departamento = $resultado->fetchObject();
            }
        }
        
        //Devuelve el array de departamentos
        return $aDepartamentos;
    }
    
    /**
     * Método altaDepartamentoo()
     * 
     * Método que da de alta en la base de datos a un nuevo departamento
     * 
     * @param string $codigo código del departamento
     * @param string $descripcion descripción del departamento
     * @param string $volumen del departamento
     * @return boolean devuelve true si se ha podido dar de alta el departamento o false si no se ha podido
     */
    public static function altaDepartamento($codigo, $descripcion, $volumen) {
        //Variable booleana inicializada a false
        $alta = false;

        //Crea el departamento en la base de datos ejecutando un query
        $consulta = "Insert into T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenNegocio, T02_FechaCreacionDepartamento) values (?,?,?,?)";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codigo, $descripcion, $volumen, time()]);

        //Si la consulta me devuelve algún resultado cambiamos el valor de $resultado a true
        if ($resultado) {
            $alta = true;
        }

        //Devuelvo la variable
        return $alta;
    }
    
    /**
     * Método bajaFisicaDepartamento()
     * 
     * Método que elimina un departamento de la base de datos
     *
     * @param  string $codigo código del usuario que queremos borrar
     * @return boolean true si se ha borrado el departamento y false en caso contrario
     */
    public static function bajaFisicaDepartamento($codigo) {
        //Variable booleana inicializada a false
        $borrado = false;
        
        //Borra el departamento de la base de datos ejecutando un query
        $consulta = "DELETE FROM T02_Departamento WHERE T02_CodDepartamento=?";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codigo]);

        //Si la consulta me devuelve algún resultado cambiamos el valor de $borrado a true
        if ($resultado) {
            $borrado = true;
        }
        
        //Devuelvo la variable
        return $borrado;
    }
    
    public static function bajaLogicaDepartamento($codigo) {
        
    }
    
    /**
     * Método modificarDepartamento()
     *
     * Método que modifica el valor de la descripción y el volumen del departamento.
     * 
     * @param  int $volumen nuevo volumen de negocio
     * @param  string $descripcion nueva descripción del usuario
     * @param  string $codigo codigo del departamento que queremos modificar
     * @return boolean devuelve true si se ha podido modificar el departamento y false si no
     */
    public static function modificaDepartamento($volumen, $descripcion, $codigo) {
        //Variable booleana inicializada a false
        $departamentoModificado = false;

        //Modifica el departamento en la base de datos ejecutando un query
        $sentenciaSQL = "UPDATE T02_Departamento SET T02_DescDepartamento=?, T02_VolumenNegocio=? WHERE T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$descripcion, $volumen, $codigo]);

        //Si la consulta me devuelve algún resultado cambiamos el valor de $departamentoModificado a true
        if ($resultadoConsulta) {
            $departamentoModificado = true;
        }
        
        //Devuelvo la variable
        return $departamentoModificado;
    }
    
    public static function rehabilitaDepartamento($codigo) {
        
    }
    
    /**
     * Método validarCodNoExiste()
     * 
     * Método que comprueba si un departamento existe o no en la base de datos 
     * 
     * @param string $codDepartamento código de departamento que queremos comprobar
     * @return boolean devuelve true si no existe y false en caso contrario
     */
    public static function validaCodNoExiste($codDepartamento) {
        //Variable booleana inicializada a true
        $departamentoNoExiste = true;
        
        //Comprueba que el departamento introducido existe en la base de datos ejecutando un query
        $consulta = "Select * from T02_Departamento where T02_CodDepartamento=?";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codDepartamento]); 

        //Si la consulta me devuelve algún resultado cambiamos el valor de $departamentoNoExiste a false
        if ($resultado->rowCount() > 0) {
            $departamentoNoExiste = false;
        }

        //Devuelvo la variable
        return $departamentoNoExiste;
    }
}