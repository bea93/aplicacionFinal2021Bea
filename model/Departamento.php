<?php

/**
 * Class Departamento
 *
 * Clase utilizada para instanciar objetos Usuario
 * 
 * @author Nerea Álvarez Justel <nerea.alvjus@educa.jcyl.es>
 * @since 1.0 Version 
 * @copyright Copyright (c) 2020 - 2021, Nerea Álvarez Justel
 * @version 1.4
 */

class Departamento {
    /**
     * Codigo del departamento
     * 
     * @var string 
     */
    private $codDepartamento;
    
    /**
     * Descripcion del departamento
     * 
     * @var string 
     */
    private $descDepartamento;
    
    /**
     * Fecha de creacion del departamento
     * 
     * @var int 
     */
    private $fechaCreacionDepartamento;
    
    /**
     * Volumen de negocio del departamento
     * 
     * @var float 
     */
    private $volumenDeNegocio;
    
    /**
     * Fecha Baja del departamento
     * 
     * @var int 
     */
    private $fechaBajaDepartamento;
    
    
    /**
     * Metodo magico __construct()
     * 
     * Metodo magico del constructor de la clase Departamento
     *
     * @param  string $codDepartamento
     * @param  string $descDepartamento
     * @param  int $fechaCreacionDepartamento
     * @param  float $volumenDeNegocio
     * @param  int $fechaBajaDepartamento
     */
    function __construct($codDepartamento, $descDepartamento, $fechaCreacion, $volumenNegocio, $fechaBaja) {
        $this->codDepartamento = $codDepartamento;
        $this->descDepartamento = $descDepartamento;
        $this->fechaCreacionDepartamento = $fechaCreacion;
        $this->volumenDeNegocio = $volumenNegocio;
        $this->fechaBajaDepartamento = $fechaBaja;
    }

    function getCodDepartamento() {
        return $this->codDepartamento;
    }

    function getDescDepartamento() {
        return $this->descDepartamento;
    }

    function getFechaCreacion() {
        return $this->fechaCreacionDepartamento;
    }

    function getVolumenNegocio() {
        return $this->volumenDeNegocio;
    }

    function getFechaBaja() {
        return $this->fechaBajaDepartamento;
    }

    function setCodDepartamento($codDepartamento): void {
        $this->codDepartamento = $codDepartamento;
    }

    function setDescDepartamento($descDepartamento): void {
        $this->descDepartamento = $descDepartamento;
    }

    function setFechaCreacion($fechaCreacion): void {
        $this->fechaCreacionDepartamento = $fechaCreacion;
    }

    function setVolumenNegocio($volumenNegocio): void {
        $this->volumenDeNegocio = $volumenNegocio;
    }

    function setFechaBaja($fechaBaja): void {
        $this->fechaBajaDepartamento = $fechaBaja;
    }
}