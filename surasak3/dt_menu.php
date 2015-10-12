
<style type="text/css">

#dropmenudiv{
position:absolute;
border:1px solid black;
border-bottom-width: 0;
font:normal 24px Angsana New;
line-height:24px;
z-index:100;
}

#dropmenudiv a{
width: 100%;
display: block;
text-indent: 3px;
border-bottom: 1px solid black;
padding: 1px 0;
text-decoration: none;
font-weight: normal;
color: #FFFFFF;
font-weight: bold;
}

#dropmenudiv a:hover{ /*hover background color*/
background-color: #C6E2FF;
color: #000000;
font-weight: bold;

}

</style>
<?php
	if($_SESSION["dt_dental"] == true){
		$first_page = "dt_dental.php";
		$lab_page = "dt_lab_dental.php";
	}else{
		$first_page = "dt_index.php";
		$lab_page = "dt_lab.php";
	}
?>
<script type="text/javascript">

/***********************************************
* AnyLink Drop Down Menu- ? Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

//Contents for menu 1

var menu1=new Array();
menu1[0]='<a href="dt_diag.php" >บันทึกการวินิจฉัยโรค</a>'
menu1[1]='<a href="dt_diag_lit.php" >ดูผลการวินิจฉัยย้อนหลัง</a>'
menu1[2]='<a href="dt_admit_lit.php" >ดูประวัติการ Admit</a>'
menu1[3]='<a href="dt_colonocopy.php" >Colonoscopy</a>'
menu1[4]='<a href="dt_esophago.php" >Esophago</a>'
menu1[5]='<a href="compareopd.php" >เปรียบเทียบผลย้อนหลัง</a>'
<?php
/*if($sIdname == "md19364" || $sIdname == "md28422" || $sIdname == "md31386" ){
	echo "menu1[3]='<a href=\"dt_colonocopy.php\" >Colonoscopy</a>'\n";
	echo "menu1[4]='<a href=\"dt_esophago.php\" >Esophago</a>'\n";
}*/
?>
var menu2=new Array();
menu2[0]='<a href="dt_drug.php" >สั่งจ่ายยา</a>'
menu2[1]='<a href="dt_drug_lit.php" >ดูการสั่งจ่ายยาย้อนหลัง</a>'
menu2[2]='<a href="dt_drugsult.php" >สร้างสูตรยา</a>'
<?php
if($sIdname == "md19921" || $sIdname == "thaywin"  ){
	echo "menu2[3]='<a href=\"dt_drug_pt.php\" >สั่งอุปกรณ์ PT</a>'\n";
};
?>

var menu3=new Array();
menu3[0]='<a href="<?php echo $lab_page;?>" >สั่งตรวจ LAB</a>'
menu3[1]='<a href="dt_lab_lst.php" >ดูผลการตรวจ LAB วันนี้</a>'
menu3[2]='<a href="dt_lab_lst2.php" >ผลLAB ตรวจสุขภาพ</a>'
menu3[3]='<a href="dt_lab_lst3.php" >ผลLAB ย้อนหลัง</a>'
menu3[4]='<a target=_BLANK href="dt_lab_lst_print.php" >พิมพ์ผล LAB</a>'
menu3[5]='<a href="comparelab.php" >เปรียบเทียบผล LAB</a>'
menu3[6]='<a href="outlabdr.php" >ดูผลLABนอก,ผลPHATO</a>'

var menu4=new Array();
menu4[0]='<a href="dt_xray.php" >สั่ง X-RAY</a>'
menu4[1]='<a href="dt_xray_film.php" >ดูฟิลม์ X-RAY</a>'
menu4[2]='<a href="orderbmd.php" >สั่งตรวจ BMD</a>'

var menu5=new Array();
menu5[0]='<a href="dt_chkup.php" >ใบรับรองแพทย์</a>'
menu5[1]='<a href="dt_refer.php" >ใบ Refer</a>'

var menu6=new Array();
menu6[0]='<a href="dxdr_ofyear1_dr.php" >ตรวจสุขภาพทหารประจำปี</a>'
menu6[1]='<a href="dxdr_ofyear_emp.php" >ตรวจสุขภาพลูกจ้าง รพ.</a>'
menu6[2]='<a href="dxdr_ofyearout_dr.php" >ตรวจสุขภาพ</a>'

var menuwidth='170px' //default menu width
var menubgcolor='#000097'  //menu bgcolor
var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var hidemenu_onclick="no" //hide menu when user clicks within menu?

/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:'+menuwidth+';background-color:'+menubgcolor+'" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top="-500px"
if (menuwidth!=""){
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
}
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure-obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move up?
edgeoffset=dropmenuobj.contentmeasure+obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either?
edgeoffset=dropmenuobj.y+obj.offsetHeight-topedge
}
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+obj.offsetHeight+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}

if (hidemenu_onclick=="yes")
document.onclick=hidemenu

</script>


<TABLE align="center" border="1" bordercolor="#F0F000">
<TR>
	<TD>
<TABLE border="0"    height="36" >
<TR align="center" bgcolor="#FFFFC1">
	<TD width="100" align="center" ><A HREF="<?php echo $first_page;?>" >ผู้ป่วยใหม่</A></TD>
	<TD width="100" align="center" ><A HREF="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu1, '190px')" onMouseout="delayhidemenu()">DIAG</A></TD>

	<TD width="100" align="center"><A HREF="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu2, '190px')" onMouseout="delayhidemenu()">จ่ายยา</A></TD>

<?php if($_SESSION["smenucode"] !="ADMPHA" && $_SESSION["smenucode"] !="ADMPHARX" && $_SESSION["smenucode"] !="ADMER"){ ?>
	<TD width="100"align="center"><A HREF="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu3, '190px')" onMouseout="delayhidemenu()">LAB</A></TD>
	
	<TD width="100" align="center"><A HREF="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu4, '190px')" onMouseout="delayhidemenu()">X-RAY</A></TD>

	<TD width="100" align="center"><A HREF="dt_appoint.php" >ใบนัด</A></TD>

	<!--<TD width="100" align="center"><A HREF="dxdr_ofyear1_dr.php" >CHKUP</A>--><TD width="100" align="center"><A HREF="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu6, '190px')" onMouseout="delayhidemenu()">CHKUP</A></TD></TD>

	<TD width="100"align="center"><A HREF="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, menu5, '190px')" onMouseout="delayhidemenu()">เอกสาร</A></TD>
<?php } ?>
	<TD width="100" align="center" ><A HREF="../nindex.htm">เมนู</A></TD>

</TR>

</TABLE>
</TD>
</TR>
</TABLE>
