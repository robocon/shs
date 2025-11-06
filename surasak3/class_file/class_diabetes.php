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

        $sql = sprintf("SELECT `dm_no` FROM `diabetes_clinic` WHERE `hn` = '%s' ", $this->dbi->real_escape_string($hn));
        $q = $this->dbi->query($sql);
        $dmNo = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
            $dmNo = $item['dm_no'];
        }
        return $dmNo;
    }

    public function insertRetinalHistory($post=null){
        
        $sql = sprintf("INSERT INTO `diabetes_clinic_history` (
        `dm_no`, `dateN`, `hn`, `doctor`, `ptname`, `bmi`, 
        `retinal`, `height`, `weight`, `round`, `temperature`, `pause`, 
        `rate`, `bp1`, `bp2`, `officer`, `register_date`, `added_date`, 
        `edited_date`, `retinal_date`, `dummy_no`, `follow`, `followText`
        ) VALUES (
        '','','','','','',
        '','','','','','',
        '','','','','','',
        '','','','','',''
        );");
        dump($sql);
    }

    public function insertRetinalDiabetes($post){
        $sql = "INSERT INTO `diabetes_clinic` (
        `dm_no`, `thidate`, `dateN`, `hn`, `doctor`, `ptname`, 
        `bmi`, `retinal`, `height`, `weight`, `round`, `temperature`, 
        `pause`, `rate`, `bp1`, `bp2`, `officer`, `register_date`, 
        `retinal_date`, `follow`, `followText`
        ) VALUES ('4555', '4545', '2025-10-30', '2025-10-30', '66-1665', 'MD204 จักษุแพทย์', 'นาง เนตย์ ก๋องวงค์', 'R01 เงินสด', '2498-03-12', '1', '', '', '', '', '0', '', '18.47', 'No DR', 'Low Risk', '110', '7.4', '44', '0.62', '', '', '1', '0', '0', '0', '', '', '', '149.0', '41.0', '71.0', '36.6', '74', '20', '175', '78', 'อาทิตยา ยาวิราช', '', '2025-10-30 12:44:26', '', '2568-10-30 00:00:00', '2568-10-30 00:00:00', '0000-00-00', '1', '', '2568-10-30', '0000-00-00', '0000-00-00', NULL, NULL);";
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