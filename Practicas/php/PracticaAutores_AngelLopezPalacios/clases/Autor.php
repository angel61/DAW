<?php

class Autor
{
    public $id;
    public $nombre;
    public $apellidos;
    public $nacionalidad;

    private function convert($p){
        return addslashes(trim(htmlspecialchars($p)));
    }

    public function __construct($id='',$nombre='',$apellidos='',$nacionalidad=''){
        if (!is_numeric($id)) $id=-1;
        $this->id = $id;
        $this->nombre = $this->convert($nombre);
        $this->apellidos = $this->convert($apellidos);
        $this->nacionalidad = $this->convert($nacionalidad);
    }
}