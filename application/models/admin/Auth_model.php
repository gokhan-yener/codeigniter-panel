<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 28.07.2018
 * Time: 22:28
 */

class Auth_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

        private $tableName="users";

    public function getAdminUserInfo($where)
    {
        return $this->db
            ->select("u.*,ug.title as usergroupname")
            ->from($this->tableName." as u")
            ->join("users_group as ug","ug.id=u.user_group_id","left")
            ->where($where)
            ->get()
            ->row();
    }

    public function updateUserInfo($where=array(),$data=array())
    {
        $this->db->where($where)->update($this->tableName,$data);
        return $this->db->affected_rows();
    }
}