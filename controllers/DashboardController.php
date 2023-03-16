<?php

namespace Controllers;

use Model\Evento;
use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class DashboardController{

    public static function index(Router $router){

        //Obtener los ultimos registros
        $registros = Registro::get(5);
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        //Calcular los ingresos
        $virtuales = Registro::total('paquete_id', '2');
        $presenciales = Registro::total('paquete_id', '1');
        $total = ($virtuales * 46.41) + ($presenciales * 189.54);
        $subtotal = ($virtuales * 49) + ($presenciales * 199);

        //Obtener eventos con mas y menos lugares disponibles
        $menos_lugares = Evento::ordenarLimite('disponibles', 'ASC', 5);
        $mas_lugares = Evento::ordenarLimite('disponibles', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administración',
            'registros' => $registros,
            'total' => $total,
            'subtotal' => $subtotal,
            'menos_lugares' => $menos_lugares,
            'mas_lugares' => $mas_lugares,
        ]);
    }
}