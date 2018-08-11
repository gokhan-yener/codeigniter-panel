<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 28.07.2018
 * Time: 22:10
 */
class Auth_library
{
    private $CI = NULL;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model("admin/Auth_model");
    }

    public function CheckAdminUser($username, $password)
    {


        $result = $this->CI->Auth_model->getAdminUserInfo(array("u.username" => $username, "u.password" => $password));

        $flag = NULL;
        if ($result) {


            // Kullanıcı bilgileri veritabanında kayıtlı
            if ((int)$result->isActive === 1) {
                // kullanıcı hesabı aktif durumda
                $last_login_date = $result->last_login_date;
                $last_login_ip = $result->last_login_ip;
                $sessionData = sha1($this->CI->input->ip_address()) . ":" . md5($result->id);

                $userData = array(
                    "userId"      => $result->id,
                    "fullname"    => $result->name . " " . $result->surname,
                    "groupId"     => $result->user_group_id,
                    "groupName"   => $result->usergroupname,
                    "lastDate"    => dateTr($last_login_date),
                    "lastIp"      => $last_login_ip,
                    "sessionData" => $sessionData,
                );
                $userInfo = json_encode($userData);

                //Kullanıcının giriş ip ve tarihi güncelleniyor
                $this->userInfoUpdate($result->id);

                $this->CI->session->set_userdata("isLogin", $sessionData);
                $this->CI->session->set_userdata("userInfo", $userInfo);

                unset($result);

                return "success";
            } elseif ((int)$result->isActive === 0) {
                //Kullanıcı var hesabı pasif durumda
                return "disable";
            }

        } else {
            return "wrong";
        }
    }

    public function userInfoUpdate($userId)
    {
        $where = array(
            "id" => $userId
        );
        $data = array(
            "last_login_date" => date("Y-m-d H:i:s"),
            "last_login_ip"   => $this->CI->input->ip_address(),

        );
        $this->CI->Auth_model->updateUserInfo($where, $data);
    }

    public function checkSessionControl()
    {
        if ($this->CI->session->has_userdata("isLogin") === TRUE) {

            if ($this->CI->session->has_userdata("userInfo") === FALSE) {
                return FALSE;
            } else {
                $userInfo = json_decode($this->CI->session->userdata("userInfo"));
                $sessionData = sha1($this->CI->input->ip_address()) . ":" . md5($userInfo->userId);
                $userInfoSessionData = $userInfo->sessionData;

                if ($sessionData === $userInfoSessionData) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        } else {
            return FALSE;
        }
    }

    public function checkUserCount()
    {
        return $this->CI->Auth_model->getUsersCount();

    }

    public function createUserManuel()
    {
        $this->CI->load->helper("security_helper");
        $data = array(
            "name"      => "system",
            "username"  => "admin",
            "password"  => setPassword("demo"),
            "save_user" => 1,
            "save_date" => date("Y-m-d H:i:s"),
        );

        return $this->CI->Auth_model->addRecord($data);
    }

    public function logout($redirect = NULL)
    {
        $this->CI->session->sess_destroy();
        redirect($redirect == NULL ? "auth" : $redirect);
    }

    public function get_controllers_name()
    {
        $this->CI->load->helper("file");

        $files = get_dir_file_info(APPPATH . "controllers/admin");

        $controllers = array();
        foreach ($files as $file) {
            $controller = str_replace(".php", "", $file["name"]);

            if ($controller != "Home") {

                $controllers[] = $controller;

            }

        }
        return $controllers;

    }

    public function checkAuth($user_group_id, $controller_name)
    {
        $where = array(
            "group_id"        => $user_group_id,
            "controller_name" => ucfirst($controller_name),
        );
        return $this->CI->auth_model->getAuthCheck($where);
    }

}