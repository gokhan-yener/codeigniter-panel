<?php
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 4.08.2018
 * Time: 12:46
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."third_party\Classes\PHPExcel.php";

class Excel_library extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}