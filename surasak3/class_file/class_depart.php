<?php 
require_once dirname(__FILE__).'/database.php';
require_once dirname(__FILE__).'/class_opcard.php';
require_once dirname(__FILE__).'/class_opday.php';
/**
 * @see https://docs.phpdoc.org/guide/references/phpdoc/index.html#phpdoc-reference
 */
class ClassDepart extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * รันเลข runno ใน depart เอาไปใช้ในฟิลด์ chktranx
     * 
     * @return mixed หมายเลข ฟิลด์runno ของตารางrunno
     */
    public function startRunno(){
        $q_runno = $this->__query("SELECT `title`,`prefix`,`runno` FROM `runno` WHERE `title` = 'depart'");
        $runno_row = $q_runno->fetch_assoc();
		$chktranx = $runno_row['runno'];
		$chktranx++;
        
        $this->__query("UPDATE `runno` SET `runno` = '$chktranx' WHERE `title`='depart'");
        
        return $chktranx;
    }
    
    /**
     * ค้นหา depart จาก row_id
     * @param string $id คือ row_id ของตาราง
     * 
     * @return mixed String if error and array if success
     */
    public function getDepartFromId($id=null){
        if (empty($id)) {
            $res = $this->res400('Required id');
        }else{
            $sql = sprintf("SELECT * FROM `depart` WHERE `row_id` = '%s' LIMIT 1", $this->dbi->real_escape_string($id));
            $q = $this->__query($sql);
            if(empty($q->errorNumber)){
                $res = array();
                if($q->num_rows>0){
                    $res = $q->fetch_assoc();
                    $q->free_result();
                }else{
                    $res = $this->res400('Not found data');
                }
            }else{
                $res = $this->res400($q->errorMessage);
            }
        }
        return $res;
    }

    /**
     * ดึงข้อมูลจากใน depart จาก วันที่ hn และ ฟิลด์depart(optional)
     * @param string $date รูปแบบวันที่ของไทย เช่น 2567-11-29
     * @param string $hn เลขที่ผู้มารับบริการ
     * @param string $depart (optional) เอาไว้แยกตามประเภท
     * 
     * @return mixed รายการของ depart
     */
    public function getDepart($date=null, $hn=null, $depart=null){
        if (empty($date) OR empty($hn)) {
            $res = $this->res400('getDepart Required date(THAI FORMAT IN YYYY-mm-dd) and HN');
        }else{
            $sql = sprintf(
                "SELECT * FROM `depart` WHERE `date` LIKE '%s%%' AND `hn` = '%s' ", 
                $this->dbi->real_escape_string($date), 
                $this->dbi->real_escape_string($hn)
            );
            if ($depart!==null) {
                $sql .= sprintf(" AND `depart` = '%s' ", $this->dbi->real_escape_string($depart));
            }
            
            $q = $this->__query($sql);
            if(empty($q->errorNumber)){
                if($q->num_rows>0){
                    $res = array();
                    while ($a = $q->fetch_assoc()) {
                        $res[] = $a;
                    }
                }else{
                    $res = $this->res400('Can not find data');
                }
            }else{
                $res = $this->res400($q->errorMessage);
            }
        }
        return $res;
    }

    /**
     * @see ทำขึ้นเพื่อใช้ในงานตรวจสุขภาพ เพราะต้องระบุด้วยว่า จ่ายเป็นเงินสดหรือตามสิทธิ + มีเลขแลป + แผนกที่สั่งหัตถการ
     * 
     * @param string $hn
     * @param string $detail            รายละเอียดว่าตรวจอะไร
     * @param string $diag              ข้อวินิจฉัยของแพทย์
     * @param array $labItems           มีรายการตรวจอะไรบ้างเอาไปคำนวณค่าใช้จ่าย
     * @param string $officer           จนท.ผู้บันทึก
     * @param string $cashok            สถานะการเก็บเงิน(ดีดลูกหนี้)
     * @param string $nLab_orderhead    เลขที่แลป
     * @param string $depart            แผนก
     * 
     * @return string $departId หมายเลขของ row_id ที่บันทึกล่าสุด
     */
    public function insertOnlyDepart($hn=null, $detail='', $diag='', $labItems=array(), $officer='', $cashok='', $nLab_orderhead='', $depart=''){ 

        $opday = new Opday();
        $op = $opday->getThisDay($hn);
        if ($op===false) {
            $res = "ไม่มีข้อมูลการออก VN ในวันนี้";
        }elseif(empty($detail) OR empty($diag) OR empty($labItems) OR empty($officer) OR empty($cashok) OR empty($nLab_orderhead) OR empty($depart) ) {
            $res = "กรุณาระบุข้อมูลให้ครบถ้วน";
        }else{
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

            $detail = $this->__input('%s', $detail);
            $diag = $this->__input('%s', $diag);
            $officer = $this->__input('%s', $officer);
            $cashok = $this->__input('%s', $cashok);
            $nLab_orderhead = $this->__input('%s', $nLab_orderhead);
            $depart = $this->__input('%s', $depart);
            
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
            $res = $this->dbi->insert_id;
        }
        return $res;
    }

    /**
     * รวมค่าใช้จ่ายตามรายการที่โยนเข้ามา รวมเป็นก้อนเดียวกัน
     * 
     * @param array @labItems       รายการแลป หรือ xray ต่างๆ ที่อยู่ใน labcare
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

            $labcare = $this->getLabcareFromCode($lab_code, array('code','oldcode','detail','price','yprice','nprice','depart','part'));

            // $sql_labcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $lab_code);
            // $q = $this->dbi->query($sql_labcare);
            // if ($q->num_rows > 0) { 

                // $labcare = $q->fetch_assoc();
                $sumPrice += $labcare['price'];
                $sumYPrice += $labcare['yprice'];
                $sumNPrice += $labcare['nprice'];

            // }
            
        } // End foreach รายการแลป

        return array(
            'sumPrice' => number_format($sumPrice, 2),
            'sumYPrice' => number_format($sumYPrice, 2),
            'sumNPrice' => number_format($sumNPrice, 2)
        );
    }

    /**
     * @param string $code รหัสที่ต้องการใน labcare
     * @param array $selectItem example: array('code','detail,'price','yprice','nprice'ff) 
     */
    public function getLabcareFromCode($code, $selectItem=array()){
        $select = '*';
        if(!empty($selectItem)){
            $select = implode(',', $selectItem);
        }
        $sql_labcare = sprintf("SELECT $select FROM `labcare` WHERE `code` = '%s' ", $this->dbi->real_escape_string($code)); 
        $q = $this->dbi->query($sql_labcare);
        if (empty($this->dbi->error) && $q->num_rows > 0) { 
            $res = $q->fetch_assoc();

        }else{
            $res = array('error' => true,'msg' => '');
            $res['msg'] = $this->dbi->error ? $this->dbi->error : 'Can not find data from codelab' ;
            
        }

        return $res;
    }

    /**
     * map ค่า ระหว่าง key กับ value ออกมาเป็น `key`='value' ใช้สำหรับ update statement
     * สามารถใช้ได้ดังนี้ array_map('mapUpdate', array_keys($array), array_values($array));
     * @param string $key
     * @param string $value
     */
    public function mapUpdate($key, $value){ 
        $key = sprintf("%s", $this->dbi->real_escape_string($key));
        $value = sprintf("%s", $this->dbi->real_escape_string($value));
        return "`$key`='$value'";
    }

    /**
     * อัพเดทข้อมูลใน depart แบบ key->value
     * 
     * @param array $dataList   รายการที่จะอัพเดทเป็น key value
     * @param string $id        primary key ของ deaprt
     * 
     * @return mixed $save      true ถ้าบันทึกข้อมูลได้ false หรือ mysql error ถ้าข้อมูลผิดพลาด
     * 
     * @example Example ตัวอย่าง code
     * ```php
     * <?php 
     * setDepartManual(array('ptname'=>'ทดสอบ ใหม่', 'doctor'=>'หมอหน่วง'),'999'); 
     * ?>
     */
    public function setDepartManual($dataList=array(), $id=null){

        if(empty($id) OR empty($dataList)){
            return false;
        }

        $updateList = array_map(array($this, 'mapUpdate'), array_keys($dataList), array_values($dataList));
        $updateTxt = implode(', ', $updateList);

        $sqlUpdateDepart = sprintf("UPDATE `depart` SET $updateTxt WHERE `row_id` = '%s' ", $this->dbi->real_escape_string($id));
        $res = false;
        $q = $this->__query($sqlUpdateDepart);
        if($q->errorNumber){
            $res = $q->errorMessage;
        }else{
            $res = true;
        }
        return $res;
    }

    /**
     * ใช้อัพเดทในกรณีที่ รายการใน depart มีเท่าเดิม แต่ค่าราคาใน price,yprice,nprice ผิดไปจากเดิมเช่น ห้องแลปไม่ได้แก้ราคาตรวจแลป
     * 
     * จะมีฟิลด์ถูกฟิกไว้อยู่แล้วที่ต้องอัพเดทตาม $itemList เช่น item, price, sumyprice, sumnprice 
     * ใน $fieldUpdate จะต้องมี detail เป็นอย่างน้อยเพื่อบอกว่ารายการที่อัพเดทเป็น ค่าบริการทางการแพทย์ หรือ ค่าบริการทางการพยาบาล
     * ส่วนฟิดล์อื่นๆ สามารถเอามาใส่ไว้ใน $fieldUpdate ได้เลย
     * 
     * @param array $itemList       รายการที่จะต้องเอามาคำนวณค่าใช้จ่าย
     * @param string $id            row_id ของ depart
     * @param array $fieldUpdate    (optional) Field ในตาราง depart ที่จะทำการอัพเดท
     *
     * @example Example ตัวอย่าง code
     * ```php
     * <?php
     * updateDepartFromList(array('ua','bs','hba1c'), '999', array('ptname'=>'ทดสอบ ใหม่', 'doctor'=>'หมอหน่วง'));
     * ?>
     */
    public function updateDepartFromList($itemList=array(), $id=null, $fieldUpdate=array()){
        if(empty($itemList) OR empty($id) OR empty($fieldUpdate)){
            return false;
        }
        $amount = count($itemList);
        $price = $sumYPrice = $sumNPrice = 0;
        foreach ($itemList as $key => $value) {
            $lab = $this->getLabcareFromCode($value, array('code', 'price', 'yprice', 'nprice'));
            if($lab['error']===true){
                return $lab['msg'];
            }

            $price += $lab['price'];
            $sumYPrice += $lab['yprice'];
            $sumNPrice += $lab['nprice'];
        }

        $mainSQL = array(
            'item'=>$amount, 
            'price'=>$price,
            'sumyprice'=>$sumYPrice,
            'sumnprice'=>$sumNPrice
        );

        if(count($fieldUpdate)>0){ 
            $mainSQL = array_merge($mainSQL, $fieldUpdate);
        }

        $res = $this->setDepartManual($mainSQL, $id);
        return $res;
    }
}

