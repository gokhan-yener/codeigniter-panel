<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 24.07.2018
 * Time: 17:05
 */
class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/product_model");
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect("auth");
        }
    }

    public function index()
    {

        $data = new  stdClass();
        $data->content = 'admin/product/product_list';
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Ürünler";
        $data->category2 = "Ürün Listele";
        $data->getAll = $this->product_model->getRows();


        $this->load->vars($data);
        $this->load->view('admin/product/home');
    }

    public function product_add()
    {

        $data = new stdClass();
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->content = "admin/product/product_add";
        $data->category1 = "Ürün";
        $data->category2 = "Ürün Ekle";
        $data->categories = $this->product_model->getCategories();
        $data->suppliers = $this->product_model->getSuppliers();


        $this->load->vars($data);
        $this->load->view("admin/product/home");
    }

    public function product_save()
    {

        $this->load->library("form_validation");

        $this->form_validation->set_rules("code", "Kod", "trim|required|is_unique[product.code]");
        $this->form_validation->set_rules("title", "Ürün adı", "trim|required|max_length[200]|min_length[3]");
        $this->form_validation->set_rules("detail", "Detay", "trim|required|min_length[3]");
        $this->form_validation->set_rules("category_id", "Kategori", "trim|required");

        if ($this->form_validation->run() == false) {

            setFlashMessage("danger", validation_errors());
            redirect("admin/product/product_add");

        } else {


            $isActive = $this->input->post("isActive") == "on" ? 1 : 0;
            $data = array(
                "title"       => $this->input->post("title"),
                "slug"        => slug($this->input->post("title")),
                "code"        => $this->input->post("code"),
                "detail"      => $this->input->post("detail"),
                "quantity"    => $this->input->post("quantity"),
                "list_price"  => $this->input->post("list_price"),
                "sale_price"  => $this->input->post("sale_price"),
                "category_id" => $this->input->post("category_id"),
                "supplier_id" => $this->input->post("supplier_id"),
                "isActive"    => $isActive,

            );
            $insert_id = $this->product_model->product_add($data);
            if ($insert_id > 0) {

                if (!empty($_FILES["img_id"]["name"])) {

                    $this->load->helper("io_helper");
                    checkProductsDirectory();
                    $config['upload_path'] = 'uploads/products';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 4096;
                    $config['encrypt_name'] = TRUE;
                    $config['file_ext_tolower'] = TRUE;


                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("img_id")) {

                        $errorMessage = NULL;
                        $errors = array("errors" => $this->upload->display_errors());
                        foreach ($errors as $error) {
                            $errorMessage .= $error . "<br>";
                        }

                        setUserdataMessage("warning", "Resim Yüklenemedi yanlız Ürün eklendi<br>$error");
                        redirect("admin/product");

                    } else {

                        $uploadData = $this->upload->data();
                        $result = $this->product_model->product_update(array("id" => $insert_id), array("img_id" => $uploadData["file_name"]));
                        if ($result > 0) {

                            $this->load->library("image_lib");
                            checkProductsthumbsDirectory();
                            $smallImage = array(
                                "image_library"  => "gd2",
                                "source_image"   => "./uploads/products/" . $uploadData["file_name"],
                                "new_image"      => "./uploads/products/thumb/" . $uploadData["file_name"],
                                "maintain_ratio" => TRUE,
                                "width"          => 80,
                                "height"         => 45,
                            );
                            $this->image_lib->initialize($smallImage);
                            $this->image_lib->resize();

                            setUserdataMessage("success", "insert");
                        } else {

                            setUserdataMessage("error", "Bilgiler kaydedildi yanlız resim yüklemede hata oluştu!!!");
                            unlink(".uploads/products/" . $uploadData["file_name"]);
                        }

                        redirect("admin/product");

                    }
                } else {

                    setUserdataMessage("success", "insert");
                    redirect("admin/product");
                }

            } else {

                setUserdataMessage("error", "insertError");
                redirect("admin/product");
            }


        }

    }

    public function product_edit($id = 0)
    {

        $id = (int)$id;
        if ($id === 0) {
            setUserdataMessage("error", "Hatalı Sayfa işlemi !!!");
            redirect("admin/product");
        }

        $data = new stdClass();
        $data->content = "admin/product/product_update";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "Ürünler";
        $data->category2 = "Ürün Güncelle";
        $data->categories = $this->product_model->getCategories();
        $data->suppliers = $this->product_model->getSuppliers();
        $data->row = $this->product_model->getproductId(array("id" => $id));

        if (!isset($data->row)) {
            setUserdataMessage("error", "Hatalı Sayfa işlemi !!!");
            redirect("admin/product");
        }
        $data->categories = $this->product_model->getCategories();

        $this->load->vars($data);
        $this->load->view("admin/product/home");
    }

    public function product_update()
    {


        $product_id = (int)$this->input->post("product_id");

        if ($product_id === 0) {
            setUserdataMessage("error", "Hatalı Sayfa işlemi !!!");
            redirect("admin/product");
        }

        $this->load->library("form_validation");


        $codeorjinal = $this->input->post("codeOrj");
        $code = $this->input->post("code");

        if ($code == $codeorjinal) {
            $this->form_validation->set_rules("code", "Kod", "trim|required");
        } else {
            $this->form_validation->set_rules("code", "Kod", "trim|required|is_unique[product.code]");
        }

        $this->form_validation->set_rules("title", "Ürün adı", "trim|required|max_length[200]|min_length[3]");
        $this->form_validation->set_rules("detail", "Detay", "trim|required|min_length[3]");
        $this->form_validation->set_rules("category_id", "Kategori", "trim|required");


        if ($this->form_validation->run() == false) {

            setFlashMessage("danger", validation_errors());
            redirect("admin/product/product_edit/" . $product_id);

        } else {


            $isActive = $this->input->post("isActive") == 1 ? 1 : 0;

            $data = array(
                "title"       => $this->input->post("title"),
                "slug"        => slug($this->input->post("title")),
                "code"        => $this->input->post("code"),
                "detail"      => $this->input->post("detail"),
                "quantity"    => $this->input->post("quantity"),
                "list_price"  => $this->input->post("list_price"),
                "sale_price"  => $this->input->post("sale_price"),
                "category_id" => $this->input->post("category_id"),
                "supplier_id" => $this->input->post("supplier_id"),
                "isActive"    => $isActive,
            );;

            $result = $this->product_model->product_update(array("id" => $product_id), $data);

            if ($result > 0) {

                if (!empty($_FILES["img_id"]["name"])) {

                    $this->load->helper("io_helper");
                    checkProductsDirectory();
                    $config['upload_path'] = 'uploads/products';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 4096;
                    $config['encrypt_name'] = TRUE;
                    $config['file_ext_tolower'] = TRUE;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload("img_id")) {

                        $errorMessage = NULL;
                        $errors = array("errors" => $this->upload->display_errors());
                        foreach ($errors as $error) {
                            $errorMessage .= $error . "<br>";
                        }

                        setUserdataMessage("warning", "Resim Yüklenemedi yanlız Ürün güncellendi<br> $error");
                        redirect("admin/product");

                    } else {

                        $oldimageinfo = $this->product_model->getOldImage(array("id" => $product_id));

                        if (strlen($oldimageinfo->img_id) > 0) {
                            if (file_exists("./uploads/products/" . $oldimageinfo->img_id)) {
                                unlink("./uploads/products/" . $oldimageinfo->img_id);
                                //eski resim varsa unlink ile silindi
                                //die("kayıt var");
                            }
                        }
                        $imgdata = $this->upload->data();

                        $updateResult = $this->product_model->product_update(array("id" => $product_id), array("img_id" => $imgdata["file_name"]));

                        if ($updateResult > 0) {

                            $this->load->library("image_lib");
                            checkProductsthumbsDirectory();
                            $smallImage = array(
                                "image_library"  => "gd2",
                                "source_image"   => "./uploads/products/" . $imgdata["file_name"],
                                "new_image"      => "./uploads/products/thumb/" . $imgdata["file_name"],
                                "maintain_ratio" => TRUE,
                                "width"          => 80,
                                "height"         => 45,
                            );
                            $this->image_lib->initialize($smallImage);
                            $this->image_lib->resize();

                            setUserdataMessage("success", "update");
                        } else {

                            setUserdataMessage("warning", "Bilgiler güncellendi fakat resim yüklemede hata oluştu");
                        }

                        redirect("admin/product");

                    }


                } else {
                    setUserdataMessage("success", "update");
                    redirect("admin/product");
                }

            } else {
                setFlashMessage("danger", "updateError");
                redirect("admin/product/product_edit/" . $product_id);
            }
        }
    }

    public function product_delete($id = 0)
    {
        $recordId = (int)$id;
        if ($recordId === 0) {
            setUserdataMessage("error", "Hatalı Sayfa işlemi !!!");
            redirect("admin/product");
        }
        $imageName = $this->product_model->getOldImage(array("id" => $recordId))->img_id;

        $result = $this->product_model->product_delete(array("id" => $recordId));
        if ($result > 0) {
            unlink("./uploads/products/" . $imageName);
            unlink("./uploads/products/thumb/" . $imageName);

            setUserdataMessage("success", "delete");

        } else {
            setUserdataMessage("error", "deleteError");

        }
        redirect("admin/product");

    }


    public function isActiveSetter()
    {

        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE));
        }
        $id = (int)$this->input->post("id");
        if ($id == 0) {
            echo json_encode(array('result' => TRUE));
        }
        $state = (object)$this->product_model->getproductId(array("id" => $id));

        $t = $state->isActive == 1 ? 0 : 1;

        $this->db->where(array("id" => $id))->update("product", array("isActive" => $t));
        $result = $this->db->affected_rows();
        if ($result > 0) {
            echo json_encode(array('result' => TRUE));
        } else {
            echo json_encode(array('result' => FALSE));
        }

    }


}