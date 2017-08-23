<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('LIB_PATH', ROOT.DS.'lib');
define('CONTROLLERS_PATH', ROOT.DS.'controllers');
define('MODELS_PATH', ROOT.DS.'models');
define('VIEWS_PATH', ROOT.DS.'views');
define('OBSERVERS_PATH', ROOT.DS.'components'.DS.'observers');
define('VALIDATOR_PATH', ROOT.DS.'components'.DS.'validator');
define('MAILER_FACADE_PATH', ROOT.DS.'components'.DS.'mailer_facade');

require_once ROOT.DS.'lib'.DS.'init.php';
require_once ROOT.DS.'vendor'.DS.'autoload.php';

//try {
    App::run($_SERVER['REQUEST_URI']);
//    $test = App::getDb()->query("SELECT * FROM `pages`;");
//    echo '<pre>';
//    print_r($test);
//} catch (Exception $exception) {
//    echo 'App exception: '.$exception->getMessage();
//}

