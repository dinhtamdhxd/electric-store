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
    $linkSortName       =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'name', 'sort_by' => $sort_by]);
    $linkSortID         =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'id', 'sort_by' => $sort_by]);
    $linkSortStatus     =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'status', 'sort_by' => $sort_by]);
    $linkSortOrdering   =   URL::createLink($this->module, $this->controller, 'index', ['sort_column' => 'ordering', 'sort_by' => $sort_by]);
    $sort_icon          =   isset($this->arrParam['sort_by']) ? $this->arrParam['sort_by'] : null;
    $column_sort        =   isset($this->arrParam['sort_column']) ? $this->arrParam['sort_column'] : '';
    $th_ID              =   HTML::sortLinkTable('Id', $column_sort, $linkSortID, $sort_icon);
    $th_Content         =   HTML::sortLinkTable('Content', $column_sort, $linkSortName, $sort_icon);
    $th_Status          =   HTML::sortLinkTable('Status', $column_sort, $linkSortStatus, $sort_icon);
    $th_Ordering        =   HTML::sortLinkTable('Ordering', $column_sort, $linkSortOrdering, $sort_icon);
    $th_modified        =   '<th class="text-center">Modified</th>';
    $th_action          =   '<th class="text-center">Action</th>';
    $th_row             =   $th_ID. $th_Content. $th_Status. $th_Ordering. $th_modified. $th_action;
    
    //TD LIST CONTENT
    $tbContentHtml              =   '';
    foreach($items as $value){
        $id                     =   $value['id'];
        $filter_search          =   (isset($this->arrParam['filter-search'])) ? $this->arrParam['filter-search'] : '';
        $valueID                =   Helper::highlight($value['id'], $filter_search, 'id', $this->arrParam);
        $name                   =   Helper::highlight($value['name'], $filter_search, 'name', $this->arrParam);
        $imgPicture             =   (file_exists(HTD_PATH.$this->dirImgPicture.PIC_SLIDER[2].$value['picture'])) ? $this->dirImgPicture.PIC_SLIDER[2].$value['picture'] : $this->dirImgPicture.'60x90-default.jpg';
        $picture                =   '<img class="img-thumbnail" src="'.$imgPicture.'" >';
        $linkChangeStatus       =   "javascript: changeAjaxState('".URL::createLink($this->module, $this->controller, 'changeAjaxState', ['task' => 'change-ajax-status', 'id' => $id, 'status' => $value['status']])."')";
        $statusIcon             =   ($value['status'] == 1) ? HTML::cmsIconState($linkChangeStatus) : HTML::cmsIconState($linkChangeStatus, 'danger', 'minus');     
        $ordering               =   HTML::cmsInput('ordering', 'number', $value['ordering'],'text-center m-auto', 'width: 65px;');
        $modified               =   HTML::cmsModified($value['modified'], $value['modified_by']);
        $linkTrash              =   "javascript: trash('".URL::createLink($this->module, $this->controller, 'trash', ['id' => $id])."')";
        $p_title                =   HTML::createPtag($name, 'mb-0 text-primary font-weight-bold', true, 'mobile-alt');
        $p_description          =   ($value['description'] == '') ? '' : HTML::createPtag($value['description'], 'mb-0 text-success white-space text-justify', true, 'angle-double-right text-warning');
        $a_link                 =   HTML::createAlink($value['link'], 'mb-0 text-info white-space text-justify', $value['link'], true, 'angle-double-right text-warning');
        $tbContentHtml         .=   '<tr id="'.$id.'">
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="checkbox-'.$id.'" name="cid[]" value="'.$id.'">
                                            <label for="checkbox-'.$id.'" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">'.$valueID.'</td>
                                    <td class="text-left" style="max-width: 400px;">
                                        '.$p_title.$p_description.$a_link.$picture.'
                                    </td>
                                    <td class="text-center status-'.$id.'">'.$statusIcon.'</td>
                                    <td class="text-center ordering-'.$id.'">'.$ordering.'</td>
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