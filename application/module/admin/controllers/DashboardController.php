<?php
    class DashboardController extends Controller{
        public function __construct($arrParam)
        {
            parent::__construct($arrParam);
        }

        public function indexAction(){
            $this->_view->title     =   'Dashboard';
            $this->_view->group     =   $this->_model->countItems(TBE_GROUP);
            $this->_view->user      =   $this->_model->countItems(TBE_USER);
            $this->_view->cat       =   $this->_model->countItems(TBE_CATEGORY);
            $this->_view->phone     =   $this->_model->countItems(TBE_PHONE);

            $this->_view->arrParam  =   $this->_arrParam;
            $this->_view->render('index');
        }
    }
?>