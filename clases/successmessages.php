<?php
    /**
        * Este clase la lista de notificaciones success 
        * @author JonatanLara <laraortizjonatan@gmail.com>
        * @version 1.2
        * @date 21/12/23 
    */
    class SuccessMenssages{

        const SUCCESS_SIGNUP_NEWUSER                   = "1fdce6bbf47d6b26a9cd809ea1910222";
        
        private $successList = [];

        public function __construct(){
            $this->successList = [
                SuccessMenssages::SUCCESS_SIGNUP_NEWUSER            => 'Usuario registrado correctamente',
            ];

        }

        /**
            * obtengo el texto (mensaje) de la clave seleccionada 
            * ejemplo get($hash) || get(SuccessMenssages::ERROR_SIGNUP_NEWUSER)
            * @return text que tenga ese indice ejemplo -> Hubo un error al intentar procesar la solicitud
            * @access public
            * @param string $hash; indice del arreglo
            * @return $this->errorList[$hash] retorna el dato seleccionado con el indice $hash
        */  
        public function get($hash){
            return $this->successList[$hash];
        }

        /**
            * busca si exite la clave seleccionada en un arreglo 
            * @access public
            * @param string $key; indice del arreglo
            * @return boolean retorna si existe esa clave dentro del arreglo
        */
        public function existsKey($key){
            if(array_key_exists($key, $this->successList)){
                return true;
            }else{
                return false;
            }
        }

    }
?>