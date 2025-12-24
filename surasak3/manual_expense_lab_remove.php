<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_patdata2.php';
include_once dirname(__FILE__).'/class_file/class_opacc2.php';
include_once dirname(__FILE__).'/includes/JSON.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$p = new ClassPatdata();
$o = new ClassOpacc();
$j = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$departItems = array();
$opaccId = $_GET['opacc_id'];
parse_str($_GET['depart_id'], $departItems); // คืนค่าจาก http_build_query ให้เป็น array

$resAll = array();
$opaccStatus = false;

if(!empty($opaccId)){
    $res = $o->findOpaccFromId($opaccId);
    if($res!==false){
        $del = $o->delOpaccFromId($opaccId);
        $opaccStatus = true;
        $res = array('status'=>200,'msg'=>'Delete opacc Successful');
    }else{
        $res = array('status'=>400,'msg'=>$o->getMsgError());
    }
    $resAll['opacc'] = $res;
}
dump($departItems);
if(count($departItems)>0 && $opaccStatus!==false){

    foreach ($departItems as $departId) {
        $resDepart = $p->delDepartFromRowId($departId);
        if($resDepart !== false){
            $resAll['depart'] = array('status'=>200, 'msg'=>'Delete depart Successful');

            $resPatdata = $p->delPatdataFromIdno($departId);
            if($resPatdata!==false){
                $resAll['patdata'] = array('status'=>200, 'msg'=>'Delete patdata Successful');
            }else{
                $resAll['patdata'] = array('status'=>400, 'msg'=>$p->getMsgError());
            }

        }else{
            $resAll['depart'] = array('status'=>400, 'msg'=>$p->getMsgError());
        }
    }
}
echo $j->encode($resAll);
exit;