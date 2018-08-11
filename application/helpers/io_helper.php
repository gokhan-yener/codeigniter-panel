<?php
/**
 * Created by PhpStorm.
 * User: gokhan
 * Date: 27.07.2018
 * Time: 01:18
 */

function checkUploadsDirectory(){
    if(!is_dir("./uploads")){
        mkdir("uploads",0775);
    }
}

function checkProductsDirectory(){
    checkUploadsDirectory();
    if(!is_dir("./uploads/products")){
        mkdir("uploads/products",0775);
    }
}

function checkProductsthumbsDirectory(){
    checkProductsDirectory();
    if(!is_dir("./uploads/products/thumb")){
        mkdir("uploads/products/thumb",0775);
    }
}