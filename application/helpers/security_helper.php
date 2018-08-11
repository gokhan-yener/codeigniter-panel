<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    function setPassword($str){
        $newPassword= sha1(substr(md5($str),12,10));
        return $newPassword;
    }

    function get_controllers_name(){

        return NULL;
}




