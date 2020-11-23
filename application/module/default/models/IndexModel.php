<?php
    class IndexModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function checkLogin($arrParam){
            $email      =   $arrParam['email'];
            $password   =   md5($arrParam['password']);
            $query[]    =   "SELECT `email`, `password` FROM "."`".TBE_USER."` ";
            $query[]    =   "WHERE `email` = '$email' AND `password` = '$password' AND `status` = '1' ";

            $query      =   implode("", $query);
            return $this->isExist($query);

        }

        public function info($arrParam){
            $email      =   $arrParam['email'];
            $tableUser  =   TBE_USER;
            $tableGroup =   TBE_GROUP;
            $query[]    =   "SELECT `u`.`id`, `u`.`username`, `u`.`fullname`, `u`.`email`, `u`.`status`, `u`.`ordering`, `u`.`group_id`, `g`.`group_acp` ";
            $query[]    =   "FROM `$tableUser` AS `u`, `$tableGroup` AS `g` ";
            $query[]    =   "WHERE `email` = '$email' AND `u`.`group_id` = `g`.`id` ";

            $query      =   implode("", $query); 
            return $this->fetchRow($query);

        }
    }
?>