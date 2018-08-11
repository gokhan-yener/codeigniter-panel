<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 28.07.2018
 * Time: 21:20
 */

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Auth_library");

        if($this->auth_library->CheckSessionControl() === FALSE){

            redirect(base_url("auth"));

        }
    }

    public function index()
    {



        $data = new  stdClass();
        $data->content = 'admin/home/home_list';
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Anasayfa";
        $data->category2 = "";

        $this->load->vars($data);
        $this->load->view('admin/home/home');
    }
}