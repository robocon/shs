<?php

	class class_upload{
		
		var $limit_size = 1048576;	 // '��˹���Ҵ�ͧ���'       �������ö�Ѻ��Ŵ�� ��˹����� byte
		var $limit_type = array();		// '��˹����ʡ�Ţͧ���'       �������ö�Ѻ��Ŵ��
		//var $limit_type_i = 0;				// ����Ţ�Ѫ�բͧ ����� limit_type
		var $files ;									// ���������Ѻ��Ŵ�����
		var $file_error ;						// 'ʶҹТͧ���'         0 = �á�� , 1 = �դ����Դ��Ҵ
		var $file_name;						// '���ͧ͢���'       ��� �Ѻ��Ŵ
		var $file_size;							// '��Ҵ�ͧ���'       ����Ѻ��Ŵ
		var $file_type;							// '���ʡ�Ţͧ���'       ����Ѻ��Ŵ
		var $file_type_detail;			// '��������´�ͧ���ʡ�Ţͧ���'       ����Ѻ��Ŵ
		var $file_tmp;							// �����Ǥ��������������麹���������
		var $txt_error;							//'��ͤ���㹡���ʴ� Error'
		var $path;
		var $fname;



// function set_limit_size ********************************************************************************************
// function 㹡�á�˹���Ҵ�ͧ��� $var = ��Ҵ�ͧ��� , $type = ˹��¢ͧ��Ҵ��� �� mb, kb ����ж������� byte
		function set_limit_size($var,$type="byte"){ 
			$type = trim(strtolower($type)); // ����¹�繵���ѡ�õ�������е����ä˹����ѧ�͡
				if(is_int($var)){
					switch($type){
						case "mb" :$this->limit_size = ($var*1024*1024);  break;
						case "kb" :$this->limit_size = ($var*1024);  break;
						default : $this->limit_size = $var; break;
					}
				}
			}



// function set_limit_type *****************************************************************************************************
//function 㹡�á�˹����ʡ�Ţ����������ö�Ѻ��Ŵ�� ************************************************************************
		function set_limit_type($var){ 
			
			array_push($this->limit_type, $var);
			
		}


// function set_file_error *****************************************************************************************************
// function 㹡�ú͡ʶҹ�㹡�� �Ѻ��Ŵ 0 = �á��,  1 = �Դ��Ҵ
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
				$this->set_txt_error("����͡����բ�Ҵ�˭��Թ�");
				return false;
			}else if(!$this->check_type()){
				$this->set_file_error(2);
				$this->set_txt_error("���͹حҵ����������ʡ�� .".$this->file_type);
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



