<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function menu_active($page, $arr)
{

    $pageid = in_array($page, $arr);


    if ($pageid == 1) {
        return 'active';
    }

}


function menu_show($pagename, $arr)
{
    $pageid = in_array($pagename, $arr);

    if ($pageid == 1) {
        return 'show';
    }

}

function pre($arr,$isStop=true)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";

    if($isStop === true){
        exit();
    }

}

function select($id1,$id2){
    return $id1==$id2 ? "selected='selected'":NULL;
}

function checkBox($check){

    if($check==1){
        echo "checked='checked'";
    }
}