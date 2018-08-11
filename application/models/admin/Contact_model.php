<?php
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 27.07.2018
 * Time: 20:17
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    private $tableName="contact";

    public function getList($where=array())
    {
        return $this->db->where($where)->get($this->tableName)->result();
    }

    public function inboxCount()
    {
        return $this->db->select("count(*) as inbox")->from($this->tableName)->get()->row();
    }

    public function getMessage($where){
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function contact_update($where=array(),$data=array())
    {
         $this->db->where($where)->update($this->tableName,$data);
        return $this->db->affected_rows();

    }

    public function trashCount(){
        return $this->db
            ->select("Count(*) as trash")
            ->from($this->tableName)
            ->where(array("isActive"=>0))
            ->get()
            ->row();
    }

    public function unRead(){
        return $this->db
            ->select("Count(*) as unread")
            ->from($this->tableName)
            ->where(array("is_read"=>0))
            ->get()
            ->row();
    }

    public function sentEmail(){
        return $this->db
            ->select("Count(*) as mail")
            ->from($this->tableName)
            ->where(array("is_sent_email"=>1))
            ->get()
            ->row();
    }
}