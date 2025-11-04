<?php
include_once dirname(__FILE__).'/database.php';
include_once dirname(__FILE__).'/class_opd.php';
class Diabetes extends Opd
{
    public $dbi = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function saveDiabetes($data){
        dump($data);
        $sql = "UPDATE `diabetes_clinic` SET 
        `row_id`='4531', 
        `dm_no`='4521', 
        `thidate`='2025-10-16', 
        `dateN`='2025-10-16', 
        `hn`='48-11528', 
        `doctor`='MD100 เชาวรินทร์ อุ่นเครือ', 
        `ptname`='นาง สมบุญ สุภาสอน', 
        `ptright`='R03 โครงการเบิกจ่ายตรง', 
        `dbbirt`='2517-03-21', 
        `sex`='1', 
        `diagnosis`='1', 
        `diagdetail`='', 
        `ht`='1', 
        `htdetail`='', 
        `smork`='0', 
        `bw`='', 
        `bmi`='26.67', 
        `retinal`='', 
        `foot`='', 
        `l_bs`='113', 
        `l_hbalc`='6.7', 
        `l_ldl`='65', 
        `l_creatinine`='', 
        `l_urine`='', 
        `l_microal`='', 
        `foot_care`='0', 
        `nutrition`='0', 
        `exercise`='0', 
        `smoking`='0', 
        `admit_dia`='', 
        `dt_heart`='', 
        `dt_brain`='', 
        `height`='150.0', 
        `weight`='60', 
        `round`='90', 
        `temperature`='36.5', 
        `pause`='82', 
        `rate`='20', 
        `bp1`='145', 
        `bp2`='80', 
        `officer`='ปิยาภรณ์ หาญนิรันดร์ ', 
        `officer_edit`='อาทิตยา ยาวิราช', 
        `register_date`='2025-10-16 11:10:33', 
        `ht_etc`='', 
        `retinal_date`='0000-00-00 00:00:00', 
        `foot_date`='2568-10-16 00:00:00', 
        `tooth_date`='0000-00-00', 
        `tooth`='', 
        `l_ua`='', 
        `date_footcare`='0000-00-00', 
        `date_nutrition`='0000-00-00', 
        `date_exercise`='0000-00-00' 
        WHERE (`row_id`='4531');";
    }
}