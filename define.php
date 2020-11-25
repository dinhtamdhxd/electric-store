<?php
    // DEFINE PATH
    define('DS', '/');
    define('HTD_PATH', 'D:/xamp/htdocs');
    
    define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__)) .DS);
    define('APPLICATION_PATH', ROOT_PATH.'application'.DS);
    define('MODULE_PATH', APPLICATION_PATH.'module'.DS);
    define('LIBS_PATH', ROOT_PATH.'libs'.DS);
    define('PUBLIC_PATH', ROOT_PATH.'public'.DS);
    define('TEMPLATE_PATH', PUBLIC_PATH.'template'.DS);
    define('FILES_PATH', PUBLIC_PATH.'files'.DS);
    define('EXTENDS_PATH', LIBS_PATH.'extends'.DS);
    define('SCRIPTS_PATH', PUBLIC_PATH.'scripts'.DS);
    
    
    // DEFINE URL
    define('ROOR_URL', str_replace(HTD_PATH, '', ROOT_PATH));
    define('APPLICATION_URL', ROOR_URL.'application'.DS);
    define('MODULE_URL', APPLICATION_URL.'module'.DS);
    define('LIBS_URL', ROOR_URL.'libs'.DS);
    define('PUBLIC_URL', ROOR_URL.'public'.DS);
    define('TEMPLATE_URL', PUBLIC_URL.'template'.DS);
    define('FILES_URL', PUBLIC_URL.'files'.DS);
    define('EXTENDS_URL', LIBS_URL.'extends'.DS);
    define('SCRIPTS_URL', PUBLIC_URL.'scripts'.DS);

    // DEFINE DATABASE
    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'electric_store');
    define('DB_TABLE', 'group');

    // DEFINE TABLE ON DB_DATABASE

    define('TBE_GROUP', 'group');
    define('TBE_USER', 'user');
    define('TBE_CATEGORY', 'category');
    define('TBE_PRIVILEGE', 'privilege');
    define('TBE_PHONE', 'phone');
    define('TBE_TABLET', 'tablet');
    define('TBE_COMPUTER', 'computer');
    define('TBE_SLIDER', 'slider');
    
    // DEFAULT VALUE
    define('DEFAULT_MODULE', 'admin');
    define('DEFAULT_CONTROLLER', 'dashboard');
    define('DEFAULT_ACTION', 'index');

    define('TIME_LOGIN', 1800);
    define('PRIVILEGE_LEVEL1', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']); //ADMIN
    define('PRIVILEGE_LEVEL2', ['1', '2', '3', '4', '6', '7', '10']);
    define('PRIVILEGE_LEVEL3', ['2', '4']);
    
    // DEFINE SIZE PICTURE
    define('PIC_USER', [60,90,'60x90-']);
    define('PIC_CATEGORY', [100,100,'100x100-']);
    define('PIC_SLIDER', [100,100,'100x100-']);
    define('PIC_PHONE', [100,100,'100x100-']);
    
    
    

    
    
    
    
    
    
?>