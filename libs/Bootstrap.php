<?php
class Bootstrap
{
    private     $params = [];

    public function init()
    {
        $this->setParam();
        $module                 =   $this->params['module'];
        $controlerName          =   ucfirst($this->params['controller']).'Controller';
        $path                   =   MODULE_PATH.$module.DS.'controllers'.DS.$controlerName.'.php';
        if(file_exists($path)){
            require_once $path;
            $controller         =   new $controlerName($this->params);
            $actionName         =   $this->params['action'].'Action';
            if(method_exists($controller, $actionName)){
                $login              =   Session::get('login');
                $timeLogin          =   Session::get('timeLogin');
                $group_acp          =   Session::get('group_acp');
                if($module == 'admin'){                                 // Module admin
                    if($actionName == 'loginAction'){
                        $controller->$actionName();
                    }else{
                        if($login && $timeLogin + TIME_LOGIN >= time()){
                            if($group_acp == 1){
                                $controller->$actionName();
                            }else{
                                URL::redirect('default', 'index', 'index', ['type' => 'not-permision']);
                            }
                            
                        }else{
                            Session::deleteInfoUser();
                            URL::redirect($module, 'index', 'login');
                        }
                    }
                    

                }else{                                                  //Module default
                    if($controlerName == 'User'){

                    }else{
                        $controller->$actionName();
                    }
                }
                
            }else{
                URL::redirect('default', 'index', 'index', ['type' => 'not-url']);
            }
        }else{
            URL::redirect('default', 'index', 'index', ['type' => 'not-url']);
        }   
        
    }
    // SET PARAMS
    public function setParam(){
        $arrParam               =   array_merge($_GET, $_POST);
        $arrParam['module']     =   (isset($arrParam['module']))        ? $arrParam['module']       : DEFAULT_MODULE;
        $arrParam['controller'] =   (isset($arrParam['controller']))    ? $arrParam['controller']   : DEFAULT_CONTROLLER;
        $arrParam['action']     =   (isset($arrParam['action']))        ? $arrParam['action']       : DEFAULT_ACTION;
        $this->params           =   $arrParam;
    }

    // GET PARAMS
    public function getParam(){
        return $this->params;
    }

    // ERROR
    public function error(){
        $path   =   MODULE_PATH.'default'.DS.'controllers'.DS.'ErrorController.php';
        require_once $path;
        $error  =   new ErrorController();
        $error->index();
    }

}
