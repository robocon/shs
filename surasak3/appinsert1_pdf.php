<?php
session_start();
?>
<body>
<html>
<head>
<title>㺹Ѵ������ þ.��������ѡ��������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<?php
function jschars($str){
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

if (isset($cHn )){ 

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    
    include("connect.inc");
    
    if($detail=="FU13 ��Ǩ�к��ҧ�Թ�����"){
        $detail2=$detail_list;
    }

	if(!isset($appd) OR $appd == null){
		$appd = $_POST['appd'];
	}else{
		$appd = $appd;
	}
   
	$patho = "NA";

    $xray=$xray.' '.$xray2;
    $xrayall=$xray.' '.jschars($xray2);

	$count = count($_SESSION["list_code"]);

    if($count > 0){
    
        $sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
            
        $list = array();
        for ($n=0; $n<$count; $n++){
            If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
                array_push($list,$q);
            }
        }
            
        $sql .= implode(", ",$list);
        $result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
        $patho = implode(", ",$_SESSION["list_code"]);
    }

    $pathoall=$patho.' '.$patho2;

	$sqltel = "update opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
	$result = mysql_query($sqltel);
	
	
    $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
detail,detail2,advice,patho,xray,other,depcode,labextra)
VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',
'$room','$detail','".jschars($detail2)."','$advice','$pathoall','$xrayall','".jschars($other)."','$depcode','".jschars($labm)."');";

    $result = mysql_query($sql);
    $idno = mysql_insert_id();

    $count = count($_SESSION["list_code"]);

    if($count > 0){
    
        $sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
            
        $list = array();
        for ($n=0; $n<$count; $n++){
            If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
                array_push($list,$q);
                
            }
        }
            
        $sql .= implode(", ",$list);
    
        $result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
        $patho = implode(", ",$_SESSION["list_code"]);
    }

    $pathoall=$patho.' '.$patho2;

//�����㺹Ѵ
////////////////////////

    $exm = explode(" ",$appd);
    
    $d1 = $exm[0]; 
    $m1 = trim($exm[1]); 
    $y1 = $exm[2]-543; 
    
    $arr1 = array("���Ҥ�" => "01" ,"����Ҿѹ��" => "02", "�չҤ�" => "03" , "����¹" => "04" ,"����Ҥ�" => "05" ,"�Զع�¹" => "06" , "�á�Ҥ�" => "07" , "�ԧ�Ҥ�" => "08" , "�ѹ��¹" => "09" , "���Ҥ�"  => "10" , "��Ȩԡ�¹" => "11" ,  "�ѹ�Ҥ�" => "12" );
    
    $appday = $y1.'-'.$arr1[$m1].'-'.$d1;
    
    $DayOfWeek = date("w", strtotime($appday));

	
    switch ($DayOfWeek) {
    case "0":
        $day="�ҷԵ��";
        break;
    case "1":
        $day="�ѹ���";
        break;
    case "2":
        $day="�ѧ���";
        break;
    case "3":
        $day="�ظ";
        break;
    case "4":
        $day="����ʺ��";
        break;
    case "5":
        $day="�ء��";
        break;
    case "6":
        $day="�����";
        break;
    }
    
    if($detail=="FU05 ��ҵѴ"){
        $wardor=substr($depcode,4);//ward or
        $timeor= $_POST["time1"].":".$_POST["time2"].":00";//time or
        $sqlor = "INSERT INTO `set_or` ( `ward` , `hn` , `an` , `ptname` , `age` , `ptright` , `diag` , `surg` , `doctor` , `inhalation_type` , `date_surg` , `time` , `officer` , `comment` ) VALUES ('".$wardor."', '".$cHn."', '', '".$cPtname."', '".$cAge."', '".$cptright."', '".$ordetail1."', '".$ordetail2."', '".$cdoctor."', '".$ordetail3."', '".$date_surg."', '".$timeor."', '".$sOfficer."', '".$ordetail4."')";
        mysql_query($sqlor);
    }
