<?php
if ( !defined('EXTENDED_ABLE') ) { exit; }

session_start();

/**
 * CONNECTION 
 * ����� Query �Ѻ Drcom ���� $drcom �� link_identifier ��
 * mysql_query('// Do some select', $drcom)
 *
 * ���� Query �Ѻ þ. ���� $shs
 * 
 * ��ҹ��� http://php.net/manual/en/function.mysql-query.php
 */
// $drcom = mysql_connect('test-mysql','root','1234') or die( mysql_error() );
// mysql_select_db('sync', $drcom );
// mysql_query("SET NAMES UTF8", $drcom) or die( mysql_error() );

// $shs = mysql_connect('test-mysql','root','1234') or die( mysql_error() );
// mysql_select_db('smdb_drcom', $shs);

// // !!!! ���ѧ�͹��Ң���Կ����� !!!! �ҧ���ѹ�������ҹ
// mysql_query("SET NAMES TIS620", $shs) or die( mysql_error() );

class DBC{

    public $dbc = false;
    public $q = false;

    public function connect($host, $user, $pass, $db, $names = false){
        
        $this->dbc = mysql_connect($host,$user,$pass) or die( mysql_error() );
        mysql_select_db($db, $this->dbc);
        if( $names !== false ){
            mysql_query("SET NAMES $names", $this->dbc);
        }

    }

    public function query($sql){
        $this->q = mysql_query($sql, $this->dbc);
        if( $this->q === false ){
            $this->set_error_log( mysql_error() );
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
        return mysql_fetch_assoc($this->q);
    }

    public function rows(){
        return mysql_num_rows($this->q);
    }

    public function get_last_id(){
        $id = (int) mysql_insert_id($this->dbc);
        return $id;
    }

    public function set_error_log($txt){
        file_put_contents(ROOT_DIR.'error_log.log', $txt."\n", FILE_APPEND);
    }
}

class DRDB extends DBC{

    function __construct(){
        $this->connect('192.168.1.4', 'surasak', '1234', 'sync');
    }

}

class SHSDB extends DBC{

    function __construct(){
        $this->connect('localhost', 'root', '1234', 'smdb_drcom', 'TIS-620');
    }

}