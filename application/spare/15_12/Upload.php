<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-09
 * Time: 15:30
 */

// php 原生文件上传
const IMG_MAX_SIZE = 1024000;
const IMG_ROOT_PATH = "file/";
const IMG_FILE_TYPE = ["image/jpeg","image/jpg","image/png","image/gif"];

echo "<pre>";
/*$arr = function (){
    return "aaa";
};

var_dump($arr());
die;*/
/*var_dump($_FILES);exit;*/
if($_FILES["file"]["error"]) {
    echo $_FILES["file"]["error"];exit;
} else {
    if(!in_array($_FILES["file"]["type"],IMG_FILE_TYPE)){
        echo "文件不是图片";exit;
    }

    if($_FILES['file']['size'] > IMG_MAX_SIZE){
        echo "文件过大";exit;
    }

    $filename = IMG_ROOT_PATH.date("YmdHis").$_FILES["file"]["name"];

    if(file_exists($filename)){
        echo "该文件已存在";exit;
    }



    if(move_uploaded_file($_FILES["file"]["tmp_name"],$filename)){
        echo $filename;exit;//成功返回路径
    } else {
        echo "上传失败";exit;
    }
}

//D:/phpStudy/Apache/cgi-bin/
