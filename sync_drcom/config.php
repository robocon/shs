<?php
if ( !defined('EXTENDED_ABLE') ) { exit; }

session_start();

class DBC{

    public $dbc = false;
    public $q = false;

    public function connect($host, $user, $pass, $db, $names = false){
        
        $this->dbc = mysql_connect($host,$user,$pass);
        if( $this->dbc === false ){
            set_error_log(mysql_error());
            exit;
        }else{
            mysql_select_db($db, $this->dbc);
            if( $names !== false ){
                mysql_query("SET NAMES $names", $this->dbc);
            }
        }
        

    }

    public function query($sql){
        $this->q = mysql_query($sql, $this->dbc);
        if( $this->q === false ){
            set_error_log(mysql_error());
        }
    }

    public function fetch(){
        
        $items = array();
        if( $this->q !== false ){
            while ( $item = mysql_fetch_assoc($this->q) ) {
                $items[] = $item;
            }
        }

        if( count($items) === 0 ){
            $items = false;
        }
        
        return $items;
    }

    public function fetch_single(){
        $item = false;
        if( $this->q != false ){
            $item = mysql_fetch_assoc($this->q);
        }
        return $item;
    }

    public function rows(){
        $rows = false;
        if( $this->q != false ){
            $rows = mysql_num_rows($this->q);
        }
        return $rows; 
    }

    public function get_last_id(){
        $id = (int) mysql_insert_id($this->dbc);
        return $id;
    }

}

class DRDB extends DBC{

    function __construct(){
        // $this->connect('test-mysql', 'surasak', '1234', 'sync');
        $this->connect('192.168.1.4', 'surasak', '1234', 'sync', 'UTF8');
    }

}

class SHSDB extends DBC{

    function __construct(){
        // $this->connect('test-mysql', 'root', '1234', 'smdb_drcom', 'TIS-620');
        $this->connect('localhost', 'root', '1234', 'smdb_drcom');
    }

}