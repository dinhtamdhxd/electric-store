<?php
class PhoneModel extends Model
{
    private $columns    =   ['id', 'name', 'description', 'price', 'special', 'sale_off', 'picture', 'created', 'created_by', 'modified', 'modidied_by', 'status', 'ordering', 'category_id'];
    public function __construct()
    {
        parent::__construct();
        $this->setTable(TBE_PHONE);
    }

    //LIST ITEMS
    public function listItems($arrParam, $options = null)
    {
        $query[]    =   "SELECT * FROM `$this->table` ";
        $query[]    =   "WHERE `id` > 0 ";

        //FILTER SEARCH
        if (isset($arrParam['filter-search'])) {
            $keywords   =   'N' . "'%" . $arrParam['filter-search'] . "%'";
            $keyid      =   $arrParam['filter-search'];
            if(isset($arrParam['filter-by'])){
                $column_search  =   $arrParam['filter-by'];
                if($column_search == 'id'){
                    $query[]        =   "AND `$column_search` = '$keyid' ";
                }else{
                    $query[]        =   "AND `$column_search` LIKE $keywords ";
                }
            }else{
                $query[]        =   "AND ( `name` LIKE $keywords OR `id` = '$keyid') ";
            }
        }

        //FILTER STATUS
        if (isset($arrParam['filter-status'])) {
            $status     =   $arrParam['filter-status'];
            $query[]    =   "AND `status` =  '$status' ";
        }

        //FILTER GROUP CATEGORY
        if (isset($arrParam['filter-group-category'])) {
            $category_id   =   $arrParam['filter-group-category'];
            $query[]    =   "AND `category_id` =  '$category_id' ";
        }
       
        //FILTER SORT
        if (isset($arrParam['sort_column'])) {
            $sort_column    =   ($arrParam['sort_column'] == 'group name') ? 'group_id' : $arrParam['sort_column'];
            $sort_by        =   $arrParam['sort_by'];
            $query[]        =   "ORDER BY `$sort_column` $sort_by ";
        }else{
            $query[]        =   "ORDER BY `id` desc ";
        }


        //FILTER PAGINATION
        $length     =   $arrParam['pagination']['totalItemsPerPage'];
        $position   =   ($arrParam['pagination']['currentPage'] - 1) * $length;
        $query[]    =   "LIMIT $position,$length ";


        $query  =   implode(" ", $query); 
        return $this->fetchAll($query);
    }

    //COUNT ITEMS
    public function countItems($arrParam, $options = null)
    {
        $query[]    =   "SELECT COUNT(`id`) AS `total` FROM `$this->table` ";
        $query[]    =   "WHERE `id` > 0 ";

        //FILTER SEARCH
        if (isset($arrParam['filter-search'])) {
            $keywords   =   'N' . "'%" . $arrParam['filter-search'] . "%'";
            $keyid      =   $arrParam['filter-search'];
            if(isset($arrParam['filter-by'])){
                $column_search  =   $arrParam['filter-by'];
                if($column_search == 'id'){
                    $query[]        =   "AND `$column_search` = '$keyid' ";
                }else{
                    $query[]        =   "AND `$column_search` LIKE $keywords ";
                }
            }else{
                $query[]        =   "AND ( `name` LIKE $keywords OR `id` = '$keyid') ";
            }
        }

        //FILTER STATUS
        if (isset($arrParam['filter-status'])) {
            $status     =   $arrParam['filter-status'];
            $query[]    =   "AND `status` =  '$status' ";
        }

         //FILTER GROUP CATEGORY
         if (isset($arrParam['filter-group-category'])) {
            $category_id   =   $arrParam['filter-group-category'];
            $query[]    =   "AND `category_id` =  '$category_id' ";
        }
        
        $query  =   implode(" ", $query);
        $result =   $this->fetchRow($query);
        return  $result['total'];
    }
    public function countStatus($options = null)
    {
        $query[]    =   "SELECT COUNT(`id`) AS `total` FROM `$this->table` ";
        $query[]    =   "WHERE `id` > 0 ";
        if (isset($options['task']) && $options['task'] == 'total-active-status') {
            $query[]    =   "AND `status` = 1 ";
        }

        $query  =   implode(" ", $query);
        $result =   $this->fetchRow($query);
        return  $result['total'];
    }

