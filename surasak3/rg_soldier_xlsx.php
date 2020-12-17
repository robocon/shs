<?php 
/**
 * @readme 
 * ��ѭ��੾��˹��仡�͹�¡�������ҧ������Կ����� 192.168.1.13 
 * ������Կ .2 ����� modules php_zip php_xml php_gd2 
 */
include 'bootstrap.php';

function iconv_utf8($txt){
    $txt = iconv('TIS-620','UTF-8',$txt);
    return $txt;
}

function iconv_tis($txt){
    $txt = iconv('UTF-8','TIS-620',$txt);
    return $txt;
}

$page = input('page');
if( empty($page) ){

    ?>
    <p><a href="http://192.168.131.250/sm3/surasak3/rg_soldier.php">&lt;&lt;&nbsp;��Ѻ�˹����ѡ �ê.</a></p>
    <h3>���͡������</h3>
    <form action="rg_soldier_xlsx.php" method="post" id="inputForm">
        <div>
            ���͡��: 
            <?php 
            // $curr_year = get_year_checkup(true);
            $curr_year = date('Y');
            $selected_y = input_post('year_selected', $curr_year);
            
            $range_y = range(2017, $curr_year);
            
            echo getYearList('year_selected', false, $selected_y, $range_y);


            $selected_m = input_post('selected_month', date('m'));
            ?>
            ���͡��͹: <?=getMonthList('selected_month', $selected_m);?>
        </div>
        <div>
            <button type="submit">���͡</button>
            <input type="hidden" name="page" value="export">
        </div>
    </form>
    <?php
}elseif ( $page == 'export' ) {
    
    require_once 'includes/libs/excel18/Classes/PHPExcel.php';
    $db = Mysql::load($from_sub_to_main);

    $year_selected = input_post('year_selected');
    $selected_month = input_post('selected_month');

    $sql = "SELECT a.*, b.`idcard`  
    FROM `rg_soldier` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE `date_certificate` LIKE '$year_selected-$selected_month%' ";
    $db->select($sql);
    $items = $db->get_items();
    // dump($items);

    // foreach ($items as $key => $item) {
    //     dump($item['ptname']);
    //     dump(iconv_tis($item['ptname']));
    //     dump(iconv_utf8($item['ptname']));
    //     echo "<hr>";
    // }

    // exit;

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Kritsanasak Kuntaros")
                                 ->setLastModifiedBy("Kritsanasak Kuntaros")
                                 ->setTitle(iconv_utf8("�ç��Һ�Ť�������ѡ��������"))
                                 ->setSubject(iconv_utf8("�ç��Һ�Ť�������ѡ��������"))
                                 ->setDescription(iconv_utf8("�к����͡������ ��§ҹ�����żš�õ�Ǩ��ҧ��¼������Ѻ�Ѵ���͡�Ҫ��÷��� �Ѳ�ҵ���ʹ�� ��¡�ɳ��ѡ��� �ѹ���"));
    
    $obj = array(
        'font' => array(
            'size' => 16,
            'name' => 'TH SarabunPSK'
        ),
    );
    $objPHPExcel->getDefaultStyle()->applyFromArray($obj);
    
    // �����
    $objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
    $objPHPExcel->getActiveSheet()->mergeCells('A2:K2');
    $objPHPExcel->getActiveSheet()->mergeCells('A3:K3');
    
    // �絵��˹ѧ�������ç��ҧ
    $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    
    // ��Ǣ�ͧҹ
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', iconv_utf8('��§ҹ�����żš�õ�Ǩ��ҧ��¼������Ѻ�Ѵ���͡�Ҫ��÷���'))
    ->setCellValue('A2', iconv_utf8('˹��§ҹ �ç��Һ�Ť�������ѡ��������'))
    ->setCellValue('A3', iconv_utf8('��Ш���͹ '.$def_fullm_th[$selected_month] ));
    
    // ��Ǣ��㹵��ҧ
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A5', iconv_utf8('�ӴѺ'))
    ->setCellValue('B5', iconv_utf8('�ӹ�˹��'))
    ->setCellValue('C5', iconv_utf8('����'))
    ->setCellValue('D5', iconv_utf8('���ʡ��'))
    ->setCellValue('E5', iconv_utf8('���ʻ�Шӵ�ǻ�ЪҪ�'))
    ->setCellValue('F5', iconv_utf8('�ä����Ǩ��'))
    ->setCellValue('G5', iconv_utf8('����з�ǧ���Ѵ'))
    ->setCellValue('H5', iconv_utf8('�������ҷ���'))
    ->setCellValue('I5', iconv_utf8('�ѧ��Ѵ'))
    ->setCellValue('J5', iconv_utf8('�ѹ����͡��Ѻ�ͧ'))
    ->setCellValue('K5', iconv_utf8('��С������ᾷ�����Ǩ'));
    $objPHPExcel->getActiveSheet()->getStyle('E5')->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('H5')->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('K5')->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle('A5:K5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    // �������ҧ�ͧ Cell
    $objPHPExcel->getActiveSheet()->getcolumnDimension('A')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('B')->setWidth(8);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('D')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('I')->setWidth(8);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('J')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getcolumnDimension('K')->setWidth(18);
    
    // �ͺ��Ǣ�ͧ͢���ҧ
    $styleArray = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => 'FF000000'),
            ),
        ),
    );
    
    $objPHPExcel->getActiveSheet()->getStyle('A5:K5')->applyFromArray($styleArray);
    
    
    // �ա�ͺ����੾�� A
    $tableLeftStyle = array(
        'borders' => array(
            'left' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => 'FF000000'),
            )
        ),
    );
    
    // �ա�ͺ ��ҧ �Ѻ ���
    $tableRightBottomStyle = array(
        'borders' => array(
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => 'FF000000'),
            ),
            'right' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => 'FF000000'),
            ),
        ),
    );
    
    $line = 6;
    $i = 1;
    foreach ($items as $key => $item) {
    
        list($name, $surname) = explode(' ', iconv_utf8($item['ptname']));

        list($date, $time) = explode(' ',$item['last_update']);
        list($y, $m, $d) = explode('-', $date);
    
        $lastupdate = $d.' '.$def_fullm_th[$m].' '.( $y + 543 );
    
        $board = $item['yot1'].$item['doctor1']."\n";
        $board .= $item['yot2'].$item['doctor2']."\n";
        $board .= $item['yot3'].$item['doctor3'];
    
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A'.$line, $i)
        ->setCellValue('B'.$line, iconv_utf8($item['yot_pt']))
        ->setCellValue('C'.$line, $name)
        ->setCellValue('D'.$line, $surname)
        ->setCellValue('E'.$line, $item['idcard'])
        ->setCellValue('F'.$line, iconv_utf8($item['diag']))
        ->setCellValue('G'.$line, iconv_utf8($item['regular']))
        ->setCellValue('H'.$line, iconv_utf8($item['address']))
        ->setCellValue('I'.$line, iconv_utf8($item['province']))
        ->setCellValue('J'.$line, iconv_utf8($lastupdate))
        ->setCellValue('K'.$line, iconv_utf8($board));
    
        // ����ѹ�Ѵ��÷Ѵ㹡�ͺ
        $objPHPExcel->getActiveSheet()->getStyle('G'.$line)->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$line)->getAlignment()->setWrapText(true);
    
        // ��ͺ����
        $objPHPExcel->getActiveSheet()->getStyle('A'.$line)->applyFromArray($tableLeftStyle);
        // ��ͺ��ҧ+���
        $objPHPExcel->getActiveSheet()->getStyle('A'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('B'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('C'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('D'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('E'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('F'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('G'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('H'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('I'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('J'.$line)->applyFromArray($tableRightBottomStyle);
        $objPHPExcel->getActiveSheet()->getStyle('K'.$line)->applyFromArray($tableRightBottomStyle);
    
        $line++;
        $i++;
    }
    
    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('AMED 2561');
    
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
    $test = rand();
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="amed'.$test.'.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    
    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    
    exit;

}


?>