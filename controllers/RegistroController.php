<?php

namespace Controllers;

use Model\Dia;
use Throwable;
use Model\Hora;
use MVC\Router;
use Model\Evento;
use Model\Regalo;
use Model\Paquete;
use Model\Ponente;
use Model\Usuario;
use Model\Registro;
use Model\Categoria;
use Model\EventosRegistros;

class RegistroController{

    public static function crear(Router $router){

        if(!is_auth()){
            header('Location: /login');
            return;
        }

        //Verificar si el usuario ya tiene boleto
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if(isset($registro) && $registro->paquete_id === '1'){
            header('Location: /finalizar-registro/conferencias');
            return;
        }

        if($registro && ($registro->paquete_id === '3' || $registro->paquete_id === '2')){
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }
            //Verificar si el usuario ya tiene boleto
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if($registro && $registro->paquete_id === '3'){
                header('Location: /boleto?id=' . urlencode($registro->token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);
        
            //Crear el registro
            $datos = array(
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            );
            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if($resultado){
                header('Location: /boleto?id=' . urlencode($registro->token));
                return;
            }
        }
    }

    public static function boleto(Router $router){

        if(!is_auth()){
            header('Location: /login');
            return;
        }

        $id = $_GET['id'] ?? null;
        $id = s($id);
        if(!$id || strlen($id) !== 8){
            header('Location: /');
            return;
        }

        $registro = Registro::where('token', $id);
        if(!$registro){
            header('Location: /');
            return;
        }
        if($registro->usuario_id !== $_SESSION['id']){
            header('Location: /');
            return;
        }
        $registro->usuario = (Usuario::find($registro->usuario_id))->get_nombre_completo();
        $registro->paquete = (Paquete::find($registro->paquete_id))->nombre;

        $router->render('registro/boleto', [
            'titulo' => 'Tu Boleto Digital',
            'registro' => $registro
        ]);
    }

    public static function pagar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_auth()){
                header('Location: /login');
                return;
            }

            //Validar que POST no venga vacío
            if(empty($_POST)){
                echo json_encode([]);
                return;
            }

            //Crear el registro
            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            $datos = $_POST;
            $datos['token'] = $token;
            $datos['usuario_id'] = $_SESSION['id'];

            try{
                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);
            }catch(\Throwable $th){
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
    }

    public static function conferencias(Router $router){

        if(!is_auth()){
            header('Location: /login');
            return;
        }
        //Validar que tenga el plan presencial
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if(isset($registro) && $registro->paquete_id == '2'){
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

        if(!$registro || $registro->paquete_id !== '1'){
            header('Location: /');
            return;
        }

        //Redirecciona a boleto virtual si ya registró sus conferencias
        if(isset($registro->regalo_id)){
            header('Location: /boleto?id=' . urlencode($registro->token));
            return;
        }

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

        $regalos = Regalo::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Usuario autenticado
            if(!is_auth()){
                header('Location: /login');
                return;
            }

            $eventos = explode(',', $_POST['eventos']);
            if(empty($eventos)){
                echo json_encode(['resultado' => false]);
                return;
            }

            //Obtener el registro del usuario
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if(!$registro || $registro->paquete_id !== '1'){
                echo json_encode(['resultado' => false]);
                return;
            }

            $eventos_array = [];
            //Revisar la disponibilidad de los eventos
            foreach($eventos as $id){
                $id = s($id);
                $evento = Evento::find($id);
                if(!$evento || $evento->disponibles === '0'){
                    echo json_encode(['resultado' => false, 'respuesta' => "Evento ({$evento->nombre}) No Disponible"]);
                    return;
                }
                $eventos_array[] = $evento;
            }
            foreach($eventos_array as $evento){
                $evento->disponibles -= 1;
                $evento->guardar();

                //Almacenar el registro
                $datos = [
                    'evento_id' => (int) $evento->id,
                    'registro_id' => (int) $registro->id
                ];
                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }
            
            //Agregar el regalo al registro
            $registro->sincronizar(['regalo_id' => (int) $_POST['regalo']]);
            $resultado = $registro->guardar();

            if($resultado){
                echo json_encode(['resultado' => $resultado, 'token' => $registro->token]);
                return;
            }else{
                echo json_encode(['resultado' => false]);
                return;
            }
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elige tus Workshops y Conferencias',
            'eventos' => $eventos_formateados,
            'regalos' => $regalos
        ]);
    }
}