    public function changeState($arrParam)
    {
        $modified       =   date('Y-m-d', time());
        $modified_by    =   (Session::get('user'))['username'];
        if ($arrParam['task'] == 'change-ajax-status') {
            $id         =   $arrParam['id'];
            $status     =   ($arrParam['status'] == 1) ? 0 : 1;
            $query      =   "UPDATE `$this->table` SET `status` = '$status', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = $id ";
            $this->query($query);
            $linkChangeStatus   =   "javascript: changeAjaxState('" . URL::createLink($arrParam['module'], $arrParam['controller'], 'changeAjaxState', ['task' => 'change-ajax-status', 'id' => $id, 'status' => $status]) . "')";
            $statusIcon         =   ($status == 1) ? HTML::cmsIconState($linkChangeStatus) : HTML::cmsIconState($linkChangeStatus, 'danger', 'minus');
            $modifiedHTML       =   HTML::cmsModified($modified, $modified_by);
            $results            =   ['id' => $id, 'name' => 'status', 'html' =>  $statusIcon,'modified' => $modifiedHTML];
            return $results;
        }

        if ($arrParam['task'] == 'change-ajax-special') {
            $id         =   $arrParam['id'];
            $special    =   ($arrParam['special'] == 1) ? 0 : 1;
            $query      =   "UPDATE `$this->table` SET `special` = '$special', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = $id ";
            $this->query($query);
            $linkChangeSpecial  =   "javascript: changeAjaxState('" . URL::createLink($arrParam['module'], $arrParam['controller'], 'changeAjaxState', ['task' => 'change-ajax-special', 'id' => $id, 'special' => $special]) . "')";
            $specialIcon        =   ($special == 1) ? HTML::cmsIconState($linkChangeSpecial) : HTML::cmsIconState($linkChangeSpecial, 'danger', 'minus');
            $modifiedHTML       =   HTML::cmsModified($modified, $modified_by);
            $results            =   ['id' => $id, 'name' => 'special', 'html' =>  $specialIcon,'modified' => $modifiedHTML];
            return $results;
        }

        if ($arrParam['task'] == 'change-multy-status') {
            $cid        =   '(' . implode(",", $arrParam['cid']) . ')';
            $status     =   $arrParam['status'];
            $query      =   "UPDATE `$this->table` SET `status` = '$status', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` IN  $cid ";
            $this->query($query);
            
        }
    }

    public function trash($arrParam)
    {
        if (isset($arrParam['task']) && $arrParam['task'] == 'multy-trash') {
            $this->delete($arrParam['cid']);
        } else {
            $this->delete([$arrParam['id']]);
        }
    }

    public function saveItem($arrParam)
    {
        if(isset($arrParam['form']['id'])){
            $arrParam['form']['modified']       =   date('Y-m-d', time());
            $arrParam['form']['modified_by']    =   (Session::get('user'))['username'];
        }else{
            $arrParam['form']['created']        =   date('Y-m-d', time());
            $arrParam['form']['created_by']     =   (Session::get('user'))['username'];
        }
        $formData                           =   array_intersect_key($arrParam['form'], array_flip($this->columns));
        
        if (isset($arrParam['form']['id'])) {
            $this->update($formData, [['id', $arrParam['form']['id'], '']]);
            $id     =   $arrParam['form']['id'];
        } else {
            $this->insert($formData);
            $id     =   $this->lastID();
        }
        return $id;
    }

    public function infoItem($id)
    {
        $query  =   "SELECT `id`, `name`, `description`, `price`, `special`, `sale_off`, `category_id`, `picture`, `status`, `ordering` FROM `$this->table` WHERE `id` = '$id' ";
        return $this->fetchRow($query);
    }

    public function changeInput($arrParam){
        $id             =   $arrParam['id'];
        $modified       =   date('Y-m-d', time());
        $modified_by    =   (Session::get('user'))['username'];
        
        $column_change  =   $arrParam['column_change'];
        $valueUpdate    =   $arrParam[$column_change];
        $query          =   "UPDATE `$this->table` SET `$column_change` = '$valueUpdate', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = $id ";
        $this->query($query);
        $modifiedHTML   =   HTML::cmsModified($modified, $modified_by);
        if($column_change == 'price'){
            $price_tag      =   HTML::cmsInput('price', 'text', number_format($valueUpdate),'text-center m-auto', 'width: 105px;');
            $result         =   ['id' => $id, 'name' => $column_change, 'modified' => $modifiedHTML, 'price_tag' => $price_tag];
        }else{
            $result         =   ['id' => $id, 'name' => $column_change, 'modified' => $modifiedHTML];
        }
        return $result;
    }

    //GET GROUPNAME
    public function getGroupCategory(){
        $tbCategory =   TBE_CATEGORY;
        $query      =   "SELECT `id`, `name` FROM `$tbCategory` ";
        return $this->fetchPairs($query);
    }

    //GET PICTURE NAME FOR REMOVE
    public function getPicturename($id){
        $query  =   "SELECT `avatar` FROM `$this->table` WHERE `id` = '$id' ";
        $result =   $this->fetchRow($query);
        return $result['avatar'];
    }

    //CHANGE SELECT
    public function changeSelect($arrParam){
        $id             =   $arrParam['id'];
        $modified       =   date('Y-m-d', time());
        $modified_by    =   (Session::get('user'))['username'];
        $column_change  =   $arrParam['column_change'];
        $valueUpdate    =   $arrParam[$column_change];
        $query          =   "UPDATE `$this->table` SET `$column_change` = '$valueUpdate', `modified` = '$modified', `modified_by` = '$modified_by' WHERE `id` = $id ";
        $this->query($query);
        $modifiedHTML   =   HTML::cmsModified($modified, $modified_by);
        $result         =   ['id' => $id, 'name' => 'Type', 'modified' => $modifiedHTML];
        return $result;
    }
}
