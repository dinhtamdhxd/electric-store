<?php
class HTML
{

    //CREATE MENUBAR OF ADMIN LTE
    public static function createAdminMenubar($controller, $action, $arrMenu)
    {
        $xhtml  =   '';
        if (!empty($arrMenu)) {
            $controllerName     =   ($controller == 'index') ? 'Dashboard' : ucfirst($controller);
            $parent             =   $arrMenu['parent'];
            $activeP            =   ($controllerName == $parent['name']) ? 'active' : '';
            if (!isset($arrMenu['childs'])) {
                $xhtml  =   '<li class="nav-item">
                                    <a href="' . $parent['link'] . '" class="nav-link ' . $activeP . '">
                                        <i class="nav-icon fas fa-' . $parent['icon'] . '"></i>
                                        <p>
                                            ' . $parent['name'] . '
                                        </p>
                                    </a>
                                </li>';
            } else {
                $actionName     =   ($action == 'index') ? 'List' : ucfirst($action);
                $childs         =   $arrMenu['childs'];
                $classOpen      =   ($controllerName == $parent['name']) ? 'menu-open' : '';
                $xhtml  =   '<li class="nav-item has-treeview '.$classOpen.'">
                                    <a href="#" class="nav-link ' . $activeP . '">
                                        <i class="nav-icon fas fa-' . $parent['icon'] . '"></i>
                                        <p>
                                            ' . $parent['name'] . '
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">';
                foreach ($childs as $value) {
                    $activeC        =   ($controllerName == $parent['name'] && $actionName == $value['name']) ? 'active' : '';
                    $xhtml  .=  '<li class="nav-item">
                                        <a href="' . $value['link'] . '" class="nav-link ' . $activeC . '">
                                            <i class="fas fa-' . $value['icon'] . ' nav-icon"></i>
                                            <p>' . $value['name'] . '</p>
                                        </a>
                                    </li>';
                }

                $xhtml  .=  '</ul></li>';
            }
        }
        return   $xhtml;
    }

    //SHOW MENU HEADER
    public static function showMenuHeader($arrMenu)
    {
        $xhtml  =   '';
        if (!empty($arrMenu)) {
            foreach ($arrMenu as $value) {
                $xhtml .=   '<li class="nav-item d-none d-sm-inline-block">
                                    <a href="' . $value['link'] . '" class="nav-link">' . $value['name'] . '</a>
                                </li>';
            }
        }
        return $xhtml;
    }

    //SHOW PANEL OF DASHBOARD
    public static function createPanel($data)
    {
        $xhtml  =   '';
        if (!empty($data)) {
            $xhtml  .=  '<div class="col-lg-' . $data['col-class'] . ' col-6">
                                    <div class="small-box bg-' . $data['bg-class'] . '">
                                        <div class="inner">
                                            <h3>' . $data['quantity'] . '</h3>
                                            <h5>' . $data['content'] . '<h5>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-' . $data['icon'] . '"></i>
                                        </div>
                                        <a href="' . $data['link'] . '" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>';
        }
        return $xhtml;
    }

    //CREATE INPUT HIDDEN
    public static function cmsInputHidden($name, $value)
    {
        return  '<input type="hidden" name="' . $name . '" value="' . $value . '" >';
    }

    //CREATE COUNT STATUS
    public static function cmsLinkStatus($name, $link, $total, $valueStatus)
    {
        switch($valueStatus){
            case 'all': $status = 'All'; break;
            case '1': $status = 'Active'; break;
            case '0': $status = 'Inactive'; break;
        }
        $class  =   ($name == $status) ? 'info' : 'secondary';
        return '<a href="' . $link . '" class="mr-1 btn btn-sm btn-'.$class.' ">
                        ' . $name . '
                        <span class="badge badge-pill badge-light">' . $total . '</span>
                    </a>';
    }

