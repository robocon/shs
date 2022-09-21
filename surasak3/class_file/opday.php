<?php
// require_once '../bootstrap.php';
class Opday
{
    private $dbi = false;
    public function __construct()
    {
        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function getThisDay($hn)
    {
        $thDateHn = date('d-m-').(date('Y')+543).$hn;
        $q = $this->dbi->query("SELECT * FROM opday WHERE thdatehn = '$thDateHn' ");
        return $q->fetch_assoc();
    }

    public function getAllDay()
    {

    }
}
?>