<?php 
require_once dirname(__FILE__).'/database.php';
class ReportHt extends DbConnect
{
    private $qOpdXDiag = false;
    public function __construct()
    {
        parent::__construct();
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
        $this->qOpdXDiag = $this->dbi->query($sqlTemp);
        return $this->qOpdXDiag;
    }

    /**
     * Summary of getAllOpdXDiag
     * @return bool|mysqli_result
     */
    public function getAllOpdXDiag(){
        $q = $this->dbi->query("SELECT * FROM `tempOpdXDiag`");
        return $q;
    }

    /**
     * Summary of getAgeMoreThan35
     * @return bool|mysqli_result
     */
    public function getAgeMoreThan35(){
        $q = $this->dbi->query("SELECT * FROM `tempOpdXDiag` WHERE `age` > 35");
        return $q;
    }

    public function getAgeLessThan35(){
        $q = $this->dbi->query("SELECT * FROM `tempOpdXDiag` WHERE `age` <= 35");
        return $q;
    }
}
