<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New' size='3'>�ѹ��� $today  ��ª��ͤ�������ѵ����  ���͵�Ǩ���������ä";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
    <tr>
        <th bgcolor=6495ED>#</th>
        <th bgcolor=6495ED>����</th>
        <th bgcolor=6495ED>����</th>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>AN</th>
        <th bgcolor=6495ED>VN</th>
        <th bgcolor=6495ED>Ἱ�</th>
        <th bgcolor=6495ED>��¡��</th>
        <th bgcolor=6495ED>����Թ</th>
        <th bgcolor=6495ED>�����Թ</th>
        <th bgcolor=6495ED>�Է��</th>
        <th bgcolor=6495ED>������</th>
    </tr>
<?php
//    $detail="�����";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT a.date,a.ptname,a.hn,a.an,a.depart,a.detail,a.price,a.paid,a.row_id,a.accno,a.ptright,a.tvn,b.`goup`, 
    SUBSTRING(a.`ptright`,1,3) AS `ptRightCode` 
    FROM depart AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.date LIKE '$today%' 
    AND a.depart='DENTA' ";
    $result = mysql_query($query) or die("Query failed");
    $lists = array();
    $ptLists = array();
    $totalpri = 0;
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$tvn,$goup,$ptRightCode) = mysql_fetch_row ($result)) { 

        $num++;
        $time=substr($date,11);
        $totalpri=$totalpri+$price;

        if(empty($lists[$goup])){
            $lists[$goup]['count'] = 1;
            $lists[$goup]['price'] = (int)$price;
        }else{
            $lists[$goup]['count']++;
            $lists[$goup]['price'] += (int)$price;
        }

        $ptKey = trim($ptRightCode);

        if(empty($ptLists[$ptKey])){
            $ptLists[$ptKey]['count'] = 1;
            $ptLists[$ptKey]['price'] = (int)$price;
        }else{
            $ptLists[$ptKey]['count']++;
            $ptLists[$ptKey]['price'] += (int)$price;
        }
        

        print (" <tr>\n".
        "  <td BGCOLOR=66CDAA>$num</td>\n".
        "  <td BGCOLOR=66CDAA>$time</td>\n".
        "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
        "  <td BGCOLOR=66CDAA>$hn</td>\n".
        "  <td BGCOLOR=66CDAA>$an</td>\n".
        "  <td BGCOLOR=66CDAA>$tvn</td>\n".
        "  <td BGCOLOR=66CDAA>$depart</td>\n".
        "  <td BGCOLOR=66CDAA>$detail</td>\n".
        "  <td BGCOLOR=66CDAA>$price</td>\n".
        "  <td BGCOLOR=66CDAA>$paid</td>\n".
        "  <td BGCOLOR=66CDAA>$ptright</td>\n".
        "  <td BGCOLOR=66CDAA>$goup</td>\n".
        " </tr>\n");
    }
   
    
?>
</table>
<?php 
print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
?>
<p style="margin-bottom: 0;"><b>��ػ����������ͧ��������ԡ��</b></p>
<table>
    <tr>
        <td bgcolor="6495ED">������</td>
        <td bgcolor="6495ED">�ʹ���(��)</td>
        <td bgcolor="6495ED">�����������(�ҷ)</td>
    </tr>
<?php
foreach ($lists as $name => $item) {
    ?>
    <tr>
        <td bgcolor="66CDAA"><?=$name;?></td>
        <td align="right" bgcolor="66CDAA"><?=$item['count'];?></td>
        <td align="right" bgcolor="66CDAA"><?=number_format($item['price'],2);?></td>
    </tr>
    <?php
}
?>
</table>

<p style="margin-bottom: 0;"><b>��ػ����Է�ԡ���ѡ�Ңͧ��������ԡ��</b></p>
<table>
    <tr>
        <td bgcolor="6495ED">�Է�ԡ���ѡ��</td>
        <td bgcolor="6495ED">�ʹ���(��)</td>
        <td bgcolor="6495ED">�����������(�ҷ)</td>
    </tr>
<?php
foreach ($ptLists as $ptName => $item) { 
    
    $q = mysql_query("SELECT CONCAT(`code`, ' ', `name`) AS `ptrightName` FROM `ptright` WHERE `code` = '$ptName' ") or die(mysql_error());
    $ptright = mysql_fetch_assoc($q);

    ?>
    <tr>
        <td bgcolor="66CDAA"><?=$ptright['ptrightName'];?></td>
        <td align="right" bgcolor="66CDAA"><?=$item['count'];?></td>
        <td align="right" bgcolor="66CDAA"><?=number_format($item['price'],2);?></td>
    </tr>
    <?php
}

include("unconnect.inc");
?>
</table>