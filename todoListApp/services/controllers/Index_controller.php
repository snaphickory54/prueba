<?php

class Index_controller extends Controller {

	function __construct() {
		parent::__construct();
	}
        
        public function getIndex(){
        $id = $_GET["id"];
        $orc = Orientacion::getById($id);
        print_r(json_encode($orc->toArray()));
        //print_r(json_encode(Orientacion::getAll()));
        }
        
        
        
        public function postIndex(){
        $keys = Orientacion::getKeys();
        unset($keys[0]);
        $this->validateKeys($keys, filter_input_array(INPUT_POST));
        $orc = Orientacion::instanciate($_POST);
        $r = $orc->create();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        print(json_encode($r));
        }
        
        public function putIndex(){
        $_PUT = $this->_PUT;
        print_r($this->_PUT);
        $orc = Orientacion::getById($_PUT["id"]);
        $orc->setPitch($_PUT["pitch"]);
        $orc->setYaw($_PUT["yaw"]);
        $orc->setRoll($_PUT["roll"]);
        
        $r = $orc->update();
        if($r["error"] == 0){ $status = 201; }else{ $status = 400; }
        Request::setHeader($status);
        echo "insert";
    
        }
}
