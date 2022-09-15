<?php 
/**
 * ความตั้งใจในการสร้าง class ตัวนี้ขึ้นมาก็เพื่อใช้ยิงค่าใช้จ่ายเกี่ยวกับ lab เพราะขี้เกียจจะมาเขียนโปรแกรมทุกครั้งเมื่อมีการ
 * ทำงานเกี่ยวกับค่าใช้จ่ายของ lab ที่เป็นผู้ป่วยนอก
 * 
 * HN + VN + รายการ lab โยนเข้ามา
 * 
 * !!! ไม่เกี่ยวกับ ค่าบริการผู้ป่วยนอก หรือการสร้าง VN แต่อย่างใด
 * 
 * เพิ่มเข้าตาราง orderhead -> orderdetail -> depart -> patdata
 */
require_once 'bootstrap.php';
/**
 * !!! labnumber !!!  -->  อาจจะต้องมีเงื่อนไขหรือ setting อะไรสักอย่างเพื่อบอกว่า labnubmer เป็นแบบตรวจสุขภาพภายนอก
 * หรือ เป็นแบบ walk-in 
 * 
 * 
 */
class OpdReceive 
{
    private $dbi = false;
    public function __construct(array $settings)
    {

        $labnumberType = $settings['labnumberType'];

        $this->dbi = new mysqli(HOST,USER,PASS,DB);
        $this->dbi->query("SET NAMES UTF8");
    }

    public function getItem(array $items){
        foreach ($items as $key => $item) { 
            $code = $this->dbi->escape_string($item);
            $q = $this->dbi->query("SELECT code,detail,price,yprice,nprice FROM labcare WHERE code LIKE '$item' ");
            dump($q->fetch_assoc());
            
        }
    }
}

$a = new OpdReceive();
$a->getItem(['chol']);