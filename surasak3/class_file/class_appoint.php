<?php 
require_once dirname(__FILE__).'/database.php';

class Appoint extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * รายชื่อผู้ป่วยนัดที่ไม่มาในวันนั้นๆ
     * @param string $date รูปแบบไทย YYYY-mm-dd
     * @return mixed $res
     */
    public function getDisAppoint($date=null){
        if (empty($date)) {
            return "Date is required";
        }
        $pattern = '/(\d{4})-(\d{2})-(\d{2})/';
        $testMatch = preg_match($pattern, $date, $matchs);
        if ($testMatch===false) {
            return "Invalid date format";
        }
        $enDate = ($matchs[1]-543).'-'.$matchs[2].'-'.$matchs[3];

        $sql = "SELECT a.*,b.vn FROM (
            SELECT row_id,hn,ptname,room,detail,detail2,depcode FROM appoint WHERE appdate_en = '$enDate' AND apptime != 'ยกเลิกการนัด'
        ) AS  a LEFT JOIN (
            SELECT row_id,hn,ptname,vn FROM opday WHERE thidate LIKE '$date%' 
        ) AS b ON a.hn = b.hn 
        WHERE b.row_id IS NULL 
        ORDER BY a.room ASC";
        $q = $this->dbi->query($sql);
        if ($q->num_rows>0) {
            $items = array();
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
            $res = $items;
        }else{
            $res = $this->dbError();
        }
        return $res;
    }
}