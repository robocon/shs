<?php
include_once dirname(__FILE__).'/database.php';
class Labcare extends DbConnect
{
    public $dbi = null;
    public function __construct()
    {
        parent::__construct();
    }

    public function getLabCode($code=''){
        $sql = sprintf("SELECT * FROM `labcare` WHERE ( `code` LIKE '%s%%' OR `codex` LIKE '%s%%' OR `codelab` LIKE '%s%%') ", 
        $this->dbi->real_escape_string($code), 
        $this->dbi->real_escape_string($code), 
        $this->dbi->real_escape_string($code));
        $q = $this->dbi->query($sql);
        $items = false;
        if($q->num_rows>0){
            
            while ($a = $q->fetch_assoc()) {
                $items[] = $a;
            }
        }
        return $items;
    }
}