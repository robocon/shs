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

        include("connect.inc");
        global $hn;
        $query = "SELECT row_id, hn,ptname,doctor,appdate,apptime,detail,patho,xray,other,date,(case when appdate = '".$select_day2."' then '#009966' else '#F5DEB3' end) AS color,injno FROM appoint WHERE hn = '$hn' ORDER BY date DESC ";
        $result = mysql_query($query) or die( mysql_error() );

        $items = array();
        // echo "<pre>";
        while( $item = mysql_fetch_assoc($result) ){

            $appdate = str_replace($months_key, $months_val, trim($item['appdate']));

            list($d, $m, $y) = explode(' ', $appdate);
            $new_date = strtotime(($y-543)."-$m-$d");
            $items[$new_date] = $item; // ��駤�����������������Ѻ sort ����ѹ�Ѵ
        }

        krsort($items); // ������§��������������

        foreach( $items as $key => $item){
            print (" <tr>\n".
            "  <td BGCOLOR='".$item['color']."'><A HREF=\"appinsert2.php?row_id=".$item['row_id']."\" target=\"_blank\">{$item['hn']}</A></td>\n".
            "  <td BGCOLOR='".$item['color']."'><A HREF=\"appdayprint.php?row_id=".$item['row_id']."\" target=\"_blank\">{$item['ptname']}</A></td>\n".
            "  <td BGCOLOR='".$item['color']."'>".substr($item['doctor'],6)."</td>\n".
            "  <td BGCOLOR='".$item['color']."'>{$item['appdate']}</td>\n".
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
