<?php
    class DashboardController extends Controller{
        public function __construct($arrParam)
        {
            parent::__construct($arrParam);
        }

        public function indexAction(){
            $this->_view->title             =   'Dashboard';
            $this->_view->total_group       =   $this->_model->countItems(TBE_GROUP);
            $this->_view->total_user        =   $this->_model->countItems(TBE_USER);
            $this->_view->total_cat         =   $this->_model->countItems(TBE_CATEGORY);
            $this->_view->total_slider      =   $this->_model->countItems(TBE_SLIDER);
            $this->_view->total_phone       =   $this->_model->countItems(TBE_PHONE);

            $this->_view->arrParam          =   $this->_arrParam;
            $this->_view->render('index');
        }
    }
?>