<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 28.07.2018
 * Time: 20:33
 */

class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->load->view("admin/userauth/loginqr");
    }

    public function check()
    {

        $this->load->library("form_validation");
        $this->form_validation->set_rules("username", "Kullanıcı Adı", "trim|required|max_length[30]|min_length[3]");
        $this->form_validation->set_rules("password", "Şifre", "trim|required|max_length[30]|min_length[4]");

        if ($this->form_validation->run() == false){

            setFlashMessage("rose",validation_errors(),"message",12);
            redirect("auth");
        }

        $this->load->helper("security_helper");
        $username = trim($this->input->post("username"));
        $password = setPassword(trim($this->input->post("password")));

        $result = $this->auth_library->CheckAdminUser($username,$password);

        if($result==="success"){
            setFlashMessage("rose","Hoşgeldiniz","message",12);
            redirect("auth/home");
        }elseif($result==="disable"){
            setFlashMessage("info","Kullanıcı hesabınız pasif durumdadır, lütfen yönetim ile iletişime geçiniz","message",12);
            redirect("auth");
        }elseif($result ==="wrong"){
            setFlashMessage("rose","Kullanıcı adı ve/veya parolanız yanlış","message",12);
            redirect("auth");
        }else{
            setFlashMessage("rose","Sistem hatası !!!","message",12);
            redirect("auth");
        }
    }

    public function checkqr()
    {

        $qr = filter_var($this->input->post("data"),FILTER_SANITIZE_STRING);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("data", "Kod Adı", "trim|required");

        if ($this->form_validation->run() == false){

            return false;
        }else{
            return true;
        }


    }
}