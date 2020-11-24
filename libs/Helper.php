<?php
class Helper
{
    //Highlight
    public static function highlight($text, $words, $filter_by, $arrParam)
    {
        $flag   =   false;
        if(isset($arrParam['filter-search'])){
            if(isset($arrParam['filter-by'])){
                if($arrParam['filter-by'] == $filter_by) $flag = true;
            }else{
                $flag = true;
            }
        };
        if ($flag) {
            $highlighted = preg_filter('/' . preg_quote($words, '/') . '/imsu', '<b style="color: red">$0</b>', $text);
            if (!empty($highlighted)) {
                $text = $highlighted;
            }
        }
        return $text;
    }

    
}
