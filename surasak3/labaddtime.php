<?php
    include("connect.inc");

function setsezo($number){
	if(strlen($number) == 1){
		return "0".$number;
	}else{
		return $number;
	}
}

if(isset($_POST["submit"])){
		
		$_POST["smm"] = setsezo($_POST["smm"]);
	$_POST["emm"] = setsezo($_POST["emm"]);
	$_POST["sdd"] = setsezo($_POST["sdd"]);
	$_POST["edd"] = setsezo($_POST["edd"]);
	$_POST["smi"] = setsezo($_POST["smi"]);
	$_POST["emi"] = setsezo($_POST["emi"]);
	$_POST["sse"] = setsezo($_POST["sse"]);
	$_POST["ese"] = setsezo($_POST["ese"]);


	$string_start = ($_POST["syy"]-543)."-".$_POST["smm"]."-".$_POST["sdd"]." ".$_POST["smi"].":".$_POST["sse"].":00";
	$string_end = ($_POST["eyy"]-543)."-".$_POST["emm"]."-".$_POST["edd"]." ".$_POST["emi"].":".$_POST["ese"].":00";
	
	$row_id = str_replace("_",",",$_POST["row_id"]);
	$sql = "update ipacc set startdatetime='".$string_start."', enddatetime='".$string_end."' where row_id in (".$row_id.") ";
	$result = Mysql_Query($sql);
		
		if($result){
			echo "<BR><CENTER>���Թ��� �����������º��������<BR><BR>
				<INPUT TYPE=\"button\" VALUE=\"Close\" ONCLICK=\"window.close();\">
			</CENTER>";
		}

exit();
}

	$sql = "Select an, idname From ipacc  where row_id = '".$_GET["row_id"]."' ";
	$result = Mysql_Query($sql);
	$arr = Mysql_fetch_assoc($result);
	echo "AN : ",$arr["an"]," ",$arr["idname"];

		$sdd = date("d");
		$smm = date("m");
		$syy = date("Y")+543;

		$smi = "";
		$sse = "00";

		$edd = date("d");
		$emm = date("m");
		$eyy = date("Y")+543;

		$emi = "";
		$ese = "00";

?>
<FORM METHOD=POST ACTION="">
	<font face="Angsana New">
�ѹ&nbsp;:&nbsp;<INPUT TYPE="text" NAME="sdd" size="2" maxlength="2" value="<?php echo $sdd;?>">&nbsp;��͹&nbsp;:&nbsp;<INPUT TYPE="text" NAME="smm" size="2" maxlength="2" value="<?php echo $smm;?>">&nbsp;
��&nbsp;:&nbsp;<INPUT TYPE="text" NAME="syy" size="4" maxlength="4" value="<?php echo $syy;?>">
����&nbsp;:&nbsp;<INPUT TYPE="text" NAME="smi"size="2" maxlength="2" value="<?php echo $smi;?>">:<INPUT TYPE="text" NAME="sse"size="2" maxlength="2" value="<?php echo $sse;?>">&nbsp;��������ͧ��ҵѴ
<BR>

<font face="Angsana New">
�ѹ&nbsp;:&nbsp;<INPUT TYPE="text" NAME="edd" size="2" maxlength="2" value="<?php echo $edd;?>">&nbsp;��͹&nbsp;:&nbsp;<INPUT TYPE="text" NAME="emm" size="2" maxlength="2" value="<?php echo $emm;?>">&nbsp;
��&nbsp;:&nbsp;<INPUT TYPE="text" NAME="eyy" size="4" maxlength="4" value="<?php echo $eyy;?>">
����&nbsp;:&nbsp;<INPUT TYPE="text" NAME="emi"size="2" maxlength="2" value="<?php echo $emi;?>">:<INPUT TYPE="text" NAME="ese"size="2" maxlength="2" value="<?php echo $ese;?>">&nbsp;����͡��ͧ��ҵѴ
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <INPUT TYPE="hidden" NAME="row_id" value="<?php echo $_GET["row_id"];?>">
  <INPUT TYPE="submit" value="��ŧ" name="submit">&nbsp;&nbsp;<INPUT TYPE="reset" value="¡��ԡ">
</FORM>
<?php
    include("unconnect.inc");
?>