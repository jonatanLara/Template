<?php
//Mi modelo solo se conecta a la base de datos
include_once 'libs/imodel.php';

    class Model{
        private $db;
        function __construct(){
            $this-> db = new Database();
        }

        /**
        * Se usa cuando no necesitamos que nuestra consulta ejecute datos dinámicos;
        * es decir el usuario no va a mandar variables que van a intervenir para mandar el resultado deseado
        * @access public
        * @param string $query 
        * @return this
        */        
        function query($query){
            return $this->db->connect()->query($query);
        }
        

        /*
        execute(). Al momento que necesitamos que nuestro sistema responda a procesar consultas con datos dinámicos que el 
        usuario manda en forma de variables; es necesario usar sentencias preparadas para procurar evitar ataques de inyección SQL
        */

        
        /**
        * Este metodo me se conecta a la clase database y prepara la consulta
        *
        * @access public
        * @param string $query la consulta que deseas realizar
        * @return prepare() retorna la consulta
        */
        function prepare($query){
            return $this->db->connect()->prepare($query);
        }

    }
?>
