<!-- เพิ่ม Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body {
    font-family: "Segoe UI", Tahoma, sans-serif;
}

.styled-table {
    border-collapse: collapse;
    width: 90%;
    margin: auto;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    border-radius: 10px;
    overflow: hidden;
}

.styled-table tr {
    background: linear-gradient(135deg, #006400, #228B22);
}

.styled-table td a {
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    padding: 12px 18px;
    font-size: 18px;
    text-decoration: none;
    transition: all 0.25s ease-in-out;
}

.styled-table td a i {
    margin-right: 8px;
    font-size: 20px;
}

.styled-table td a:hover {
    background: linear-gradient(135deg, #32CD32, #006400);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    border-radius: 6px;
}

/* ปรับ dropdown ให้ลงด้านล่าง */
#dropmenudiv {
    position: absolute;
    border: none;
    font: normal 16px "Segoe UI", Tahoma, sans-serif;
    line-height: 20px;
    z-index: 100;
    background-color: #006400;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

#dropmenudiv a {
    display: block;
    padding: 8px 15px;
    text-decoration: none;
    font-weight: normal;
    color: #ffffff;
    transition: background 0.25s ease-in-out;
}

#dropmenudiv a:hover {
    background-color: #32CD32;
    color: #000;
    border-radius: 5px;
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
	
//print_r($_SESSION);	
?>
<script type="text/javascript">
function newWindowsPaperless()
{
	var height = window.screen.height;
	var width = window.screen.width;

	window.open("dt_paperLess.php?hn=<?=$_SESSION['hn_now'];?>", "MsgWindow", "width="+width+",height="+height+",scrollbars=yes,top=1,left=1");
}
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
menu1[3]='<a href="javascript:void(0)" onclick="newWindowsPaperless()" >ดูประวัติออนไลน์(e-OPD)</a>'
menu1[4]='<a href="dt_colonocopy.php" >Colonoscopy</a>'
menu1[5]='<a href="dt_esophago.php" >Esophago</a>'
menu1[6]='<a href="compareopd.php" >เปรียบเทียบผลย้อนหลัง</a>'

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
menu2[3]='<a href="dt_drugpay.php">สั่งจ่ายยาชำระเงินเอง</a>'
<?php
if($sIdname == "md19921" || $sIdname == "md50813" || $sIdname == "thaywin"  ){
	echo "menu2[4]='<a href=\"dt_drug_pt.php\" >สั่งอุปกรณ์ PT</a>'\n";
}
if($sIdname == "md20278" || $sIdname == "thaywin"  ){
	echo "menu2[4]='<a href=\"dt_drug_pt.php\" >สั่งอุปกรณ์ ENT</a>'\n";
}
?>
menu2[5]='<a href="dt_slipadd.php" >เพิ่มวิธีใช้ยา</a>'

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
menu4[3]='<a href="echo.php" >บันทึก ECHO</a>'

var menu5=new Array();
menu5[0]='<a href="dt_chkup.php" >ใบรับรองแพทย์</a>'
menu5[1]='<a href="dt_refer.php" >ใบ Refer</a>'

var menu6=new Array();
menu6[0]='<a href="dxdr_ofyear1_dr.php" >บันทึกตรวจสุขภาพประจำปีกองทัพบก</a>'
<!--menu6[1]='<a href="dxdr_ofyear_empsoldier.php">ตรวจสุขภาพลูกจ้าง รพ.</a>'-->
menu6[2]='<a href="dxdr_ofyearout_dr.php" >บันทึกตรวจสุขภาพทั่วไป && ฮักกันยามเฒ่า</a>'
<!--menu6[3]='<a href="Edxdr_ofyearout_dr.php" >ตรวจสุขภาพ - สำหรับใบรับรองแพทย์อิเล็กทรอนิกส์</a>'-->
menu6[4]='<a href="report_dxofyear.php?hn=<?=$_SESSION[hn_now];?>" target=_BLANK >ดูผลตรวจสุขภาพประจำปีกองทัพบก</a>'

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


<!-- ตัวอย่างการใส่ไอคอนในเมนู -->
<TABLE align="center" border="0" class="styled-table">
  <TR>
    <TD><A HREF="<?php echo $first_page;?>"><i class="fa-solid fa-user-plus"></i> ผู้ป่วยใหม่</A></TD>
    <TD><A HREF="javascript:void(0);" onclick="newWindowsPaperless()"><i class="fa-solid fa-notes-medical"></i> ประวัติการรักษา (E-OPD)</A></TD>
    <TD><A HREF="#" onmouseover="dropdownmenu(this, event, menu1, '190px')" onmouseout="delayhidemenu()"><i class="fa-solid fa-stethoscope"></i> DIAG</A></TD>
    <TD><A HREF="#" onmouseover="dropdownmenu(this, event, menu2, '190px')" onmouseout="delayhidemenu()"><i class="fa-solid fa-pills"></i> จ่ายยา</A></TD>
    <TD><A HREF="#" onmouseover="dropdownmenu(this, event, menu3, '190px')" onmouseout="delayhidemenu()"><i class="fa-solid fa-vials"></i> LAB</A></TD>
    <TD><A HREF="#" onmouseover="dropdownmenu(this, event, menu4, '190px')" onmouseout="delayhidemenu()"><i class="fa-solid fa-x-ray"></i> X-RAY</A></TD>
    <TD><A HREF="dt_appoint.php"><i class="fa-solid fa-calendar-check"></i> ใบนัด</A></TD>
    <TD><A HREF="#" onmouseover="dropdownmenu(this, event, menu6, '190px')" onmouseout="delayhidemenu()"><i class="fa-solid fa-heart-pulse"></i> CHKUP</A></TD>
    <TD><A HREF="#" onmouseover="dropdownmenu(this, event, menu5, '190px')" onmouseout="delayhidemenu()"><i class="fa-solid fa-file-medical"></i> เอกสาร</A></TD>
    <TD><A HREF="../nindex.htm"><i class="fa-solid fa-house"></i> เมนู</A></TD>
  </TR>
</TABLE>
