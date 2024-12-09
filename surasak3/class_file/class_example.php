<?php
require_once dirname(__FILE__).'/database.php';

class Example extends DbConnect{
    public $dbi = null;
    function __construct()
    {
        parent::__construct();
    }
}