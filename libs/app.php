<?php

require_once 'controllers/errores.php';
/**
    * Este clase captura la url y la descompone enviandolo 
    * a sus controladores correspondiente asi como sus metodos y parametros
    * @author JonatanLara <laraortizjonatan@gmail.com>
    * @version 1.2
    * @date 21/12/23 
*/
class App{
    /**
        * Al iniciar el __construct() 1. Verifica si ha sido definida en caso de que no manda null
        * 2. Borra cualquier diagonal que se encuetre 3. Divide la URL con diagonales
        * @access public
        * @return boolean 
     */
        
    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/'); 
        $url = explode('/', $url);

        if(empty($url[0])){
            error_log('App::construct-> no hay valor especificado');
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }

        //si nuestra url si trae una ruta especificado
        $archivoController = 'controllers/' . $url[0] . '.php';
        //error_log($archivoController);

        if(file_exists($archivoController)){
            require_once $archivoController;
            // inicializar controlador
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            // si hay un método que se requiere cargar
            if(isset($url[1])){
                // comprobamos si existe el metodo dentro de ese controlador
                if(method_exists($controller, $url[1])){
                    // si exite un 3 parametros
                    if(isset($url[2])){
                        //el método tiene parámetros
                        //sacamos e # de parametros
                        $nparam = sizeof($url) - 2;
                        //crear un arreglo con los parametros
                        $params = [];
        
                        for($i = 0; $i < $nparam; $i++){
                            array_push($params, $url[$i] + 2);
                        }
                        //pasarlos al metodo
                        $controller->{$url[1]}($params);
                    }else{
                        // si no tiene parametros se manda a llamar el metodo tal cual
                        $controller->{$url[1]}();
                    }
                }else{
                    //error, no existe el metodo que nos regrese un error 404
                    $controller = new Errores();
                    $controller->render();
                    error_log('App:controller->no existe el metodo');
                }
            }else{
                //no hay metodo que cargar, o no existe el metodo
                $controller->render();
            }
        }else{
            //TODO:error no existe el archivo controller
            error_log('App:controller->TODO:error no existe el archivo controller');
            $controller = new Errores();
            $controller->render();
        }

    }
}

?>