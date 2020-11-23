<!-- Search & Filter -->
<?php
    //LIST ITEMS
    $items              =   $this->items;
   
    
    //SELECT BOX BULK ACTION 
    $arrBulk            =   ['default' => '-Bulk Action-', 'multy_active' => 'Multy Active', 'multy_inactive' => 'Multy Inactive', 'multy_delete' => 'Multy Delete'];
    $slbBulkAction      =   HTML::cmsSelectbox('bulk_action', $arrBulk, 'default', '', 'bulk-action','width: unset');
    
    //ROW HEADER TABLE
    $sort_by            =   isset($this->arrParam['sort_by']) ? $this->arrParam['sort_by'] : 'desc';
    $sort_by            =   ($sort_by == 'desc') ? 'asc' : 'desc';
    $linkSortUserName   =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'username', 'sort_by' => $sort_by]);
    $linkSortID         =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'id', 'sort_by' => $sort_by]);
    $linkSortStatus     =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'status', 'sort_by' => $sort_by]);
    $linkSortGroupName  =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'group name', 'sort_by' => $sort_by]);
    $linkSortOrdering   =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'ordering', 'sort_by' => $sort_by]);
    $sort_icon          =   isset($this->arrParam['sort_by']) ? $this->arrParam['sort_by'] : null;
    $column_sort        =   isset($this->arrParam['sort_column']) ? $this->arrParam['sort_column'] : '';
    $th_ID              =   HTML::sortLinkTable('Id', $column_sort, $linkSortID, $sort_icon);
    $th_Username        =   HTML::sortLinkTable('Username', $column_sort, $linkSortUserName, $sort_icon);
    $th_Status          =   HTML::sortLinkTable('Status', $column_sort, $linkSortStatus, $sort_icon);
    $th_GroupName       =   HTML::sortLinkTable('Group Name', $column_sort, $linkSortGroupName, $sort_icon);
    $th_Ordering        =   HTML::sortLinkTable('Ordering', $column_sort, $linkSortOrdering, $sort_icon);
    $th_row             =   $th_ID. $th_Username. $th_GroupName. $th_Status. $th_Ordering;
    
    //ARRAY SEARCH BY
    $arrSearchBy        =   ['username', 'email', 'id'];
    //TD LIST CONTENT
    $tbContentHtml              =   '';
    foreach($items as $value){
        $id                     =   $value['id'];
        $filter_search          =   (isset($this->arrParam['filter-search'])) ? $this->arrParam['filter-search'] : '';
        $valueID                =   Helper::highlight($value['id'], $filter_search, 'id', $this->arrParam);
        $username               =   Helper::highlight($value['username'], $filter_search, 'username', $this->arrParam);
        $email                  =   Helper::highlight($value['email'], $filter_search, 'email', $this->arrParam);
        $linkChangeStatus       =   "javascript: changeAjaxState('".URL::createLink($this->module, $this->controller, 'changeAjaxState', ['task' => 'change-ajax-status', 'id' => $id, 'status' => $value['status']])."')";
        $statusIcon             =   ($value['status'] == 1) ? HTML::cmsIconState($linkChangeStatus) : HTML::cmsIconState($linkChangeStatus, 'danger', 'minus');     
        // $linkChangeGroupName    =   "javascript: changeAjaxState('".URL::createLink($this->module, $this->controller, 'changeAjaxState', ['task' => 'change-ajax-group-acp', 'id' => $id, 'group_acp' => $value['group_acp']])."')";
        $slbGroupName           =   HTML::cmsSelectbox('form[group-name]', $this->arrGroupName, $value['group_id'], null, null, 'width: unset;');         
        $ordering               =   HTML::cmsInput('ordering', 'number', $value['ordering'],'text-center m-auto', 'width: 65px;');
        $modified               =   HTML::cmsModified($value['modified'], $value['modified_by']);
        $linkTrash              =   "javascript: trash('".URL::createLink($this->module, $this->controller, 'trash', ['id' => $id])."')";
        $tbContentHtml         .=   '<tr id="'.$id.'">
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="checkbox-'.$id.'" name="cid[]" value="'.$id.'">
                                            <label for="checkbox-'.$id.'" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">'.$valueID.'</td>
                                    <td class="text-center">
                                        <p class="mb-0"><i class="far fa-user"></i> '.$username.'</p>
                                        <p class="mb-0"><i class="far fa-envelope"></i> '.$email.'</p>
                                    </td>
                                    <td class="text-center group_name-'.$id.'" style="width: 130px">'.$slbGroupName.'</td>
                                    <td class="text-center status-'.$id.'">'.$statusIcon.'</td>
                                    <td class="text-center ordering-'.$id.'">'.$ordering.'</td>
                                    <td class="text-center">
                                        <p class="mb-0 history-by"><i class="far fa-user"></i> '.$value['created_by'].'</p>
                                        <p class="mb-0 history-time"><i class="far fa-clock"></i> '.$value['created'].'</p>
                                    </td>
                                    <td class="text-center modified-'.$id.'">'.$modified.'</td>
                                    <td class="text-center">
                                        <a href="'.URL::createLink($this->module, $this->controller, 'form', ['id' => $id]).'" class="rounded-circle btn btn-sm btn-info" title="edit" ><icon class="fas fa-pencil-alt"></icon></a>
                                        <a href="'.$linkTrash.'" class="rounded-circle btn btn-sm btn-danger" title="trash" ><icon class="fas fa-trash"></icon></a>
                                    </td>
                                </tr>';
    }
?>
<!-- Seach Filter -->
<?php require_once 'search-filter/search-filter.php'; ?>
<!-- List -->
<div class="card card-info card-outline">
    <div class="card-header">
        <h4 class="card-title">List</h4>
        <div class="card-tools">
            <a href="<?php echo URL::createLink($this->module, $this->controller, 'index'); ?>" class="btn btn-tool"><i class="fas fa-sync"></i></a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
            <div class="mb-1">
                <?php echo $slbBulkAction; ?>
                <button id="bulk-apply" class="btn btn-sm btn-info">Apply <span class="badge badge-pill badge-danger navbar-badge" style="display: none"></span></button>
            </div>
            <a href="<?php echo URL::createLink($this->module, $this->controller, 'form'); ?>" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Add New</a>
        </div>

        <!-- List Content -->
        <form action="" method="post" class="table-responsive" id="form-table">
            <table class="table table-bordered table-hover text-nowrap btn-table mb-0">
                <thead>
                    <tr>
                        <th class="text-center">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="check-all">
                                <label for="check-all" class="custom-control-label"></label>
                            </div>
                        </th>
                        <?php echo $th_row; ?>
                        <th class="text-center">Created</th>
                        <th class="text-center">Modified</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $tbContentHtml;?>
                </tbody>
            </table>
        </form>
    </div>
    <div class="card-footer clearfix">
        <?php echo $this->paginationHtml; ?>
    </div>
</div>