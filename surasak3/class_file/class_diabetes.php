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

    public function getDmNumber($hn=null){

        $sql = sprintf("SELECT `dm_no` FROM `diabetes` WHERE `hn` = '%s' ", $this->dbi->real_escape_string($hn));
        $q = $this->dbi->query($sql);
        $item = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
        }
        return $item;
    }

    public function insertDiabetes($post=null){

        INSERT INTO `diabetes_clinic_history` (`row_id`, `dm_no`, `thidate`, `dateN`, `hn`, `doctor`, `ptname`, `ptright`, `dbbirt`, `sex`, `diagnosis`, `diagdetail`, `ht`, `htdetail`, `smork`, `bw`, `bmi`, `retinal`, `foot`, `l_bs`, `l_hbalc`, `l_ldl`, `l_creatinine`, `l_urine`, `l_microal`, `foot_care`, `nutrition`, `exercise`, `smoking`, `admit_dia`, `dt_heart`, `dt_brain`, `height`, `weight`, `round`, `temperature`, `pause`, `rate`, `bp1`, `bp2`, `officer`, `officer_edit`, `register_date`, `added_date`, `edited_date`, `ht_etc`, `edited_user`, `retinal_date`, `foot_date`, `dummy_no`, `tooth_date`, `tooth`, `l_ua`, `date_footcare`, `date_nutrition`, `date_exercise`, `follow`, `followText`) VALUES ('27226', '566', '2011-11-07', '2025-11-04', '49-11742', 'MD009 นภสมร ธรรมลักษมี', 'นาย ประสงค์ เตชะนันท์', 'R07ประกันสังคม', '2508-09-01', '0', '1', '2549-12-06', '1', '2549-09-08', '0', '', '26.56', 'No DR', '', '132', '7.1', '84', '11001324', '', '', '0', '0', '0', '0', '', '', '', '160.0', '75.0', '', '36.6', '90', '20', '134', '79', 'สุวพันธ์ ชมวงษ์', '', '', '2025-11-04 09:01:55', '2025-11-04 09:01:55', '', 'สุวพันธ์3', '2568-11-04 00:00:00', '0000-00-00 00:00:00', '60242818', '0000-00-00', '', '', '0000-00-00', '0000-00-00', NULL, NULL, NULL);

    }

    public function saveDiabetes($data){
        dump($data);
        $sql = "UPDATE `diabetes_clinic` SET 


`bmi`='26.67',                          bmi
`height`='150.0',                       height
`weight`='60',                          weight
`pause`='82',                           pulse
`rate`='20',                            rate
`retinal`='',                           retinal
`retinal_date`='0000-00-00 00:00:00',   retinal_date
`temperature`='36.5',                   temp
                                        follow
                                        followText

`dateN` = NOW()

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
        
        
        `round`='90', 
        
        
        
        `bp1`='145', 
        `bp2`='80', 
        `officer`='ปิยาภรณ์ หาญนิรันดร์ ', 
        `officer_edit`='อาทิตยา ยาวิราช', 
        `register_date`='2025-10-16 11:10:33', 
        `ht_etc`='', 
        
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