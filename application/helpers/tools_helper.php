<?php
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 24.06.2018
 * Time: 02:22
 */

function get_category_title($id){

    $CI = &get_instance();
    $row = $CI->db->where("id",$id)->get("category")->row();

    $title ="<span style='color: red'>Kategori Bulunamadı</span>";
    if(!empty($row)):
    return $row->title;
    else:
        return $title;
    endif;
}


function get_supplier_title($id)
{

    $CI = &get_instance();
    $row = $CI->db->where("id", $id)->get("supplier")->row();
    $title = "<span style='color: red'>Tedarikçi Bulunamadı</span>";
    if (!empty($row)):
        return $row->title;
    else:
        return $title;
    endif;
}

