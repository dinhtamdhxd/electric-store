<?php 

    $name           =   (isset($this->arrParam['form']['name']))        ? $this->arrParam['form']['name'] : '';
    $privilege_id   =   (isset($this->arrParam['form']['privilege_id']))? $this->arrParam['form']['privilege_id'] : '';
    $ordering       =   (isset($this->arrParam['form']['ordering']))    ? $this->arrParam['form']['ordering'] : '';
    $keyStatus      =   (isset($this->arrParam['form']['status']))      ? $this->arrParam['form']['status'] : 'default';
    $keyGroupACP    =   (isset($this->arrParam['form']['group_acp']))   ? $this->arrParam['form']['group_acp'] : 'default';

    //Input
    $inputName          =   HTML::cmsInputForm('form[name]', 'text', $name);
    $inputPrivilege_id  =   HTML::cmsInputForm('form[privilege_id]', 'text', $privilege_id, null, null, 'input-privilege');
    $inputOrdering      =   HTML::cmsInputForm('form[ordering]', 'number', $ordering);
    $inputToken         =   HTML::cmsInputHidden('form[token]', time());

    //Selectbox
    $arrStatus          =   ['default' => '-Select Status-', 1 => 'Active', 0 => 'Inactive'];
    $slbStatus          =   HTML::cmsSelectboxForm('form[status]', $arrStatus, $keyStatus);

    $arrGroupACP        =   ['default' => '-Select Group ACP-', 1 => 'Yes', 0 => 'No'];
    $slbGroupACP        =   HTML::cmsSelectboxForm('form[group_acp]', $arrGroupACP, $keyGroupACP);

    //Row form
    $nameRow            =   HTML::cmsRowForm('Name', $inputName);
    $privilege_idRow    =   HTML::cmsRowForm('Privilege_id', $inputPrivilege_id);
    $statusRow          =   HTML::cmsRowForm('Status', $slbStatus);
    $groupACPRow        =   HTML::cmsRowForm('Group ACP', $slbGroupACP);
    $orderingRow        =   HTML::cmsRowForm('Ordering', $inputOrdering);
    $inputHiddenRow     =   $inputToken;
    //InputHidden
    if(isset($this->arrParam['id'])){
        $inputHiddenRow .=   HTML::cmsInputHidden('form[id]', $this->arrParam['id']);
    }

    $formTable      =   $nameRow. $privilege_idRow. $statusRow. $groupACPRow. $orderingRow. $inputHiddenRow;

    //Button
    $linkSave       =   URL::createLink($this->module, $this->controller, 'form', ['type' => 'save']);
    $linkSaveClose  =   URL::createLink($this->module, $this->controller, 'form', ['type' => 'save-close']);
    $linkSaveNew    =   URL::createLink($this->module, $this->controller, 'form', ['type' => 'save-new']);
    $linkCancel     =   URL::createLink($this->module, $this->controller, 'index');
    $saveBtn        =   HTML::cmsBtnFormAction('Save', $linkSave, 'btn-save', 'primary');
    $save_closeBtn  =   HTML::cmsBtnFormAction('Save & Close', $linkSaveClose, 'btn-save-close', 'success');
    $save_newBtn    =   HTML::cmsBtnFormAction('Save & New', $linkSaveNew, 'btn-save-new','info');
    $cancelBtn      =   HTML::cmsBtnFormAction('Cancel', $linkCancel, 'btn-cancel', 'danger');

    $rowBtn         =   $saveBtn. $save_closeBtn. $save_newBtn. $cancelBtn;
?>
<div class="card card-info" style="width: 700px; margin: auto;">
    <div class="card-header">
        <h3 class="card-title">Change Info Group</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" action="", method="POST" id="form-data">
        <div class="card-body">
            <?php echo $this->errors ?? ''; ?>
            <?php echo $formTable; ?>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <?php echo $rowBtn; ?>
        </div>
        <!-- /.card-footer -->
    </form>
</div>