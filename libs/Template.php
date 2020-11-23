<?php
    class Template{
        private $_folderTemplate;
        private $_fileTemplate;
        private $_fileTemplateIni;
        private $controller;

        public function __construct($controller)
        {
            $this->controller   =   $controller;
        }

        public function setFolderTemplate($folderName){
            $this->_folderTemplate  =   $folderName;
        }
        public function getFolderTemplate(){
            return $this->_folderTemplate;
        }

        public function setFileTemplate($fileName){
            $this->_fileTemplate  =   $fileName;
        }
        public function getFileTemplate(){
            return $this->_fileTemplate;
        }

        public function setFileTemplateIni($fileIni){
            $this->_fileTemplateIni  =   $fileIni;
        }

        public function load(){
            $pathFileTemplateIni    =   TEMPLATE_PATH.$this->_folderTemplate.DS.$this->_fileTemplateIni;
            $dataTemplate           =   parse_ini_file($pathFileTemplateIni);
           
            $metaName               =   $this->createMeta($dataTemplate['metaName'], 'name') ;
            $metaHTTP               =   $this->createMeta($dataTemplate['metaName'], 'HTTP') ;
            $meta                   =   $metaHTTP. $metaName;

            $dirCss                 =   TEMPLATE_URL.$this->_folderTemplate.DS.$dataTemplate['dirCss'].DS;
            $cssFile                =   $this->createLinkCss($dataTemplate['fileCss'], $dirCss, 'file');
            $cssLink                =   isset($dataTemplate['linkCss']) ? $this->createLinkCss($dataTemplate['linkCss']) : '';
            $css                    =   $cssFile. $cssLink;

            $dirJs                  =   TEMPLATE_URL.$this->_folderTemplate.DS.$dataTemplate['dirJs'].DS;
            $jsFile                 =   $this->createLinkJs($dataTemplate['fileJs'], $dirJs, 'file');
            $jsLink                 =   isset($dataTemplate['linkJs']) ? $this->createLinkJs($dataTemplate['linkJs']) : '';
            $js                     =   $jsLink. $jsFile;

            $this->controller->_view->title     =   $dataTemplate['title'];
            $this->controller->_view->meta      =   $meta;
            $this->controller->_view->css       =   $css;
            $this->controller->_view->js        =   $js;
            $this->controller->_view->dirImages =   TEMPLATE_URL.$this->_folderTemplate.DS.$dataTemplate['dirImages'];
        }

        public function createMeta($arrMeta, $type = 'name'){
            $xhtml  =   '';
            if(!empty($arrMeta)){
                foreach($arrMeta as $value){
                    $data   =   explode('|', $value);
                    if($type == 'name'){
                        $xhtml .= '<meta name="'.$data[0].'" content="'.$data[1].'">';
                    }else if($type == 'HTTP'){
                        $xhtml .= '<meta http-equiv="'.$data[0].'" content="'.$data[1].'">';
                    }
                }
            }
            return $xhtml;
        }

        public function createLinkCss($arrCss, $dirCss = null, $type = 'link'){
            $xhtml  =   '';
            if(!empty($arrCss)){
                foreach($arrCss as $value){
                    if($type == 'file'){
                        $xhtml .= '<link rel="stylesheet" href="'.$dirCss.$value.'">';
                    }else if($type == 'link'){
                        $xhtml .= '<link rel="stylesheet" href="'.$value.'">';
                    }
                }
            }
            return $xhtml;
        }

        public function createLinkJs($arrJs, $dirJs = null, $type = 'link'){
            $xhtml  =   '';
            if(!empty($arrJs)){
                foreach($arrJs as $value){
                    if($type == 'file'){
                        $xhtml .= '<script src="'.$dirJs.$value.'"></script>';
                    }else if($type == 'link'){
                        $xhtml .= '<script src="'.$value.'"></script>';
                    }
                }
            }
            return $xhtml;
        }
       
    }
?>