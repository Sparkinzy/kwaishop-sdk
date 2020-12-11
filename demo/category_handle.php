<?php

ob_start();
include __DIR__ . '/data/categories.json';
$result = ob_get_contents();
$result = json_decode($result, true);
ob_end_clean();

$tree = make_tree($result['data'], 0);
die(json_encode($tree));
function make_tree($arr, $pid = 0, $column_name = 'categoryId|categoryPid|children|categoryName', $new_column_name = "value|pid|children|label")
{
    list($idname, $pidname, $cldname, $label_name) = explode('|', $column_name);
    list($new_idname, $new_pidname, $children_name, $new_label_name) = explode('|', $new_column_name);
    $ret = array();
    foreach ($arr as $k => $v) {
        if ($v [$pidname] == $pid) {
            $tmp = [
                $new_idname     => $arr [$k][$idname],
                $new_label_name => $arr[$k][$label_name],
            ];
            unset($arr [$k]);
            $children = make_tree($arr, $v [$idname], $column_name, $new_column_name);
            if (count($children)) {
                $tmp [$children_name] = $children;
            }
            $ret [] = $tmp;
        }
    }
    return $ret;
}