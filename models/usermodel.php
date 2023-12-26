<?php
    /**
     * Esta clase controla el los movimientos de la tabla persona
     * @author JonatanLara <laraortizjonatan@gmail.com>
     * @version 1.0.0
     * @date 23/12/23
    */
    class UserModel extends Model implements IModel{
        //referencias a los datos que tengo registrado en mi tablas db
        private $id;
        private $nombre;

        function __construct(){
            parent::__construct();
            //inicializamos los datos globales
            $this->nombre = '';
        }
        
        //<-----sets----->
        public function setNombre($nombre){ $this->nombre = $nombre; }
        public function setId($id){$this->id  = $id;}
        
        //<-----gets----->
        public function getId(){ return $this->id; }
        public function getNombre(){ return $this->nombre; }
        
        //<-----imodel----->
        public function save(){
            try{
                $query = $this->prepare('INSERT INTO users() VALUES (:nombre)');
                $query->execute([
                    'nombre' => $this->nombre,
                ]);
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::save->PDOException '.$e);
                return false;
            }
        }

        public function getAll(){
            $items = [];
            try{
                $query = $this->query('SELECT * FROM users');
                while( $p = $query->fetch(PDO::FETCH_ASSOC)){
                    $item = new UserModel();
                    $item->from($p);
                    array_push($items, $item);
                }
                return $items;
            }catch(PDOException $e){
                error_log('USERMODEL::getAll->PDOException '.$e);
                return false;
            }
        }

        public function get($id){
            try{
                $query = $this->query('');
                $query->execute([
                    'id' => $id
                ]);
                $item = $query->fetch(PDO::FETCH_ASSOC);
                $this->setId($item['id']);
                $this->setNombre($item['nombre']);
                return $this;

            }catch(PDOException $e){
                error_log('USERMODEL::get->PDOException '.$e);
                return false;
            }
        }

        public function delete($id){
            try {
                $query = $this->prepare('DELETE FROM user WHERE id = :id');
                $query->execute([
                  'id' => $id
                ]);
                return true;
              } catch (PDOException $e) {
                error_log('USERMODEL::delate->PDOException '. $e);
                return false;
            }
        }
        //para utilizar update primero hay que ejecutar un get($)
        public function update(){
            try{
                $query = $this->prepare('UPDATE user SET nombre = :nombre WHERE id = :id ');
                $query->execute([
                    'id' => $this->id,
                    'nombre' => $this->nombre,
                ]);
                return true;
            }catch(PDOException $e){
                error_log('USERMODEL::update->PDOException '. $e);
                return false;
            }
        }

        public function from($array){
            $this->id       = $array['id'];
            $this->nombre   = $array['nombre'];
        }

        //<----- funciones privadas || funciones de clase ----->
        public function exists($username){
            try{
                $query = $this->prepare('SELECT');
                $query->execute(['username' => $username]);
                return ($query->rowCount() > 0) ? true : false;
            }catch(PDOException $e){
                error_log('USERMODEL::exists->PDOException '. $e);
                return false;
            }
        }

    }
?>