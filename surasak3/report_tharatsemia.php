<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
-->
</style>
<div id="non-printable">
<form id="form1" name="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="show" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td align="center">���͡��͹
<?
        $thaimonthFull=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�", "��Ȩԡ�¹","�ѹ�Ҥ�");
        echo "<select name='selmon' size='1'  class='txt'>";
        for($i=0;$i<count($thaimonthFull);$i++){
        	echo "<option value='".($i+1)."' ";
			if(date("m")==$i+1){
				echo " selected";
			}
        	echo ">".$thaimonthFull[$i]."</option>";
        }
        echo "</select>";
        ?>
&nbsp;�� 
<? 
			$y=date("Y")+543;
			$date=date("Y")+543+5;
			$dates=range(2547,$date);
			echo "<select name='selyear' size='1' class='txt'>";
			foreach($dates as $i){
		?>
<option value="<?=$i;?>" <? if($y==$i){ echo "selected"; }?>>
<?=$i;?>
</option>
<?
			}
			echo "</select>";
		?>
<span style="margin-left: 35px;"><input type="submit" value="���Ң�����" name="B1"  class="txt" />
		</span></td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; ��Ѻ������ѡ &gt;&gt;</a></td>
    </tr>
  </table>
</form>
</div> 
<?
if($_POST["act"]=="show"){
$seldate=sprintf("%02d",$_POST["seldate"]);
echo "-->".$seldate;
$selmon=$_POST["selmon"];
	if($selmon=="01"){
		$mon ="���Ҥ�";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="����Ҿѹ��";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="�չҤ�";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="����¹";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="����Ҥ�";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="�Զع�¹";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="�á�Ҥ�";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="�ԧ�Ҥ�";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="�ѹ��¹";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="���Ҥ�";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="��Ȩԡ�¹";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="�ѹ�Ҥ�";
		$selmon="12";
	}
$thyear=$_POST["selyear"];
$ksyear=$_POST["selyear"]-543;
}
?>
