<?php
	/*** By Weerachai Nukitram ***/
	/***  http://www.ThaiCreate.Com ***/	
	include("connect.inc");
?>
<html>
<head>
<title>��Թԡ����ɹ͡�����Ҫ���</title>


</head>
<body>
<h1 align="center">��Թԡ����ɹ͡�����Ҫ���  </h1>
<div><a target=_self  href='../nindex.htm'><<����� </a><br>
<a  href="clinic_report.php">��§ҹ��Թԡ�����(�����)</a>&nbsp;<a  href="clinic_report1.php"><br>
��§ҹ��Թԡ�����(��д١��Т��)</a>&nbsp;</div>
<script language="JavaScript">
	var HttPRequest = false;

	function ajaxFunction(){
		HttPRequest = false;
		if (window.XMLHttpRequest) { // Mozilla, Safari,...
			HttPRequest = new XMLHttpRequest();
			if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			}
		} else if (window.ActiveXObject) { // IE
			try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			}
		} 

		if (!HttPRequest) {
			alert('Cannot create XMLHTTP instance');
			return false;
		}
	}
	
	
	function doCallAjax(thn,tptname, ttan) {
		
		ajaxFunction();
			
		var url = 'clinic_vipgetfill_test.php';
		var pmeters = "strHn=" + encodeURI( document.getElementById(thn).value);
		
		HttPRequest.open('POST',url,true);
		HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		HttPRequest.setRequestHeader("Content-length", pmeters.length);
		HttPRequest.setRequestHeader("Connection", "close");
		HttPRequest.send(pmeters);

		HttPRequest.onreadystatechange = function()
		{
			if(HttPRequest.readyState == 4) // Return Request
			{
				var myProduct = HttPRequest.responseText;
				
				// replace space with ''
				myProduct.replace(/^\s+|\s+$/g, '');
				
				if(myProduct != ''){
					var myArr = myProduct.split("|");
					
					document.getElementById(tptname).value = myArr[0];
					document.getElementById(ttan).value = myArr[1];
				}
			}

		}

	}
	   
	   
 function fncSubmit2(){
	
	if(document.frmMain.yot.value==""){
		
		alert("��س����͡�Ȣͧᾷ��");
		document.frmMain.yot.focus();
		return false;
	}
	
	if(document.frmMain.doctor.value==""){
		
		alert("��س����͡ᾷ��");
		document.frmMain.doctor.focus();
		return false;
	}
	
	
	
	document.frmMain.submit();
}

	   
	</script>
<form name="frmMain" action="clinic_vipadd.php" method="post" onSubmit="JavaScript:return fncSubmit2();">
  <table width="390" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <th>&nbsp;</th>
    <th colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th>�ѹ���</th>
    <th colspan="2" align="left"><select name='d_start'>
    			 <? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					if($dd==$d){
					?>
                    
                    <option value="<?=$d;?>" selected><?=$d;?></option>
				<?
					}else{
				?>
                <option value="<?=$d;?>"><?=$d;?></option>
                <?
				}
				}
				
				?>
                </select>
	<? $m=date('m'); ?>
      <select name="m_start">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' >";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "</select>";
				?></th>
    </tr>
  <tr>
    <th>����</th>
    <th colspan="2" align="left">
    <select name='time' >
    <option value="08.00-12.00">08.00-12.00</option>
    <option value="08.00-16.00">08.00-16.00</option>
    <option value="09.00-15.00">09.00-15.00</option>
    <option value="10.30-14.00">10.30-14.00</option>
    <option value="16.00-20.00">16.00-20.00</option>
    </select>
    </th>
    </tr>
  <tr>
    <th>�� -ᾷ��</th>
    <th colspan="2" align="left"><select name="yot" id="yot"> 
    	<option value="">---��س����͡---</option>
      <option value="�.�.˭ԧ">�ѹ�͡˭ԧ</option>
      <option value="�.�.">�ѹ�͡</option>
      <option value="�.�.˭ԧ">�ѹ�˭ԧ</option>
      <option value="�.�.">�ѹ�</option>
      <option value="�.�.˭ԧ">�ѹ���˭ԧ</option>
      <option value="�.�.">�ѹ���</option>
      <option value="�.�.˭ԧ">�����͡˭ԧ</option>
      <option value="�.�.">�����͡</option>
      <option value="�.�.˭ԧ">�����˭ԧ</option>
       <option value="�.�.">�����</option>
      <option value="�.�.˭ԧ">���µ��˭ԧ</option>
      <option value="�.�.">���µ��</option>
      <option value="�.�.">���ᾷ��</option>
      <option value="�.�.">ᾷ��˭ԧ</option>      
      </select></th>
  </tr>
  <tr>
    <th>����ᾷ��</th>
    <th colspan="2" align="left"><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <th width="84" bgcolor="#CCCCCC">HN</th>
    <th width="185" bgcolor="#CCCCCC">���� - ʡ��  </th>
    <th width="99" bgcolor="#CCCCCC">AN</th>
  </tr>
  <? for($i=1;$i<=15;$i++){?>
  <tr>
    <th>
<input type="text" name="thn<?=$i?>" id="thn<?=$i?>" size="20" OnChange="JavaScript:doCallAjax('thn<?=$i;?>','tptname<?=$i;?>','ttan<?=$i;?>');">
	</th>
    <th><input type="text" name="tptname<?=$i?>" id="tptname<?=$i?>" size="40"></th>
    <th><input type="text" name="ttan<?=$i?>" id="ttan<?=$i?>" size="20"></th>
  </tr>
  <? } ?>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>&nbsp;</th>
    <th><input type="submit" value="�ѹ�֡������" name="submit"></th>
    <th>&nbsp;</th>
  </tr>

  </table>
</form>
</body>
</html>
</body>
</html>