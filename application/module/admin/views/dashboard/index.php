<?php
    // Group Panel
    $grouData       =   ['content' => 'Group', 'link' => URL::createLink($this->module, 'group', 'index') ,'quantity' => $this->group['total'], 'icon' => 'android-contacts', 'col-class' => 3, 'bg-class' => 'primary'];
    $groupPanel     =   HTML::createPanel($grouData);

    // User Panel
    $userData       =   ['content' => 'User Registration', 'link' => URL::createLink($this->module, 'user', 'index') ,'quantity' => $this->user['total'], 'icon' => 'android-contact', 'col-class' => 3, 'bg-class' => 'success'];
    $userPanel      =   HTML::createPanel($userData);

    // Category Panel
    $catData        =   ['content' => 'Category', 'link' => URL::createLink($this->module, 'category', 'index') ,'quantity' => $this->cat['total'], 'icon' => 'clipboard', 'col-class' => 3, 'bg-class' => 'info'];
    $catPanel       =   HTML::createPanel($catData);

    // Computer Panel
    $comData        =   ['content' => 'Computer', 'link' => URL::createLink($this->module, 'computer', 'index') ,'quantity' => 150, 'icon' => 'laptop', 'col-class' => 3, 'bg-class' => 'warning'];
    $comPanel       =   HTML::createPanel($comData);

    // Phone Panel
    $phoneData      =   ['content' => 'Phone', 'link' => URL::createLink($this->module, 'phone', 'index') ,'quantity' => $this->phone['total'], 'icon' => 'iphone', 'col-class' => 3, 'bg-class' => 'danger'];
    $phonePanel     =   HTML::createPanel($phoneData);

    // Tablet Panel
    $tabletData     =   ['content' => 'Tablet', 'link' => URL::createLink($this->module, 'tablet', 'index') ,'quantity' => 80, 'icon' => 'ipad', 'col-class' => 3, 'bg-class' => 'secondary'];
    $tabletPanel    =   HTML::createPanel($tabletData);
?>  
<div class="row">
    <?php echo $groupPanel. $userPanel. $catPanel. $comPanel. $phonePanel. $tabletPanel; ?>
</div>