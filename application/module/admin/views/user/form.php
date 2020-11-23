<?php 
    $username       =   (isset($this->arrParam['form']['username']))    ? $this->arrParam['form']['username'] : '';
    $fullname       =   (isset($this->arrParam['form']['fullname']))    ? $this->arrParam['form']['fullname'] : '';
    $email          =   (isset($this->arrParam['form']['email']))       ? $this->arrParam['form']['email'] : '';
    $ordering       =   (isset($this->arrParam['form']['ordering']))    ? $this->arrParam['form']['ordering'] : '';
    $keyStatus      =   (isset($this->arrParam['form']['status']))      ? $this->arrParam['form']['status'] : 'default';
    $keyGroupName   =   (isset($this->arrParam['form']['group_id']))  ? $this->arrParam['form']['group_id'] : 'default';

    //Input
    $inputUsername          =   HTML::cmsInputForm('form[username]', 'text', $username);
    // $inputFullname          =   HTML::cmsInputForm('form[fullname]', 'text', $fullname);
    $inputEmail             =   HTML::cmsInputForm('form[email]', 'email', $email);
    $inputOrdering          =   HTML::cmsInputForm('form[ordering]', 'number', $ordering);
    $inputToken             =   HTML::cmsInputHidden('form[token]', time());

    //Selectbox
    $arrStatus          =   ['default' => '-Select Status-', 1 => 'Active', 0 => 'Inactive'];
    $slbStatus          =   HTML::cmsSelectboxForm('form[status]', $arrStatus, $keyStatus);

    $arrGroupName               =   $this->arrGroupName;
    $arrGroupName['default']    =   '-Select Group Name-';
    ksort($arrGroupName); 
    $keyGroupName;
    $slbGroupName               =   HTML::cmsSelectboxForm('form[group-name]', $arrGroupName, $keyGroupName);

    //Row form
    $usernameRow        =   HTML::cmsRowForm('Username', $inputUsername);
    // $fullnameRow        =   HTML::cmsRowForm('Fullname', $inputFullname);
    $emailRow           =   HTML::cmsRowForm('Email', $inputEmail);
    $statusRow          =   HTML::cmsRowForm('Status', $slbStatus);
    $groupNameRow       =   HTML::cmsRowForm('Group Name', $slbGroupName);
    $orderingRow        =   HTML::cmsRowForm('Ordering', $inputOrdering);
    $inputHiddenRow     =   $inputToken;
    //InputHidden
    if(isset($this->arrParam['id'])){
        $inputHiddenRow .=   HTML::cmsInputHidden('form[id]', $this->arrParam['id']);
    }

    $formTable      =   $usernameRow. $emailRow. $statusRow. $groupNameRow. $orderingRow. $inputHiddenRow;

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
        <h3 class="card-title">Change Info User</h3>
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