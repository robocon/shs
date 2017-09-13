<?php
Class dxofyear{
	
var $ptname;
var $age;
var $camp;
var $camp_until;
var $height;
var $weight;
var $round_;
var $temperature;
var $pause;
var $rate;
var $bmi;
var $bp1;
var $bp2;
var $ua_color;
var $ua_appear;
var $ua_spgr;
var $ua_phu;
var $ua_bloodu;
var $ua_prou;
var $ua_gluu;
var $ua_ketu;
var $ua_urobil;
var $ua_bili;
var $ua_nitrit;
var $ua_wbcu;
var $ua_rbcu;
var $ua_epiu;
var $ua_bactu;
var $ua_yeast;
var $ua_mucosu;
var $ua_amopu;
var $ua_castu;
var $ua_crystu;
var $ua_otheru;
var $cbc_wbc;
var $cbc_rbc;
var $cbc_hb;
var $cbc_hct;
var $cbc_mcv;
var $cbc_mch;
var $cbc_mchc;
var $cbc_pltc;
var $cbc_plts;
var $cbc_neu;
var $cbc_lymp;
var $cbc_mono;
var $cbc_eos;
var $cbc_baso;
var $cbc_band;
var $cbc_atyp;
var $cbc_nrbc;
var $cbc_rbcmor;
var $cbc_other;
var $cxr;
var $bs;
var $bun;
var $cr;
var $uric;
var $chol;
var $tg;
var $sgot;
var $sgpt;
var $alk;
var $dx;

	function set_ptname($xxx){$this->ptname = $xxx;}
function set_age($xxx){$this->age = $xxx;}
function set_camp($xxx){$this->camp = $xxx;}
function set_camp_until($xxx){$this->camp_until = $xxx;}
function set_height($xxx){$this->height = $xxx;}
function set_weight($xxx){$this->weight = $xxx;}
function set_round_($xxx){$this->round_ = $xxx;}
function set_temperature($xxx){$this->temperature = $xxx;}
function set_pause($xxx){$this->pause = $xxx;}
function set_rate($xxx){$this->rate = $xxx;}
function set_bmi($xxx){$this->bmi = $xxx;}
function set_bp1($xxx){$this->bp1 = $xxx;}
function set_bp2($xxx){$this->bp2 = $xxx;}
function set_ua_color($xxx){$this->ua_color = $xxx;}
function set_ua_appear($xxx){$this->ua_appear = $xxx;}
function set_ua_spgr($xxx){$this->ua_spgr = $xxx;}
function set_ua_phu($xxx){$this->ua_phu = $xxx;}
function set_ua_bloodu($xxx){$this->ua_bloodu = $xxx;}
function set_ua_prou($xxx){$this->ua_prou = $xxx;}
function set_ua_gluu($xxx){$this->ua_gluu = $xxx;}
function set_ua_ketu($xxx){$this->ua_ketu = $xxx;}
function set_ua_urobil($xxx){$this->ua_urobil = $xxx;}
function set_ua_bili($xxx){$this->ua_bili = $xxx;}
function set_ua_nitrit($xxx){$this->ua_nitrit = $xxx;}
function set_ua_wbcu($xxx){$this->ua_wbcu = $xxx;}
function set_ua_rbcu($xxx){$this->ua_rbcu = $xxx;}
function set_ua_epiu($xxx){$this->ua_epiu = $xxx;}
function set_ua_bactu($xxx){$this->ua_bactu = $xxx;}
function set_ua_yeast($xxx){$this->ua_yeast = $xxx;}
function set_ua_mucosu($xxx){$this->ua_mucosu = $xxx;}
function set_ua_amopu($xxx){$this->ua_amopu = $xxx;}
function set_ua_castu($xxx){$this->ua_castu = $xxx;}
function set_ua_crystu($xxx){$this->ua_crystu = $xxx;}
function set_ua_otheru($xxx){$this->ua_otheru = $xxx;}
function set_cbc_wbc($xxx){$this->cbc_wbc = $xxx;}
function set_cbc_rbc($xxx){$this->cbc_rbc = $xxx;}
function set_cbc_hb($xxx){$this->cbc_hb = $xxx;}
function set_cbc_hct($xxx){$this->cbc_hct = $xxx;}
function set_cbc_mcv($xxx){$this->cbc_mcv = $xxx;}
function set_cbc_mch($xxx){$this->cbc_mch = $xxx;}
function set_cbc_mchc($xxx){$this->cbc_mchc = $xxx;}
function set_cbc_pltc($xxx){$this->cbc_pltc = $xxx;}
function set_cbc_plts($xxx){$this->cbc_plts = $xxx;}
function set_cbc_neu($xxx){$this->cbc_neu = $xxx;}
function set_cbc_lymp($xxx){$this->cbc_lymp = $xxx;}
function set_cbc_mono($xxx){$this->cbc_mono = $xxx;}
function set_cbc_eos($xxx){$this->cbc_eos = $xxx;}
function set_cbc_baso($xxx){$this->cbc_baso = $xxx;}
function set_cbc_band($xxx){$this->cbc_band = $xxx;}
function set_cbc_atyp($xxx){$this->cbc_atyp = $xxx;}
function set_cbc_nrbc($xxx){$this->cbc_nrbc = $xxx;}
function set_cbc_rbcmor($xxx){$this->cbc_rbcmor = $xxx;}
function set_cbc_other($xxx){$this->cbc_other = $xxx;}
function set_cxr($xxx){$this->cxr = $xxx;}
function set_bs($xxx){$this->bs = $xxx;}
function set_bun($xxx){$this->bun = $xxx;}
function set_cr($xxx){$this->cr = $xxx;}
function set_uric($xxx){$this->uric = $xxx;}
function set_chol($xxx){$this->chol = $xxx;}
function set_tg($xxx){$this->tg = $xxx;}
function set_sgot($xxx){$this->sgot = $xxx;}
function set_sgpt($xxx){$this->sgpt = $xxx;}
function set_alk($xxx){$this->alk = $xxx;}
function set_dx($xxx){$this->dx = $xxx;}


function get_ptname(){return $this->ptname;}
function get_age(){return $this->age;}
function get_camp(){return $this->camp;}
function get_camp_until(){return $this->camp_until;}
function get_height(){return $this->height;}
function get_weight(){return $this->weight;}
function get_round_(){return $this->round_;}
function get_temperature(){return $this->temperature;}
function get_pause(){return $this->pause;}
function get_rate(){return $this->rate;}
function get_bmi(){return $this->bmi;}
function get_bp1(){return $this->bp1;}
function get_bp2(){return $this->bp2;}
function get_ua_color(){return $this->ua_color;}
function get_ua_appear(){return $this->ua_appear;}
function get_ua_spgr(){return $this->ua_spgr;}
function get_ua_phu(){return $this->ua_phu;}
function get_ua_bloodu(){return $this->ua_bloodu;}
function get_ua_prou(){return $this->ua_prou;}
function get_ua_gluu(){return $this->ua_gluu;}
function get_ua_ketu(){return $this->ua_ketu;}
function get_ua_urobil(){return $this->ua_urobil;}
function get_ua_bili(){return $this->ua_bili;}
function get_ua_nitrit(){return $this->ua_nitrit;}
function get_ua_wbcu(){return $this->ua_wbcu;}
function get_ua_rbcu(){return $this->ua_rbcu;}
function get_ua_epiu(){return $this->ua_epiu;}
function get_ua_bactu(){return $this->ua_bactu;}
function get_ua_yeast(){return $this->ua_yeast;}
function get_ua_mucosu(){return $this->ua_mucosu;}
function get_ua_amopu(){return $this->ua_amopu;}
function get_ua_castu(){return $this->ua_castu;}
function get_ua_crystu(){return $this->ua_crystu;}
function get_ua_otheru(){return $this->ua_otheru;}
function get_cbc_wbc(){return $this->cbc_wbc;}
function get_cbc_rbc(){return $this->cbc_rbc;}
function get_cbc_hb(){return $this->cbc_hb;}
function get_cbc_hct(){return $this->cbc_hct;}
function get_cbc_mcv(){return $this->cbc_mcv;}
function get_cbc_mch(){return $this->cbc_mch;}
function get_cbc_mchc(){return $this->cbc_mchc;}
function get_cbc_pltc(){return $this->cbc_pltc;}
function get_cbc_plts(){return $this->cbc_plts;}
function get_cbc_neu(){return $this->cbc_neu;}
function get_cbc_lymp(){return $this->cbc_lymp;}
function get_cbc_mono(){return $this->cbc_mono;}
function get_cbc_eos(){return $this->cbc_eos;}
function get_cbc_baso(){return $this->cbc_baso;}
function get_cbc_band(){return $this->cbc_band;}
function get_cbc_atyp(){return $this->cbc_atyp;}
function get_cbc_nrbc(){return $this->cbc_nrbc;}
function get_cbc_rbcmor(){return $this->cbc_rbcmor;}
function get_cbc_other(){return $this->cbc_other;}
function get_cxr(){return $this->cxr;}
function get_bs(){return $this->bs;}
function get_bun(){return $this->bun;}
function get_cr(){return $this->cr;}
function get_uric(){return $this->uric;}
function get_chol(){return $this->chol;}
function get_tg(){return $this->tg;}
function get_sgot(){return $this->sgot;}
function get_sgpt(){return $this->sgpt;}
function get_alk(){return $this->alk;}
function get_dx(){return $this->dx;}


	function resault_clinic( $orderdate, $hn){
		$sql = " SELECT  * FROM resulthead a, resultdetail b WHERE a.hn =  '$hn'  AND a.autonumber = b.autonumber AND a.orderdate LIKE '$orderdate%' AND clinicalinfo = 'ตรวจโรคประจำปี' ";
		$rs = mysql_query($sql);
		return $rs;
	}

	
}
?>