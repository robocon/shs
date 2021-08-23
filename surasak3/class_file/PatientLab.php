<?php 
require_once 'InPatient.php';

class PatientLab{
    private $dbi = false;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER, PASS, DB);
    }

    /**
     * แสดงข้อมูลจาก labcare เรียกตาม code
     * @param string $labcode code จาก labcare
     * @return mixed
     */
    public function getLab($labCode)
    {
        if(!empty($labCode))
        {
            $lab = array();
            $q_lab = $this->dbi->query("SELECT * FROM `labcare` WHERE `code` = '$labCode' ");
            if($q_lab->num_rows > 0)
            {
                $lab = $q_lab->fetch_assoc();
            }
            return $lab;
        }
    }

    private $error = array();

    /**
     * @param string $an            64/1500 เลขที่ AN
     * @param string $lab_code      045002 code จาก labcare
     * @param string $amount        1 จำนวนที่สั่ง
     * 
     * @param string $labnumber     (optional) 1 เลข lab จาก runno
     * @param string $patient_from  (optional) OPD|IPD 
     * @param string $staf_massage  (optional) $_SESSION[sOfficer] ชื่อจนท.เฉพาะนวดแผนไทย
     * @param string $sOfficer      (optional) ชื่อผู้ใช้งานที่ Login
     * @param string $date_fix      (optional) ฟิกวันที่รองรับแค่รูปแบบ YYYY(พ.ศ.)-mm-dd
     */
    public $data_input = array(
        'an' => '',
        'lab_code' => '',
        'amount' => '',
        'labnumber' => 'NULL',
        'patient_from' => '',
        'staf_massage' => '',
        'sOfficer' => '',
        'date_fix' => '',
    );

    /**
     * บันทึกค่าใช้จ่ายผู้ป่วยใน เซ็ตใน $data_input = array();
     * @return bool|string $return 
     */
    public function SaveExpense()
    {
        $return = true;

        $ipd = new InPatient();
        $ipd->an = $this->data_input['an']; // !!!CHANGE INPUT!!!
        $ipcard = $ipd->getIpcard();

        $doctor = $ipcard['doctor'];
        $ptname = $ipcard['ptname'];
        $hn = $ipcard['hn'];
        $an = $ipcard['an'];
        $diag = $ipcard['diag'];
        $ptright = $ipcard['ptright'];

        $lab = $this->getLab($this->data_input['lab_code']); // !!!CHANGE INPUT!!!
        $depart = $lab['depart'];
        $part = $lab['part'];
        $detail = $lab['detail'];
        $lab_code = $lab['code'];

        $amount = $this->data_input['amount']; // !!!CHANGE INPUT!!!

        $price = $lab['price'] * $amount;
        $yprice = $lab['yprice'] * $amount;
        $nprice = ($lab['nprice'] == '') ? '0.00' : $lab['nprice'] * $amount;
        $idname = $this->data_input['sOfficer'];

        $labnumber = $this->data_input['labnumber']; // !!!CHANGE INPUT!!!
        $patient_from = $this->data_input['patient_from']; // !!!CHANGE INPUT!!!
        $staf_massage = $this->data_input['staf_massage']; // !!!CHANGE INPUT!!!

        $thDate = (date('Y')+543).date('-m-d');
        if(!empty($this->data_input['fix_date']))
        {
            $thDate = $this->data_input['fix_date'];
        }
        $date_now = $thDate.' '.date('H:i:s');

        $this->dbi->query("LOCK TABLES `runno` READ;");
        $runno_q = $this->dbi->query("SELECT * FROM `runno` WHERE `title` = 'depart' ");
        $runno_item = $runno_q->fetch_assoc();
        $number = $runno_item['runno']+1;
        $this->dbi->query("UNLOCK TABLES;");

        $this->dbi->query("LOCK TABLES `runno` WRITE;");
        $runno_q = $this->dbi->query("UPDATE runno SET runno = '$number' WHERE title = 'depart';");
        $this->dbi->query("UNLOCK TABLES;");

        $depart_insert = "INSERT INTO `depart` (
            `row_id`, `chktranx`, `date`, `ptname`, `hn`, `an`, 
            `doctor`, `depart`, `item`, `detail`, `price`, `sumyprice`, 
            `sumnprice`, `paid`, `idname`, `diag`, `accno`, `tvn`, 
            `ptright`, `lab`, `cashok`, `detailbydr`, `status`, `priority`, 
            `patient_from`, `staf_massage`
        ) VALUES (
            NULL, '$number', '$date_now', '$ptname', '$hn', '$an', 
            '$doctor', '$depart', '1', '$detail', '$price', '$yprice', 
            '$nprice', '0.00', '$idname', '$diag', '1', '$an', 
            '$ptright', '$labnumber', NULL, '', 'Y', '', 
            '$patient_from', '$staf_massage'
        );";
        if($this->dbi->query($depart_insert)==false)
        {
            $this->error[] = 'DEPART : '.$this->dbi->error;
        }

        $depart_id = $this->dbi->insert_id;

        $patdata_insert = "INSERT INTO `patdata` (
            `row_id`, `date`, `hn`, `an`, `ptname`, `copy`, 
            `doctor`, `item`, `code`, `detail`, `amount`, `price`, 
            `yprice`, `nprice`, `paid`, `depart`, `labcode`, `report`, 
            `part`, `idno`, `picture`, `ptright`, `film_size`, `status`, 
            `priority`, `tranipacc`
        ) VALUES (
            NULL, '$date_now', '$hn', '$an', '$ptname', NULL, 
            '$doctor', '1', '$lab_code', '$detail', '$amount', '$price', 
            '$yprice', '$nprice', NULL, '$depart', NULL, NULL, 
            '$part', '$depart_id', NULL, '$ptright', NULL, 'Y', 
            '', ''
        );";
        if($this->dbi->query($patdata_insert)==false)
        {
            $this->error[] = 'PATDATA : '.$this->dbi->error;
        }

        $ipacc_insert = "INSERT INTO `ipacc` (
            `row_id`, `date`, `an`, `code`, `depart`, `detail`, 
            `amount`, `price`, `paid`, `part`, `yprice`, `nprice`, 
            `idname`, `accno`, `idno`, `startdatetime`, `enddatetime`, `status`, 
            `billno`, `officemon`, `ptright`
        ) VALUES (
            NULL, '$date_now', '$an', '$lab_code', '$depart', '$detail', 
            '$amount', '$price', NULL, '$part', '$yprice', '$nprice', 
            '$idname', '1', '$depart_id', NULL, NULL, '', 
            NULL, NULL, '$ptright'
        );";
        if($this->dbi->query($ipacc_insert)==false)
        {
            $this->error[] = 'IPACC : '.$this->dbi->error;
        }

        if(!empty($this->error))
        {
            return implode("\n\r", $this->error);
        }
        return $return;

    }

    public function only_55010()
    {
        $depart = "WARD";
        $part = "NCARE";
        $code = "NCARE";
        $detail = "(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
        $price = "300.00";
        $yprice = "0.00";
        $nprice = "0.00";
        $idname = "คอมพิวเตอร์";
        $ptright = ""; 

        $ipd = new InPatient();
        $ipd->an = $this->data_input['an'];
        $ipcard = $ipd->getIpcard();
        $an = $ipcard['an'];

        $thDate = (date('Y')+543).date('-m-d');
        if(!empty($this->data_input['fix_date']))
        {
            $thDate = $this->data_input['fix_date'];
        }
        $date_now = $thDate.' '.date('H:i:s');

        // $date_now = $fix_date.date(' H:i:s');

        $ipacc_insert = "INSERT INTO `ipacc` (
            `row_id`, `date`, `an`, `code`, `depart`, `detail`, 
            `amount`, `price`, `paid`, `part`, `yprice`, `nprice`, 
            `idname`, `accno`, `idno`, `startdatetime`, `enddatetime`, `status`, 
            `billno`, `officemon`, `ptright`
        ) VALUES (
            NULL, '$date_now', '$an', '$code', '$depart', '$detail', 
            '1', '$price', NULL, '$part', '$yprice', '$nprice', 
            '$idname', '1', '$depart_id', NULL, NULL, '', 
            NULL, NULL, '$ptright'
        );";
    }
}