///////////////////////
 
    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    
    print "<p class='size5 center'><b>㺹Ѵ������ �ç��Һ�Ť�������ѡ�������� �ӻҧ</b></p>";
    print "<p class='size2 center'>FR-NUR-003/2,04, 25 �.�. 54</p>";
    
    print "<p class='size4'><b>����:</b> $cPtname <b>HN:</b> $cHn <b>����:</b> $cAge <b>�Է��:</b> $cptright</p>";
    print "<p class='size3'><b>�����˵�: <u>$cidguard</u></b></p>";
    print "<p class='size5' style=\"line-height: 36px;\"><b><u>�Ѵ��: �ѹ$day ��� $appd<br>����: $capptime</u></b></p>";
    print "<p class='size4'><b><u>���㺹Ѵ���: $room</u></b>&nbsp;<b>����:</b> $detail".( $detail2 != "" ? "($detail2)" : "" )."</p>";
    
    if ($detail != 'NA') { 
        // print "&nbsp;<p class='size4'><b>����:</b> $detail".( $detail2 != "" ? "($detail2)" : "" )."</p>";
        print "<p class='size3'><b>ᾷ����Ѵ:</b> $cdoctor</p>";
    }
    
    if ($advice != 'NA') {
        print "<p><b>����й�:</b> $advice</p>";
    }
    
    if (trim($pathoall) != 'NA') {
        print "<p><b>��Ǩ��Ҹ�:</b> $pathoall</p>";
    }
    
    if (!empty($labm)) { 
        print "<p><b>����觾����:</b> $labm</p>";
    }
    
    if (trim($xray) != 'NA') {
        print "<p><b>��Ǩ�͡�����:</b> $xray</p>";
    }
    
    if (!empty($other)) { 
        print "<p><b>����:</b> $other</p>";
    }
    
    print "<p><b>����͡㺹Ѵ:</b> $sOfficer, $depcode <b>�ѹ������ҷ���͡㺹Ѵ:</b> $Thaidate</p>"; 
    
    if ($detail =='FU01 ��Ǩ����Ѵ' OR $detail == 'FU11 ��Ǩ����Ѵ���������ѵԼ������' OR $detail == 'FU14 ������ʹ��辺ᾷ��' ){
        // print "<br>";
        print "��س��ҵç����ѹ������ҹѴ <b>��ҼԴ�Ѵ</b> ������㺹Ѵ���Ἱ�����¹<br>";
        print "<b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br>";
        print "��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100, 1125</b></p>"; 
    }else if ($detail =='FU02 ����ŵ�Ǩ' ){
        print "��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; 
    }else if ($detail =='FU03 �͹�ç��Һ��') { 
        print "�����¹Ѵ�͹�ç��Һ��������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;
    ��س��ҵç����ѹ������ҹѴ <br>  ������͡��÷���ͧ����ç��Һ�� �� ���Һѵû�Шӵ�� , ˹ѧ����Ѻ�ͧ�Է�Ե�ҧ�  &nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
    }else if ($detail =='FU04 �ѹ�����') { 
        print "1.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ����� &nbsp;&nbsp;
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B> <br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> 
    ��ѹ�����Ҫ��� �� 054-839305-6 ��� 1230</b>"; 
    }else if ($detail =='FU05 ��ҵѴ') { 
        print "1.�����¹Ѵ��Ǩ��ҵѴ������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b> "; 
    }else if ($detail =='FU06 �ٵ�') { 
        print "1.�����¹Ѵ��Ǩ�ٵ�������㺹Ѵ���Ἱ�����¹ &nbsp;&nbsp;
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<b> </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� �� 054-839305-6 ��� 5111 </b>";  
    }else if ($detail =='FU07 ��չԡ�ѧ���'){ 
        print "
        1.�Ӥ������Ҵ��ҧ���������º����&nbsp;&nbsp;
        2.�Ѻ��зҹ������������� <br> 
        3.�������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br> 
        4.�����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���<br>
        5.������� 1 �����ѧ�ѧ������� ����ա�á����¹��&nbsp;&nbsp;
        6.��س��ҵç����ѹ������ҹѴ&nbsp;<br>  <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ���  �� 054-839305-6 ��� 8004 ,7253</b>";
        }else if ($detail =='FU08 Echo'){ 
        print "1.�����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ &nbsp;&nbsp;
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>";  
    }else if ($detail =='FU09 ��š�д١'){ 
        print "1.�����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ&nbsp;&nbsp;
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; </B><br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125</b>"; 
    }else if ($detail =='FU12 �ǴἹ��'){ 
        
        print "
        1. �óչѴ���� �ҡ�Ҫ���Թ 10 �ҷ� ���������駢�ʧǹ�Է���������Ѻ��ԡ�÷�ҹ������Ѻ��ԡ�á�͹<BR>
        2. �ҡ��ҹ���ҡ�� �� �纤� �� ��͹���� ��駴��ùǴ<br>
        3. �ҧ�ç��Һ���������ö�Ѻ�Դ�ͺ��觢ͧ�դ�Ңͧ��ҹ��<BR>
        <B>�����Ţ���Ѿ�� 054-839305-6 ��� 8002</B>
        ";  
    
    }else if ($detail =='FU10 ����Ҿ'){ 
        print "
    1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ &nbsp;&nbsp;<BR>
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    3.<b>��ҼԴ�Ѵ </b>������駷ҧἹ�����Ҿ�ӺѴ &nbsp;<br><b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8000</b>"; 
    }else if ($detail =='FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���鹿�'){ 
        print "
    1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ &nbsp;&nbsp;<BR>
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp;<br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8001 ���� 8000 </b>"; 
    }else if ($detail =='FU24 ��Ǩ����Ѵ OPD �ѡ��(��)'){ 
        print "
    1.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    2.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp;<br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 2111</b>"; 
    }else if ($detail =='FU25 CT Scan'){ 
        print "
        1.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
        2.�Դ��ͨش�Ѵ ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305 ��� 1100 , 1125<BR>
        * ��������ӡ�õ�Ǩ���ʹ���� ";
    }else if ($detail =='FU31 OPD PM&R'){ 
        print "
    1.�����¹Ѵ��Ǩ������㺹Ѵ������Ҿ�ӺѴ ���2 &nbsp;&nbsp;<BR>
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; <br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8002</b>"; 
    }else if($detail =='FU32 �Ѵ��ǨBMD'){ 
        print "
    1.�����¹Ѵ��Ǩ������㺹Ѵ�����ͧ�͡����� &nbsp;&nbsp;<BR>
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; <br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 8002</b>"; 
    }else if($detail =='FU19 ��ŵ��ҫ�Ǵ�'){ 
        print "
    1.�����¹Ѵ��Ǩ������㺹Ѵ�����ͧ������� &nbsp;&nbsp;<BR>
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; <br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 1140</b>";
    }else if($detail =='FU37 ��Ǩ IVP'){ 
        print "
    1.�����¹Ѵ��Ǩ������㺹Ѵ�����ͧ������� &nbsp;&nbsp;<BR>
    2.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    3.<b>��ҼԴ�Ѵ </b>���㺹Ѵ���Ἱ�����¹ &nbsp; <br>
	4.<b>�����·������ ����÷��� </b>��س������˹�ҷ���ѧ�ա�����͹ &nbsp; <br>
    <b>�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 1 �ѹ�ӡ��<br> ��ѹ�����Ҫ��� ���� 09.00 �. - 15.00 �. �� 054-839305-6 ��� 1140</b>";     	     
	}else{ 
        print "
    1.��س��ҵç����ѹ������ҹѴ&nbsp;<BR>
    2.�Դ��ͨش�Ѵ ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305 ��� 1100 , 1125"; 
    }

    // include("unconnect.inc");
    // session_unregister("cHn");  
    // session_unregister("cPtname");
    // session_unregister("cAge");
    
} else { // If not HN
        
    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    
    print "<p class='size5'>&nbsp;&nbsp;<b>>>>>>>>>㺹Ѵ������<<<<<<<<</b><br>";
    print "<p class='size1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";
    print "<p class='size3'&nbsp;&nbsp;>>>>>�ç��Һ�Ť�������ѡ��������  �ӻҧ  �� 054 - 839305 - 6 <<<<<br>";
    print "<b><p class='size3'>����:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<B>�Է��:$cptright<u>$cidguard</u></p></B><br>";
    print "<b><p SIZE=4><U>�Ѵ��: �ѹ$day ��� $appd &nbsp;&nbsp;&nbsp;</U> </p></b><b> ����:</b> $capptime<br>";
    print "<b>�Ѵ�ҷ����ͧ:</b>&nbsp; $room";
    print "&nbsp;&nbsp;&nbsp;<b>ᾷ����Ѵ:</b>&nbsp; $cdoctor<br>";
    
    if ($detail !='NA') { 
    print "<b>����:</b>&nbsp; $detail";
    }
    
    if (!empty($detail2)) { 
    print "<b>:</b>&nbsp; $detail2<br>";
    }
    
    if ($advice != 'NA') {
    print "<b>����й�:</b> &nbsp;$advice<br>";
    }
    
    if ($patho != 'NA') {
    print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho<br>";
    }
    
    if ($xray != 'NA') {
    print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";
    }
    
    if (!empty($other)) { 
    print "<b>��Ǩ:</b>&nbsp; $other<br>";
    }
    
    print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
    print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
    print "<b>�����˵�: <u>$cidguard</u></b><BR>1.�����¹Ѵ��Ǩ���㺹Ѵ���ش��ԡ�ùѴ &nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ </b>������Ἱ�����¹ &nbsp; </B><br>3.�����¹Ѵ��ҵѴ �͹ ����ٵ� ������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;4.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ�����<br>5.5.�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ����ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125 "; 
    die("");
} // End else
?>