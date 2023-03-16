<?php

namespace Model;

class EventosRegistros extends ActiveRecord{
    protected static $tabla = 'eventos_registros';
    protected static $columnasDB = ['id', 'evento_id', 'registro_id'];
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->evento_id = $args['evento_id'] ?? null;
        $this->registro_id = $args['registro_id'] ?? null;
    }
}