<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_cat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->mainView = "admin";
        $this->mainViewSubFolder = __CLASS__;
        $this->load->model("admin/user_cat_model");
        $this->load->library(array( 'form_validation'));
        $this->load->helper(array('url', 'language'));
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect("auth");
        }
    }

    public function index()
    {

        $data = new  stdClass();
        $data->content = 'admin/user_cat/user_cat_list';
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Kullanıcı Kategori";
        $data->category2 = "Kullanıcı Kategori Listele";
        $data->getRows = $this->user_cat_model->get_Rows();


        $this->load->vars($data);
        $this->load->view("{$this->mainView}/{$this->mainViewSubFolder}/home");
    }

    public function user_cat_save()
    {

        $this->load->library("form_validation");

        $this->form_validation->set_rules("name", "Grup Adı", "trim|required|max_length[30]|min_length[3]");

        if ($this->form_validation->run() == false) {

            setFlashMessage("danger", validation_errors());
            redirect("{$this->mainView}/{$this->mainViewSubFolder}");
        } else {


            $data = array(
                "name"    => trim($this->input->post("name")),
            );

            $result = $this->user_cat_model->set_user_cat_Add($data);

            if ($result > 0) {
                setUserdataMessage("success", "insert");
                redirect("{$this->mainView}/{$this->mainViewSubFolder}");
            } else {
                setFlashMessage("danger", "Kaydedilmede hata oluştu !!!");
                redirect("{$this->mainView}/{$this->mainViewSubFolder}");
            }
        }
    }

    public function user_cat_edit($id)
    {

        $id = (int)$id;
        if ($id === 0) {

            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->mainView}/{$this->mainViewSubFolder}");
        }

        $data = new stdClass();
        $data->content = "admin/user_cat/user_cat_update";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Kullanıcı Grubu";
        $data->category2 = "Kullanıcı Grup Güncelle";
        $data->row = $this->user_cat_model->get_user_group_Id(array("id" => $id));
        $data->privileges = $this->user_cat_model->get_Privileges(array("group_id" => $id));
        $this->load->helper("security_helper");
        $data->controllernames = $this->ion_auth->get_controllers_name();

        if (!isset($data->row)) {
            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->mainView}/{$this->mainViewSubFolder}");
        }

        $this->load->vars($data);
        $this->load->view("{$this->mainView}/{$this->mainViewSubFolder}/home");
    }

    public function user_cat_update()
    {

        $user_cat_id = (int)$this->input->post("user_cat_id");

        if ($user_cat_id === 0) {

            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->mainView}/{$this->mainViewSubFolder}");
        }

        $this->load->library("form_validation");


        $this->form_validation->set_rules("name", "Grup adı", "trim|required|max_length[30]|min_length[3]");

        if ($this->form_validation->run() == false) {

            setFlashMessage("danger", validation_errors());
            redirect("{$this->mainView}/{$this->mainViewSubFolder}");

        } else {



            $data = array(
                "name"    => trim($this->input->post("name")),

            );

            $result = $this->user_cat_model->set_user_cat_Update(array("id" => $user_cat_id), $data);

            if ($result > 0) {
                setUserdataMessage("success", "update");
                redirect("{$this->mainView}/{$this->mainViewSubFolder}");
            } else {
                setFlashMessage("danger", "Kaydedilmede hata oluştu !!!");
                redirect("{$this->mainView}/{$this->mainViewSubFolder}");
            }
        }
    }

    public function user_cat_delete($id = 0)
    {
        $recordId = (int)$id;
        if ($recordId === 0) {

            setUserdataMessage("error", "delete");
            redirect("{$this->mainView}/{$this->mainViewSubFolder}");
        }

        $result = $this->user_cat_model->user_cat_delete(array("id" => $recordId));
        if ($result > 0) {

            setUserdataMessage("success", "delete");

        } else {

            setUserdataMessage("error", "deleteError");

        }
        redirect("{$this->mainView}/{$this->mainViewSubFolder}");
    }


    //AJAX">


    public function isActiveSetter()
    {


        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE, "messages" => "Hatalı istek"));
        }
        $id = (int)$this->input->post("id");

        if ($id <= 0) {
            echo json_encode(array('result' => FALSE, "messages" => "Hatalı istek"));
        }
        $state = (object)$this->user_cat_model->get_user_cat_Id(array("ug.id" => $id));

        $t = $state->isActive == 1 ? 0 : 1;

        $this->db->where(array("id" => $id))->update("users_group", array("isActive" => $t));
        $result = $this->db->affected_rows();
        if ($result > 0) {
            echo json_encode(array('result' => TRUE));
        } else {
            echo json_encode(array('result' => FALSE, "messages" => "Hata oluştu tekrar deneyiniz"));
        }

    }

    public function group_privileges_save()
    {


        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE, "messages" => "Hatalı istek"));
        }


        $page = filter_var($this->input->post("p"), FILTER_SANITIZE_STRING);
        $del = $this->input->post("d");
        $create = $this->input->post("c");
        $update = $this->input->post("u");
        $read = $this->input->post("r");
        $aai = (int)$this->input->post("aai");



        $id = (int)$this->input->post('id');


        $data = array(
            "group_id"        => $id,
            "controller_name" => $page,
            "can_delete"      => $del == TRUE ? 1 : 0,
            "can_create"      => $create == TRUE ? 1 : 0,
            "can_update"      => $update == TRUE ? 1 : 0,
            "can_read"        => $read == TRUE ? 1 : 0,
        );

        if ($id <= 0) {
            echo json_encode(array('result' => FALSE, "messages" => "Hatalı istek"));

        }
        if($aai > 0 ){
            // update
            $result = $this->user_cat_model->set_privileges_update(array("id"=>$aai),$data);
            if($result > 0){
                echo json_encode(array('result' => TRUE, "messages" => "Yetkiler başarıyla güncellendi"));
            }else{
                echo json_encode(array('result' => FALSE, "messages" => "Hata oluştu tekrar deneyiniz"));
            }

        }else {
            // insert
            $result = $this->user_cat_model->set_privileges_add($data);

            if ($result > 0) {
                echo json_encode(array('result' => TRUE, "messages" => "Yetkiler başarıyla kaydedildi"));
            } else {
                echo json_encode(array('result' => FALSE, "messages" => "Hata oluştu tekrar deneyiniz"));
            }
        }

    }

    public function get_privileges_controller()
    {


        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE, "messages" => "Hatalı istek"));
        }
        $page = $this->input->post("page");
        $group_id = (int)$this->input->post("group_id");

        if ($group_id <= 0) {
            echo json_encode(array('result' => FALSE, "messages" => "Hatalı istek"));
        }
        $result = $this->user_cat_model->get_privileges_info(array("controller_name" => $page,"group_id"=>$group_id));

        if ($result) {
            echo json_encode(array('result' => TRUE,"messages"=>$result));
        } else {
            echo json_encode(array('result' => FALSE, "messages" => "Hata oluştu tekrar deneyiniz"));
        }

    }
}