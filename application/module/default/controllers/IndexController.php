<?php
    class IndexController extends Controller{
        public function __construct($arrParam)
        {
            parent::__construct($arrParam);
        }

        public function indexAction(){
            if(isset($this->_arrParam['type']) && $this->_arrParam['type'] == 'not-url'){
                $this->_view->render('not-url', false);
            }
        }
        public function loginAction(){

           
            if(isset($this->_arrParam['form']['token'])){
                $this->_validate->validate();
                if($this->_validate->isValid()){
                    if($this->_model->checkLogin($this->_arrParam['form'])){
                        $dataUser               =   $this->_model->info($this->_arrParam['form']);
                        Session::set('login', true);
                        Session::set('user', $dataUser);
                        Session::set('group_acp', $dataUser['group_acp']);
                        URL::redirect($this->_module, 'dashboard', 'index');
                    }else{
                        $this->_view->errors    =   '<p class="text-danger">Thông tin đăng nhập không chính xác!</p>';
                    }
                }else{
                    $this->_view->errors    =   $this->_validate->showErrors();
                }
            }
            $fileConfig             =   MODULE_PATH.$this->_module.DS.'views'.DS.$this->_controller.DS.'config.ini';
            $dataConfig             =   parse_ini_file($fileConfig);
            $arrCss['file']         =   $dataConfig['fileCss'];
            $arrCss['link']         =   $dataConfig['linkCss'];
            $arrJs['file']          =   $dataConfig['fileJs'];
            $this->_view->title     =   $dataConfig['title'];
            $this->_view->dirImages =   MODULE_URL. $this->_module.DS.'views'.DS. $this->_controller.DS.$dataConfig['dirImages'];
            
            $this->_view->render('login', false, $arrCss, $arrJs);
        }
    }
?>