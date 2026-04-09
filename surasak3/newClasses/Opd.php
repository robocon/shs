<?php
class Opd extends Database
{
    public $dbi = null;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ดึงข้อมูลล่าสุดจาก HN
     * @param string $hn HN ของผู้ป่วย
     * @return array|false คืนค่า array ถ้ามีข้อมูล, false ถ้าไม่มีข้อมูล
     */
    public function lastDataFromHn($hn = false){
        $sql = sprintf("SELECT * FROM `opd` WHERE `hn` = '%s' ORDER BY `row_id` DESC LIMIT 1", 
        $this->dbi->real_escape_string($hn));
        $q = $this->dbi->query($sql);
        if($q->num_rows>0){
            return $q->fetch_assoc();
        }else{
            return false;
        }
    }

    public function last3MonthsFromHn($hn = false){
        $last3Months = strtotime("-6 months");
        $lastThidate = (date('Y', $last3Months)+543).date('-m-d 00:00:00', $last3Months);

        $sql = sprintf("SELECT `row_id`,`thidate`,`vn`,`hn`,`ptname`,`temperature` AS `temp`,`pause` AS `pulse`,`rate`,`weight`,`height`,`bmi`,`bp1`,`bp2`,`waist`,`bp3`,`bp4`,`doctor`,`toborow` 
            FROM `opd` 
            WHERE `thidate` >= '$lastThidate' 
            AND `hn` = '%s' 
            ORDER BY `row_id` DESC", 
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

    /**
     * @param string Thai Date + HN รูปแบบ dd-mm-YYYYHN
     * @return array All item from opd_botox
     */
    public function getBotoxFromThdatehn($thdatehn){
        $sql = sprintf("SELECT * FROM `opd_botox` WHERE `thdatehn` = '%s'", $this->dbi->real_escape_string($thdatehn));
        $q = $this->dbi->query($sql);
        $item = false;
        if($q->num_rows > 0){
            $item = $q->fetch_assoc();
        }
        return $item;
    }

    /**
     * เพิ่มข้อมูล Box ในหน้าซักประวัติ
     * @param array $data ข้อมูลนำเข้า
     * - string thdatehn วันที่ พ.ศ.+hn รูปแบบ dd-mm-yyyyHN,
     * - string hn
     * - string opd_id
     * @return bool|string $res คืนค่า
     * - bool false ถ้าบันทึกข้อมูลไม่ได้
     * - string last_insert_id
     */
    public function insertBotox($data){
        $sql = sprintf("INSERT INTO `opd_botox` (`id`, `thdatehn`, `hn`, `opd_id`, `date_add`) VALUES (NULL, '%s', '%s', '%s', NOW());",
            $this->dbi->real_escape_string($data['thdatehn']),
            $this->dbi->real_escape_string($data['hn']),
            $this->dbi->real_escape_string($data['opd_id'])
        );
        $q = $this->dbi->query($sql);
        $res = false;
        if($q!==false){
            $res = $this->dbi->insert_id;
        }
        return $res;
    }

    /**
     * อัพเดทข้อมูล Botox
     * @param array $data มีรายละเอียด
     * - string thdatehn วันที่ พ.ศ.+hn รูปแบบ dd-mm-yyyyHN
     * - string hn
     * - string opd_id
     * @return bool
     */
    public function updateBotox($data, $opd_id){
        $sql = sprintf("UPDATE`opd_botox` SET `thdatehn`='%s', `hn`='%s' 
        WHERE (`opd_id`='%s');",
            $this->dbi->real_escape_string($data['thdatehn']),
            $this->dbi->real_escape_string($data['hn']),
            $this->dbi->real_escape_string($opd_id)
        );
        $q = $this->dbi->query($sql);
        return $q;
    }
}