<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 27.07.2018
 * Time: 21:54
 */

function editButtonForList($url)
{

    return ' <a href="' . base_url($url) . '">
                <button type="button" rel="tooltip" class="btn btn-success btn-round btn-sm btn-fab"
                        data-original-title="" title="">
                    <i class="material-icons">edit</i>
                </button>
            </a>';
}

function deleteButtonForList($url)
{

    return '<a class="removeBtn" dataUrl="'.base_url($url).'">
                                <button type="button" rel="tooltip" class="btn btn-danger btn-fab btn-round btn-sm">
                                    <i class="material-icons">close</i>
                                </button>
                            </a>';

}

function imageButtonForList($url)
{

    return '<a class="imageBtn" href="'.base_url($url).'">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Resim ekle" class="btn btn-info btn-fab btn-round btn-sm">
                                    <i class="material-icons">add_photo_alternate</i>
                                </button>
                            </a>';

}


function switchIsactiveButton($id,$isActive,$url)
{
    $output = '<div class="togglebutton">
        <label>
            <input type="checkbox" name="isActive"
                   dataUrl="' . base_url($url) . '"
                   dataId="' . $id . '"
                   class="isActive"  ';
    if ($isActive == 1) {
        $output .= ' checked ';
    }
    $output .= '><span class="toggle"></span></label></div>';

    return $output;
}

function flexibleButtonForList($style = "red", $icon = "info"){
    return '<a  href="#" >
                                    <i class="material-icons" style="color: '.$style.';">'.$icon.'</i>
                              
                            </a>';
}