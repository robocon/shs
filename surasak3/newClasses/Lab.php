<?php
class Lab extends Database
{
    public $dbi;
    public $dbiBlood;
    public function __construct()
    {
        parent::__construct();

        $this->dbiBlood = new mysqli(BLOOD_SERVER, BLOOD_USER, BLOOD_PASS, BLOOD_DB);
        if ($this->dbiBlood->error) {
            return $this->dbiBlood->error;
        }
        $this->dbiBlood->query("SET NAMES UTF8");
        $this->dbiBlood->set_charset('utf8');

    }

    public function getBloodstockFromGroup($blood_group=''){
        $blood_group = sprintf("%s", $this->dbi->real_escape_string($blood_group));
        $sql = "SELECT * FROM `mst_stock` 
        WHERE `Exp_Date` >= CURDATE() 
        AND `Blood_Group` = '$blood_group'
        AND ( `Flag_Exp` = '' AND `Flag_pay` = '' )
        ORDER BY `Exp_Date` ASC";
        $qBlood = $this->dbiBlood->query($sql);
        if($qBlood->num_rows>0){
            $item = array();
            while ($a = $qBlood->fetch_assoc()) {
                $item[] = $a;
            }
        }else{
            $item = false;
        }

        return $item;
    }
}