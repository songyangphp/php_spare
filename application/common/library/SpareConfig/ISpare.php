<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-10-16
 * Time: 11:09
 */

interface ISpare
{
    public function insertFile($conpath);//文件安装器



    public function insertDatabase($dbpre);//数据库安装器
}