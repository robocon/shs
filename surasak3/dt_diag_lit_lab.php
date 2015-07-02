<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}s

-->
</style>
<?
 		/*$list_ua["COLOR"] =  "ua_color"; 
		$list_ua["APPEAR"] =  "ua_appear"; 
		$list_ua["SPGR"] =  "ua_spgr"; 
		$list_ua["PHU"] =  "ua_phu"; 
		$list_ua["BLOODU"] =  "ua_bloodu"; 
		$list_ua["PROU"] =  "ua_prou"; 
		$list_ua["GLUU"] =  "ua_gluu"; 
		$list_ua["KETU"] =  "ua_ketu"; 
		$list_ua["UROBIL"] =  "ua_urobil"; 
		$list_ua["BILI"] =  "ua_bili"; 
		$list_ua["NITRIT"] =  "ua_nitrit"; 
		$list_ua["WBCU"] =  "ua_wbcu"; 
		$list_ua["RBCU"] =  "ua_rbcu"; 
		$list_ua["EPIU"] =  "ua_epiu"; 
		$list_ua["BACTU"] =  "ua_bactu"; 
		$list_ua["YEAST"] =  "ua_yeast"; 
		$list_ua["MUCOSU"] =  "ua_mucosu"; 
		$list_ua["AMOPU"] =  "ua_amopu";
		$list_ua["CASTU"] =  "ua_castu"; 
		$list_ua["CRYSTU"] =  "ua_crystu"; 
		$list_ua["OTHERU"] =  "ua_otheru"; */
		/*
		$list_cbc["WBC"] =  "cbc_wbc"; 
		$list_cbc["RBC"] =  "cbc_rbc"; 
		$list_cbc["HB"] =  "cbc_hb"; 
		$list_cbc["HCT"] =  "cbc_hct"; 
		$list_cbc["MCV"] =  "cbc_mcv";
		$list_cbc["MCH"] =  "cbc_mch";
		$list_cbc["MCHC"] =  "cbc_mchc";
		$list_cbc["PLTC"] =  "cbc_pltc";
		$list_cbc["PLTS"] =  "cbc_plts";
		$list_cbc["NEU"] =  "cbc_neu";
		$list_cbc["LYMP"] =  "cbc_lymp";
		$list_cbc["MONO"] =  "cbc_mono";
		$list_cbc["EOS"] =  "cbc_eos";
		$list_cbc["BASO"] =  "cbc_baso";
		$list_cbc["BAND"] =  "cbc_band";
		$list_cbc["ATYP"] =  "cbc_atyp";
		$list_cbc["NRBC"] =  "cbc_nrbc";
		$list_cbc["RBCMOR"] =  "cbc_rbcmor";
		$list_cbc["OTHER"] =  "cbc_other";*/
	?>
<table width="200" bordercolor="#336699" border="1">
<tr><td>
	<table width="200">
	<?
		$sql2 = "Select  labcode,result From resulthead as a , resultdetail as b  where a.hn='".$_SESSION["hn_now"]."' AND a.autonumber = b.autonumber AND a.orderdate like '".$_GET['dd']."%' AND a.profilecode = '".$_GET['code']."' ";
		//echo $sql2;
			echo "<TR  bgcolor='#CCFFFF'>";
			echo "<TD width='100' align='center'>LAB</TD>";
			echo "<TD width='100' align='center'>Result</TD>";
			echo "</TR>";
		$resulthead = mysql_query($sql2);
		while($arrhead = mysql_fetch_assoc($resulthead)){
			echo "<TR>";
			echo "<TD width='100'>",$arrhead["labcode"],"</TD>";
			echo "<TD width='100'>",$arrhead["result"],"</TD>";
			echo "</TR>";
		}
?>
</table>
</td></tr>
</table>
