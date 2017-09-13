<?php

	class class_upload{
		
		var $limit_size = 1048576;	 // 'กำหนดขนาดของไฟล์'       ที่สามารถอับโหลดได้ มีหน่วยเป็น byte
		var $limit_type = array();		// 'กำหนดนามสกุลของไฟล์'       ที่สามารถอับโหลดได้
		//var $limit_type_i = 0;				// ตัวเลขดัชนีของ ตัวแปร limit_type
		var $files ;									// ค่าไฟล์ที่อับโหลดเข้ามา
		var $file_error ;						// 'สถานะของไฟล์'         0 = ปรกติ , 1 = มีความผิดพลาด
		var $file_name;						// 'ชื่อของไฟล์'       ที่ อับโหลด
		var $file_size;							// 'ขนาดของไฟล์'       ที่อับโหลด
		var $file_type;							// 'นามสกุลของไฟล์'       ที่อับโหลด
		var $file_type_detail;			// 'รายละเอียดของนามสกุลของไฟล์'       ที่อับโหลด
		var $file_tmp;							// ไฟล์ชั่วคราวเพื่อรอไปเก็บไว้บนเซิร์ปเวอร์
		var $txt_error;							//'ข้อความในการแสดง Error'
		var $path;
		var $fname;



// function set_limit_size ********************************************************************************************
// function ในการกำหนดขนาดของไฟล์ $var = ขนาดของไฟล์ , $type = หน่วยของขนาดไฟล์ เช่น mb, kb อื่นๆจะถือว่าเป็น byte
		function set_limit_size($var,$type="byte"){ 
			$type = trim(strtolower($type)); // เปลี่ยนเป็นตัวอักษรตัวเล็กและตัววรรคหน้าหลังออก
				if(is_int($var)){
					switch($type){
						case "mb" :$this->limit_size = ($var*1024*1024);  break;
						case "kb" :$this->limit_size = ($var*1024);  break;
						default : $this->limit_size = $var; break;
					}
				}
			}



// function set_limit_type *****************************************************************************************************
//function ในการกำหนดนามสกุลขอไฟล์ที่สามารถอับโหลดได้ ************************************************************************
		function set_limit_type($var){ 
			
			array_push($this->limit_type, $var);
			
		}


// function set_file_error *****************************************************************************************************
// function ในการบอกสถานะในการ อับโหลด 0 = ปรกติ,  1 = ผิดพลาด
		function set_file_error($var){ $this->file_error = $var; }


// function set_file_name *****************************************************************************************************
		function set_file_name($var){ $this->file_name = $var; }


// function set_file_size *****************************************************************************************************
		function set_file_size($var){ $this->file_size = $var; }


// function set_file_type *****************************************************************************************************
		function set_file_type($var){ $this->file_type = strtolower($var); }

// function set_file_type_detail *****************************************************************************************************
		function set_file_type_detail($var){ $this->file_type_detail = $var; }


// function set_file_type *****************************************************************************************************
		function set_file_tmp($var){ $this->file_tmp = $var; }

// function set_txt_error *****************************************************************************************************
		function set_txt_error($var){ $this->txt_error = $var; }


		function set_file($var){ 
			$this->files = $var["name"]; 
			$this->set_file_name($var["name"]); 
			$this->set_file_size($var["size"]); 
			
			$list = explode(".",$var["name"]);
			$surname = $list[count($list)-1];
			$this->set_file_type($surname);
			$this->set_file_type_detail($var["type"]);
			$this->set_file_tmp($var["tmp_name"]);
		}
		
		function check_size(){
			if($this->file_size > $this->limit_size)
				return false;
			else
				return true;
		}

		function check_type(){
			$stat = false;
			foreach ($this->limit_type as & $value) {
				if($value == $this->file_type){
					$stat = true;
				}
			}
			return $stat;
		}

		function set_path($var){
			$this->path = trim($var);
		}

		function get_path(){
			return $this->path;
		}

		function upload($fname=""){
		
			if(!$this->check_size()){
				$this->set_file_error(1);
				$this->set_txt_error("ไฟล์เอกสารมีขนาดใหญ่เกินไป");
				return false;
			}else if(!$this->check_type()){
				$this->set_file_error(2);
				$this->set_txt_error("ไม่อนุญาติให้นำไฟล์นามสกุล .".$this->file_type);
				return false;
			}else{
				if($fname == ""){
					$fname = time();
				}else{
					$fname = str_replace("/","-",$fname);
				}
				$this->fname = $this->get_path().$fname.".".$this->file_type;
				$result = move_uploaded_file($this->file_tmp, $this->get_path().$fname.".".$this->file_type);
				
				return $result;
			}


		}

	}

?>



