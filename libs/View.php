<?php
class View
{
    public  $arrParam;
    public  $module;
    public  $controller;
    public  $action;
    public  $fileView;
    public  $title;
    public  $meta;
    public  $css;
    public  $js;
    public  $dirImages;

    public function __construct($arrParam)
    {
        $this->arrParam     =   $arrParam;
        $this->module       =   $arrParam['module'];
        $this->controller   =   $arrParam['controller'];
        $this->action       =   $arrParam['action'];
    }

    public function render($filename, $loadTemplate = true, $arrCss = null, $arrJs = null)
    {
        $this->fileView     =   MODULE_PATH . $this->module . DS . 'views' . DS . $this->controller . DS . $filename . '.php';
        if ($loadTemplate == true) {
            $folderTemplate     =   $this->templateObj->getFolderTemplate();
            $fileTemplate       =   $this->templateObj->getFileTemplate();
            $path               =   TEMPLATE_PATH . $folderTemplate . DS . $fileTemplate . '.php';
            if (file_exists($path)) require_once $path;
        }else{
            $this->appendCss($arrCss);
            $this->appendJs($arrJs);
            require_once $this->fileView;   
        }
    }

    public function appendCss($arrCss){
        $dirCss     =   MODULE_URL. $this->module.DS.'views'.DS. $this->controller.DS.'css'.DS;
        if(!empty($arrCss)){
            foreach($arrCss as $key => $value){
                if($key == 'file'){
                    foreach($value as $fileCss){
                        $this->css  .=  '<link rel="stylesheet" href="'.$dirCss.$fileCss.'">';
                    }
                    
                }else if($key == 'link'){
                    foreach($value as $linkCss){
                        $this->css  .=  '<link rel="stylesheet" href="'.$linkCss.'">';
                    }
                }
            }
        }
    }

    public function appendJs($arrJs){
        $dirJs     =   MODULE_URL. $this->module.DS.'views'.DS. $this->controller.DS.'js'.DS;
        if(!empty($arrJs)){
            foreach($arrJs as $key => $value){
                if($key == 'file'){
                    foreach($value as $fileJs){
                        $this->js  .=  '<link rel="stylesheet" href="'.$dirJs.$fileJs.'">';
                    }
                }else if($key == 'link'){
                    foreach($value as $linkJs){
                        $this->js  .=  '<link rel="stylesheet" href="'.$linkJs.'">';
                    }
                }
            }
        }
    }

    
}
