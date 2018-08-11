<?php
defined('BASEPATH') OR exit('No direct script access allowed');


function createoption($arr=array(),$select=NULL) {
 
foreach ($arr as $key => $value) {

        echo '<option value="'.$key.'" ' .($key==$select ? 'selected="selected"': NULL).'\>'.$value.'</option>';
}
      
       
    }



