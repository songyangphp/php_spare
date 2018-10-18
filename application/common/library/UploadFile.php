<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 11:10
 */
namespace app\common\library;

class UploadFile
{
    public static function uploadFile($files,$callback){
        foreach($files as $file){
            $info = $file->move(TARGET_ROOT_PATH."/".$callback['lastsid']."_".$callback['lastvid'],'');
            if(!$info){
                return false;
            }
        }

        return true;
    }
}