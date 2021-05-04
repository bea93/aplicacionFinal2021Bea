<?php

class REST {
    
    /**
     * Llama al servicio API REST, que nos devuelve la información de un personaje
     * de la serie Rick and Morty.
     * 
     * @param type $number nos devolverá la información de un personaje.
     * @return type array que contiene información sobre el personaje. 
     */
    public static function personajeRM($number) {
        return json_decode(file_get_contents("https://rickandmortyapi.com/api/character/$number"), true);
    }
}