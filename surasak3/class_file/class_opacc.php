<?php 
require_once 'class_file/opcard.php';
require_once 'class_file/opday.php';
require_once 'class_file/class_depart.php';

class ClassOpacc extends ClassDepart{

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @param string @date รูปแบบ พ.ศ. เช่น 2565-09-25
     * @param string @hn เช่น 99-9999
     * 
     * @return array ตามโครงสร้างของ opacc
     */
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
    
    public function insertOpacc($departItems=null,$detail=null,$officer=null,$credit=null){ 

        if (empty($departItems)) {
            return "insertOpacc required departItems";
            exit;
        }

        // dump($departItems);
        // dump($detail);
        // dump($officer);
        // dump($credit);
        
        // คำถามก็คือ
        // จะดึงค่า price paid essd nessdy nessdn ฯลฯ จาก opacc หรือ patdata ดี?
        /*
        เคส กฟภ
        */
        $opaccItems = array();
        $thDateTime = $this->getThDateTime();
        foreach ($departItems as $key => $id) {

            // $depart = new ClassDepart();
            // $dep = $depart->getDepartFromId($id);
            $dep = $this->getDepartFromId($id);

            $txdate = $dep['date'];
            $hn = $dep['hn'];
            $depart = $dep['depart'];
            $price = $dep['price'];
            $paid = $dep['paid'];
            $ptright = $dep['ptright'];
            $vn = $dep['tvn'];

            $sql = "INSERT INTO `opacc` ( 
                `row_id`, `date`, `txdate`, `hn`, `depart`, 
                `detail`, `price`, `paid`, `idname`, `credit`, 
                `ptright`, `vn`, `paidcscd`
            ) VALUES (
                NULL, '$thDateTime', '$txdate', '$hn', '$depart', 
                '$detail', '$price', '$paid', '$officer','$credit', 
                '$ptright', '$vn', '$paid'
            );";
            // dump($sql);
            $save = $this->dbi->query($sql);
            if($save===false){
                return $this->dbi->error;
                exit;
            }else{
                $opaccItems[] = $this->dbi->insert_id;
            }
            
            // dump($save);
        }
        return $opaccItems;
        
    }
}