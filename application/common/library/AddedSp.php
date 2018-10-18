<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 11:18
 */
namespace app\common\library;
class AddedSp
{
    public static function Added($files,$now_version,$name,$remake,$author){
        $callback = Add::InsertData($now_version,$name,$remake,$author);
        if(!$callback) return false;

        $re = UploadFile::uploadFile($files,$callback);

        if($re){
            return true;
        }else{
            return false;
        }
    }
}