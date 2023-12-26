<?php 
    class Login extends SessionController{
        
        function __construct(){
            parent::__construct();
            error_log('Login::construct-> Inicio de login');
        }
        
        function render(){
            //$this->view->render('login/index');
            $view = new View();
            $view->render('login/index');
        }
    }
?>