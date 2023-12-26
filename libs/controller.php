<?php
    /**
        * Este clase es controlador base, aqui van a heredar todos mis controladores
        * @author JonatanLara <laraortizjonatan@gmail.com>
        * @version 1.2
        * @date 21/12/23 
    */
    class Controller{
        private $view;
        

        function __construct(){
            $this->view = new View();
        }

        /**
         * Carga el archivo de mi modelo de mi controlador asociado
         *
         * @access public
         * @param string $url que es la ruta donde se encuentra mi modelo
         * @return Account
         */
        
         function loadModel($model){
            $url = 'models/'. $model . 'model.php';

            if(file_exists($url)){//si archivo model existe
                require_once $url;
                $modelName = $model.'Model';
                $m = new $modelName();
            }
        }
        
        /**
         * Valida si exiten el valor enviado por el metodo POST
         *
         * @access public
         * @param string $. ...
         * @return boolean false si uno de los elementos no exite retorna, en caso contrario retorna un true
         */
        function existPOST($params){
            foreach ($params as $param) {
                if(!isset($_POST[$param])){
                    error_log("Controller::ExistPOST: No existe el parametro $param");
                    return false;
                }
            }
            error_log( "ExistPOST: Existen parámetros" );
            return true;
        }

        /**
             * Valida si exiten el valor enviado por el metodo GET
             *
             * @access public
             * @param string $. ...
             * @return boolean false si uno de los elementos no exite retorna, en caso contrario
             * retorna un true
         */
        function existGET($params){
            foreach ($params as $param) {
                if(!isset($_GET[$param])){
                    error_log('CONTROLLER::existGET => no existe el paramentro '.$param);
                    return false;
                }
            }
            return true;
        }

        /**
             * Obtenemos un el dato que venga por el $_GET
             * @access public
             * @param string $name recibe el nombre del [''].
             * @return $_GET[$name]
         */
        function getGet($name){
            return $_GET[$name];
        }

        /**
             * Obtenemos un el dato que venga por el $_POST
             * @access public
             * @param string $name recibe el nombre del [''].
             * @return $_POST[$name]
         */
        function getPost($name){
            return $_POST[$name];
        }

        /**
             * Cuando se complete una accion redirecciona a una página
             * cuando hay un error o algo salio bien redirecionamos a un url y le puedo enviar datos
             * @access public
             * @param string $url Es la página a la que quiero redirigir 
             * @param array $mensajes Envio datos por medio de este array como parametro
             * header('location: ' . constant('URL'). $url . $params);
         */  
        function redirect($url, $mensajes = []){
            $data = [];
            $params = '';
        
            foreach ($mensajes as $key => $value) {
                array_push($data, $key . '=' . $value);
            }
            $params = join('&', $data);
            // ?nombre=jonatan&apellido=Lara
            if($params != ''){
                $params = '?' . $params;
            }
            header('location: ' . constant('URL'). $url . $params);
        }
    }
?>