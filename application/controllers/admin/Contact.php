<?php
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 27.07.2018
 * Time: 20:14
 */
class Contact extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/contact_model");

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
           redirect("auth");
        }

    }

    public function index($param =NULL)
    {

        $where=array();
        if($param){

            if($param =="unread"){
                $where=array("is_read"=>0);
            }elseif ($param=="trash"){
                $where=array("isActive"=>0);
            }elseif ($param=="sendEmail") {
                $where = array("is_sent_email" => 1);
            }
        }
        $data = new  stdClass();
        $data->content = 'admin/contact/contact_list';
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Mesajlar";
        $data->category2 = "Mesaj Listeleme";
        $data->rows = $this->contact_model->getList($where);
        $data->recordCount = count($this->contact_model->getList($where));
        $data->inbox = $this->contact_model->inboxCount();
        $data->trash = $this->contact_model->trashCount();
        $data->unRead = $this->contact_model->unRead();
        $data->sentCount = $this->contact_model->sentEmail();


        $this->load->vars($data);
        $this->load->view('admin/contact/home');
    }

    public function unread()
    {
        $this->index("unread");
    }

    public function trash()
    {
        $this->index("trash");
    }

    public function sendEmail()
    {
        $this->index("sendEmail");
    }

    public function contact_edit($recordId=0)
    {
        $id = (int)$recordId;
        if($id==0){
            setUserdataMessage("error","Hatalı sayfa !!!");
            redirect("admin/contact");
        }

        $data = new  stdClass();
        $data->content = "admin/contact/contact_update";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Mesajlar";
        $data->category2 = "Mesaj Güncelle";
        $data->row = $this->contact_model->getMessage(array("id"=>$id));

        $this->load->vars($data);
        $this->load->view('admin/contact/home');

        $this->contact_model->contact_update(array("id"=>$id),array("is_read"=>1));


    }

    public function contact_update()
    {
        $id = (int)$this->input->post("contact_id");
        if($id==0){
            setUserdataMessage("error","Hatalı sayfa !!!");
            redirect("admin/contact");
        }
        $isActive = $this->input->post("isActive") == "on" ? 1 : 0;
        $data = array(
            "notes"=>$this->input->post("notes"),
            "isActive"=>$isActive,
        );
        $result = $this->contact_model->contact_update(array("id"=>$id),$data);

        if($result > 0){
            setUserdataMessage("success","update");
            redirect("admin/contact");
        }else{
            setFlashMessage("danger","Güncelleme hatası oluştu");
            redirect("admin/contact/".$id);
        }
    }

    public function email()
    {

       $id = (int)$this->input->post("messageid");
       if($id==0){
           setUserdataMessage("error","Hatalı sayfa !!!");
           redirect("admin/contact");
       }

        $emailConfig =array(
            "protocol"=>"smtp",
            "smtp_host"=>"localhost",
            "smtp_user"=>"demo@gmail.com",
            "smtp_pass"=>"87782nu",
            "smtp_port"=>465,
            "mailtype"=>"html",

        );
        $this->load->library('email');
        $this->email->initialize($emailConfig);

        $this->email->from('your@example.com', 'Your Name');
        $this->email->to('someone@example.com');
        $this->email->cc('another@another-example.com');
        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if($this->email->send() == TRUE){
            $this->contact_model->contact_update(["id"=>$id],["feedback"=>$this->input->post("feedback"),"is_sent_email"=>1]);
            setUserdataMessage("success","Epostanız başarıyla gönderildi");
            redirect("admin/contact");
        }else{
            setUserdataMessage("error","Mesaj gönderme hatası");
            redirect("admin/contact");
        }
    }
}