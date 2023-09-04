<?php 
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';

class ClassOpacc{
    public $dbi;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        if ($this->dbi->connect_errno) {
            var_dump($this->dbi->error);
            exit;
        }
        $this->dbi->query("SET NAMES UTF8");
        return $this->dbi;
    }

    public function getThDateTime(){
        return (date('Y')+543).date('-m-d H:i:s');
    }

    public function getOpacc($date=null,$hn=null){
        if ($date===null && $hn===null) {
            return "getOpacc required date and hn";
            exit;
        }

        $sql = "SELECT * FROM opacc WHERE date LIKE '$date%' AND hn = '$hn%' ";
        $q = $this->dbi->query($sql);
        $items = array();
        if ($q->num_rows>0) {
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }else{
            return "Opacc is empty";
            exit;
        }

        return $items;
    }

    public function insertOpacc($departId=null,$detail=null,$officer=null,$credit=null,$part=null){ 


        คำถามก็คือ
        จะดึงค่า price paid essd nessdy nessdn ฯลฯ จาก opacc หรือ patdata ดี?
        /*
        เคส กฟภ
        */
        // INSERT INTO `opacc` ( 
        //     `row_id`, `date`, `txdate`, `hn`, `an`, `depart`, 
        //     `detail`, `price`, `paid`, `idname`, `essd`, `nessdy`, 
        //     `nessdn`, `dpy`, `dpn`, `dsy`, `dsn`, `credit`, 
        //     `ptright`, `credit_detail`, `billno`, `vn`, `paidcscd`, `lastupdate`, 
        //     `typecscd`, `typesso`, `icd10_cscd`, `stm_invno`, `status_stm`, `stm_no`, 
        //     `reply_no`) 
        // VALUES (
        //     '5753200', '2566-09-01 11:39:22', '2566-09-01 10:46:02', '52-5113', '', 'XRAY', 
        //     'ค่าตรวจวิเคราะห์โรค', '500.00', '500.00', 'ยูถิกา ยอดคำ', NULL, NULL, 
        //     NULL, NULL, NULL, NULL, NULL, 'กฟผ', 
        //     'R04�รัฐวิสาหกิจ', '', NULL, NULL, '500.00', NULL, 
        //     '', '', '', '', '', '', 
        //     ''
        // );




        //
        // สองเคสด้านล่างเป็นเคสทั่วไป
        //
        // INSERT INTO `opacc` ( 
        // `row_id`, `date`, `txdate`, `hn`, `an`, `depart`, 
        // `detail`, `price`, `paid`, `idname`, `essd`, `nessdy`, 
        // `nessdn`, `dpy`, `dpn`, `dsy`, `dsn`, `credit`, 
        // `ptright`, `credit_detail`, `billno`, `vn`, `paidcscd`, `lastupdate`, 
        // `typecscd`, `typesso`, `icd10_cscd`, `stm_invno`, `status_stm`, `stm_no`, 
        // `reply_no`) 
        // // VALUES 
        // ('5753209', '2566-09-01 11:45:18', '2566-09-01 10:40:48', '48-5521', '', 'PATHO', 
        // 'ค่าตรวจวิเคราะห์โรค', '1800.00', '1800.00', 'นางสาว พวงเพ็ชร หอมแก่นจันทร์', NULL, NULL, 
        // NULL, NULL, NULL, NULL, NULL, 'จ่ายตรง อปท.', 
        // 'R33 เบิกจ่ายตรง อปท.', '', '277', '213', '1000.00', NULL, 
        // '', '', '', '', '', '', 
        // '');

        // INSERT INTO `opacc` ( 
        // `row_id`, `date`, `txdate`, `hn`, `an`, `depart`, 
        // `detail`, `price`, `paid`, `idname`, `essd`, `nessdy`, 
        // `nessdn`, `dpy`, `dpn`, `dsy`, `dsn`, `credit`, 
        // `ptright`, `credit_detail`, `billno`, `vn`, `paidcscd`, `lastupdate`, 
        // `typecscd`, `typesso`, `icd10_cscd`, `stm_invno`, `status_stm`, `stm_no`, 
        // `reply_no`) 
        // // VALUES 
        // ('5755042', '2566-09-03 21:57:20', '2566-09-03 21:13:32', '65-2766', '', 'XRAY', 
        // 'ค่าตรวจวิเคราะห์โรค', '1000.00', '1000.00', 'นางสาว วัลยา คำปาเชื้อ', NULL, NULL, 
        // NULL, NULL, NULL, NULL, NULL, 'นอนโรงพยาบาล', 
        // 'R06 พ.ร.บ.คุ้มครองผู้ประสบภัยจ', '', NULL, NULL, '1000.00', NULL, 
        // '', '', '', '', '', '', 
        // '');

    }
}