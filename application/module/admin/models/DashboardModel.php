<?php
    class DashboardModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function countItems($table){
            $query  =   "SELECT count(`id`) AS total FROM "."`".$table."`";
            return $this->fetchRow($query);
        }
    }
?>