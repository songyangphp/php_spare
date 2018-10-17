<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-16
 * Time: 11:16
 */
use think\Exception;
class Config1_3 implements ISpare
{
    private $sid; //插件id
    private $vid; //版本id

    public function __construct($sid,$vid){
        $this->sid = $sid;
        $this->vid = $vid;
    }

    public function insertFile($conpath='')//文件安装器
    {
        if(empty($conpath)){
            return false;
        }
        if(!file_exists($conpath)){ //检测用户控制器目录
            return false;
        }
        if(!file_exists(str_replace("controller","view",$conpath))){ //检测用户模板目录
            return false;
        }

        $controller_dir = $conpath."\\sLogin";
        $view_dir = str_replace("controller","view",$conpath)."\\sLogin";

        if (!file_exists($controller_dir) && !file_exists($view_dir)){
            //建立目标目录
            mkdir($controller_dir,0777,true);
            mkdir($view_dir,0777,true);

            $spare_file = TARGET_ROOT_PATH.$this->sid."_".$this->vid; //获取插件包目录
            $filelist = array_diff(scandir($spare_file),['..','.']); //解析插件包
            try{
                foreach ($filelist as $k => $v){
                    if(!file_exists($controller_dir."\\".$v)){
                        if(substr(strrchr($v, '.'), 1) == 'php'){ //安装php文件
                            copy($spare_file."/".$v,$controller_dir."\\".$v);
                        }

                        if(substr(strrchr($v, '.'), 1) == 'html'){ //安装html文件
                            copy($spare_file."/".$v,$view_dir."\\".$v);
                        }

                        if(substr(strrchr($v, '.'), 1) == 'js'){ //安装js文件
                            continue;
                        }
                    }
                }
                return true;
            }catch (Exception $e){
                echo $e->getMessage();
            }
        }else{
            return false; //"directory already exists";
        }
    }

    public function insertDatabase($dbpre='')//数据库安装器 返回sql语句 回调执行
    {
        if(empty($dbpre)){
            echo "no dbpre";exit;
        }

        $sql =
            "CREATE TABLE `".$dbpre."suser` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) NOT NULL,
              `phone` int(11) NOT NULL,
              `password` varchar(255) NOT NULL,
              `addtime` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `phone` (`phone`),
              KEY `addtime` (`addtime`),
              KEY `addtime_2` (`addtime`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $out[] = ["table_name" => $dbpre.'suser' , "sql" => $sql];
        return $out;
    }
}