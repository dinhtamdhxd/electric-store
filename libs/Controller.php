<?php
    class Controller{
        protected $_arrParam;
        protected $_module;
        protected $_controller;
        public    $_view;
        protected $_model;
        public    $_templateObj;
        public    $_pagination;
        public    $_validate;

        public function __construct($arrParam)
        {
            $this->setParam($arrParam);
            $this->setTemplate();
            $this->setView();
            $this->setModel();
            $this->setValidate();
            $this->_view->templateObj =   $this->_templateObj;
            if($this->_module == 'admin' && $this->_controller != 'index'){
                $this->_templateObj->setFolderTemplate('admin/adminLte');
                $this->_templateObj->setFileTemplate('index');
                $this->_templateObj->setFileTemplateIni('template.ini');
                $this->_templateObj->load();
            }
           
        }

        public function setParam($arrParam){
            $this->_arrParam    =   $arrParam;
            $this->_module      =   $arrParam['module'];
            $this->_controller  =   $arrParam['controller'];
        }

        public function setTemplate(){
            $this->_templateObj =   new Template($this);
        }

        public function setView(){
            $this->_view        =   new View($this->_arrParam);
        }

        public function setModel(){
            $modelName      =   ucfirst($this->_controller).'Model';
            $path           =   MODULE_PATH.$this->_module.DS.'models'.DS.$modelName.'.php';
            require_once $path;
            $this->_model   =   new $modelName();
        }

        public function setValidate(){
            $validateName       =   ucfirst($this->_controller).'Validate';
            $path               =   MODULE_PATH.$this->_module.DS.'validates'.DS.$validateName.'.php';
            require_once $path;
            $source             =   (isset($this->_arrParam['form'])) ? $this->_arrParam['form'] : null;
            $this->_validate    =   new $validateName($source);
        }
        
    }
?>