<?php
    class URL{

        public static function createLink($module, $controller, $action, $options = null){
            $link   =   "index.php?module=$module&controller=$controller&action=$action";
            if(!empty($options)){
                foreach($options as $key => $value){
                    $link   .=  "&$key=$value";
                }
            }
            return $link;
        }

        public static function redirect($module, $controller, $action, $options = null){
            $link   =   self::createLink($module, $controller, $action, $options);
            header('location: '.$link);
        }
    }
?>