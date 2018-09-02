<?php

class Usuario_controller extends Controller {

	function __construct() {
		parent::__construct();
	}
        
    public function getUsuario($id){
        
        if($id){
            $usr = Usuario::getById($id);
            if($usr == null){exit("{}");}
            print_r(json_encode($usr->toArray()));
        }else{
            print_r(json_encode(Usuario::getAll()));
        }
    }

    public function postUsuario(){
        $keys = Usuario::getKeys();
        unset($keys[0]);
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $usr = Usuario::instanciate($_POST);
        $r = $usr->create();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }
    
    public function putUsuario(){
        $_PUT = $this->_PUT;
        print_r($this->_PUT);
        $usr = Usuario::getById($_PUT["id"]);
        $usr->setNombre($_PUT["nombre"]);
        $r = $usr->update();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
    }


    public function postLogin(){
        $params = json_decode(file_get_contents('php://input'),true);
        if($params){
            $email = $params['email'];
            $clave = $params['clave'];
        }else{
            $email = $_POST['email'];
            $clave = $_POST['clave'];
        }
        if( ( isset($email) && ($email!=null || $email!='') ) && ( isset($clave) && ($clave!=null || $clave!='') ) ){
        $usr = Usuario::search("email ='$email' AND clave = '$clave'");

        if($usr == null){exit("Datos incorrectos");}
        print_r(json_encode($usr));
      }else{
          exit("Datos incorrectos");
      }
  
      }

      
}
