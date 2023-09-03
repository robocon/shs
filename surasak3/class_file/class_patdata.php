<?php 
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';

class Patdata
{
    public $dbi;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        if ($this->dbi->connect_errno) {
            var_dump($this->dbi->error);
            exit;
        }
        $this->dbi->query("SET NAMES UTF8");
        return $this->dbi;
    }

    public function getPatdata($idno=null){

        if ($idno===null) {
            return "idno is Require in patdata";
            exit;
        }

        $sql = "SELECT * FROM `patdata` WHERE `idno` = '$idno' ";
        $q = $this->dbi->query($sql);
        $items = array();
        if ($q->num_rows>0) {
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }
        return $items;
    }

    public function insertOnlyPatdata(){
        var_dump("INSERT ONLY PATDATA");
    }
}