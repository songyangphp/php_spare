<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 8:47
 */

namespace app\epiiadmin\controller;
use app\common\library\AddedSp;

class Addedspare extends EpiiController
{
    public function index(){
        if($this->request->isPost()){
            $files = request()->file('file');

            $now_version = $this->request->param("now_version/s");
            $name = $this->request->param("name/s");
            $remake = $this->request->param("remake/s");
            $author = $this->request->param("author/s");
            $ident = $this->request->param("ident/s");

            $re = AddedSp::Added($files,$now_version,$name,$remake,$author,$ident);

            dump($re);
        }else{
            return $this->fetch();
        }
    }
}