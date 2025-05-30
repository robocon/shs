<?php 
require_once dirname(__FILE__).'/database.php';

class ClassResulthead extends DbConnect{ 
    public function __construct()
    {
        parent::__construct();
    }

    public function getResulthead($labnumber=''){ 
        
        if(empty($labnumber)){
            return "labnumber is required";
            exit;
        }

        $sql = "SELECT * FROM resulthead WHERE labnumber = '$labnumber' ";
        $q = $this->dbi->query($sql);
        if ($q->num_rows>0) {
            $lab_items = array();
            while ($a = $q->fetch_assoc()) {
                $lab_items[] = $a;
            }
            return $lab_items;
        }else{
            return false;
            exit;
        }
    }
}