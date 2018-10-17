<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-16
 * Time: 11:13
 */
namespace app\common\library\SpareConfig;
require_once __DIR__ . "/ISpare.php";

class SpareInit
{
    protected $_class;

    protected $_sid;
    protected $_vid;
    protected $_conpath;
    protected $_dbpre;

    public function __construct($sid,$vid,$path='',$dbpre=''){
        $this->_sid = $sid;
        $this->_vid = $vid;
        $this->_conpath = urldecode($path);
        $this->_dbpre = urldecode($dbpre);

        $class = "Config".$this->_sid."_".$this->_vid;
        $path = __DIR__ . "\\". $class.".php";

        if(!file_exists($path)){
            echo -1;exit;
        }else{
            require_once $path;
            $this->_class = new $class($this->_sid,$this->_vid);
        }
    }


    public function insertFile(){
        $function = "insertFile";
        return $this->_class->{$function}($this->_conpath);
    }

    public function insertDatabase(){
        $function = "insertDatabase";
        return $this->_class->{$function}($this->_dbpre);
    }
}