<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "admin/".strtolower(__CLASS__);
        $this->load->model("admin/".__CLASS__."_model");
        $this->load->model("admin/User_model");
        $this->load->helper(array('url', 'language'));
        $this->load->model("Ion_auth_model");
        $this->data['title'] = $this->lang->line('create_user_heading');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect("auth");
        }
    }

    public function index()
    {
        $data = new  stdClass();
        $data->content = 'admin/user/user_list';
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Kullanıcılar";
        $data->category2 = "Kullanıcı Listele";
        $data->getRows = $this->User_model->get_Rows();


        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }

    public function user_add()
    {
        $data = new  stdClass();
        $data->content = 'admin/user/user_add';
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Kullanıcılar";
        $data->category2 = "Kullanıcı Ekle";

        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }

    public function user_save()
    {


        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->load->library("form_validation");
        // validate form input
        $this->form_validation->set_rules('first_name',"Ad", 'trim|required');
        $this->form_validation->set_rules('last_name', "Soyad", 'trim|required');
        if ($identity_column !== 'email')
        {
            $this->form_validation->set_rules('identity', "Kullanıcı adı", 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', "Eposta", 'trim|required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', "Eposta", 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', "Telefon", 'trim');
        $this->form_validation->set_rules('password', "Şifre", 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', "Şifre Tekrar", 'required');

        if ($this->form_validation->run() === TRUE)
        {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            setUserdataMessage("success",$this->ion_auth->messages());
            redirect("{$this->viewFolder}");
        }
        else
        {


            setFlashMessage("danger",validation_errors());
            redirect("{$this->viewFolder}/user_add");

        }
    }

   /*

   qrkodlu user save

   public function user_save()
    {


        $this->load->library("form_validation");

        $this->form_validation->set_rules("name", "Ad", "trim|required|max_length[30]|min_length[3]");
        $this->form_validation->set_rules("surname", "Soyadı", "trim|max_length[30]|min_length[3]");
        $this->form_validation->set_rules("username", "Kullanıcı adı", "trim|required|is_unique[users.username]");
        $this->form_validation->set_rules("user_group_id", "Kullanıcı grubu", "trim|required|is_natural_no_zero");
        $this->form_validation->set_rules("password", "Şifre", "trim|required|max_length[20]|min_length[4]");
        $this->form_validation->set_rules("password1", "Şifre tekrar", "trim|required|max_length[20]|min_length[4]|matches[password]");
        $this->form_validation->set_rules("email", "Eposta", "trim|max_length[30]|min_length[4]|valid_email");

        if ($this->form_validation->run() == false){

            setFlashMessage("danger",validation_errors());
            redirect("{$this->viewFolder}/user_add");
        }else{

            $email = setPassword(trim($this->input->post("email")));

            $this->load->library('ciqrcode');
            $params['data'] = $email;
            $params['level'] = 'H';
            $params['size'] = 20;
            $params['savename'] = FCPATH."uploads/qrcode/".$email.".png";// servera kaydetmesende olur
            $this->ciqrcode->generate($params);


            $isactive = $this->input->post("isActive")== "on"? 1 :0;
            $this->load->helper("security_helper");
            $this->load->helper("strings_helper");
            $data =array(
                "name"=>trim($this->input->post("name")),
                "surname"=>trim($this->input->post("surname")),
                "username"=>trim($this->input->post("username")),
                "password"=>setPassword(trim($this->input->post("password"))),
                "user_group_id"=>trim($this->input->post("user_group_id")),
                "email"=>trim($this->input->post("email")),
                "mobile_phone"=>phoneClean(trim($this->input->post("mobile_phone"))),
                "isActive"=>$isactive,
                "save_user"=>1,
                "save_date"=>date("Y-m-d H:i:s"),
            );

            $result= $this->User_model->set_User_Add($data);

            if($result > 0){
                setUserdataMessage("success","insert");
                redirect("{$this->viewFolder}");
            }else{
                setFlashMessage("danger","Kaydedilmede hata oluştu !!!");
                redirect("{$this->viewFolder}/user_add");
            }
        }
    }*/

    public function user_edit($id)
    {


        $id = (int)$id;
        if ($id === 0) {

            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("admin/content");
        }

        $data = new stdClass();
        $data->content = "admin/user/user_update";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Kullanıcılar";
        $data->category2 = "Kullanıcı Detay";
        $data->row = $this->User_model->get_User_Id(array("id" => $id));
        $data->groups = $this->User_model->get_User_Groups();
        $data->currentGroups = $this->ion_auth->get_users_groups($id)->result();
        $data->csrf = $this->_get_csrf_nonce();


        if (!isset($data->row)) {
            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("admin/content");
        }

        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }

    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }


    public function _valid_csrf_nonce(){
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
            return TRUE;
        }
        return FALSE;
    }

    public function user_update($id=0)
    {
        $id = (int)$this->input->post("id");
        if ($id === 0) {

            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->viewFolder}");
        }

        $this->data['title'] = $this->lang->line('edit_user_heading');


        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', "Ad", 'trim|required');
        $this->form_validation->set_rules('last_name',"Soyad" , 'trim|required');
        $this->form_validation->set_rules('phone', "Telefon", 'trim|required');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', "Şifre", 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', "Şifrev Tekrar", 'required');
            }

            if ($this->form_validation->run() === TRUE)
            {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin())
                {
                    // Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData))
                    {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp)
                        {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data))
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin

                    setUserdataMessage("success", $this->ion_auth->messages());
                    redirect("{$this->viewFolder}/user_edit/$id");

                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin

                    setFlashMessage("warning", $this->ion_auth->errors());
                    redirect("{$this->viewFolder}/user_edit/$id");

                }

            }else{
                setFlashMessage("danger", validation_errors());
                redirect("{$this->viewFolder}/user_edit/$id");
            }
        }


    }





    /*  public function user_update()
      {

          $user_id = (int)$this->input->post("user_id");
          if ($user_id === 0) {

              setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
              redirect("admin/content");
          }

          $this->load->library("form_validation");

          $pass= trim($this->input->post("pass"));
          $pass1= trim($this->input->post("pass1"));

          $username= trim($this->input->post("username"));
          $usernameOrj= trim($this->input->post("usernameOrj"));

          if($username === $usernameOrj){
              $this->form_validation->set_rules("username", "Kullanıcı adı", "trim|required");
          }else{
              $this->form_validation->set_rules("username", "Kullanıcı adı", "trim|required|is_unique[users.username]");
          }
          if(strlen($pass) > 0 || strlen($pass1) >0){
              $this->form_validation->set_rules("pass", "Şifre", "trim|required|max_length[20]|min_length[4]");
              $this->form_validation->set_rules("pass1", "Şifre tekrar", "trim|required|max_length[20]|min_length[4]|matches[pass]");
          }
          $this->form_validation->set_rules("name", "Ad", "trim|required|max_length[30]|min_length[3]");
          $this->form_validation->set_rules("surname", "Soyadı", "trim|max_length[30]|min_length[3]");
          $this->form_validation->set_rules("user_group_id", "Kullanıcı grubu", "trim|required|is_natural_no_zero");
          $this->form_validation->set_rules("email", "Eposta", "trim|max_length[30]|min_length[4]|valid_email");

          if ($this->form_validation->run() == false){

              setFlashMessage("danger",validation_errors());
              redirect("{$this->viewFolder}/user_edit/".$user_id);

          }else{



              $email = setPassword(trim($this->input->post("email")));
              if(!file_exists(FCPATH."uploads/qrcode/".$email.".png")){
              $this->load->library('ciqrcode');
              $params['data'] = $email;
              $params['level'] = 'H';
              $params['size'] = 20;
              $params['savename'] = FCPATH."uploads/qrcode/".$email.".png";// servera kaydetmesende olur
              $this->ciqrcode->generate($params);
              }

              $isactive = $this->input->post("isActive")== "on"? 1 :0;
              $this->load->helper("security_helper");
              $this->load->helper("strings_helper");

              $data =array(
                  "name"=>trim($this->input->post("name")),
                  "surname"=>trim($this->input->post("surname")),
                  "username"=>trim($this->input->post("username")),
                  "user_group_id"=>trim($this->input->post("user_group_id")),
                  "email"=>trim($this->input->post("email")),
                  "mobile_phone"=>phoneClean(trim($this->input->post("mobile_phone"))),
                  "isActive"=>$isactive,
                  "save_user"=>1,
                  "save_date"=>date("Y-m-d H:i:s"),
              );
              if(strlen($pass) > 0){
                  $pass = setPassword($this->input->post("pass"));
                  $data["password"]=$pass;
              }

              $result = $this->User_model->set_User_Update(array("id"=>$user_id),$data);

              if($result > 0){
                  setUserdataMessage("success","update");
                  redirect("{$this->viewFolder}/user_edit/".$user_id);
              }else{
                  setFlashMessage("danger","Kaydedilmede hata oluştu !!!");
                  redirect("{$this->viewFolder}/user_edit/".$user_id);
              }
          }
      }*/

    public function user_delete($id = 0)
    {
        $recordId = (int)$id;
        if ($recordId === 0) {

            setUserdataMessage("error", "delete");
            redirect("{$this->viewFolder}");
        }

        $result = $this->User_model->user_delete(array("id" => $recordId));
        if ($result > 0) {

            setUserdataMessage("success", "delete");

        } else {

            setUserdataMessage("error", "deleteError");

        }
        redirect("{$this->viewFolder}");
    }



    //AJAX">



    public function isActiveSetter()
    {


        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE));
        }
        $id = (int)$this->input->post("id");

        if ($id == 0) {
            echo json_encode(array('result' => TRUE));
        }
        $state = (object)$this->User_model->get_User_Id(array("id" => $id));

        $t = $state->active == 1 ? 0 : 1;

        $this->db->where(array("id" => $id))->update("users", array("active" => $t));
        $result = $this->db->affected_rows();
        if ($result > 0) {
            echo json_encode(array('result' => TRUE));
        } else {
            echo json_encode(array('result' => FALSE));
        }

    }
}