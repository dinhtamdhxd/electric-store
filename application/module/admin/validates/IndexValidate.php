<?php
class IndexValidate extends Validate
{
    public function __construct($arrParam)
    {
        parent::__construct($arrParam);
    }

    public function validate()
    {
        $this   ->addRule('email', 'email')
                ->addRule('password', 'password', null);
        $this   ->run();
    }

    public function showErrors(){
        $xhtml  =   '';
        if(!empty($this->errors)){
            $xhtml  .=  '<ul class="text-light bg-danger" style="padding: 5px 0px 5px 20px;">';
            foreach($this->errors as $value){
                $xhtml  .=  '<li class="row">'.$value.'</li>';
            }
            $xhtml  .=  '</ul>';
        }
        return $xhtml;
    }
    
}
