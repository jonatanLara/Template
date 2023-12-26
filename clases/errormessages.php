<?php
    /**
     * Esta clase los mensajes de errores  
     * @author JonatanLara <laraortizjonatan@gmail.com>
     * @version 1.0.0
     * @date 20/12/23
    */
    class ErrorMenssages{

        const ERROR_LOGIN_AUTHENTICATE               = "11c37cfab311fbe28652f4947a9523c4";
        const ERROR_LOGIN_AUTHENTICATE_EMPTY         = "2194ac064912be67fc164539dc435a42";
        const ERROR_LOGIN_AUTHENTICATE_DATA          = "bcbe63ed8464684af6945ad8a89f76f8";
        const ERROR_SIGNUP_NEWUSER                   = "1fdce6bbf47d6b26a9cd809ea1910222";
        const ERROR_SIGNUP_NEWUSER_EMPTY             = "a5bcd7089d83f45e17e989fbc86003ed";
        const ERROR_SIGNUP_NEWUSER_EXISTS            = "a74accfd26e06d012266810952678cf3";
        const ERROR_UPDATE_EXISTS                    = "dfb4dc6544b0dae5421786b37e286a3c";
        private $errorList = [];

        public function __construct(){
            $this->errorList = [
                ErrorMenssages::ERROR_SIGNUP_NEWUSER            => 'Hubo un error al intentar procesar la solicitud',
                ErrorMenssages::ERROR_SIGNUP_NEWUSER_EMPTY      => 'Llena los campos de usuario y password',
                ErrorMenssages::ERROR_SIGNUP_NEWUSER_EXISTS     => 'Ya existe ese nombre de usuario',
                ErrorMenssages::ERROR_LOGIN_AUTHENTICATE_EMPTY  => 'No se encontro ningun usuario con esos datos',
                ErrorMenssages::ERROR_LOGIN_AUTHENTICATE        => 'Hubo un problema al autenticarse',
                ErrorMenssages::ERROR_LOGIN_AUTHENTICATE_DATA   => 'El nombre de usuario y/o password es incorecto',
                ErrorMenssages::ERROR_UPDATE_EXISTS             => 'Error al actulizar el dato'
            ];

        }

        /**
            * obtengo el texto (mensaje) de la clave seleccionada 
            * ejemplo get($hash) || get(ErrorMenssages::ERROR_SIGNUP_NEWUSER)
            * @return text que tenga ese indice ejemplo -> Hubo un error al intentar procesar la solicitud
            * @access public
            * @param string $hash; indice del arreglo
            * @return $this->errorList[$hash] retorna el dato seleccionado con el indice $hash
        */  
        public function get($hash){
            return $this->errorList[$hash];
        }

        /**
            * busca si exite la clave seleccionada en un arreglo 
            * @access public
            * @param string $key; indice del arreglo
            * @return boolean retorna si existe esa clave dentro del arreglo
        */
        public function existsKey($key){
            if(array_key_exists($key, $this->errorList)){
                return true;
            }else{
                return false;
            }
        }
        
    }
?>