<?php

// INPUT HIDDEN TO GET ARRPARAM
$inputModuleHD      =   HTML::cmsInputHidden('module', $this->module);
$inputControllerHD  =   HTML::cmsInputHidden('controller', $this->controller);
$inputActionHD      =   HTML::cmsInputHidden('action', 'index');

// FILTER STATUS
$total              =   $this->total;
$valueStatus        =   (isset($this->arrParam['filter-status'])) ? $this->arrParam['filter-status'] : 'all';
$allStatus          =   HTML::cmsLinkStatus('All', URL::createLink($this->module, $this->controller, $this->action), $total, $valueStatus);
$totalActive        =   $this->totalActive;
$activeStatus       =   HTML::cmsLinkStatus('Active', URL::createLink($this->module, $this->controller, $this->action, ['filter-status' => 1]), $totalActive, $valueStatus);
$totalInactive      =   $total - $totalActive;
$inactiveStatus     =   HTML::cmsLinkStatus('Inactive', URL::createLink($this->module, $this->controller, $this->action, ['filter-status' => 0]), $totalInactive, $valueStatus);

// SELECT BOX FILTER GROUP ACP
$arrGroupName       =   ['default' => '-Select Group Name-', 1 => 'Admin', 2 => 'Member'];
$slbGroupName       =   HTML::cmsSelectbox('filter_group-name', $arrGroupName, 'default', '', 'filter-group-name', 'width: unset');
//INPUT SEARCH
$valueSearch        =   isset($this->arrParam['filter-search']) ? $this->arrParam['filter-search'] : '';
$inputSearch        =   HTML::cmsInput('filter-search', 'search', $valueSearch, 'form-control-sm', 'min-width: 300px;', 'filter-search');
// BUTTON SEARCH FILTER
$btn_clear          =  HTML::cmsButton('button', 'Clear', 'danger', 'btn-clear-search');
$btn_search         =  HTML::cmsButton('button', 'Search', 'info', 'btn-search');

// FILTER BY
$keySearchBy        =   isset($this->arrParam['filter-by']) ? $this->arrParam['filter-by'] : 'all';
$arrSearchBy        =   ['all' => 'All', 'id' => 'ID', 'username' => 'Username', 'email' => 'email'];
$slbSearchBy        =   HTML::cmsSelectbox('filter-by', $arrSearchBy, $keySearchBy, '', 'filter-by', 'width: unset');
?>
<div class="card card-info card-outline">
    <div class="card-header">
        <h6 class="card-title">Search Filter</h6>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: block;">
        <form action="" method="GET" id="filter-bar">
            <?php echo $inputModuleHD . $inputControllerHD . $inputActionHD; ?>
        </form>

        <div class="row justify-content-between">
            <div class="mb-1">
                <?php echo $allStatus . $activeStatus . $inactiveStatus; ?>
            </div>
            <div class="mb-1">
                <?php echo $slbGroupName; ?>
            </div>
            <div class="mb-1">
                <div class="input-group">
                    <?php echo $slbSearchBy. $inputSearch; ?>
                    <div class="input-group-append">
                        <?php echo $btn_clear. $btn_search;  ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>