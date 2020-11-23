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
            $login      =   Session::get('login');
            $timeLogin  =   Session::get('timeLogin');
            if($login && $timeLogin + TIME_LOGIN >= time()){
                URL::redirect($this->_module, 'dashboard', 'index');
            }else{
                Session::deleteInfoUser();
            }
            if(isset($this->_arrParam['form']['token'])){
                $this->_validate->validate();
                if($this->_validate->isValid()){
                    if($this->_model->checkLogin($this->_arrParam['form'])){
                        $dataUser               =   $this->_model->info($this->_arrParam['form']);
                        Session::setLoginUser($dataUser);
                        URL::redirect($this->_module, 'dashboard', 'index');
                    }else{
                        $this->_view->errors    =   '<p class="text-danger">Thông tin đăng nhập không chính xác!</p>';
                        
                    }
                }else{
                    $this->_view->errors        =   $this->_validate->showErrors();
                    $this->_arrParam['form']    =   $this->_validate->getResult();
                }
            }
            $fileConfig             =   MODULE_PATH.$this->_module.DS.'views'.DS.$this->_controller.DS.'config.ini';
            $dataConfig             =   parse_ini_file($fileConfig);
            $arrCss['file']         =   $dataConfig['fileCss'];
            $arrCss['link']         =   $dataConfig['linkCss'];
            $arrJs['file']          =   $dataConfig['fileJs'];
            $this->_view->title     =   $dataConfig['title'];
            $this->_view->dirImages =   MODULE_URL. $this->_module.DS.'views'.DS. $this->_controller.DS.$dataConfig['dirImages'];
            $this->_view->arrParam  =   $this->_arrParam;
            $this->_view->render('login', false, $arrCss, $arrJs);
        }

        public function logoutAction(){
            Session::destroy();
            URL::redirect($this->_module, 'index', 'index');
        }
    }
?>