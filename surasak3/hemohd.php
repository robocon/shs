<?
session_start();
if(isset($_GET["action"]) && $_GET["action"] != ""){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");
if(isset($_GET["action"]) && $_GET["action"] != ""){
	
    $tvn=$_GET["action"];
    if(!empty($tvn)){
		$today = date("d-m-Y");   
        $d=substr($today,0,2);
        $m=substr($today,3,2);
        $yr=substr($today,6,4) +543;  
        $thdatevn=$d.'-'.$m.'-'.$yr.$tvn;
			
	$sql = "Select `hn`,`ptname`,`ptright` From opday where thdatevn = '".$thdatevn."' limit 1 ";
	$result = mysql_query($sql);
		list($hn,$ptname,$ptright) = mysql_fetch_row($result);
		echo "$ptname ($hn) $ptright";
		exit();
	}
}

if($_POST["act"]=="add"){
	$count = count($_POST["list_hn"]);
	$diag=$_POST["diag"];
	$doctor=$_POST["doctor"];
	$code=$_POST["code"];
	$detail=$_POST["detail"];	
	$detaildepart=$_POST["detaildepart"];		
	$item=$_POST["item"];
	$amount=$_POST["amount"];	
	$depart=$_POST["depart"];
	$part=$_POST["part"];
	$status=$_POST["status"];	
	
	if($_POST["outlay"]=="2000"){
		$sumprice =$_POST["outlay"];
		$yprice=2000;
		$nprice=0;			
	}else if($_POST["outlay"]=="1500"){
		$sumprice =$_POST["outlay"];
		$yprice=1500;
		$nprice=0;		
	}else if($_POST["outlay"]=="500"){
		$sumprice =$_POST["outlay"];	
		$yprice=0;
		$nprice=500;			
	}

	for($i=0;$i<$count;$i++){
		$today = date("d-m-Y");   
        $d=substr($today,0,2);
        $m=substr($today,3,2);
        $yr=substr($today,6,4) +543;  
        $thdatevn=$d.'-'.$m.'-'.$yr.$_POST["list_hn"][$i];
		$newdate ="$yr-$m-$d ".date("H:i:s");
		
	$sql="select hn, vn, ptname, ptright from opday where thdatevn='$thdatevn' and vn='".$_POST["list_hn"][$i]."' ";
	//echo $sql."<br>";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num."<br>";
		if($num >= 1){
			$rows=mysql_fetch_array($query);
			$hn=$rows["hn"];
			$ptname=$rows["ptname"];
			$ptright=$rows["ptright"];
				
			
			$query1 = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
			$result1 = mysql_query($query1)or die("Query failed");
			for ($ii = mysql_num_rows($result1) - 1; $ii >= 0; $ii--) {
				if (!mysql_data_seek($result1, $ii)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
				if(!($row = mysql_fetch_object($result1))){
					continue;
				 }
				$nRunno=$row->runno;
				$nRunno++;
				//echo $nRunno."<br>";		
				$query2 ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
				//echo $query2."<br>";		
				$result2 = mysql_query($query2)or die("Query failed");						 				
			}			
					
			$add1="insert into depart set chktranx='$nRunno',
															   `date`='$newdate',
															   ptname='$ptname',
															   hn='$hn',
															   an='',
															   doctor='$doctor',
															   depart='$depart',
															   item='$item',
															   detail='$detaildepart',
															   price='$sumprice',
															   sumyprice='$yprice',
															   sumnprice='$nprice',
															   idname='$sOfficer',
															   diag='$diag',
															   accno='0',
															   tvn='".$_POST["list_hn"][$i]."',
															   ptright='$ptright',
															   status='$status';";
			//echo $add1."<br>";															   
			if(mysql_query($add1)){
			$insert_id=mysql_insert_id();
			$add2="insert into patdata set date='$newdate',
															   hn='$hn',
															   ptname='$ptname',
															   doctor='$doctor',
															   item='$item',
															   code='$code',
															   detail='$detail',
															   amount='$amount',
															   price='$sumprice',
															   yprice='$yprice',
															   nprice='$nprice',
															   depart='$depart',
															   part='$part',
															   idno='$insert_id',
															   ptright='$ptright',
															   status='$status';";
			//echo $add2."<br>";
			mysql_query($add2);
			
			$Thdhn=date("d-m-").(date("Y")+543).$hn;
		    $add3 ="UPDATE opday SET  other='$sumprice' WHERE thdatehn= '$Thdhn' AND vn = '".$_POST["list_hn"][$i]."' ";
			mysql_query($add3);			
			
			
			echo "<script>alert('�ѹ�֡�����Ť���������������');window.location='hemohd.php?page=show&hemodate=$newdate&depart=$depart&doctor=$doctor&diag=$diag';</script>";
			}  //close insert depart															   			
	 	}  //close check num rows
	 }  //close for
}  //close if act
?>
<script language="JavaScript">
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function checkname(hn) {
	
	var hn_value = "";

			url = 'hemohd.php?action='+hn;
			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			hn_value = xmlhttp.responseText;
	
	return hn_value;

}

function add_hn(){
		var hn_true = "";	
		hn_true = checkname(document.getElementById('hn').value);
		//alert(hn_true);
		
			document.getElementById('list_hn').innerHTML = document.getElementById('list_hn').innerHTML + "<INPUT TYPE=\"checkbox\" name=\"list_hn[]\" value=\""+document.getElementById('hn').value+"\" checked>&nbsp;"+document.getElementById('hn').value + " "+hn_true+"<BR>";
			document.getElementById("hn").select();

	}
</script>

<script>
function check(){
	if(document.getElementById("doctor").selectedIndex=='0'){
		alert("��س����͡ᾷ��");
		return false;
	}else if(document.getElementById("outlay1").checked == false && document.getElementById("outlay2").checked == false && document.getElementById("outlay3").checked == false && document.getElementById("outlay4").checked == false){
		alert("��سҤ�ԡ���͡��������");
		return false;
	}else{
		return true;
	}
}
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="39" colspan="2" align="center"><strong>�ѹ�֡��������Ẻ�����</strong></td>
  </tr>
  <tr>
    <td height="24" colspan="2" align="center"><a target=_top  href="../nindex.htm">&lt;&lt; ������ѡ</a></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="38%" align="center" valign="top" bgcolor="#FFCC99"><table width="63%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="22%" height="33" align="right"> <strong>�к� VN : &nbsp;</strong></td>
        <td width="78%"><input type="text" id="hn" name="hn" onkeypress = "if(event.keyCode == 13){ add_hn(); }" />
          &nbsp;         <input type="button" value="��ŧ" onclick="add_hn();" /></td>
      </tr>
    </table></td>
    <td width="62%" align="center" bgcolor="#FFFFCC">
	<form name="f1" method="POST" action="hemohd.php" onsubmit="return check();">
	  <input name="act" type="hidden" id="act" value="add" />
      <input name="code" type="hidden" id="code" value="CHD" />
      <input name="detail" type="hidden" id="detail" value="(71641)���������� (Hemodialysis) - Chronic Hemodialysis)" />
      <input name="detaildepart" type="hidden" id="detaildepart" value="��Һ�ԡ�ÿ͡���ʹ��������ͧ�����" />      
      <input name="item" type="hidden" id="item" value="1" />
      <input name="amount" type="hidden" id="amount" value="1" />
      <input name="depart" type="hidden" id="depart" value="HEMO" />
      <input name="part" type="hidden" id="part" value="SURG" />
      <input name="status" type="hidden" id="status" value="Y" />
<table width="80%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td height="33" colspan="2" align="center"><strong>��������´</strong></td>
        </tr>
      <tr>
        <td width="23%" align="right" valign="top"><strong>VN : &nbsp;</strong></td>
        <td width="77%" align="left"><div id="list_hn"></div></td>
      </tr>
      <tr>
        <td align="right"><strong>�ä : &nbsp;</strong></td>
        <td align="left"><input type="text" name="diag" id="diag" /></td>
      </tr>
      <tr>
        <td align="right"><strong>ᾷ�� : &nbsp;</strong></td>
        <td align="left">
		<?php
        $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
        list($menucode) = Mysql_fetch_row(Mysql_Query($sql));
        
        if($menucode == "ADMMAINOPD"){
        
        $strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'   order by name"; 
        $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
        ?>
                  <select name="doctor" id="doctor">
                  <option value="-��س����͡ᾷ��-">-��س����͡ᾷ��-</option>
        <? 
        while($objResult = mysql_fetch_array($objQuery)) { 
        ?>
                   <option value="<?=$objResult["name"];?>">
                   <?=$objResult["name"];?>
                   </option>
                   <? 
        } 
        ?>
                  </select>
        <?php }else  if($menucode == "ADMDEN"){
        $strSQL = "SELECT name FROM doctor  where status='y'  and menucode ='ADMDEN'  order by name "; 
        $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
        ?>
                  <select name="doctor" id="doctor">
                    <option value="-��س����͡ᾷ��-">-��س����͡ᾷ��-</option>
                    <? 
        while($objResult = mysql_fetch_array($objQuery)) { 
        ?>
                    <option value="<?=$objResult["name"];?>">
                      <?=$objResult["name"];?>
                      </option>
        <? 
        } 
        ?>
                  </select>
        <?php }else{?>
        <? 
        $strSQL = "SELECT name FROM doctor where status='y'  order by name "; 
        $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
        ?>
        <select name="doctor" id="doctor">
					<option value="-��س����͡ᾷ��-">-��س����͡ᾷ��-</option>
          <? 
        while($objResult = mysql_fetch_array($objQuery)) { 
        ?>
          <option value="<?=$objResult["name"];?>">
          <?=$objResult["name"];?>
          </option>
          <? 
        } 
        ?>
        </select>
        <?php 
        }
        ?>        </td>
      </tr>
      <tr>
        <td align="right" valign="top"><strong>���͡�������� : &nbsp;</strong> </td>
        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td align="left"><input name="outlay" type="radio" id="outlay1" value="2000" />
              &nbsp;��ҿ͡� 2,000 �ҷ
              </label>(�ԡ�� 2000 �ҷ �ԡ����� 0 �ҷ)</td>
            </tr>
          <tr>
            <td align="left"><input name="outlay" type="radio" id="outlay2" value="1500" />
&nbsp;��ҿ͡� 1,500 �ҷ
              </label>
              (�ԡ�� 1500 �ҷ �ԡ����� 0 �ҷ)</td>
            </tr>
          <tr>
            <td align="left"><input name="outlay" type="radio" id="outlay3" value="500" />
&nbsp;��ҿ͡� 500 �ҷ
              </label>
              (�ԡ�� 0 �ҷ �ԡ����� 500 �ҷ)</td>
            </tr>
          <tr>
            
        </table></td>
      </tr>
      <tr>
        <td height="33" align="right">&nbsp;</td>
        <td align="left"><input type="submit" name="button" id="button" value="�ѹ�֡������" /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
    </table>
    </form>    </td>
  </tr>
</table>
<p>&nbsp;</p>
<?
if($_GET["page"]=="show"){
$hemodate=$_GET["hemodate"];
$depart=$_GET["depart"];
$doctor=$_GET["doctor"];
$diag=$_GET["diag"];
/*	echo "<p align=\"center\"><a href=\"labtranxhemo.php?hemodate=$hemodate&depart=$depart&doctor=$doctor&diag=$diag\" target=\"_blank\" onclick=\"location.href='hemohd.php'\">���˹����ºؤ��</a></p>";*/
	echo "<p align=\"center\"><a href=\"labtranxhemogroup.php?hemodate=$hemodate&depart=$depart&doctor=$doctor&diag=$diag\" target=\"_blank\" onclick=\"location.href='hemohd.php'\">���˹��Ẻ�����</a></p>";	
}
?>
<? 
function displaydate($x) {
	$thai_m=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate

?>
<p align="center"><strong>�����Ť������� ��Ш��ѹ��� <?=displaydate(date('Y-m-d'));?></strong></p>
<table width="80%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center" bgcolor="#3399CC"><strong>�ӴѺ</strong></td>
    <td width="9%" align="center" bgcolor="#3399CC"><strong>HN</strong></td>
    <td width="8%" align="center" bgcolor="#3399CC"><strong>VN</strong></td>
    <td width="26%" align="center" bgcolor="#3399CC"><strong>���� - ���ʡ��</strong></td>
    <td width="24%" align="center" bgcolor="#3399CC"><strong>�Է������ѡ��</strong></td>
    <td width="9%" align="center" bgcolor="#3399CC"><strong>�ӹǹ�Թ</strong></td>
    <td width="9%" align="center" bgcolor="#3399CC"><strong>�ԡ��</strong></td>
    <td width="9%" align="center" bgcolor="#3399CC"><strong>�ԡ�����</strong></td>
  </tr>
<?
$today=date('Y-m-d');
list($y,$m,$d)=explode("-",$today);
$y=$y+543;
$newdate="$y-$m-$d";
$code="HEMO";
$detail="��Һ�ԡ�ÿ͡���ʹ��������ͧ�����";

	  $sql="select * from depart where date like '$newdate%' && depart='$code' && detail='$detail'";
	  //echo $sql;
	  $query=mysql_query($sql);
	  if(mysql_num_rows($query) < 1){
	  	echo "<tr>
					<td colspan='8' align='center' style='color: red;'><strong>�ѧ����բ����ŤԴ�������¢ͧ�ѹ�����к�</strong></td>
				  </tr>";
	  }
	  $no=0;
	  $totalprice=0;
	  $totalyprice=0;
	  $totalnprice=0;
	  while($rows=mysql_fetch_array($query)){
	  $no++;
	  $totalprice=$totalprice+$rows["price"];
	  $totalyprice=$totalyprice+$rows["sumyprice"];
	  $totalnprice=$totalnprice+$rows["sumnprice"];	  	  
?>  
  <tr>
    <td align="center" bgcolor="#FFFFCC"><?=$no;?></td>
    <td bgcolor="#FFFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["tvn"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["ptname"];?></td>
    <td bgcolor="#FFFFCC"><?=$rows["ptright"];?></td>
    <td align="right" bgcolor="#FFFFCC"><?=$rows["price"];?></td>
    <td align="right" bgcolor="#FFFFCC"><?=$rows["sumyprice"];?></td>
    <td align="right" bgcolor="#FFFFCC"><?=$rows["sumnprice"];?></td>
  </tr>
<?
	}
?>   
  <tr>
    <td colspan="5" align="right" bgcolor="#66CCCC"><strong>������Թ</strong></td>
    <td align="right" bgcolor="#66CCCC"><strong>
      <?=number_format($totalprice,2);?>
    </strong></td>
    <td align="right" bgcolor="#66CCCC"><strong>
      <?=number_format($totalyprice,2);?>
    </strong></td>
    <td align="right" bgcolor="#66CCCC"><strong>
      <?=number_format($totalnprice,2);?>
    </strong></td>
  </tr> 
</table>

