<?php
    /**
        * Este clase funciona para conectarme a la db y retorna la conexion. 
        * @author JonatanLara <laraortizjonatan@gmail.com>
        * @version 1.2
        * @date 21/12/23 
    */
    class Database{

        private $host;
        private $db;
        private $user;
        private $password;
        private $charset;

        public function __construct(){
            $this->host = constant('HOST');
            $this->db = constant('DB');
            $this->user = constant('USER');
            $this->password = constant('PASSWORD');
            $this->charset = constant('CHARSET');
        }

        function connect(){
            try{
                $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];

                $pdo = new PDO($connection, $this->user, $this->password, $options);
                error_log('Conexión a BD exitosa');
                return $pdo;
            }catch(PDOException $e){
                error_log('Error connection: ' . $e->getMessage());
            }
        }

    }

?>
