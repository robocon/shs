<?php
class Bed extends Database
{
    public $dbi;
    public function __construct()
    {
        parent::__construct();
    }

    public function getBed($an = ''){
        if(empty($an)){
            return false;
        }
        $sql = "SELECT * FROM `bed` WHERE `an` = '$an' ";
        $q = $this->dbi->query($sql);
        $item = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
        }
        return $item;
    }
}