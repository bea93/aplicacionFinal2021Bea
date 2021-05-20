<?php
/**
 * Class REST
 *
 * Clase que se utilizará para llamar a las distintas API REST del proyecto 
 * 
 * @author Beatriz Merino
 * @since 1.0
 * @copyright 09/05/2021
 * @version 1.0
 */

class REST {
    
    /**
     * Función que recoge el error de respuesta HTTP de una URL
     * 
     * @param type string URL de la página que queramos
     * @return type string de la posición 0 del array obtenido por get_Headers con la función substr, la cadena y las posiciones de inicio y fin que le pasemos
     */
    public static function get_http_response_code($url) {
        $aHeaders = get_headers($url);
        return substr($aHeaders[0], 9, 3);
        /*La posición 0 de aHeaders es [HTTP/1.1 200 OK] Solo queremos el número [200] así que la posición de inicio es 9 y la de fin es 3
        https://www.php.net/manual/es/function.get-headers.php */
    }

    /**
     * Llama al servicio API REST, que nos devuelve la información de un personaje
     * de la serie Rick and Morty.
     * 
     * @param type number número del personaje que queremos buscar.
     * @return type array que contiene información sobre el personaje. 
     */
    public static function personajeRM($number) {
        //Variable que almacena la url de la api con el número introducido por el usuario concatenado
        $url = "https://rickandmortyapi.com/api/character/" . $number . "/";
        //Llama a la función get_http_response_code y le pasa la url de la API. Si la respuesta es distinta a 200 
        if (self::get_http_response_code($url) != "200") {
            //La petición no se ha podido hacer y se crea un array de respuesta con el mensaje de error
            $respuesta[0] = false;
            $respuesta[1] = "Error de petición al servidor";
            //Devuelve el array
            return $respuesta;
        } else {
            //Si la respuesta HTTP es 200 la petición se ha podido hacer y se guarda el array de resultado
            $resultado = file_get_contents("https://rickandmortyapi.com/api/character/" . $number . "/", true);
            
            //Si todo ha ido bien se crea un array para almacenar los datos del personaje y se devuelve
            if ($resultado !== false || $number !== null) {
                
                $personaje = json_decode($resultado, true);
                $respuesta[0] = true;
                $respuesta[1] = $personaje;
                return $respuesta;
            }
        }
    }

    /**
     * Llama al servicio API REST, que nos devuelve la información sobre un libro del autor indicado por el usuario
     * 
     * @param type string nombre y apellido del autor que queramos buscar separados por un espacio.
     * @return type array que contiene información sobre uno de sus libros. 
    */ 
    public static function libros($autor) {
        //Creamos e inicializamos un array que almacenará los datos del libro a null
        $aLibro = null;
        
        //Variable que almacena una clave generada en internet y que necesitaremos para usar la api
        $key = 'hOzsi3xqFWqCMIbDznRf3I5UQ8GxlvPA';
        $resultado = file_get_contents('https://api.nytimes.com/svc/books/v3/reviews.json?author=' . $autor . '&api-key=' . $key);
        $aJSON = json_decode($resultado, true);

        //Dentro del aJSON solo accedemos al elemento 'results', que es el que almacena la información de los libros
        foreach ($aJSON['results'] as $datos ) {
            //Guardamos los datos del libro dentro de un array
            $aLibro = [
                'Titulo' => $datos['book_title'],
                'Resumen' => $datos['summary'],
                'Fecha' => $datos['publication_dt'],
                'URL' => $datos['url']
            ];
        }
        
        //Devolvemos el array
        return $aLibro;
    }
}