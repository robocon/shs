<form method="post" action="<?php echo $PHP_SELF ?>">
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ӹǹ���駷��Ѵ���ç��Һ��</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="hn" size="12"></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
    </form>

<table>
    <tr>
        <th bgcolor=CD853F>HN</th>
        <th bgcolor=CD853F>����-ʡ��</th>
        <th bgcolor=CD853F>ᾷ��</th>
        <th bgcolor=CD853F>�ѹ�Ѵ</th>
        <th bgcolor=CD853F>�Ѵ����</th>
        <th bgcolor=CD853F>���ҹѴ</th>
        <th bgcolor=CD853F>�ź</th>
        <th bgcolor=CD853F>�͡�����</th>
        <th bgcolor=CD853F>���</th>
    </tr>

    <?php
    If (!empty($hn)){

        $month["01"]="���Ҥ�";
        $month["02"]="����Ҿѹ��";
        $month["03"]="�չҤ�";
        $month["04"]="����¹";
        $month["05"]="����Ҥ�";
        $month["06"]="�Զع�¹";
        $month["07"]="�á�Ҥ�";
        $month["08"]="�ԧ�Ҥ�";
        $month["09"]="�ѹ��¹";
        $month["10"]="���Ҥ�";
        $month["11"]="��Ȩԡ�¹";
        $month["12"]="�ѹ�Ҥ�";

        $months_key = array(
            '���Ҥ�',
            '����Ҿѹ��',
            '�չҤ�',
            '����¹',
            '����Ҥ�',
            '�Զع�¹',
            '�á�Ҥ�',
            '�ԧ�Ҥ�',
            '�ѹ��¹',
            '���Ҥ�',
            '��Ȩԡ�¹',
            '�ѹ�Ҥ�',
        );

        $months_val = array(
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12',
        );

        $day_now = date("d");
        $month_now = date("m");
        $year_now = (date("Y")+543);

        $select_day2 = $day_now." ".$month[$month_now]." ".$year_now;

///�ǡ�ѹ�����������ա 1 �ѹ
$timestamp = strtotime ( "+1 days" );       
$newtimestamp=date ( "Y-m-d", $timestamp);
list($ty,$tm,$td)=explode("-",$newtimestamp);
$ty=$ty+543;
$select_tomorow = $td." ".$month[$tm]." ".$ty;

	
        include("connect.inc");
        global $hn;
        $query = "SELECT a.`row_id`,a.`hn`,a.`ptname`,a.`doctor`,a.`appdate`,a.`apptime`,a.`detail`,a.`patho`,a.`xray`,a.`other`,a.`date`,a.`injno`, 
		CASE WHEN `appdate` = '".$select_day2."'  THEN '#009966' 
		    WHEN `appdate` = '".$select_tomorow."'  THEN '#FF6699' ELSE '#F5DEB3' 
		END AS `color`  
        FROM `appoint` AS a 

        RIGHT JOIN (
            SELECT MAX(`row_id`) AS `row_id` 
            FROM `appoint` 
            WHERE `hn` = '$hn' 
            GROUP BY `appdate`
        ) AS b ON b.`row_id` = a.`row_id` 

        ORDER BY a.`date` DESC ";
        // echo "<pre>";
		// var_dump($query);
        $result = mysql_query($query) or die( mysql_error() );
        $items = array();
        $i=1;
        echo "<pre>";
        while( $item = mysql_fetch_assoc($result) ){
            
            list($testAppDate, $appTime) = explode(' ', $item['date']);
            
            //
            if( !preg_match('/\d+\-\d+\-\d+/', $item['appdate']) ){
                $appdate = str_replace($months_key, $months_val, trim($item['appdate']));
                list($d, $m, $y) = explode(' ', $appdate);
                
            }else{
                list($y, $m, $d) = explode('-', $item['appdate']);
                
            }

            // $appoint_date = strtotime(($y-543)."-$m-$d $appTime");
            $new_date = strtotime(($y-543)."-$m-$d $appTime");
            $items[$new_date] = $item; // ��駤�����������������Ѻ sort ����ѹ�Ѵ
            $i++;
        }

        krsort($items); // ������§��������������
        
        foreach( $items as $key => $item){
            print (" <tr>\n".
            "  <td BGCOLOR='".$item['color']."'><A HREF=\"appinsert2.php?row_id=".$item['row_id']."\" target=\"_blank\">{$item['hn']}</A></td>\n".
            "  <td BGCOLOR='".$item['color']."'><A HREF=\"appdayprint.php?row_id=".$item['row_id']."\" target=\"_blank\">{$item['ptname']}</A></td>\n".
            "  <td BGCOLOR='".$item['color']."'>".substr($item['doctor'],6)."</td>\n".
            "  <td BGCOLOR='".$item['color']."' title=\"�͡㺹Ѵ����� {$item['date']}\">{$item['appdate']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['detail']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['apptime']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['patho']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['xray']}</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['other']}{$item['injno']}</td>\n".
            " </tr>\n");
        }
    }
    ?>
</table>
