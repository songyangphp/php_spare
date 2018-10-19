<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-18
 * Time: 11:43
 */
//通用安装程序
class CurrInsertSystem implements ISpare
{
    private $sid; //插件id
    private $vid; //版本id

    public function __construct($sid,$vid){
        $this->sid = $sid;
        $this->vid = $vid;
    }

    public function insertFile($ident,$conpath='')//文件安装器
    {
        if(empty($conpath)) return false;
        if(!file_exists($conpath)) return false;//检测用户控制器目录
        if(!file_exists(str_replace("controller","view",$conpath))) return false; //检测用户模板目录

        $controller_dir = $conpath."\\".$ident;
        $view_dir = str_replace("controller","view",$conpath)."\\".$ident;

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
                return false;
            }
        }else{
            return false; //"directory already exists";
        }
    }

    public function insertDatabase($dbpre='')//数据库安装器 返回sql语句 回调执行
    {
        return true;
    }
}