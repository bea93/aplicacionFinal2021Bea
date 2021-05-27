<?php
     
       require_once "../config/configDB.php"; //Cogemos el archivo con los parametros de conexion segun estemos en casa en desarollo o explotacion caragara un archivo diferente
        
            try {
                //Establecer una conexión con la base de datos 
                $miDB = new PDO(DNS,USER,PASSWORD);
                //La clase PDO permite definir la fórmula que usará cuando se produzca un error, utilizando el atributo PDO::ATTR_ERRMODE
                //Le ponemos de parametro - > PDO::ERRMODE_EXCEPTION. Cuando se produce un error lanza una excepción utilizando el manejador propio PDOException.
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                
               $sql = "SHOW TABLES FROM dbs272025";
               $resultadoConsulta = $miDB->prepare($sql);     //Con consulta preparada
               $resultadoConsulta->execute();                 //Ejecutamos la consulta
            
                echo "Número de tablas: " .$resultadoConsulta->rowCount();
                
                
                
               $sql1 = "SELECT * FROM T02_Departamento";
               $resultadoConsulta = $miDB->prepare($sql1);     //Con consulta preparada
               $resultadoConsulta->execute();                 //Ejecutamos la consulta
         
            echo "<br>Número de registros en la tabla T02_Departamento: " .$resultadoConsulta->rowCount();
             
            $oDepartamento = $resultadoConsulta->fetchObject(); 
            while ($oDepartamento) {                                            //El fetchObject obtiene la siguiente fila y la devuelve como objeto.
                echo "<p>$oDepartamento->T02_CodDepartamento     |  ";
                echo "<$oDepartamento->T02_DescDepartamento     |  ";              //Mostramos el reguistro de la fila de CodDepartamento
                echo " $oDepartamento->T02_FechaCreacionDepartamento      |  ";
                echo " $oDepartamento->T02_VolumenNegocio      |  ";
                echo " $oDepartamento->T02_FechaBajaDepartamento    </p>";
            $oDepartamento = $resultadoConsulta->fetchObject();
            }
            
            $sql2 = "SELECT * FROM T01_Usuario";
               $resultadoConsulta = $miDB->prepare($sql2);     //Con consulta preparada
               $resultadoConsulta->execute();                 //Ejecutamos la consulta
         
            echo "<br>Número de registros en la tabla T01_Usuario: " .$resultadoConsulta->rowCount();
             
            $oDepartamento = $resultadoConsulta->fetchObject(); 
            while ($oDepartamento) {                                            //El fetchObject obtiene la siguiente fila y la devuelve como objeto.
                echo "<p>$oDepartamento->T01_CodUsuario     |  ";
                echo "<$oDepartamento->T01_Password     |  ";           //Mostramos el reguistro de la fila de CodDepartamento
                echo " $oDepartamento->T01_DescUsuario      |  ";
                echo " $oDepartamento->T01_NumConexiones      |  ";
                echo " $oDepartamento->T01_FechaHoraUltimaConexion    |  ";
                echo " $oDepartamento->T01_Perfil    |  ";
                echo " $oDepartamento->T01_ImagenUsuario    </p>";
            $oDepartamento = $resultadoConsulta->fetchObject();
            }
            
            
            
            }
            catch (PDOException $excepcion) {
                $error = $e->getCode();                                         //guardamos en la variable error el error que salta
                $mensaje = $e->getMessage();                                    //guardamos en la variable mensaje el mensaje del error que salta
                
                echo "ERROR $error";                                            //Mostramos el error
                echo "<p style='background-color: coral>Se ha producido un error! .$mensaje</p>"; //Mostramos el mensaje de error
            } finally {
                unset($miDB);
            }
?>