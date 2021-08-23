<?php 
class InPatient{ 

    public $an = '';
    private $dbi = false;

    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER, PASS, DB);
    }

    public function getIpcard()
    {
        if(!empty($this->an))
        {
            $ipcard = array();
            $q_ipcard = $this->dbi->query("SELECT * FROM `ipcard` WHERE `an` = '$this->an' ");
            if ($q_ipcard->num_rows > 0) {
                $ipcard = $q_ipcard->fetch_assoc();
            }
            return $ipcard;
        }
        else
        {
            return array('error' => 1, 'error_msg' => 'ไม่พบข้อมูล AN');
        }
    }

    public function getBed()
    {
        if(!empty($this->an))
        {
            $bed = array();
            $q_bed = $this->dbi->query("SELECT * FROM `bed` WHERE `an` = '$this->an' ");
            if ($q_bed->num_rows > 0) {
                $bed = $q_bed->fetch_assoc();
                $bed['ward_code'] = substr($bed['bedcode'],0,2);
                $bed['bed_number'] = substr($bed['bedcode'],2,strlen($bed['bedcode']));
                $bed['ward_name'] = $this->getWardName($bed['ward_code']);
            }
            return $bed;
        }
        else
        {
            return array('error' => 1, 'error_msg' => 'ไม่พบข้อมูล AN');
        }
    }

    public function getWardName($ward_code = '')
    {
        if(empty($ward_code))
        {
            return "ไม่พบรหัส Ward";
        }
        $ward_list = array(
            '42' => 'หอผู้ป่วยรวม',
            '44' => 'หอผู้ป่วย ICU',
            '43' => 'หอผู้ป่วยสูติ',
            '45' => 'หอผู้ป่วยพิเศษ'
        );
        return $ward_list[$ward_code];
    }








    /**
     * default จะเป็น WHERE `an` = 'xxx'
     */
    public function getIpacc($where = '')
    {
        $ipacc_list = array();
        if(empty($where))
        {
            if(empty($this->an))
            {
                return array('error' => 1, 'error_msg' => 'ไม่พบข้อมูล AN');
            }
            $where = "WHERE `an` = '$this->an'";
        }
        $q_ipacc = $this->dbi->query("SELECT * FROM `ipacc` $where ");
        if ($q_ipacc->num_rows > 0) {
            while ($ipacc = $q_ipacc->fetch_assoc()) {
                $ipacc_list[] = $ipacc;
            }
        }
        return $ipacc_list;
    }
}