<?php
class UserValidate extends Validate
{
    public function validate($database, $checkExist = true)
    {
        if($checkExist){
            $username   =   $this->source['username'];
            // $fullname   =   $this->source['fullname'];
            $email      =   $this->source['email'];
            $queryUsername  =   "SELECT * FROM `$database->table` WHERE `username` = '$username' ";
            $queryEmail     =   "SELECT * FROM `$database->table` WHERE `email` = '$email' ";
            // $queryFullName  =   "SELECT * FROM `$database->table` WHERE `fullname` = '$fullname' ";

            $this   ->addRule('username', 'string-notExistRecord', ['database'=>$database, 'query' => $queryUsername, 'min' => 3 , 'max' => 100])
                    // ->addRule('fullname', 'string-notExistRecord', ['database'=>$database, 'query' => $queryFullName])
                    ->addRule('email', 'email-notExistRecord', ['database'=>$database, 'query' => $queryEmail])
                    ->addRule('ordering', 'int', ['min' => 1 , 'max' => 100])
                    ->addRule('group-name', 'status', ['deny' => ['default']])
                    ->addRule('status', 'status', ['deny' => ['default']]);
        }else{
            $this   ->addRule('username', 'string', ['min' => 3 , 'max' => 100])
                    // ->addRule('fullname', 'string', ['min' => 15 , 'max' => 100])
                    ->addRule('email', 'email')
                    ->addRule('ordering', 'int', ['min' => 1 , 'max' => 100])
                    ->addRule('group-name', 'status', ['deny' => ['default']])
                    ->addRule('status', 'status', ['deny' => ['default']]);
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
