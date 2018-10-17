<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-16
 * Time: 8:17
 */

namespace app\epiiadmin\controller;
use think\Db;
use app\common\library\SpareConfig\SpareInit;
class Index extends EpiiController
{
    const SPARE_URL = "http://test.spare.com/Index/test";

    public function index(){
        $list = Db::name("spare")->select();
        foreach ($list as $k => $v){
            $list[$k]['addtime'] = date("Y-m-d",$v['addtime']);
            $list[$k]['version'] = $this->getversion($v['id']);
        }

        $this->assign("list",$list);
        echo json_encode($list);
    }

    private function getversion($s_id){
        $list = Db::name("version")->field("id,version,content,addtime")->where("s_id = '$s_id'")->order("id DESC")->select();

        foreach ($list as $k => $v){
            $list[$k]['publish_time'] = date("Y-m-d",$v['addtime']);
            unset($list[$k]['addtime']);
        }

        return $list;
    }

    public function test(){//接受用户请求
        $sid = $this->request->param("sid/s");
        $vid = $this->request->param("vid/s");
        $conpath = $this->request->param("conpath/s");
        $dbpre = $this->request->param("dbpre/s");
        /*echo json_encode([$sid,$vid,$conpath,$dbpre]);die;*/
        $spare = new SpareInit($sid,$vid,$conpath,$dbpre);
        $fileInit = $spare->insertFile();
        $databaseInit = $spare->insertDatabase();

        $callback = ["filestatus" => $fileInit , "dbdata" => $databaseInit];
        echo json_encode($callback);
    }
}