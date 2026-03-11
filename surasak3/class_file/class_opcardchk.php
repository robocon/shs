<?php
include_once dirname(__FILE__).'/database.php';
class Opcardchk extends DbConnect
{
    public $dbi = null;
    public function __construct()
    {
        parent::__construct();
    }

    public function getComanyNameFromId($chk_company_id){
        return false;
    }
    public function getPreVnUser($hn, $chk_company_id){
        return false;
    }
    public function getUserFromHnAndCompany($hn, $part){
        return false;
    }
}