<?php

namespace Controllers;

use Model\Dia;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Ponente;
use Model\Categoria;

class PaginasController{
    public static function index(Router $router) {
        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento){
            $evento->categoria = (Categoria::select($evento->categoria_id, 'nombre'))->nombre;
            $evento->dia = (Dia::select($evento->dia_id, 'nombre'))->nombre;
            $evento->hora = (Hora::select($evento->hora_id, 'hora'))->hora;
            $evento->ponente = (Ponente::find($evento->ponente_id));
            
            if($evento->dia_id == '1' && $evento->categoria_id == '1'){
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id == '2' && $evento->categoria_id == '1'){
                $eventos_formateados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id == '1' && $evento->categoria_id == '2'){
                $eventos_formateados['workshops_v'][] = $evento;
            }
            if($evento->dia_id == '2' && $evento->categoria_id == '2'){
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        //Obtener el total de cada bloque
        $ponentes_total = Ponente::total();
        $conferencias = Evento::total('categoria_id', '1');
        $workshops = Evento::total('categoria_id', '2');

        $ponentes = Ponente::all('ASC');

        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            'eventos' => $eventos_formateados,
            'ponentes_total' => $ponentes_total,
            'conferencias' => $conferencias,
            'workshops' => $workshops,
            'ponentes' => $ponentes
        ]);
    }

    public static function evento(Router $router) {

        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp'
        ]);
    }

    public static function paquetes(Router $router) {
        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp'
        ]);
    }

    public static function conferencias(Router $router) {

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventos_formateados = [];
        foreach($eventos as $evento){
            $evento->categoria = (Categoria::select($evento->categoria_id, 'nombre'))->nombre;
            $evento->dia = (Dia::select($evento->dia_id, 'nombre'))->nombre;
            $evento->hora = (Hora::select($evento->hora_id, 'hora'))->hora;
            $evento->ponente = (Ponente::find($evento->ponente_id));
            
            if($evento->dia_id == '1' && $evento->categoria_id == '1'){
                $eventos_formateados['conferencias_v'][] = $evento;
            }
            if($evento->dia_id == '2' && $evento->categoria_id == '1'){
                $eventos_formateados['conferencias_s'][] = $evento;
            }
            if($evento->dia_id == '1' && $evento->categoria_id == '2'){
                $eventos_formateados['workshops_v'][] = $evento;
            }
            if($evento->dia_id == '2' && $evento->categoria_id == '2'){
                $eventos_formateados['workshops_s'][] = $evento;
            }
        }

        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Workshops',
            'eventos' => $eventos_formateados
        ]);
    }

    public static function error(Router $router) {
        $router->render('paginas/error', [
            'titulo' => 'Página No Encontrada'
        ]);
    }
}