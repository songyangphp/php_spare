<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 9:50
 */
namespace app\common\library;
use think\Db;
use think\exception\DbException;
class Add
{
    public static function InsertData($now_version,$name,$remake,$author,$ident){
        if(empty($now_version) || empty($name) ||empty($remake) ||empty($author) ||empty($ident)) return false;

        Db::startTrans();
        try{
            $lastsid = self::InsertSpare($now_version,$name,$remake,$author,$ident);
            $lastvid = self::InsertVersion($lastsid,$now_version,$remake);
            Db::commit();
            return ['lastsid' => $lastsid , 'lastvid' => $lastvid];
        }catch (DbException $e){
            Db::rollback();
            echo $e->getMessage();die;
        }
    }

    private static function InsertSpare($now_version,$name,$remake,$author,$ident){
        if(Db::name("spare")->where("name = '$name'")->find()) return false;

        $insertData = ["now_version" => $now_version , "name" => $name , "remake" => $remake , "author" => $author , "addtime" => time() , "ident" => $ident];//epiiadmin

        $Lastsid = Db::name("spare")->insertGetId($insertData);
        if($Lastsid){
            return $Lastsid;
        }else{
            return false;
        }
    }

    public static function InsertVersion($sid,$version,$content){
        if(Db::name("version")->where("s_id = '$sid' and  version = '$version'")->find()) return false;

        $insertData = ["version" => $version , "content" => $content , "s_id" => $sid , "addtime" => time()];
        $lastvid = Db::name("version")->insertGetId($insertData);

        if($lastvid){
            return $lastvid;
        }else{
            return false;
        }
    }
}