<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 28.07.2018
 * Time: 23:52
 */

class My_Controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }
}

class AdminBaseController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();


        if($this->Auth_library->CheckSessionControl() === FALSE){

            redirect(base_url("auth"));

        }
    }
}

class FrontBaseController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
    }
}

