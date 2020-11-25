<?php 
    $name           =   (isset($this->arrParam['form']['name']))    ? $this->arrParam['form']['name'] : '';
    $ordering       =   (isset($this->arrParam['form']['ordering']))    ? $this->arrParam['form']['ordering'] : '';
    $keyStatus      =   (isset($this->arrParam['form']['status']))      ? $this->arrParam['form']['status'] : 'default';

    //Input
    $inputName      =   HTML::cmsInputForm('form[name]', 'text', $name);
    $inputPicture   =   HTML::cmsInputFile('picture', 'form-picture');
    $inputOrdering  =   HTML::cmsInputForm('form[ordering]', 'number', $ordering);
    $inputToken     =   HTML::cmsInputHidden('form[token]', time());

    //Selectbox
    $arrStatus          =   ['default' => '-Select Status-', 1 => 'Active', 0 => 'Inactive'];
    $slbStatus          =   HTML::cmsSelectboxForm('form[status]', $arrStatus, $keyStatus);


    //Row form
    $nameRow            =   HTML::cmsRowForm('Name', $inputName);
    $statusRow          =   HTML::cmsRowForm('Status', $slbStatus);
    $orderingRow        =   HTML::cmsRowForm('Ordering', $inputOrdering);
    $inputHiddenRow     =   $inputToken;
    $pictureShow         =   '';
    if(isset($this->arrParam['id'])){
        $inputPicture    =  HTML::cmsInputFile('picture', 'form-picture', null, $this->arrParam['form']['picture']);
        $pictureImg      =  HTML::cmsImg($this->srcpicture, 'ml-2');
        $pictureShow     =  HTML::cmsRowForm('', $pictureImg);
        $inputHiddenRow .=  HTML::cmsInputHidden('form[id]', $this->arrParam['id']);
    }
    $pictureRow         =   $pictureShow. HTML::cmsRowForm('Picture', $inputPicture, false, 'pr-2');
    $formTable          =   $nameRow. $pictureRow. $statusRow. $orderingRow. $inputHiddenRow;

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
        <h3 class="card-title">Change Info Category</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" role="form" action="", method="POST" id="form-data" enctype="multipart/form-data">
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