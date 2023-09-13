<?php 
require_once 'class_file/database.php';
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';

class ClassDepart extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * รันเลข runno ใน depart เอาไปใช้ในฟิลด์ chktranx
     * 
     * @return string @chktranx คือหมายเลข ฟิลด์runno ของตารางrunno
     */
    public function startRunno(){
        $q_runno = $this->dbi->query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        $this->dbi->query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='depart'");
        return $chktranx;
    }

    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }
    
    /**
     * ค้นหา depart จาก row_id
     * 
     * @param string @id คือ row_id ของตาราง
     * 
     * @return array @res
     */
    public function getDepartFromId($id=null){
        if ($id===null) {
            return "required id";
            exit;
        }

        $sql = sprintf("SELECT * FROM depart WHERE row_id = %s LIMIT 1", $id);
        $q = $this->dbi->query($sql);
        $res = array();
        if($q->num_rows>0){
            $res = $q->fetch_assoc();
            $q->free_result();
        }else{
            return "not found data";
            exit;
        }
        return $res;

    }

    /**
     * ดึงข้อมูลจากใน depart 
     * @param string @date รูปแบบวันที่ของไทย
     * @param string @hn เลขที่ผู้มารับบริการ
     * @param string @depart (optional) เอาไว้แยกตามประเภท
     * 
     * @return array @items รายการของ depart
     */
    public function getDepart($date=null, $hn=null, $depart=null){

        if ($date==null OR $hn===null) {
            return "getDepart required date(THAI FORMAT IN YYYY-mm-dd) and HN";
            exit;
        }

        $sql = "SELECT * FROM depart WHERE date LIKE '$date%' AND hn = '$hn' ";
        if ($depart!==null) {
            $sql .= " AND depart = '$depart' ";
        }

        $q = $this->dbi->query($sql);
        $items = false;
        if($q->num_rows>0){
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }
        
        return $items;
    }

    /**
     * เพิ่มข้อมูลค่าใช้จ่ายใน depart เท่านั้น
     * 
     * @return string $departId หมายเลขของ row_id ที่บันทึกล่าสุด
     */
    public function insertOnlyDepart(
        $hn=null, 
        $detail='',             // รายละเอียดว่าตรวจอะไร
        $diag='',               // ข้อวินิจฉัยของแพทย์
        $labItems=array(),      // มีรายการตรวจอะไรบ้างเอาไปคำนวณค่าใช้จ่าย
        $officer='',            // จนท.ผู้บันทึก
        $cashok='',             // สถานะการเก็บเงิน(ดีดลูกหนี้)
        $nLab_orderhead = '',   // เลขที่แลป
        $depart=''              // แผนก
    ){ 

        $opday = new Opday();
        $op = $opday->getThisDay($hn);
        if ($op===false) {
            return "ไม่มีข้อมูลการออก VN ในวันนี้";
            exit;
        }

        $ptright = $op['ptright'];
        $ptname = $op['ptname'];
        $vn = $op['vn'];

        $labprice = $this->getPrice($labItems);
        $sumPrice = $labprice['sumPrice'];
        $sumYPrice = $labprice['sumYPrice'];
        $sumNPrice = $labprice['sumNPrice'];

        $runnoChktranx = $this->startRunno();
        $thaiDateTime = $this->getThDateTime();
        $countItem = count($labItems);
        if (empty($officer)) {
            $officer = $this->getOfficer();
        }
        
        $sql_depart = "INSERT INTO `depart` ( 
            `chktranx`, `date`, `ptname`, `hn`, `doctor`, `depart`, 
            `item`, `detail`, `price`, `sumyprice`, `sumnprice`, 
            `idname`, `diag`, `tvn`, `ptright`, `lab`, `status` ,
            `cashok`, `paid`
        ) VALUES ( 
            '$runnoChktranx', '$thaiDateTime', '$ptname', '$hn', 'MD022 (ไม่ทราบแพทย์)', '$depart', 
            '$countItem', '$detail', '$sumPrice', '$sumYPrice', '$sumNPrice', 
            '$officer', '$diag', '$vn', '$ptright', '$nLab_orderhead', 'Y', 
            '$cashok', '$sumPrice'
        )";
        
        $depart_save = $this->dbi->query($sql_depart);
        if($depart_save==false){
            return $this->dbi->error;

        }
        $departId = $this->dbi->insert_id;
        return $departId;

    }

    /**
     * รวมค่าใช้จ่ายตามรายการที่โยนเข้ามา รวมเป็นก้อนเดียวกัน
     * 
     * @param array @labItems รายการแลป หรือ xray ต่างๆ ที่อยู่ใน labcare
     * 
     * @return array    sumPrice ค่าใช้จ่ายทั้งหมด
     *                  sumYPrice แยกตามที่เบิกได้
     *                  sumNPrice ที่เบิกไม่ได้
     */
    public function getPrice($labItems){
        $sumPrice = 0;
        $sumYPrice = 0;
        $sumNPrice = 0;
        foreach ($labItems as $key => $lab_code) { 

            $sql_labcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $lab_code);
            $q = $this->dbi->query($sql_labcare);
            if ($q->num_rows > 0) { 

                $labcare = $q->fetch_assoc();
                $sumPrice += $labcare['price'];
                $sumYPrice += $labcare['yprice'];
                $sumNPrice += $labcare['nprice'];

            }
            
        } // End foreach รายการแลป

        return array(
            'sumPrice' => number_format($sumPrice, 2),
            'sumYPrice' => number_format($sumYPrice, 2),
            'sumNPrice' => number_format($sumNPrice, 2)
        );
    }

}

