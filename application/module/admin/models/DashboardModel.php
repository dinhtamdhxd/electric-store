<?php
    class DashboardModel extends Model{
        public function __construct()
        {
            parent::__construct();
        }

        public function countItems($table){
            $query  =   "SELECT count(`id`) AS total FROM "."`".$table."`";
            $result =    $this->fetchRow($query);
            $total  =   (!empty($result)) ? $result['total'] : 0;
            return $total;
        }
    }
?>