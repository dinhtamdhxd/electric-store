<?php
class GroupValidate extends Validate
{
    public function validate($database, $checkExist = true)
    {
        if($checkExist){
            $name       =   $this->source['name'];
            $queryName  =   "SELECT * FROM `$database->table` WHERE `name` = '$name' ";
            $this   ->addRule('name', 'string-notExistRecord', ['database'=>$database, 'query' => $queryName, 'min' => 5 , 'max' => 100])
                    ->addRule('ordering', 'int', ['min' => 1 , 'max' => 100])
                    ->addRule('status', 'status', ['deny' => ['default']])
                    ->addRule('group_acp', 'status', ['deny' => ['default']]);
        }else{
            $this   ->addRule('name', 'string', ['min' => 5 , 'max' => 100])
                    ->addRule('ordering', 'int', ['min' => 1 , 'max' => 100])
                    ->addRule('status', 'status', ['deny' => ['default']])
                    ->addRule('group_acp', 'status', ['deny' => ['default']]);
        }   
        
        $this->run();
    }

    public function showErrors()
    {
        $xhtml  =   '';
        if (!empty($this->errors)) {
            $xhtml  .=  '<ul class="bg-warning" style="padding: 5px 0px 5px 20px;">';
            foreach ($this->errors as $value) {
                $xhtml  .=  '<li class="row">' . $value . '</li>';
            }
            $xhtml  .=  '</ul>';
        }
        return $xhtml;
    }
}
