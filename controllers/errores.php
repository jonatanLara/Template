<?php
    /**
        * Esta clase envia y controla la vista de errores en especial error 404
        * @author JonatanLara <laraortizjonatan@gmail.com>
        * @version 1.2
        * @date 21/12/23 
    */
    class Errores extends Controller{

        function __construct(){
            parent::__construct();
            error_log('Errores::construct -> Inicio de Errores');
        }

        function render(){
            $this->view->render('errores/index');
        }
    }
?>
