<?php
    /**
         * Esta clase redirecciona con base al usuario en sesion a los apartados que tiene derecho el usuario.
         * @author JonatanLara <laraortizjonatan@gmail.com>
         * @version 1.0.0
         * @date 20/12/23
    */
    class SessionController extends Controller{
        private $userSession;
        private $username;
        private $userid;
        private $session;
        private $sites;
        private $user;
        private $defaultSites;
        function __construct(){
            parent::__construct();
            $this->init();
        }

        function init(){
            //creamos un objeto de la clase session
            $this->session = new Session();
            //
            $json = $this->getJSONFileConfig();
            //asignamos el valor a las variables
            $this->sites = $json['sites']; 
            $this->defaultSites = $json['default-sites'];
            $this->validateSession();
        }
        
        public function getUserSession(){
            return $this->userSession;
        }
      
        public function getMatricula(){
            return $this->username;
        }
      
        public function getUserId(){
            return $this->userid;
        }
        /**
             * Obtiene la información de un archivo json
             * Y la convierte un string codificado.
             * @return json_decode
        */
        private function getJSONFileConfig(){
            $string = file_get_contents('config/access.json');
            $json = json_decode($string, true);
            return $json;
        }

        /**
             * 1 - Validamos si existe una sesion
             * 2 - Verificamos si la página a entrar es publica
             * 3 - 
             * @return json_decode
        */
        private function validateSession(){
            error_log('SESSIONCONTROLLER::validateSession');
            //NOTE: Casos cuando Existe una session
            if($this->existsSession()){
                $role = $this->getUserSessionData()->getRole();

                //si esta intentado entrar a una página publica
                if($this->isPublic()){
                    $this->redirectDefaultSiteByRole($role);
                }else{
                    //si no es publica
                    if($this->isAuthorized($role)){//lo dejo pasar
                        error_log("SessionController::validateSession() -> isAuthorized => autorizado, lo deja pasar");
                    }else{
                        error_log("SessionController::validateSession() => No autorizado, redirigelo al main de cada rol");
                        $this->redirectDefaultSiteByRole($role);
                    }
                }
            }else{
                //NOTE: Casos cuando NO existe una session 
                if($this->isPublic()){ 
                    // si es una página publica lo dejo entrar
                  }else{
                    //si no es una página publica lo redirecciono al login
                    error_log('SessionController::validateSession() -> redireccionando al login');
                    header('location: '. constant('URL') . '');
                  }
            }
        }

        /**
             * Valida si existe una sesion
             * @return boolean 
        */
        private function existsSession(){
            if(!$this->session->exists()) return false;
            if($this->session->getCurrentUser() == NULL) return false;        
            $userid = $this->session->getCurrentUser();
            if($userid) return true;
            return false;
        }

        /**
             * crear un nuevo modelo de nuestro usuario 
             * @return user 
        */
        private function getUserSessionData(){
            //$id = $this->userid;
            $id = $this->session->getCurrentUser();
            $this->user = new UserModel();
            $this->user->get($id); //me regresa todos los datos del usuario con el id solicitado
            return $this->user;
        }

        /**
             * comprobamos si la pagina es publica o privada 
             * @return boolean 
        */
        private function isPublic(){
            /**  @var string $currentURL*/
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/","", $currentURL);//extraemos los caracteres que no necesitamos(\?.*)
            for($i=0; $i < sizeof($this->sites); $i++){
              if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['access'] === 'public'){
                return true;
              }
            }
            return false;
        }

        /**
             * obtiene la url actual y retorna el indice en la posicion 2
             * @return url [2]
        */
        private function getCurrentPage(){
            $actuallink = trim("$_SERVER[REQUEST_URI]");//obtengo la url actual
            $url = explode('/', $actuallink); //separo la url por diagonales 
            error_log("sessionController::getCurrentPage(): actualLink =>" . $actuallink . ", url => " . $url[2]);            
            return $url[2];
        }

        /**
             * 
             * @return void location $url
        */
        private function redirectDefaultSiteByRole($role){
            $url ='';
            for($i=0; $i< sizeof($this->sites); $i++){
                if($this->sites[$i]['role'] === $role){
                    $url = constant('URL').$this->sites[$i]['site'];
                    //error_log('SESSIONCONTROLLER::redirectDefaultSiteByRole -> /nameProject/ '.$this->sites[$i]['site']);
                    break;
                }
            }
            header('location: '. $url);
        }

        /**
             * con prueba si el rol tiene autorizacion de estar en ese sitio y retorna un true o false
             * 
             * @return boolean
        */
        private function isAuthorized($role){
            /**  @var string $currentURL */
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/","", $currentURL);
        
            for($i=0; $i< sizeof($this->sites); $i++){
                if($currentURL === $this->sites[$i]['site'] && $this->sites[$i]['role'] === $role){
                    return true;
                }
            }
            return false;
        }

        /**
             * Al incializar asigno al setCurrentUser ($user)
             * y ejecuto el metodo authorizeAccess ($role)
             * @return void
        */
        function initialize($user){
            $this->session->setCurrentUser($user->getMatricula());// tomo el id de userModel
            $this->authorizeAccess($user->getRole());//tomo el rol de userModel
        }

        /**
             * dependiendo del rol que tenga mi usuario sera redireccionado un sitio
             * @return boolean
        */
        private function authorizeAccess($role){
            switch($role){
                case 'user': //'user'
                    $this->redirect($this->defaultSites['user']);
                break;
                default:
            }
        }

        function logout(){
            $this->session->closeSession();
        }
    }    

?>