<?php
    class PhoneController extends Controller{
        
        public function __construct($arrParam)
        {
            parent::__construct($arrParam);
        }

        public function indexAction(){
            $this->_view->title             =   'Phone';

            //DATA LIST PHONE       
            $totalItems                     =   $this->_model->countItems($this->_arrParam);

            //DATA FILTER STATUS
            $this->_view->total             =   $this->_model->countStatus();
            $this->_view->totalActive       =   $this->_model->countStatus(['task' => 'total-active-status']);

            //DATA FILTER GROUP NAME

            //SET PAGINATION
            $currentPage                    =   (isset($this->_arrParam['page'])) ? $this->_arrParam['page'] : 1;
            $arrPagination                  =   ['pageRange' => '3', 'totalItemsPerPage' => '5', 'currentPage' => $currentPage];
            $this->_arrParam['pagination']  =   $arrPagination;
            
            $this->_pagination              =   new Pagination($totalItems, $arrPagination);
            $this->_view->paginationHtml    =   $this->_pagination->showPagination();
            $this->_view->items             =   $this->_model->listItems($this->_arrParam);
            $this->_view->arrGroupCategory  =   $this->_model->getGroupCategory();
            $this->_view->dirImgPicture     =   FILES_URL.$this->_controller.DS.'images/'.PIC_PHONE[2].DS;
            $this->_view->arrParam          =   $this->_arrParam;
            $this->_view->totalSearch       =   $totalItems;
            $this->_view->render('index');
        }

        public function formAction(){
            $pathUpload     =   EXTENDS_PATH.'Upload.php';
            require_once $pathUpload;
            $uploadObj      =   new Upload();
            $dirImgPicture  =   FILES_URL.$this->_controller.DS.'images/'.PIC_PHONE[2].DS;
            if(isset($this->_arrParam['id'])){
                $id                         =   $this->_arrParam['id'];
                $infoUser                   =   $this->_model->infoItem($id);
                $this->_arrParam['form']    =   $infoUser;
                $this->_view->srcpicture    = (file_exists(HTD_PATH.$dirImgPicture.PIC_PHONE[2].$infoUser['picture'])) ? $dirImgPicture.PIC_PHONE[2].$infoUser['picture'] : $dirImgPicture.'60x90-default.jpg';
                if(empty($this->_arrParam['form'])) URL::redirect($this->_module, $this->_controller, 'index');
            }
            if(isset($this->_arrParam['form']['token']) &&  $this->_arrParam['form']['token'] > 0){

                //Set source for picture file
                if(isset($_FILES['picture']) && $_FILES['picture']['name'] != ''){
                    $this->_arrParam['form']['picture'] = $_FILES['picture'];
                    $this->_validate->setSource('picture', $this->_arrParam['form']['picture']);
                }else{
                    $this->_validate->setSource('picture', null);
                }
                $checkExists                =   isset($this->_arrParam['form']['id']) ? false : true; 
                $this->_validate->validate($this->_model, $checkExists);
                if($this->_validate->isValid()){
                    //Upload file
                    $fileUpload     =   $this->_arrParam['form']['picture'];
                    $folderUpload   =   $this->_controller.DS.'images/'.PIC_PHONE[2].DS;
                    //Remove file and upload
                    if(isset($_FILES['picture']) && $_FILES['picture']['name'] != ''){
                        $picturename =   $this->_model->getPicturename($this->_arrParam['form']['id']);
                        $uploadObj->removeFile($folderUpload, $picturename);
                        $uploadObj->removeFile($folderUpload, PIC_PHONE[2].$picturename);
                        $this->_arrParam['form']['picture']  =   $uploadObj->uploadFile($fileUpload, $folderUpload, PIC_PHONE[0], PIC_PHONE[1]);
                    }
                    $id =   $this->_model->saveItem($this->_arrParam, ['task' => 'form']);
                    if($this->_arrParam['type'] == 'save') URL::redirect($this->_module, $this->_controller, 'form', ['id' => $id]);
                    if($this->_arrParam['type'] == 'save-close') URL::redirect($this->_module, $this->_controller, 'index');
                    if($this->_arrParam['type'] == 'save-new') URL::redirect($this->_module, $this->_controller, 'form');
                }else{
                    $this->_view->errors        =   $this->_validate->showErrors();
                }
                $this->_arrParam['form']        =   $this->_validate->getResult();
            }
            
            
            $this->_view->title             =   'Form';
            $this->_view->arrGroupCategory  =   $this->_model->getGroupCategory();
            $this->_view->dirImgPicture     =   $dirImgPicture;
            $this->_view->arrParam          =   $this->_arrParam;
            $this->_view->render('form');
        }
        public function changeAjaxStateAction(){
            $results    =   $this->_model->changeState($this->_arrParam, ['task' => $this->_arrParam['task']]);
            echo json_encode($results);
        }

        public function trashAction(){
            $this->_model->trash($this->_arrParam);
            URL::redirect($this->_module, $this->_controller, 'index');
        }
        
        public function multy_activeAction(){
            $this->_arrParam['task']    = 'change-multy-status';
            $this->_arrParam['status']  = '1';
            $this->_model->changeState($this->_arrParam);
            if(isset($this->_arrParam['page']) && $this->_arrParam['page'] > 1){
                URL::redirect($this->_module, $this->_controller, 'index', ['page' => $this->_arrParam['page']]);
            }else{
                URL::redirect($this->_module, $this->_controller, 'index');
            }
        }

        public function multy_inactiveAction(){
            $this->_arrParam['task']    = 'change-multy-status';
            $this->_arrParam['status']  = '0';
            $this->_model->changeState($this->_arrParam);
            if(isset($this->_arrParam['page']) && $this->_arrParam['page'] > 1){
                URL::redirect($this->_module, $this->_controller, 'index', ['page' => $this->_arrParam['page']]);
            }else{
                URL::redirect($this->_module, $this->_controller, 'index');
            }
        }

        public function multy_deleteAction(){
            $this->_arrParam['task']    = 'multy-trash';
            $this->_model->trash($this->_arrParam);
            URL::redirect($this->_module, $this->_controller, 'index');
        }

        public function changeInputAction(){
            $result     =   $this->_model->changeInput($this->_arrParam);
            echo json_encode($result);
        }

        public function changeSelectAction(){
            $result     =   $this->_model->changeSelect($this->_arrParam);
            echo json_encode($result);
        }

    }
