<?php 
require_once dirname(__FILE__).'/database.php';
class ReportHt extends DbConnect
{
    public $qOpdXDiag = false;
    public function __construct()
    {
        parent::__construct();
    }

    private function doQuery($sql){
        $q = $this->dbi->query($sql);
        if($q!==false){
            return $q;
        }else{
            return $this->dbi->error;
        }
    }

    /**
     * Summary of generateTempOpdXDiag
     * @param mixed $year ปี พ.ศ. ไทย
     * @return bool return mysqli result set
     */
    public function generateTempOpdXDiag($year){
        $sqlTemp = "CREATE TEMPORARY TABLE `tempOpdXDiag` 
        SELECT b.`row_id`,b.`thdatehn`,b.`thidate`,b.`hn`,b.`ptname`,b.`bp1`,b.`bp2`,b.`bp3`,b.`bp4`,a.`icd10`,SUBSTR(b.`age`,1,2) AS `age`,a.`latest_row_id` 
        FROM ( 
            SELECT y.`row_id`,y.`svdate`,y.`hn`,y.`an` AS `vn`,`icd10`,CONCAT(SUBSTRING(y.`svdate`,9,2),'-',SUBSTRING(y.`svdate`,6,2),'-',SUBSTRING(y.`svdate`,1,4),y.`hn`) AS `thdatehn`,NOW() AS `date_generate`,x.`latest_row_id` 
            FROM ( 
                SELECT MAX(`row_id`) AS `latest_row_id` 
                FROM `diag` 
                WHERE `icd10` = 'I10' 
                AND `status` = 'Y' 
                AND `svdate` LIKE '$year%' 
                GROUP BY `hn` 
                ORDER BY `row_id` ASC 
            ) AS x 
            LEFT JOIN `diag` AS y ON x.`latest_row_id` = y.`row_id` 
        ) AS a 
        LEFT JOIN `opd` AS b ON a.`thdatehn` = b.`thdatehn` 
        WHERE b.`row_id` IS NOT NULL 
        AND ( b.`bp1` <> '' AND b.`bp2` <> '');";
        $q = $this->doQuery($sqlTemp);
        return $q;
    }

    /**
     * Summary of getAllOpdXDiag
     * @return bool|mysqli_result
     */
    public function getAllOpdXDiag(){
        $q = $this->doQuery("SELECT * FROM `tempOpdXDiag`");
        return $q;
    }

    /**
     * Summary of getAgeMoreThan35
     * @return bool|mysqli_result
     */
    public function getAgeMoreThan35(){
        $q = $this->doQuery("SELECT * FROM `tempOpdXDiag` WHERE `age` > 35");
        return $q;
    }

    /**
     * Summary of getAgeLessThan35
     * @return bool|mysqli_result
     */
    public function getAgeLessThan35(){
        $q = $this->doQuery("SELECT * FROM `tempOpdXDiag` WHERE `age` <= 35");
        return $q;
    }

    /**
     * Summary of getBPLess140
     * @return bool|mysqli_result
     */
    public function getBPLess140(){
        $sql = "SELECT * 
        FROM `tempOpdXDiag` 
        WHERE ( `bp3` <> '' AND `bp4` <> '' ) 
        AND ( `bp3` NOT LIKE '..%' AND `bp4` NOT LIKE '..%' ) 
        AND ( `bp3` < 140 AND `bp4` < 90)";
        $q = $this->doQuery($sql);
        return $q;
    }

    public function getBPMore140(){
        $sql = "SELECT * 
        FROM `tempOpdXDiag` 
        WHERE ( `bp3` <> '' AND `bp4` <> '' ) 
        AND ( `bp3` NOT LIKE '..%' AND `bp4` NOT LIKE '..%' ) 
        AND ( `bp3` >= 140 AND `bp4` >= 90)";
        $q = $this->doQuery($sql);
        return $q;
    }

    public function getXrayXEkg($year){
        $sql = "SELECT a.*,b.*  
        FROM `tempOpdXDiag` AS a 
        LEFT JOIN ( 
            SELECT `row_id`,`date`,`hn`,`ptname`,`code`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn` 
            FROM `patdata` 
            WHERE `date` LIKE '$year%' 
            AND `hn` <> '' 
            AND ( `code` LIKE '41001%' OR `code` LIKE '%EKG%') 
            GROUP BY `hn`
        ) AS b ON a.`thdatehn` = b.`thdatehn` 
        WHERE b.`row_id` IS NOT NULL;";
        $q = $this->doQuery($sql);
        return $q;
    }

    public function generateTempResulthead($year){
        $sqlTemp = "CREATE TEMPORARY TABLE `tempResulthead` 
        SELECT b.autonumber,b.hn,b.patientname,CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',(SUBSTRING(b.`orderdate`,1,4)+543),b.`hn`) AS `thdatehn` 
        FROM (
            SELECT MAX(autonumber) AS latest_autonumber 
            FROM resulthead 
            WHERE orderdate LIKE '$year%' 
            AND profilecode IN ('CREAG','ALB','UMALB') 
            GROUP BY hn
        ) AS a 
        LEFT JOIN resulthead AS b ON b.autonumber = a.latest_autonumber
        ORDER BY b.autonumber ASC";
        $q = $this->doQuery($sqlTemp);
        return $q;
    }

    /**
     * Summary of getAlbumin ต้องการการเรียกใช้งาน generateTempOpdXDiag()
     * @return mysqli_result|string
     */
    public function getAlbumin(){
        $sql = "SELECT m.*,n.* FROM `tempOpdXDiag` AS m 
        LEFT JOIN ( 
                
            SELECT x.*,y.`labcode`,y.`labname`,y.`result`  
            FROM `tempResulthead` AS x
            LEFT JOIN `resultdetail` AS y ON x.`autonumber` = y.`autonumber` 
            WHERE y.`labcode` IN ('ALB','UMALB') 
            GROUP BY `hn`

        ) AS n ON m.`thdatehn` = n.`thdatehn`
        WHERE n.`autonumber` IS NOT NULL;";
        $q = $this->doQuery($sql);
        return $q;
    }

    public function getCREA(){
        $sql = "SELECT m.*,n.* FROM `tempOpdXDiag` AS m 
        LEFT JOIN ( 
            SELECT x.*,y.`labcode`,y.`labname`,y.`result`  
            FROM `tempResulthead` AS x
            LEFT JOIN `resultdetail` AS y ON x.`autonumber` = y.`autonumber` 
            WHERE y.`labcode` = 'CREA' 
            GROUP BY `hn`
        ) AS n ON m.`thdatehn` = n.`thdatehn`
        WHERE n.`autonumber` IS NOT NULL;";
        $q = $this->doQuery($sql);
        return $q;
    }
}
