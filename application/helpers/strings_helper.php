<?php
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 24.06.2018
 * Time: 17:21
 */

function Slug($str)
{
    $bul = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
    $degistir = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
    $str = strtolower(str_replace($bul, $degistir, $str));
    $str = preg_replace('/[\']/', '', $str);
    $str = preg_replace("@[^A-Za-z0-9\-_\.\/\+]@i", ' ', $str);
    $str = preg_replace('/[_]+/', '-', $str);
    $str = trim(preg_replace('/\s+/', ' ', $str));
    $str = str_replace(' ', '-', $str);

    return $str;
}

function phoneClean($phoneNumber){
    $phone = str_replace("(","",$phoneNumber);
    $phone = str_replace(")","",$phone);
    $phone = str_replace(" ","",$phone);
    $phone = str_replace("-","",$phone);
    $phone = str_replace("_","",$phone);
    return $phone;
}

function setFlashMessage($color = "info", $message, $flashName = "message",$colonWidth=8)
{

    $output = '<div class="col-md-'.$colonWidth.'">
    <div class="alert alert-' . $color . ' alert-with-icon" data-notify="container">
        <i class="material-icons" data-notify="icon">notifications</i>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span data-notify="message">' . $message . '</span>
    </div>
</div>';

    $CI = &get_instance();
    $CI->session->set_flashdata($flashName, $output);

}


function getMessage($msg)
{
    $messages = array(
        "insert"      => "Kayıt başarılı bir şekilde eklendi",
        "insertError" => "Kayıt eklemede hata oluştu.!!!",
        "update"      => "Kayıt başarılı bir şekilde güncellendi",
        "updateError" => "Kayıt güncellemede hata oluştu !!!",
        "delete"      => "Kayıt başarılı bir şekilde silindi",
        "deleteError" => "Kayıt silmede hata oluştu !!!",

        "productSaveerror" => "Ürün ekleme işlemi başarılıdır",
        "fileError"        => "Ürün Yüklendi fakat dosya yüklenme hatası!!!",
        "formerror"        => "Daha once bu email adresi kullanılmış olabılır yada şifreler eşleşmemiş olabilir!!!",
    );

    if(array_key_exists($msg,$messages)) {
        return $messages[$msg];
    }else{
        return $msg;
    }


}

function getMessageType($key)
{

    // type = ['','info', 'success', 'warning', 'danger', 'rose', 'primary'];
    $type = array(

        "error"   => 4,
        "success" => 2,
        "warning" => 3,
        "info"    => 1,

    );
    return $type[$key];
}

function setUserdataMessage($type = 'info', $message)
{
    $arr = array(
        "alert"        => true,
        "alertMessage" => getMessage($message),
        "type"         => getMessageType($type),
    );
    $CI = @get_instance();
    $CI->session->set_userdata($arr);
}

function dateTr($date,$time=false){

    if($date=="0000-00-00 00:00:00")
        return "-";
    if($date==NULL)
        return "-";
    if($time==false)
    return date("d.m.Y",strtotime($date));
    else
        return date("d.m.Y H:i:s",strtotime($date));
}

function timeDate($date,$time=false){

    if($date=="0000-00-00 00:00:00")
        return "-";
    if($date==NULL)
        return "-";
    if($time==false)
        return date("d.m.Y",$date);
    else
        return date("d.m.Y H:i:s",$date);
}
