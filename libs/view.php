<?php
    /**
         * Es el controlador encargado de renderizar las vistas y enviar informacion atravez de un arreglo $d 
         * @author JonatanLara <laraortizjonatan@gmail.com>
         * @version 1.0.0
         * @date 20/12/23
    */
    class View{

        private $d;
        
        function __construct(){

        }

        /**
            * renderiza el archivo $nombre.-> require 'views/'. $nombre .'.php';
            * y por medio de $data [] envio un dato o mensaje a la vista seleccionada.
            * @access public
            * @param string $nombre; la vista que quiero cargar
            * @param array $data; pasar la información directamente por este medio 
            * @return d contiene los datos pasados por $data
        */  
        function render($nombre, $data = []){
            $this-> d = $data;
            $this->handleMessages();
            require 'views/'. $nombre .'.php';
        }

        /**
            * @access public
            * Validamos si existe en la url success o error.
            * si encuentra un success @return handleSuccess
            * si encuentra un error @return handleError
        */ 
        private function handleMessages(){
            //validamos si tenemos uno de los dos errores
            if(isset($_GET['success']) && isset($_GET['error'])){
                //error
            } else if(isset($_GET['success'])){
                $this->handleSuccess();
            } else if(isset($_GET['error'])){
                $this->handleError();
            }
        }

        /**
            * @access private
            * crea un nuevo objeto de la clase ErrorMensages
            * ejecuta el metodo existsKey($hash) 
            * y optenemos el texto con get($hash)
        */ 
        private function handleError(){
            if(isset($_GET['error'])){
                $hash = $_GET['error'];
                $errors = new ErrorMenssages();

                if($errors->existsKey($hash)){
                    error_log('View::handleError() existsKey =>' . $errors->get($hash));
                    $this->d['error'] = $errors->get($hash);
                }else{
                    $this->d['error'] = NULL;
                }
            }
        }

        /**
            * @access private
            * crea un nuevo objeto de la clase SuccessMensages
            * ejecuta el metodo existsKey($hash) 
            * y optenemos el texto con get($hash)
        */ 
        private function handleSuccess(){
            if(isset($_GET['success'])){
                $hash = $_GET['success'];
                $success = new SuccessMenssages();

                if($success->existsKey($hash)){
                    error_log('View::handleSuccess() existsKey =>' . $success->existsKey($hash));
                    $this->d['success'] = $success->get($hash);
                }else{
                    $this->d['success'] = NULL;
                }
            }
        }

        /**
            * @access public
            * funcion para mostrar los mensajes
        */ 
        public function showMessages(){
            $this->showError();
            $this->showSuccess();
        }

        public function showError(){
            if(array_key_exists('error', $this->d)){

            //echo '<div class="error"></div>';
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <strong>!</strong> '.$this->d['error']. '
                  </div>';
            }
        }

        public function showSuccess(){
            if(array_key_exists('success', $this->d)){
            //CREACION DE popup
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <strong>!</strong> '.$this->d['success']. '
                  </div>';

            }
        }

    }

 ?>
