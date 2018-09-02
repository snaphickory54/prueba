<?php

define('ROOT', 'http://localhost/todoListApp/');
define("_URL", "http://localhost/todoListApp/app/");
define('_BUSSINES','../bussines/');
define("TEMPLATE", "public/template/");
define("CLAVEWORD","(emails*24_16)");

//DATABASE GLOBALS

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'todolist');
define('DB_TYPE', 'mysql');

define('_MODELS', '../models/');
define('MODELS', '../models/');
define('BS','../bussines/');

//FOLDERS GLOBALS

if($source == 'app'){
define('LIBS', 'libs/');    
}else if($source == 'services'){
  define('LIBS', './libs/');  
  define('URL', ROOT.'services/');
  define('LIBS_SERVICES', '../services_libs/');
    
}



//SECURITY GLOBALS
    define('HASH_KEY', '1234');
    define('HASH_SECRET', '5678');
    define('HASH_PASSWORD_KEY', '9123');
    define('SECRET_WORD', 'surrender');
    
define('LOCAL_SERVER',true);