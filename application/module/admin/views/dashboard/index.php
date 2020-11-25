<?php
    // Group Panel
    $grouData       =   ['content' => 'Group', 'link' => URL::createLink($this->module, 'group', 'index') ,'quantity' => $this->total_group, 'icon' => 'android-contacts', 'col-class' => 3, 'bg-class' => 'primary'];
    $groupPanel     =   HTML::createPanel($grouData);

    // User Panel
    $userData       =   ['content' => 'User Registration', 'link' => URL::createLink($this->module, 'user', 'index') ,'quantity' => $this->total_user, 'icon' => 'android-contact', 'col-class' => 3, 'bg-class' => 'success'];
    $userPanel      =   HTML::createPanel($userData);

    // Category Panel
    $catData        =   ['content' => 'Category', 'link' => URL::createLink($this->module, 'category', 'index') ,'quantity' => $this->total_cat, 'icon' => 'clipboard', 'col-class' => 3, 'bg-class' => 'info'];
    $catPanel       =   HTML::createPanel($catData);

    // Slider Panel
    $sliderData     =   ['content' => 'Slider', 'link' => URL::createLink($this->module, 'slider', 'index') ,'quantity' => $this->total_slider, 'icon' => 'images', 'col-class' => 3, 'bg-class' => 'warning'];
    $sliderPanel    =   HTML::createPanel($sliderData);

    // Phone Panel
    $phoneData      =   ['content' => 'Phone', 'link' => URL::createLink($this->module, 'phone', 'index') ,'quantity' => $this->total_phone, 'icon' => 'iphone', 'col-class' => 3, 'bg-class' => 'danger'];
    $phonePanel     =   HTML::createPanel($phoneData);

    // Tablet Panel
    $tabletData     =   ['content' => 'Tablet', 'link' => URL::createLink($this->module, 'tablet', 'index') ,'quantity' => 80, 'icon' => 'ipad', 'col-class' => 3, 'bg-class' => 'secondary'];
    $tabletPanel    =   HTML::createPanel($tabletData);
?>  
<div class="row">
    <?php echo $groupPanel. $userPanel. $catPanel. $sliderPanel. $phonePanel. $tabletPanel; ?>
</div>