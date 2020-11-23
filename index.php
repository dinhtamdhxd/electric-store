<?php
    require_once 'define.php';
    spl_autoload_register(function ($class) {
        $pathRequire    =   LIBS_PATH.$class.'.php';
        if(file_exists($pathRequire)) require_once $pathRequire;
    });

    Session::init();
    $bootstrap  =   new Bootstrap();
    $bootstrap->init();
?>