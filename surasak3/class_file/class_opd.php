<?php
require_once dirname(__FILE__).'/database.php';
class Opd extends DbConnect
{
    public $dbi = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function last3MonthsFromHn($hn = false){
        $last3Months = strtotime("-3 month");
        $lastThidate = (date('Y', $last3Months)+543).date('-m-d 00:00:00', $last3Months);

        $sql = sprintf("SELECT `row_id`,`thidate`,`vn`,`hn`,`ptname`,`weight`,`height`,`bmi`,`bp1`,`bp2`,`waist`,`bp3`,`bp4`,`doctor`,`toborow` 
            FROM `opd` 
            WHERE `thidate` >= '$lastThidate' 
            AND `hn` = '%s' ", 
        $this->dbi->real_escape_string($hn));
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            return $items;
        }else{
            return '';
        }
    }
}