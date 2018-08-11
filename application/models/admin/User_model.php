<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "users";
    }

    public function get_Rows($where=array()){

        return $this->db
            ->select("u.*, g.name")
            ->from($this->tableName. " as u ")
            ->join("users_groups as ug","ug.user_id=u.id","left")
            ->join("groups as g","g.id=ug.group_id","left")
            ->where($where)
            ->get()
            ->result();


    }

    public function get_User_Id($where=array()){

        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_User_Groups()
    {
        return $this->db->get("groups")->result();
    }

    public function set_User_Add($data){

        $this->db->insert($this->tableName,$data);

        return $this->db->insert_id();
    }

    public function set_User_Update($where=array(),$data=array())
    {
        $this->db->where($where)->update($this->tableName,$data);

        return $this->db->affected_rows();

    }

    public function user_delete($where){
        $this->db->where($where)->delete($this->tableName);
        return $this->db->affected_rows();
    }







}