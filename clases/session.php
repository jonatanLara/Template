<?php
/**
    * Este clase controla la session
    * @author JonatanLara <laraortizjonatan@gmail.com>
    * @version 1.2
    * @date 21/12/23 
*/
    class Session{

        private $sessionName = 'user';

        public function __construct(){
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }

        /**
             * Actualiza el nombre del usuario en session
             *
             * @param string $user el nombre del usuario
             * @return void
        */
        public function setCurrentUser($user){
            $_SESSION[$this->sessionName] = $user;
        }

        /**
             * Obtiene el nombre del usuario en session
             *
             * @return string $_SESSION[sesionName].
        */
        public function getCurrentUser(){
            return $_SESSION[$this->sessionName];
        }

        /**
            * Cierra la session y la destruye 
            * @access public
            * @return void 
        */
        public function closeSession(){
            error_log('Sesion::closeSession->Cierre de sesion del '.$_SESSION[$this->sessionName]);
            session_unset();
            session_destroy();
        }

        /**
            * Comprueba si existe una session 
            * @access public
            * @return boolean  
        */
        public function exists(){
            return isset($_SESSION[$this->sessionName]);
        }

    }
?>