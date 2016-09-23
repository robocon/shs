<?php
include '../bootstrap.php';

// Override Connect
// $Conn = mysql_connect('localhost', '43user', '1234') or die( mysql_error() );
// mysql_select_db('smdb', $Conn) or die( mysql_error() );

// $thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
// '05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
// '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');



if( $action === false ){
?>
	<div>
		<a href="../../nindex.htm">&lt;&lt;&nbsp;��Ѻ�˹������</a> | <a href="export_new43.php">˹����ѡ 43���</a>
	</div>
	<div>
		<h3>���͡43���</h3>
		<p>�Ѿഷ੾�� ��� charge_ipd </p>
	</div>
	<form action="specialpp.php" method="post">
		<div>
			�� <input type="text" name="dateSelect">
			<span style="color: red">* ������ҧ 2559-01</span>
		</div>
		<div>
			<button type="submit">���͡</button>
			<input type="hidden" name="action" value="export">
		</div>
	</form>

    <?php
    $pp_lists = array();
    function find_txt($path){
        global $pp_lists;
        foreach( glob($path.'/*') as $fname ){
            if( is_dir($fname) ){
                find_txt($fname);
            }else{
                if( preg_match('/specialpp\.csv/', $fname) ){
                    $pp_lists[] = $fname;
                }
            }
        }
    }

    find_txt('export');
    ?>
    <div>
        <ul>
        <?php
        foreach( $pp_lists as $key => $file ){
            // $match = preg_match('/(\w+\.csv)/', $file, $matchs);
            // if( $match !== false ){
                $name = $matchs['1'];
                ?>
                <li><a href="<?=$file;?>" target="_blank"><?=$file;?></a></li>
                <?php
            // }
        }
        ?>
        </ul>
    </div>
<?php
} else if( $action === 'export' ){
	
	$dateSelect = input_post('dateSelect');
	
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>͹حҵ������ٻẺ ��-��͹ �� 2559-04 ��ҹ��</p>
		<a href="specialpp.php">��͹��Ѻ</a>
		<?php
		exit;
	}
	list($thiyr, $rptmo) = explode('-', $dateSelect);

	$dirPath = "export/$thiyr/$rptmo";
	
	if( !is_dir("export/$thiyr") ){
		mkdir("export/$thiyr", 0777);
	}
	
	if( !is_dir($dirPath) ){
		mkdir($dirPath, 0777);
	}
	
	// define default val
	// $newyear = "$thiyr$rptmo$day";
	$thimonth = "$thiyr-$rptmo"; // e.g. 2559-05
	$yrmonth = ( $thiyr - 543 )."-$rptmo"; // e.g. 2016-05
	$yy = 543;

	$HOSPCODE = '11512';
    $SERVPLACE = '1';
	$zipLists = array();
	$qofLists = array();

    $db = Mysql::load();

    /*
    $sql = "SELECT `name`, `doctorcode`, SUBSTRING(`name`, 1, 5) AS `namecode`
    FROM `doctor` 
    WHERE `status` = 'y'";
    $db->select($sql);
    $items = $db->get_items();
    $doctors = array();
    foreach( $items as $key => $item ){
        $key = md5($item['namecode']);
        if( empty($item['doctorcode']) ){
            $item['doctorcode'] = '00000';
        }
        $doctors[$key] = $item;
    }
    */

	//��� 41 SPECIALPP
    $sql = "SELECT a.`date`, a.`hn`, a.`tvn`, 
    # YYYYMMDD
    CONCAT((SUBSTRING( a.`date`, 1, 4 ) - 543), SUBSTRING( a.`date`, 6, 2 ), SUBSTRING( a.`date`, 9, 2 )) AS `date_serv`,
    # HHIISS
    CONCAT(SUBSTRING( a.`date`, 12, 2 ), SUBSTRING( a.`date`, 15, 2 ), SUBSTRING( a.`date`, 18, 2 )) AS `time`,
    # Docter Code
    SUBSTRING( a.`doctor`, 1, 5) AS `dt_code`, 
    b.`idcard`, 
    TRIM( a.`idname` ) AS `idname`, 
    c.`icd10` 
    FROM `depart` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
    LEFT JOIN `opday` AS c ON c.`thdatehn` = CONCAT( SUBSTRING( a.`date`, 9, 2 ),'-', SUBSTRING( a.`date`, 6, 2 ),'-', SUBSTRING( a.`date`, 1, 4 ), a.`hn`)  
    WHERE a.`date` LIKE '$dateSelect%' 
    AND a.`staf_massage` != '' 
    AND a.`status` = 'Y' 
    GROUP BY a.`hn`, `date_serv`
    ORDER BY `date_serv`, `time`";
    // dump($sql);
    // exit;
    $db->select($sql);
    $items = $db->get_items();
    
    // �ԡ�Ţᾷ��Ἱ��仡�͹
    $staff = array(
        '�ѭ��Ǵ� ����ѵ��' => '1038',
        '���Ծ� �Թ�ѹ' => '1272',
        '�Ҥ���� ���ط��ǧ��' => '714',
        '�.�.˷���ѵ�� ��Ūԧ���' => '2252'
    );

    $header = "HOSPCODE|PID|SEQ|DATE_SERV|SERVPLACE|PPSPECIAL|PPSPLACE|PROVIDER|D_UPDATE\r\n";
    $txt = '';
    foreach ($items as $key => $item) {
        
        $PID = trim($item['hn']);
        $SEQ = $item['date_serv'].(sprintf('%08d', trim($item['tvn'])));
        $DATE_SERV = $item['date_serv'];
        $SERVPLACE = '1';
        $PPSPECIAL = $item['icd10'];
        $PPSPLACE = $HOSPCODE;

        $hn = str_replace('-', '', trim($item['hn']));
        
        $D_UPDATE = $item['date_serv'].$item['time'];

        $find_key = $item['idname'];
        if( isset($staff[$find_key]) ){
            $dr_code = $staff[$find_key];
        }else{
            $dr_code = 00000;
        }
        
        $PROVIDER = $item['date_serv'].(sprintf('%07d', $dr_code));
        
        // $txt .= "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$SERVPLACE|$PPSPECIAL|$PPSPLACE|$PROVIDER|$D_UPDATE\r\n";

        $txt .= '"'.$HOSPCODE.'","'.$PID.'","'.$SEQ.'","'.$DATE_SERV.'","'.$SERVPLACE.'","'.$PPSPECIAL.'","'.$PPSPLACE.'","'.$PROVIDER.'","'.$D_UPDATE.'"'."\r\n";
    }
    // print_r($txt);
    // exit;

    // $filePath = $dirPath.'/specialpp.txt';
    // file_put_contents($filePath, $txt);
    
    // $qofPath = $dirPath.'/qof_specialpp.txt';
    // file_put_contents($qofPath, $header.$txt);

    $filePath = $dirPath.'/specialpp.csv';
    file_put_contents($filePath, $txt);

    echo "<p><b>���͡��������� SPECIALPP �� $thiyr ��͹ {$def_fullm_th[$rptmo]}</b></p>";
    echo '<p><a href="'.$filePath.'" target="_blank">�����Ŵ���</a></p>';
	// echo '<p><a href="'.$filePath.'" target="_blank">�����Ŵ���</a></p>';
	// echo '<p><a href="'.$qofPath.'" target="_blank">�����Ŵ�������Ѻ QOF</a></p>';
	echo '<p><a href="specialpp.php">&lt;&lt;&nbsp;��Ѻ�˹����¡��</a></p>';
}