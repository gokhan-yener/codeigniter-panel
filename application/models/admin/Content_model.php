<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 24.07.2018
 * Time: 23:43
 */
class Content_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->tableName = "content";
    }

    public function getRows()
    {
        return $this->db
            ->select("c.*,cat.title as c_title")
            ->from("content as c")
            ->join("category as cat", "cat.id=c.category_id", "left")
            ->get()
            ->result();
    }

    public function content_add($data)
    {

        $insert = $this->db->insert($this->tableName, $data);

        if ($insert) {
            return true;
        } else {
            return false;
        }


    }

    public function getContentId($where)
    {

        return $this->db->where($where)->get($this->tableName)->row();

    }

    public function content_update($where = array(), $data = array())
    {

        $this->db->where($where)->update($this->tableName, $data);

        //echo $this->db->last_query();
        //exit;
        return $this->db->affected_rows();
    }

    public function content_delete($where = array())
    {
        $this->db->where($where)->delete($this->tableName);
        return $this->db->affected_rows();
    }

    public function getCategories()
    {
        return $this->db->where(array("isActive" => 1))->get("category")->result();
    }

    public function getCategoryId($where)
    {
        return $this->db->where($where)->get("category")->row();
    }

    public function getContent()
    {
        return $this->db->get($this->tableName)->result_array();
    }

    public function getCategoryExcel($where)
    {
        $result = $this->db->where($where)->get("category")->row();
        if (isset($result)) {
            return $result->id;
        } else {
            $this->db->insert("category", $where);
            return $this->db->insert_id();
        }
    }

    public function content_excell_add($data)
    {

        $result = $this->getContentId(["title" => $data["title"]]);

        if (!isset($result)) {
            $insert = $this->db->insert($this->tableName, $data);

            if ($insert) {
                return true;
            } else {
                return false;
            }

        }


    }

}
