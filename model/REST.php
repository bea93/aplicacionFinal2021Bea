<?php

class REST {
    
    /**
     * Llama al servicio API REST, que nos devuelve la información de un personaje
     * de la serie Rick and Morty.
     * 
     * @param type number número del personaje que queremos buscar.
     * @return type array que contiene información sobre el personaje. 
     */
    public static function personajeRM($number) {
        return json_decode(file_get_contents("https://rickandmortyapi.com/api/character/$number"), true);
    }
    
    
    /**
     * Llama al servicio API REST, que nos devuelve la información sobre un libro del autor indicado por el usuario
     * 
     * @param type string nombre y apellido del autor que queramos buscar separados por un espacio.
     * @return type array que contiene información sobre uno de sus libros. 
     */
    public static function libros($autor) {

        //Variable que almacena una clave generada en internet y que necesitaremos para usar la api
        $key = 'hOzsi3xqFWqCMIbDznRf3I5UQ8GxlvPA';
        $resultado = file_get_contents('https://api.nytimes.com/svc/books/v3/reviews.json?author=' . $autor . '&api-key=' . $key);
        $aDatos = json_decode($resultado, true);

        //Recorremos el array con la información del libro para sacar los datos que queremos mostrar
        foreach ($aDatos as $campo => $valor) {
            foreach ($valor as $dato) {  
            }
        }
        return $dato;
    }

}