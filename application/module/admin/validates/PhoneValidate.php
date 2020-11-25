<?php
class PhoneValidate extends Validate
{
    public function validate($database, $checkExist = true)
    {
        if($checkExist){
            $name       =   $this->source['name'];
            $queryName  =   "SELECT * FROM `$database->table` WHERE `name` = '$name' ";

            $this   ->addRule('name', 'string-notExistRecord', ['database'=>$database, 'query' => $queryName, 'min' =>  2, 'max' => 100])
                    ->addRule('picture', 'file', ['extension' => ['jpg', 'png'], 'min' => 1000, 'max' => 100000000], false)
                    ->addRule('ordering', 'int', ['min' => 1 , 'max' => 100])
                    ->addRule('status', 'status', ['deny' => ['default']])
                    ->addRule('price', 'int', ['min' => 0, 'max' => '100000000'])
                    ->addRule('sale_off', 'int', ['min' => 0, 'max' => '100'])
                    ->addRule('special', 'status', ['deny' => ['default']])
                    ->addRule('category_id', 'status', ['deny' => ['default']]);

        }else{
            $this   ->addRule('name', 'string', ['min' => 2 , 'max' => 100])
                    ->addRule('picture', 'file', ['extension' => ['jpg', 'png'], 'min' => 1000, 'max' => 100000000], false)
                    ->addRule('ordering', 'int', ['min' => 1 , 'max' => 100])
                    ->addRule('status', 'status', ['deny' => ['default']])
                    ->addRule('price', 'int', ['min' => 0, 'max' => '100000000'])
                    ->addRule('sale_off', 'int', ['min' => 0, 'max' => '100'])
                    ->addRule('special', 'status', ['deny' => ['default']])
                    ->addRule('category_id', 'status', ['deny' => ['default']]);
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
