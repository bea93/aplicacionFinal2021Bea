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
     * Método que obtiene todos los datos de un departamento de la base de datos basándose en su descripción
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
     * Método que obtiene todos los datos departamentos de la base de datos basándose en su descripción
     * 
     * @param  string $busqueda descripción del departamento a buscar
     * @return null|\array devuelve un array de objetos de tipo Departamento con los datos guardados en la base de datos y null si no se ha encontrado ninguno
     */
    public static function buscaDepartamentosPorDesc($busqueda) {
        $aDepartamentos = null;
        
        $consulta = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE CONCAT('%', ?, '%')";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$busqueda]);

        //Si hay algún resultado lo almacena en la variable
        if ($resultado->rowCount() > 0) {
           
            for ($numDepartamento = 0, $departamento = $resultado->fetchObject(); $numDepartamento < $resultado->rowCount(); ++$numDepartamento, $departamento = $resultado->fetchObject()) {
                // Instanciamos un objeto Departamento con los datos devueltos por la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
                //Añade el objeto Departamento en el array en la posición indicada
                $aDepartamentos[$numDepartamento] = $oDepartamento;
            }
        }
        
        //Devuelve el array de departamentos
        return $aDepartamentos;
    }
    
    /**
     * Método buscaDepartamentosPorDescYEstado()
     *
     * Método que obtiene todos los datos departamentos de la base de datos basándose en su descripción y estado(alta o baja)
     * 
     * @param  string $busqueda descripción del departamento a buscar
     * @param  string $estado estado del departamento a buscar(alta o baja)
     * @return null|\array devuelve un array de objetos de tipo Departamento con los datos guardados en la base de datos y null si no se ha encontrado ninguno
     */
    public static function buscaDepartamentosPorDescYEstado($busqueda, $estado) {
        $aDepartamentos = null;
        $filtroConsulta = null;

        //Condiciones que se añadirán al query en función del estado del departamento
        if ($estado == "Baja") {
            $filtroConsulta = "AND T02_FechaBajaDepartamento IS NOT null";
        } else if ($estado == "Alta") {
            $filtroConsulta = "AND T02_FechaBajaDepartamento IS null";
        }
        
        $consulta = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%' ? '%' " . (($filtroConsulta != null) ? $filtroConsulta : NULL);
        $resultado = DBPDO::ejecutaConsulta($consulta, [$busqueda]);

        //Si hay algún resultado lo almacena en la variable
        if ($resultado->rowCount() > 0) {

            for ($numDepartamento = 0, $departamento = $resultado->fetchObject(); $numDepartamento < $resultado->rowCount(); ++$numDepartamento, $departamento = $resultado->fetchObject()) {
                // Instanciamos un objeto Departamento con los datos devueltos por la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
                //Añade el objeto Departamento en el array en la posición indicada
                $aDepartamentos[$numDepartamento] = $oDepartamento;
            }
        }

        //Devuelve el array de departamentos
        return $aDepartamentos;
    }
    /**
     * Método buscaDepartamentosPorDescEstadoYPagina()
     *
     * Método que obtiene todos los datos departamentos de la base de datos basándose en su descripción y estado(alta o baja)
     * 
     * @param  string $busqueda descripción del departamento a buscar
     * @param  string $estado estado del departamento a buscar(alta o baja)
     * @param  string $numPaginaActual descripción del departamento a buscar
     * @param  string $numMaxDepartamentos estado del departamento a buscar(alta o baja)
     * @return null|\array devuelve un array de objetos de tipo Departamento con los datos guardados en la base de datos y null si no se ha encontrado ninguno
     */
    public static function buscaDepartamentosPorDescEstadoYPagina($busqueda, $estado,  $numPaginaActual, $numMaxDepartamentos) {
        $aDepartamentos = [];
        $filtroConsulta = null;
        $numPaginasTotal = 1;

        //Condiciones que se añadirán al query en función del estado del departamento
        if ($estado == "Baja") {
            $filtroConsulta = "AND T02_FechaBajaDepartamento IS NOT null";
        } else if ($estado == "Alta") {
            $filtroConsulta = "AND T02_FechaBajaDepartamento IS null";
        }
        
        $consulta = "SELECT * FROM T02_Departamento WHERE T02_DescDepartamento LIKE '%' ? '%' " . (($filtroConsulta != null) ? $filtroConsulta : NULL) . " LIMIT " . (($numPaginaActual - 1) * $numMaxDepartamentos) . ',' . $numMaxDepartamentos;
        $resultado = DBPDO::ejecutaConsulta($consulta, [$busqueda]);

        //Si hay algún resultado lo almacena en la variable
        if ($resultado->rowCount() > 0) {

            for ($numDepartamento = 0, $departamento = $resultado->fetchObject(); $numDepartamento < $resultado->rowCount(); ++$numDepartamento, $departamento = $resultado->fetchObject()) {
                // Instanciamos un objeto Departamento con los datos devueltos por la consulta
                $oDepartamento = new Departamento($departamento->T02_CodDepartamento, $departamento->T02_DescDepartamento, $departamento->T02_FechaCreacionDepartamento, $departamento->T02_VolumenNegocio, $departamento->T02_FechaBajaDepartamento);
                //Añade el objeto Departamento en el array en la posición indicada
                $aDepartamentos[$numDepartamento] = $oDepartamento;
            }
        }
        
        $sentenciaSQLNumDepartamentos = "Select count(*) FROM T02_Departamento where T02_DescDepartamento LIKE '%' ? '%' " . (($filtroConsulta != null) ? $filtroConsulta : NULL);
        $resultadoConsultaNumDepartamentos = DBPDO::ejecutaConsulta($sentenciaSQLNumDepartamentos, [$busqueda]); // almacenamos en la variable $resultadoConsultaNumDepartamentos el resultado devuelto por la consulta
        $numDepartamentos = $resultadoConsultaNumDepartamentos->fetch(); // almacenamos el la variable $numDepartamentos el numero de departamentos devuelto por la consulta

        if ($numDepartamentos[0] % $numMaxDepartamentos == 0) { // si devuelve un numero par
            $numPaginasTotal = ($numDepartamentos[0] / $numMaxDepartamentos); // el numero de paginas totales sera el resultado obtenido de dividir el numero de departamentos devuelto por la consulta y el numero maximo de paginas
        } else { // si devuelve un numero impar
            $numPaginasTotal = (floor($numDepartamentos[0] / $numMaxDepartamentos) + 1); // el numero de paginas totales sera el resultado obtenido de dividir el numero de departamentos devuelto por la consulta y el numero maximo de paginas redondeado a la baja mas uno
        }

        settype($numPaginasTotal, "integer"); // convertimos el numero de paginas totales a integer para eliminar los decimales
        //Devuelve el array de departamentos
        return [$aDepartamentos, $numPaginasTotal];

    }

    /**
     * Método altaDepartamento()
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
        $consulta = "INSERT INTO T02_Departamento (T02_CodDepartamento, T02_DescDepartamento, T02_VolumenNegocio, T02_FechaCreacionDepartamento) VALUES (?,?,?,?)";
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
    
    /**
     * Método bajaLogicaDepartamento()
     * 
     * Método que da de baja un departamento
     * 
     * @param string $codigo código de departamento que queremos dar de baja
     * @return boolean devuelve true si se ha dado de baja y false en caso contrario
     */
    public static function bajaLogicaDepartamento($codigo) {
        //Variable booleana inicializada a false
        $bajaLogica = false;
        //Inicializamos la variable $dateTimeBaja con un objeto de tipo DateTime de la fechaBaja pasada como parámetro
        $dateTimeBaja = new DateTime($fechaBaja);

        //Cambia la fecha de baja del departamento en la base de datos ejecutando un query
        $sentenciaSQL = "UPDATE T02_Departamento SET T02_FechaBajaDepartamento=? WHERE T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$dateTimeBaja->getTimestamp(), $codigo]);

        //Si la consulta se realiza correctamente cambiamos el valor de $bajaLogica a true
        if ($resultadoConsulta) {
            $bajaLogica = true;
        }

        //Devuelvo la variable
        return $bajaLogica;
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
    
    /**
     * Método rehabilitaDepartamento()
     * 
     * Método que rehabilita un departamento dado de baja
     * 
     * @param string $codigo código de departamento que queremos rehabilitar
     * @return boolean devuelve true si se ha rehabilitado y false en caso contrario
     */
    public static function rehabilitaDepartamento($codigo) {
        //Variable booleana inicializada a false
        $rehabilitacion = false;

        //Cambia la fecha de baja del departamento en la base de datos ejecutando un query
        $sentenciaSQL = "UPDATE T02_Departamento SET T02_FechaBajaDepartamento=null WHERE T02_CodDepartamento=?";
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, [$codigo]);

        //Si la consulta se realiza correctamente cambiamos el valor de $rehabilitacion a true
        if ($resultadoConsulta) {
            $rehabilitacion = true;
        }

        //Devuelvo la variable
        return $rehabilitacion; 
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
        $consulta = "SELECT * FROM T02_Departamento WHERE T02_CodDepartamento=?";
        $resultado = DBPDO::ejecutaConsulta($consulta, [$codDepartamento]); 

        //Si la consulta me devuelve algún resultado cambiamos el valor de $departamentoNoExiste a false
        if ($resultado->rowCount() > 0) {
            $departamentoNoExiste = false;
        }

        //Devuelvo la variable
        return $departamentoNoExiste;
    }
    
    /**
     * Metodo exportarDepartamentos()
     * 
     * Metodo que exporta los departamentos almacenados en la base de datos en distintos formatos,
     * estos formatos pueden ser xml o json
     *
     * @param  string $tipo tipo de archivo que se desea exportar (xml o json)
     * @return void
     */
    public static function exportarDepartamentos($tipo) {
        $sentenciaSQL = "SELECT * FROM T02_Departamento";
        $resultadoConsulta = DBPDO::ejecutaConsulta($sentenciaSQL, []);
        //Si la sentencia SQL se ejecuta correctamente
        if (isset($resultadoConsulta)) {
            //Filtra el tipo que el usuario desea importar
            switch ($tipo) {
                //Si el archivo es XML
                case 'xml':
                    //Crea un objeto DOMDocument con dos parámetros, la versión y la codificación del documento
                    $archivoXML = new DOMDocument("1.0", "utf-8");
                    //Formatea la salida
                    $archivoXML->formatOutput = true;
                    //Crea el nodo Departamentos
                    $nodoDepartamentos = $archivoXML->appendChild($archivoXML->createElement("Departamentos")); 
                    $registro = $resultadoConsulta->fetchObject();
                    while ($registro) {
                        //Crea un hijo dentro del nodo Departamentos llamado Departamento
                        $nodoDepartamento = $nodoDepartamentos->appendChild($archivoXML->createElement("Departamento"));
                        //Dentro de cada nodo Departamento va creando nodos para guardar los datos del departamento
                        $nodoDepartamento->appendChild($archivoXML->createElement("CodDepartamento", $registro->T02_CodDepartamento));
                        $nodoDepartamento->appendChild($archivoXML->createElement("DescDepartamento", $registro->T02_DescDepartamento));
                        $nodoDepartamento->appendChild($archivoXML->createElement("FechaCreacionDepartamento", $registro->T02_FechaCreacionDepartamento));
                        $nodoDepartamento->appendChild($archivoXML->createElement("FechaBajaDepartamento", $registro->T02_FechaBajaDepartamento));
                        $nodoDepartamento->appendChild($archivoXML->createElement("VolumenNegocio", $registro->T02_VolumenNegocio));
                        //Obtiene el siguiente registro de la consulta y avanzamos el puntero
                        $registro = $resultadoConsulta->fetchObject(); 
                    }
                    //Guarda el archivo XML en la carpeta tmp del servidor
                    $archivoXML->save("tmp/tablaDepartamento.xml"); 
                    //Tipo del archivo
                    header('Content-Type: text/xml;charset=utf-8');
                    //Nombre del archivo de la descarga
                    header('Content-Disposition: attachment; filename="tablaDepartamento.xml"');
                    //Ubicación del archivo
                    readfile("tmp/tablaDepartamento.xml"); 
                    exit;
                break;
                //Si el archivo es JSON
                case 'json':
                    //Se declara el array donde almacenaremos los departamentos del archivo json
                    $aDepartamentos = []; 
                    //Obtiene el primer registro y avanzamos el puntero al siguiente
                    $registro = $resultadoConsulta->fetchObject(); 
                    while ($registro) {
                        //Añade un array asociativo por cada departamento de la base de datos en el array de departamentos
                        $aDepartamentos[] = [
                            'CodDepartamento' => $registro->T02_CodDepartamento,
                            'DescDepartamento' => $registro->T02_DescDepartamento,
                            'FechaCreacionDepartamento' => $registro->T02_FechaCreacionDepartamento,
                            'FechaBajaDepartamento' => $registro->T02_FechaBajaDepartamento,
                            'VolumenNegocio' => $registro->T02_VolumenNegocio
                        ];
                        //Avanza el puntero al siguiente registro
                        $registro = $resultadoConsulta->fetchObject(); 
                    }
                    //Abre el fichero JSON
                    $fichero = fopen('tmp/tablaDepartamento.json', 'w');
                    //Escribe el array formateado en el archivo JSON
                    fwrite($fichero, json_encode($aDepartamentos, JSON_PRETTY_PRINT));
                    //Cierra el fichero
                    fclose($fichero); 
                    //Tipo del archivo
                    header('Content-Type: application/json;charset=utf-8');
                    //Nombre del archivo de la descarga
                    header('Content-Disposition: attachment; filename="tablaDepartamento.json"');
                    //Ubicación del archivo
                    readfile("tmp/tablaDepartamento.json"); 
                    exit;
                break;
            }
        }
    }
    
    /**
     * Metodo importarDepartamentos()
     * 
     * Metodo que sirve para importar departamentos a nuestra base de datos a partir de un archivo,
     * este archivo puede tener extension xml o json
     *
     * @param  string $fichero fichero que queremos importar
     * @param  string $tipo tipo de archivo que se desea exportar (xml o json)
     * @return void
     */
    public static function importarDepartamentos($fichero, $tipo) {
        $sentenciaSQL = "INSERT INTO T02_Departamento VALUES (?, ?, ?, ?, ?)";
        
        //Filtra el tipo que el usuario desea importar
        switch ($tipo) {
            //Si el archivo es XML
            case 'xml':
                //Mueve el archivo al tmp con el nombre que deseemos
                move_uploaded_file($fichero, 'tmp/copiaDeSeguridad.xml'); 
                //Crea un objeto DOMDocument con dos parámetros, la versión y la codificación del documento
                $archivoXML = new DOMDocument("1.0", "utf-8");
                //Carga el documento XML
                $archivoXML->load('tmp/copiaDeSeguridad.xml');
                //Guarda el número de departamentos que hay en el archivoXML
                $numeroDepartamentos = $archivoXML->getElementsByTagName('Departamento')->count();
                //Recorre los departamentos
                for ($numeroDepartamento = 0; $numeroDepartamento < $numeroDepartamentos; $numeroDepartamento++) {
                    //Guarda el valor del elemento del cógido de departamento
                    $CodDepartamento = $archivoXML->getElementsByTagName("CodDepartamento")->item($numeroDepartamento)->nodeValue;
                    //Se comprueba que el código de departamento no exista en la BBDD llamando al método validaCodNoExiste
                    if (!self::validaCodNoExiste($CodDepartamento)) {
                        //En caso de que esxista se elimina llamando al método BajaFisicaDepartamento para volver a guardarlo actualizado
                        self::bajaFisicaDepartamento($CodDepartamento);
                    }
                    //Guarda el valor del elemento de la descripción del departamento
                    $DescDepartamento = $archivoXML->getElementsByTagName("DescDepartamento")->item($numeroDepartamento)->nodeValue; 
                    //Guarda el valor del elemento de la fecha de creación del departamento
                    $timestampFechaCreacion = $archivoXML->getElementsByTagName("FechaCreacionDepartamento")->item($numeroDepartamento)->nodeValue; 
                    //Guarda el valor del elemento de la fecha de baja
                    $timestampFechaBaja = $archivoXML->getElementsByTagName("FechaBajaDepartamento")->item($numeroDepartamento)->nodeValue; 
                    //Si el elemento de la feha de baja está vacío le asignamos el valor null para poder insertarlo en la BBDD sin errores
                    if (empty($timestampFechaBaja)) { 
                        $timestampFechaBaja = null;
                    }
                    //Guarda el valor del elemento del volumen de negocio
                    $VolumenNegocio = $archivoXML->getElementsByTagName("VolumenNegocio")->item($numeroDepartamento)->nodeValue; 
                    //Asigna al array parametros los diferentes valores de los campos guardados
                    $parametros = [$CodDepartamento, $DescDepartamento, $timestampFechaCreacion, $VolumenNegocio, $timestampFechaBaja];
                    //Ejecuta la consulta con los parámetros
                    DBPDO::ejecutaConsulta($sentenciaSQL, $parametros); 
                }
            break;
            //Si el archivo es JSON
            case 'json':
                //Mueve el archivo al tmp con el nombre que se quiera
                move_uploaded_file($fichero, 'tmp/copiaDeSeguridad.json'); 
                //Almacena el fichero convertido en string
                $archivoJson = file_get_contents('tmp/copiaDeSeguridad.json');
                //Decodifica el archivo JSON
                $aDepartamentos = json_decode($archivoJson, true); 
                //Recorre el array con la información obtenida del archivo
                foreach ($aDepartamentos as $aDepartamento) {
                    $codDepartamento = $aDepartamento['CodDepartamento'];
                    //Se comprueba que el código de departamento no exista ya en la BBDD llamando al método validaCodNoExiste
                    if (!self::validaCodNoExiste($codDepartamento)) {
                        //Si existe se borra con el método bajaFisicaDepartamento para poder guardarlo actualizado
                        self::bajaFisicaDepartamento($codDepartamento);
                    }
                    //Crea el array de los parámetros que se van a insertar en la BBDD
                    $parametros = [$aDepartamento['CodDepartamento'],
                        $aDepartamento['DescDepartamento'],
                        $aDepartamento['FechaCreacionDepartamento'],
                        $aDepartamento['VolumenNegocio'],
                        $aDepartamento['FechaBajaDepartamento']];
                    //Ejecuta la consulta con los parámetros
                    DBPDO::ejecutaConsulta($sentenciaSQL, $parametros); 
                }
            break;
        }
    }

}