    //CREATE SELECTBOX
    public static function cmsSelectbox($name, $arrData, $keySelected, $class = null, $id = null, $style = null)
    {
        $id                     =   ($id != null) ? 'id="' . $id . '"' : '';
        $style                  =   ($style != null) ? 'style="' . $style . '"' : '';
        preg_match('#[a-z]+#imsu', $keySelected, $result);
        $numberKeySelected      =   (!empty($result)) ? true : false;
        $xhtml                  =   '<select  ' . $style . $id . ' name="' . $name . '" class="custom-select custom-select-sm' . $class . '">';
        foreach ($arrData as $key => $value) {
            $flagKey    =   false;
            if ($numberKeySelected) {
                if ($key === $keySelected) $flagKey = true;
            } else {
                if ($key == $keySelected) $flagKey = true;
            }
            if ($flagKey) {
                $xhtml  .=  '<option value="' . $key . '" selected = "true">' . $value . '</option>';
            } else {
                $xhtml  .=  '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }

    //CREATE ICON STATE
    public static function cmsIconState($link, $class = 'success', $icon = 'check'){
        return '<div><a href="'.$link.'" class="my-btn-state rounded-circle btn btn-sm btn-'.$class.'"><i class="fas fa-'.$icon.'"></i></a></div>';
    }

    //CREATE INPUT
    public static function cmsInputForm($name, $type, $value = null, $class = null, $style = null, $id = null){
        $id     =   ($id == null) ? '' : 'id="'.$id.'"';
        $style  =   ($style == null) ? '' : 'style="'.$style.'"';
        $value  =   ($value == null) ? '' : 'value="'.$value.'"';
        $xhtml  =   '<div class="col-sm-10">
                        <input type="'.$type.'" name="'.$name.'" '.$value.' class="form-control '.$class.'" '.$id.' '.$style.' >
                    </div>';
                       
        return   $xhtml;
    }

    public static function cmsInput($name, $type, $value = null, $class = null, $style = null, $id = null){
        $id     =   ($id == null) ? '' : 'id="'.$id.'"';
        $style  =   ($style == null) ? '' : 'style="'.$style.'"';
        $value  =   ($value == null) ? '' : 'value="'.$value.'"';
        $xhtml  =   '<div class="text-center">
                        <input type="'.$type.'" name="'.$name.'" '.$value.' class="form-control '.$class.'" '.$id.' '.$style.' >
                    </div>';
                       
        return   $xhtml;
    }

    //CREATE SELECTBOX FORM
    public static function cmsSelectboxForm($name, $arrData, $keySelected = null, $class = null, $id = null){
        $id     =   ($id == null) ? '' : 'id="'.$id.'"';
        preg_match('#[a-z]+#imsu', $keySelected, $result);
        $numberKeySelected      =   (!empty($result)) ? true : false;
        $xhtml  =   '<div class="col-sm-10">
                        <select class="custom-select '.$class.'" name="'.$name.'" '.$id.'>';
        foreach($arrData as $key => $value){
            $flagKey    =   false;
            if ($numberKeySelected) {
                if ($key === $keySelected) $flagKey = true;
            } else {
                if ($key == $keySelected) $flagKey = true;
            }
            if ($flagKey) {
                $xhtml  .=  '<option value="' . $key . '" selected = "true">' . $value . '</option>';
            } else {
                $xhtml  .=  '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $xhtml .=   ' </select></div>';   
                       
        return   $xhtml;
    }
    //CREATE ROW FORM
    public static function cmsRowForm($name, $input, $required = false){
        $iconRequired   =   ($required) ? ' <span class="text-danger">*</span>' : '';
        $xhtml  =   '<div class="form-group row">
                        <label class="col-sm-2 col-form-label">'.$name.$iconRequired.'</label>
                        '.$input.'
                    </div>';
                       
        return   $xhtml;
    }

    //CREATE BUTTON FORM ACTION
    public static function cmsBtnFormAction($name, $link, $id, $class){
        $xhtml   =   '<a href="'.$link.'" class="btn btn-'.$class.' mr-2 btn-save" id="'.$id.'">'.$name.'</a>';
        return   $xhtml;
    }

    //SORT LINK
    public static function sortLinkTable($columnName, $columnSort, $link, $iconSort = null){
        $icon_tag   =   '';
        switch($iconSort){
           case 'desc': $icon_tag  =   ' <i class="fas fa-sort-down text-secondary"></i>'; break;
            case 'asc': $icon_tag  =   ' <i class="fas fa-sort-up text-secondary"></i>'; break;
        }
        if($columnName == ucwords($columnSort)){
            $xhtml  =   '<th class="text-center"><a href="'.$link.'">'.$columnName.$icon_tag.' </a></td>';
        }else{
            $xhtml  =   '<th class="text-center"><a href="'.$link.'">'.$columnName.' </a></td>';
        }
        
        return $xhtml;
    }

    //MODIFIED
    public static function cmsModified($modified, $modified_by){
        $xhtml  =   '<p class="mb-0 history-by"><i class="far fa-user"></i> '.$modified_by.'</p>
                    <p class="mb-0 history-time"><i class="far fa-clock"></i> '.$modified.'</p>';
        return $xhtml;
    }

    //ICON SHOW PRIVILEGE
    public static function showIconPrivilege($privilege_id){
        $arrPrivilege_id        =   (gettype($privilege_id ) == 'string') ? explode(',', $privilege_id) : [];
        $class  =   'secondary';
        if(count(array_intersect($arrPrivilege_id, PRIVILEGE_LEVEL1)) == count(PRIVILEGE_LEVEL1)){
            $class = 'primary';
        }else if(count(array_intersect($arrPrivilege_id, PRIVILEGE_LEVEL2)) == count(PRIVILEGE_LEVEL2)){
            $class = 'success';
        }else if(count(array_intersect($arrPrivilege_id, PRIVILEGE_LEVEL3)) == count(PRIVILEGE_LEVEL3)){
            $class = 'warning';
        }
        
        $xhtml  =   '<span class="btn btn-sm btn-'.$class.' span-icon-privilege rounded-circle">
                        <i class="fa fa-eye fa-xs"></i>
                    </span>';
        return $xhtml;
    }

    //CREATE BUTTON
    public static function cmsButton($type, $name, $class, $id = null){
        $id     =   ($id == null) ? '' : 'id="'.$id.'"';
       return $xhtml = '<button type="'.$type.'" class="btn btn-sm btn-'.$class.'" '.$id.'>'.$name.'</button>';
    }
}
