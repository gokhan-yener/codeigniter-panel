<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 24.07.2018
 * Time: 17:05
 */
class Content extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "admin/".strtolower(__CLASS__);
        $this->load->model("admin/".__CLASS__."_model");
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect("auth/login");
        }
    }

    public function index()
    {

        $data = new  stdClass();
        $data->content = "{$this->viewFolder}/content_list";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "İçerikler";
        $data->category2 = "İçerik Listele";
        $data->getAll = $this->Content_model->getRows();
        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }

    public function content_add()
    {

        $data = new stdClass();
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->content = "{$this->viewFolder}/content_add";
        $data->category1 = "İçerik";
        $data->category2 = "İçerik Ekle";
        $data->categories = $this->Content_model->getCategories();

        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }

    public function content_save()
    {


        $this->load->library("form_validation");

        $this->form_validation->set_rules("title", "Başlık", "trim|required|max_length[200]|min_length[3]|is_unique[content.title]");
        $this->form_validation->set_rules("detail", "İçerik", "trim|required|min_length[3]");
        $this->form_validation->set_rules("category_id", "Kategori", "trim|required");


        if ($this->form_validation->run() == false) {


            $data = new stdClass();
            $data->breadcrumb = "admin/inc/breadcrumb";
            $data->content = "{$this->viewFolder}/content_add";
            $data->category1 = "İçerik";
            $data->category2 = "İçerik Ekle";
            $data->categories = $this->Content_model->getCategories();

            setFlashMessage("danger", validation_errors());
            $this->load->vars($data);
            $this->load->view("{$this->viewFolder}/home");

        } else {

            $isactive = $this->input->post("isActive") == "on" ? 1 : 0;
            $data = array(
                "title"       => $this->input->post("title"),
                "slug"        => slug($this->input->post("title")),
                "detail"      => $this->input->post("detail"),
                "category_id" => $this->input->post("category_id"),
                "isActive"    => $isactive,
                "save_user"   => 1,
                "save_date"   => date("Y-m-d H:i:s"),
            );
            $insert = $this->Content_model->content_add($data);

            if ($insert) {
                setUserdataMessage("success", "insert");
                redirect("{$this->viewFolder}");
            } else {

                setUserdataMessage("error", "insertError");
                redirect("{$this->viewFolder}");
            }
        }

    }

    public function content_edit($id = 0)
    {
        $id = (int)$id;
        if ($id === 0) {
            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->viewFolder}");
        }

        $data = new stdClass();
        $data->content = "{$this->viewFolder}/content_update";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "İçerikler";
        $data->category2 = "İçerik Güncelle";
        $data->row = $this->Content_model->getContentId(array("id" => $id));
        if (!isset($data->row)) {
            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->viewFolder}");
        }
        $data->categories = $this->Content_model->getCategories();

        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }

    public function content_update()
    {

        $content_id = (int)$this->input->post("content_id");

        if ($content_id === 0) {

            setUserdataMessage("warning", "Hatalı Sayfa işlemi !!!");
            redirect("{$this->viewFolder}");
        }

        $this->load->library("form_validation");

        $title = $this->input->post("titleOrjinal");
        $titleorjinal = $this->input->post("title");

        if ($title == $titleorjinal) {
            $this->form_validation->set_rules("title", "Başlık", "trim|required|max_length[200]|min_length[3]");
        } else {
            $this->form_validation->set_rules("title", "Başlık", "trim|required|max_length[200]|min_length[3]|is_unique[content.title]");
        }
        $this->form_validation->set_rules("title", "Başlık", "trim|required|max_length[200]|min_length[3]");
        $this->form_validation->set_rules("detail", "İçerik", "trim|required|min_length[3]");
        $this->form_validation->set_rules("category_id", "Kategori", "trim|required");


        if ($this->form_validation->run() == false) {

            setFlashMessage("danger", validation_errors());
            redirect("{$this->viewFolder}/content_edit/" . $content_id);

        } else {

            $isActive = $this->input->post("isActive") == "on" ? 1 : 0;
            $data = array(
                "title"       => $this->input->post("title"),
                "slug"        => slug($this->input->post("title")),
                "detail"      => $this->input->post("detail"),
                "category_id" => $this->input->post("category_id"),
                "isActive"    => $isActive,
                "edit_user"   => 1,
                "edit_date"   => date("Y-m-d H:i:s"),
            );
            $result = $this->Content_model->content_update(array("id" => $content_id), $data);

            if ($result > 0) {

                setUserdataMessage("success", "update");
                redirect("{$this->viewFolder}");
            } else {

                setUserdataMessage("error", "updateError");
                redirect("{$this->viewFolder}/content_edit/" . $content_id);
            }


        }
    }

    public function content_delete($id = 0)
    {
        $recordId = (int)$id;
        if ($recordId === 0) {

            setUserdataMessage("error", "delete");
            redirect("{$this->viewFolder}");
        }

        $result = $this->Content_model->content_delete(array("id" => $recordId));
        if ($result > 0) {

            setUserdataMessage("success", "delete");

        } else {

            setUserdataMessage("error", "deleteError");

        }
        redirect("{$this->viewFolder}");
    }

    public function excel()
    {
        //load our new PHPExcel library
        $this->load->library('Excel_library');
        $this->excel = new PHPExcel();
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Content(haber) list');
        $this->excel->getActiveSheet()->setCellValue("A1", "adı");
        $this->excel->getActiveSheet()->setCellValue("B1", "Detay");
        $this->excel->getActiveSheet()->setCellValue("C1", "Slug");
        $this->excel->getActiveSheet()->setCellValue("D1", "categori id");
        $this->excel->getActiveSheet()->setCellValue("E1", "Save date");
        $this->excel->getActiveSheet()->setCellValue("F1", "Save USER");
        $this->excel->getActiveSheet()->setCellValue("G1", "edit user");
        $this->excel->getActiveSheet()->setCellValue("H1", "Edit Date");
        $this->excel->getActiveSheet()->setCellValue("J1", "isActive");

        $contents = $this->Content_model->getContent();

        $i = 2;
        foreach ($contents as $key => $value) {
            $this->excel->getActiveSheet()->setCellValue("A" . $i, $value["title"]);
            $this->excel->getActiveSheet()->setCellValue("B" . $i, $value["detail"]);
            $this->excel->getActiveSheet()->setCellValue("C" . $i, $value["slug"]);
            $this->excel->getActiveSheet()->setCellValue("D" . $i, $value["category_id"]);
            $this->excel->getActiveSheet()->setCellValue("F" . $i, $value["save_date"]);
            $this->excel->getActiveSheet()->setCellValue("E" . $i, $value["save_user"]);
            $this->excel->getActiveSheet()->setCellValue("G" . $i, $value["edit_user"]);
            $this->excel->getActiveSheet()->setCellValue("H" . $i, $value["edit_date"]);
            $this->excel->getActiveSheet()->setCellValue("J" . $i, $value["isActive"]);

            $i++;
        }

        $filename = 'content_list.xlsx'; //save our workbook as this file name

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');

        //$objWriter->save($filename);
        $objWriter->save('php://output'); // servera kaydedilmiyor
        // $objWriter->save($filename); // servera kaydediliyor

    }

    public function excelUpload()
    {

        $tmpname = $_FILES["excel"]["tmp_name"];
        $this->load->library('Excel_library');
        $this->excel = new PHPExcel();
        $objPhpExcel = PHPExcel_IOFactory::load($tmpname);
        foreach ($objPhpExcel->getWorksheetIterator() as $worksheet) {
            $worksheetTitle = $worksheet->getTitle();
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

            for ($row = 2; $row <= $highestRow; $row++) {

                $cell = $worksheet->getCellByColumnAndRow(0, $row);
                $title = $cell->getValue();

                $cell = $worksheet->getCellByColumnAndRow(1, $row);
                $detail = $cell->getValue();

                $cell = $worksheet->getCellByColumnAndRow(2, $row);
                $slug = $cell->getValue();


                $cell = $worksheet->getCellByColumnAndRow(3, $row);
                $category = $cell->getValue();

                $category_id = $this->Content_model->getCategoryExcel(array("title" => $title));

                $data = array(
                    "title"       => $title,
                    "detail"      => $detail,
                    "slug"        => $slug,
                    "category_id" => $category_id,
                );

                $this->Content_model->content_excell_add($data);
            }
        }
        setUserdataMessage("success", "Excel başarıyla yüklendi");
        redirect("{$this->viewFolder}");
    }



    /*Ajax Process*/
    public function isActiveSetter()
    {

        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE));
        }
        $id = (int)$this->input->post("id");

        if ($id == 0) {
            echo json_encode(array('result' => TRUE));
        }

        $state = (object)$this->Content_model->getContentId(array("id" => $id));

        $t = $state->isActive == "1" ? 0 : 1;

        $this->db->where(array("id" => $id))->update("content", array("isActive" => $t));
        $result = $this->db->affected_rows();

        if ($result > 0) {
            echo json_encode(array('result' => TRUE));
        } else {
            echo json_encode(array('result' => FALSE));
        }

    }

    public function rankSetter()
    {
        if ($this->input->is_ajax_request() == FALSE) {

            echo json_encode(array('result' => FALSE));
        }
        parse_str($this->input->post("data"),$order);

        $items = $order["ord"];

        foreach ($items as $rank => $id) {
            $where = array("id"=>$id,"rank != " => $rank);
            $this->db->where($where)->update("content", array("rank" => $rank));
        }
            echo json_encode(array('result' => TRUE));

    }

    public function drop()
    {
        $data = new stdClass();
        $data->content = "{$this->viewFolder}/drop";
        $data->breadcrumb = "admin/inc/breadcrumb";
        $data->category1 = "İçerikler";
        $data->category2 = "İçerik Güncelle";

        $this->load->vars($data);
        $this->load->view("{$this->viewFolder}/home");
    }


}