<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 24.07.2018
 * Time: 23:43
 */
class Product_model extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->tableName="product";
    }

    public function getRows()
    {
        return $this->db
            ->select("p.*,cat.title as category_title,sup.title as supplier_title")
            ->from("product as p")
            ->join("category as cat","cat.id=p.category_id","left")
            ->join("supplier as sup","sup.id=p.supplier_id","left")
            ->get()
            ->result();
    }

    public function product_add($data){

        $insert = $this->db->insert($this->tableName,$data);

        if ($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }


    }

    public function getproductId($where=array()){

        return $this->db->where($where)->get($this->tableName)->row();

    }

    public function getOldImage($where=array()){

        return $this->db
                ->select("img_id")
                ->from($this->tableName)
                ->where($where)
                ->limit(1)
                ->get()
                ->row();

    }

    public function product_update($where = array(),$data=array())
    {

        return $this->db->where($where)->update($this->tableName,$data);

        return $this->db->affected_rows();
    }

    public function product_delete($where=array())
    {
        $this->db->where($where)->delete($this->tableName);
        return $this->db->affected_rows();
    }

    public function getCategories()
    {
        return $this->db->where(array("isActive"=>1))->get("category")->result();
    }

    public function getSuppliers(){
        return $this->db->where("isActive", 1)->get("supplier")->result();
    }


}
