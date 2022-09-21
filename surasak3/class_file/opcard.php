<?php 
class Opcard
{
    private $dbi = false;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function getOpcard($hn)
    {
        $opcard = false;
        $q = $this->dbi->query("SELECT * FROM `opcard` WHERE `hn` = '$hn' ");
        if($q->num_rows>0){
            $opcard = $q->fetch_assoc();
        }
        return $opcard;
    }
}
