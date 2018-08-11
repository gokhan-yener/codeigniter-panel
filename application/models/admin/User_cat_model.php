<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_cat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "groups";
    }

    public function get_Rows($where=array()){

        return $this->db
            ->select("*")
            ->from($this->tableName)
            ->where($where)
            ->get()
            ->result();


    }

    public function set_user_cat_Add($data=array()){

        $this->db->insert($this->tableName,$data);

        return $this->db->insert_id();
    }

    public function get_user_cat_Id($where=array()){

    return $this->db
        ->select("ug.*,uaa.group_id,uaa.controller_name,uaa.can_read,uaa.can_create,uaa.can_update,uaa.can_delete")
        ->from($this->tableName. " as ug")
        ->join("users_groups_privilage as uaa","uaa.group_id=ug.id","left")
        ->where($where)
        ->get()
        ->row();
    }

    public function get_user_group_Id($where=array()){

        return $this->db->where($where)->get($this->tableName)->row();
    }
    public function set_user_cat_Update($where=array(),$data=array())
    {
        $this->db->where($where)->update($this->tableName,$data);

        return $this->db->affected_rows();

    }

    public function user_cat_delete($where=array()){
        $this->db->where($where)->delete($this->tableName);
        return $this->db->affected_rows();
    }

    public function get_Privileges($where=array()){
         return $this->db
            ->select("*")
            ->from("users_groups_privilage")
            ->where($where)
            ->get()
            ->result();

    }

    public function set_privileges_add($data=array())
    {
        $this->db->insert("users_groups_privilage",$data);
        return $this->db->insert_id();
    }

    public function get_privileges_info($where=array()){

        return $this->db->where($where)->get("users_groups_privilage")->row();
    }

    public function set_privileges_update($where=array(),$data=array())
    {
        $this->db->where($where)->update("users_groups_privilage",$data);

        return $this->db->affected_rows();

    }





}