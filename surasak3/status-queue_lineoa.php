<?php
include("connect.inc");
// สมมติค่าคิวปัจจุบัน
$patient_id="54-7404";  //รับค่า  HN
$patient_name = "54-7404 เทวิน ศรีแก้ว";  // แสดงHN+ชื่อผู้รับบริการ
$current_queue = "";
$queue_remaining="";
$current_status = "";
$datenow=date("Y-m-d");
$date_th=(date("Y")+543)."-".date("m-d");
// สมมติสถานะปัจจุบัน (1: ซักประวัติ, 2: รอตรวจ, 3: รอรับยา, 4: เสร็จสิ้น)
$sql1 = "SELECT queue_no FROM queue_opd WHERE register_date='$datenow' AND hn='$patient_id' AND (call_status='' || call_status='w')";			
//echo $sql1;
$query1 = mysql_query($sql1);	
$num1=mysql_num_rows($query1);				
if($num1 > 0){
	list($queue_opd)=mysql_fetch_array($query1);
	$current_status = 1;
	$current_queue = $queue_opd;
	
	$sql_opd1="SELECT COUNT(*) AS queue_A FROM queue_opd WHERE register_date = '$datenow' AND queue_no < ( SELECT queue_no FROM queue_opd WHERE hn = '$patient_id' AND register_date = '$datenow' and queue_type='A' LIMIT 1 ) AND (call_status = '' || call_status='w')";
	//echo $sql_opd1;
	$query_opd1 = mysql_query($sql_opd1);	
	$num_opd1=mysql_num_rows($query_opd1);				
	if($num_opd1 > 0){	
		list($queue_A)=mysql_fetch_array($query_opd1);
		$queue_remaining = $queue_A;
	}else{
		$sql_opd2="SELECT COUNT(*) AS queue_B FROM queue_opd WHERE register_date = '$datenow' AND queue_no < ( SELECT queue_no FROM queue_opd WHERE hn = '$patient_id' AND register_date = '$datenow' and queue_type='B' LIMIT 1 ) AND (call_status = '' || call_status='w')";
		$query_opd2 = mysql_query($sql_opd2);	
		$num_opd2=mysql_num_rows($query_opd2);				
		if($num_opd2 > 0){	
			list($queue_B)=mysql_fetch_array($query_opd2);
			$queue_remaining = $queue_B;
		}else{
			$sql_opd3="SELECT COUNT(*) AS queue_C FROM queue_opd WHERE register_date = '$datenow' AND queue_no < ( SELECT queue_no FROM queue_opd WHERE hn = '$patient_id' AND register_date = '$datenow' and queue_type='C' LIMIT 1 ) AND (call_status = '' || call_status='w')";
			$query_opd3 = mysql_query($sql_opd3);	
			$num_opd3=mysql_num_rows($query_opd3);				
			if($num_opd3 > 0){	
				list($queue_C)=mysql_fetch_array($query_opd3);
				$queue_remaining = $queue_C;
			}else{
				$queue_remaining="";
			}
		}			
	}
}	


//------- คิวพบแพทย์ --------//
$sql2 = "SELECT queue_no_new FROM queue_doctor WHERE register_date='$datenow' AND hn='$patient_id' AND (call_status='' || call_status='w')"; //เจอข้อมูลแสดงว่ายังอยู่ในกระบวนการห้องตรวจโรค		
//echo $sql2;
$query2 = mysql_query($sql2);	
$num2=mysql_num_rows($query2);					
if($num2 > 0){
	list($queue_doc)=mysql_fetch_array($query2);
	$current_status = 2;
	$current_queue = $queue_doc;
	
	$sql_doc1="SELECT COUNT(*) AS queue_F1 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F1'
	AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
    SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
	AND register_date = '$datenow'	AND queue_room_new='F1' LIMIT 1 )
	AND (call_status = '' || call_status='w')";
	//echo $sql_doc1;
	$query_doc1 = mysql_query($sql_doc1);	
	$num_doc1=mysql_num_rows($query_doc1);				
	list($queue_F1)=mysql_fetch_array($query_doc1);
	if($num_doc1 > 0 && $queue_F1 > 0){	
		$queue_remaining = $queue_F1;
	}else{
		$sql_doc2="SELECT COUNT(*) AS queue_F2 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F2'
		AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
		SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
		AND register_date = '$datenow'	AND queue_room_new='F2' LIMIT 1 )
		AND (call_status = '' || call_status='w')";
		//echo $sql_doc2;
		$query_doc2 = mysql_query($sql_doc2);	
		$num_doc2=mysql_num_rows($query_doc2);				
		list($queue_F2)=mysql_fetch_array($query_doc2);
		if($num_doc2 > 0 && $queue_F2 > 0){	
			$queue_remaining = $queue_F2;
		}else{
			$sql_doc3="SELECT COUNT(*) AS queue_F3 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F3'
			AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
			SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
			AND register_date = '$datenow'	AND queue_room_new='F3' LIMIT 1 )
			AND (call_status = '' || call_status='w')";
			//echo $sql_doc3;
			$query_doc3 = mysql_query($sql_doc3);	
			$num_doc3=mysql_num_rows($query_doc3);
			list($queue_F3)=mysql_fetch_array($query_doc3);		
			if($num_doc3 > 0 && $queue_F3 > 0){	
				$queue_remaining = $queue_F3;
			}else{
				$sql_doc4="SELECT COUNT(*) AS queue_F4 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F4'
				AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
				SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
				AND register_date = '$datenow'	AND queue_room_new='F4' LIMIT 1 )
				AND (call_status = '' || call_status='w')";
				//echo $sql_doc4;
				$query_doc4 = mysql_query($sql_doc4);	
				$num_doc4=mysql_num_rows($query_doc4);				
				list($queue_F4)=mysql_fetch_array($query_doc4);
				if($num_doc4 > 0 && $queue_F4 > 0){	
					$queue_remaining = $queue_F4;
				}else{
					$sql_doc5="SELECT COUNT(*) AS queue_F5 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F5'
					AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
					SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
					AND register_date = '$datenow'	AND queue_room_new='F5' LIMIT 1 )
					AND (call_status = '' || call_status='w')";
					//echo $sql_doc5;
					$query_doc5 = mysql_query($sql_doc5);	
					$num_doc5=mysql_num_rows($query_doc5);				
					list($queue_F5)=mysql_fetch_array($query_doc5);
					if($num_doc5 > 0 && $queue_F5 > 0){	
						$queue_remaining = $queue_F5;
					}else{
						$sql_doc6="SELECT COUNT(*) AS queue_F6 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F6'
						AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
						SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
						AND register_date = '$datenow'	AND queue_room_new='F6' LIMIT 1 )
						AND (call_status = '' || call_status='w')";
						//echo $sql_doc6;
						$query_doc6 = mysql_query($sql_doc6);	
						$num_doc6=mysql_num_rows($query_doc6);				
						list($queue_F6)=mysql_fetch_array($query_doc6);
						if($num_doc6 > 0 && $queue_F6 > 0){	
							$queue_remaining = $queue_F6;
						}else{
							$sql_doc7="SELECT COUNT(*) AS queue_F7 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F7'
							AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
							SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
							AND register_date = '$datenow'	AND queue_room_new='F7' LIMIT 1 )
							AND (call_status = '' || call_status='w')";
							//echo $sql_doc7;
							$query_doc7 = mysql_query($sql_doc7);	
							$num_doc7=mysql_num_rows($query_doc7);				
							list($queue_F7)=mysql_fetch_array($query_doc7);
							if($num_doc7 > 0 && $queue_F7 > 0){	
								$queue_remaining = $queue_F7;
							}else{
								$sql_doc8="SELECT COUNT(*) AS queue_F8 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F8'
								AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
								SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
								AND register_date = '$datenow'	AND queue_room_new='F8' LIMIT 1 )
								AND (call_status = '' || call_status='w')";
								//echo $sql_doc8;
								$query_doc8 = mysql_query($sql_doc8);	
								$num_doc8=mysql_num_rows($query_doc8);	
								list($queue_F8)=mysql_fetch_array($query_doc8);								
								if($num_doc8 > 0 && $queue_F8 > 0){	
									$queue_remaining = $queue_F8;
								}else{
									$sql_doc9="SELECT COUNT(*) AS queue_F9 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F9'
									AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
									SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
									AND register_date = '$datenow'	AND queue_room_new='F9' LIMIT 1 )
									AND (call_status = '' || call_status='w')";
									//echo $sql_doc9;
									$query_doc9 = mysql_query($sql_doc9);	
									$num_doc9=mysql_num_rows($query_doc9);				
									list($queue_F9)=mysql_fetch_array($query_doc9);
									if($num_doc9 > 0 && $queue_F9 > 0){											
										$queue_remaining = $queue_F9;
									}else{
										$sql_doc10="SELECT COUNT(*) AS queue_F10 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F10'
										AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
										SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
										AND register_date = '$datenow'	AND queue_room_new='F10' LIMIT 1 )
										AND (call_status = '' || call_status='w')";
										//echo $sql_doc10;
										$query_doc10 = mysql_query($sql_doc10);	
										$num_doc10=mysql_num_rows($query_doc10);				
										list($queue_F10)=mysql_fetch_array($query_doc10);										
										if($num_doc10 > 0 && $queue_F10 > 0){	
											$queue_remaining = $queue_F10;
										}else{
											$sql_doc11="SELECT COUNT(*) AS queue_F11 FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'F11'
											AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
											SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
											AND register_date = '$datenow'	AND queue_room_new='F11' LIMIT 1 )
											AND (call_status = '' || call_status='w')";
											//echo $sql_doc11;
											$query_doc11 = mysql_query($sql_doc11);	
											$num_doc11=mysql_num_rows($query_doc11);
											list($queue_F11)=mysql_fetch_array($query_doc11);											
											if($num_doc11 > 0 && $queue_F11 > 0){											
												$queue_remaining = $queue_F11;
											}else{
												$sql_docg="SELECT COUNT(*) AS queue_G FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'G'
												AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
												SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
												AND register_date = '$datenow'	AND queue_room_new='G' LIMIT 1 )
												AND (call_status = '' || call_status='w')";
												//echo $sql_docg;
												$query_docg = mysql_query($sql_docg);	
												$num_docg=mysql_num_rows($query_docg);
												list($queue_G)=mysql_fetch_array($query_docg);											
												if($num_docg > 0 && $queue_G > 0){											
													$queue_remaining = $queue_G;
												}else{
													$sql_docp="SELECT COUNT(*) AS queue_P FROM queue_doctor WHERE register_date = '$datenow' AND queue_room_new = 'P'
													AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
													SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) FROM queue_doctor WHERE hn = '$patient_id'
													AND register_date = '$datenow'	AND queue_room_new='P' LIMIT 1 )
													AND (call_status = '' || call_status='w')";
													//echo $sql_docp;
													$query_docp = mysql_query($sql_docp);	
													$num_docp=mysql_num_rows($query_docp);
													list($queue_P)=mysql_fetch_array($query_docp);											
													if($num_docp > 0 && $queue_P > 0){											
														$queue_remaining = $queue_P;
													}else{
														$sql_docw1="SELECT COUNT(*) AS queue_W1 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W1'
														AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
														SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
														AND register_date = '$datenow'	AND queue_room_new='W1' LIMIT 1 )
														AND (call_status = '' || call_status='w')";
														//echo $sql_docw1;
														$query_docw1 = mysql_query($sql_docw1);	
														$num_docw1=mysql_num_rows($query_docw1);				
														list($queue_W1)=mysql_fetch_array($query_docw1);
														if($num_docw1 > 0 && $queue_W1 > 0){	
															$queue_remaining = $queue_W1;
														}else{
															$sql_docw2="SELECT COUNT(*) AS queue_W2 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W2'
															AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
															SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
															AND register_date = '$datenow'	AND queue_room_new='W2' LIMIT 1 )
															AND (call_status = '' || call_status='w')";
															//echo $sql_docw2;
															$query_docw2 = mysql_query($sql_docw2);	
															$num_docw2=mysql_num_rows($query_docw2);				
															list($queue_W2)=mysql_fetch_array($query_docw2);
															if($num_docw2 > 0 && $queue_W2 > 0){	
																$queue_remaining = $queue_W2;
															}else{
																$sql_docw3="SELECT COUNT(*) AS queue_W3 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W3'
																AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																AND register_date = '$datenow'	AND queue_room_new='W3' LIMIT 1 )
																AND (call_status = '' || call_status='w')";
																//echo $sql_docw3;
																$query_docw3 = mysql_query($sql_docw3);	
																$num_docw3=mysql_num_rows($query_docw3);
																list($queue_W3)=mysql_fetch_array($query_docw3);		
																if($num_docw3 > 0 && $queue_W3 > 0){	
																	$queue_remaining = $queue_W3;
																}else{
																	$sql_docw4="SELECT COUNT(*) AS queue_W4 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W4'
																	AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																	SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																	AND register_date = '$datenow'	AND queue_room_new='W4' LIMIT 1 )
																	AND (call_status = '' || call_status='w')";
																	//echo $sql_docw4;
																	$query_docw4 = mysql_query($sql_docw4);	
																	$num_docw4=mysql_num_rows($query_docw4);				
																	list($queue_W4)=mysql_fetch_array($query_docw4);
																	if($num_docw4 > 0 && $queue_W4 > 0){	
																		$queue_remaining = $queue_W4;
																	}else{
																		$sql_docw5="SELECT COUNT(*) AS queue_W5 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W5'
																		AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																		SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																		AND register_date = '$datenow'	AND queue_room_new='W5' LIMIT 1 )
																		AND (call_status = '' || call_status='w')";
																		//echo $sql_docw5;
																		$query_docw5 = mysql_query($sql_docw5);	
																		$num_docw5=mysql_num_rows($query_docw5);				
																		list($queue_W5)=mysql_fetch_array($query_docw5);
																		if($num_docw5 > 0 && $queue_W5 > 0){	
																			$queue_remaining = $queue_W5;
																		}else{
																			$sql_docw6="SELECT COUNT(*) AS queue_W6 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W6'
																			AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																			SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																			AND register_date = '$datenow'	AND queue_room_new='W6' LIMIT 1 )
																			AND (call_status = '' || call_status='w')";
																			//echo $sql_docw6;
																			$query_docw6 = mysql_query($sql_docw6);	
																			$num_docw6=mysql_num_rows($query_docw6);				
																			list($queue_W6)=mysql_fetch_array($query_docw6);
																			if($num_docw6 > 0 && $queue_W6 > 0){	
																				$queue_remaining = $queue_W6;
																			}else{
																				$sql_docw7="SELECT COUNT(*) AS queue_W7 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W7'
																				AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																				SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																				AND register_date = '$datenow'	AND queue_room_new='W7' LIMIT 1 )
																				AND (call_status = '' || call_status='w')";
																				//echo $sql_docw7;
																				$query_docw7 = mysql_query($sql_docw7);	
																				$num_docw7=mysql_num_rows($query_docw7);				
																				list($queue_W7)=mysql_fetch_array($query_docw7);
																				if($num_docw7 > 0 && $queue_W7 > 0){	
																					$queue_remaining = $queue_W7;
																				}else{
																					$sql_docw8="SELECT COUNT(*) AS queue_W8 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W8'
																					AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																					SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																					AND register_date = '$datenow'	AND queue_room_new='W8' LIMIT 1 )
																					AND (call_status = '' || call_status='w')";
																					//echo $sql_docw8;
																					$query_docw8 = mysql_query($sql_docw8);	
																					$num_docw8=mysql_num_rows($query_docw8);	
																					list($queue_W8)=mysql_fetch_array($query_docw8);								
																					if($num_docw8 > 0 && $queue_W8 > 0){	
																						$queue_remaining = $queue_W8;
																					}else{
																						$sql_docw9="SELECT COUNT(*) AS queue_W9 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W9'
																						AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																						SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																						AND register_date = '$datenow'	AND queue_room_new='W9' LIMIT 1 )
																						AND (call_status = '' || call_status='w')";
																						//echo $sql_docw9;
																						$query_docw9 = mysql_query($sql_docw9);	
																						$num_docw9=mysql_num_rows($query_docw9);				
																						list($queue_W9)=mysql_fetch_array($query_docw9);
																						if($num_docw9 > 0 && $queue_W9 > 0){											
																							$queue_remaining = $queue_W9;
																						}else{
																							$sql_docw10="SELECT COUNT(*) AS queue_W10 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W10'
																							AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																							SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																							AND register_date = '$datenow'	AND queue_room_new='W10' LIMIT 1 )
																							AND (call_status = '' || call_status='w')";
																							//echo $sql_docw10;
																							$query_docw10 = mysql_query($sql_docw10);	
																							$num_docw10=mysql_num_rows($query_docw10);				
																							list($queue_W10)=mysql_fetch_array($query_docw10);										
																							if($num_docw10 > 0 && $queue_W10 > 0){	
																								$queue_remaining = $queue_W10;
																							}else{
																								$sql_docw11="SELECT COUNT(*) AS queue_W11 WROM queue_docwtor WHERE register_date = '$datenow' AND queue_room_new = 'W11'
																								AND CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) < (
																								SELECT CAST(SUBSTRING(queue_no_new, 3) AS UNSIGNED) WROM queue_docwtor WHERE hn = '$patient_id'
																								AND register_date = '$datenow'	AND queue_room_new='W11' LIMIT 1 )
																								AND (call_status = '' || call_status='w')";
																								//echo $sql_docw11;
																								$query_docw11 = mysql_query($sql_docw11);	
																								$num_docw11=mysql_num_rows($query_docw11);
																								list($queue_W11)=mysql_fetch_array($query_docw11);											
																								if($num_docw11 > 0 && $queue_W11 > 0){											
																									$queue_remaining = $queue_W11;
																								}else{
																									$queue_remaining = "";
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}															
													}  //close
												}				
											}			
										}			
									}	
								}	
							}	
						}
					}
				}
			}
		}			
	}		
}





//------- คิวรับยา ทค--------//
$sql3 = "SELECT kewphar FROM dphardep 
WHERE date LIKE '$date_th%' AND hn = '$patient_id' AND kewphar LIKE 'ทค%'  AND pharin <> ''  AND kewphar <> '' AND stkcutdate <> '' AND dr_cancle 	is null
ORDER BY pharout DESC";			
//echo $sql3;
$query3 = mysql_query($sql3);	
$num3=mysql_num_rows($query3);					
if($num3 > 0){
	list($queue_phar)=mysql_fetch_array($query3);
	$current_status = 3;
	$current_queue = $queue_phar;
	
	
	$sql_phar1="SELECT COUNT(*) AS queue_P1 FROM dphardep WHERE date LIKE '$date_th%' AND kewphar LIKE 'ทค%'
	AND CAST(SUBSTRING(kewphar, 3) AS UNSIGNED) < (
    SELECT CAST(SUBSTRING(kewphar, 3) AS UNSIGNED) FROM dphardep WHERE hn = '$patient_id'
	AND date LIKE '$date_th%' AND kewphar LIKE 'ทค%' LIMIT 1 )
	AND pharout IS NULL";
	//echo $sql_phar1;
	$query_phar1 = mysql_query($sql_phar1);	
	$num_phar1=mysql_num_rows($query_phar1);				
	if($num_phar1 > 0){	
		list($queue_P1)=mysql_fetch_array($query_phar1);
		$queue_remaining = $queue_P1;	
	}else{
		$queue_remaining = "";
	}		
}

//------- คิวรับยาทั่วไป--------//
$sql4 = "SELECT kewphar FROM dphardep 
WHERE date LIKE '$date_th%' AND hn = '$patient_id' AND (kewphar NOT LIKE 'ทค%'  AND kewphar !='') AND pharin <> ''  AND kewphar <> '' AND stkcutdate <> '' AND dr_cancle 	is null
ORDER BY pharout DESC";			
//echo $sql4;
$query4 = mysql_query($sql4);	
$num4=mysql_num_rows($query4);					
if($num4 > 0){
	list($queue_phar)=mysql_fetch_array($query4);
	$current_status = 3;
	$current_queue = $queue_phar;
	
	
	$sql_phar2="SELECT COUNT(*) AS queue_P2 FROM dphardep WHERE date LIKE '$date_th%' AND (kewphar NOT LIKE 'ทค%'  AND kewphar !='')
	AND kewphar < (
	SELECT kewphar FROM dphardep WHERE hn = '$patient_id'
	AND date LIKE '$date_th%' AND (kewphar NOT LIKE 'ทค%'  AND kewphar !='') LIMIT 1 )
	AND pharout IS NULL";
	//echo $sql_phar2;
	$query_phar2 = mysql_query($sql_phar2);	
	$num_phar2=mysql_num_rows($query_phar2);				
	if($num_phar2 > 0){	
		list($queue_P2)=mysql_fetch_array($query_phar2);
		$queue_remaining = $queue_P2;
	}else{
		$queue_remaining = "";
	}		
}

//echo "$num1...$num2---$num3";
if($num1 <= 0 && $num2 <= 0 && $num3 <= 0 && $num4 <= 0){
	$current_status = 4;
}


if($current_status=="1"){
	$depart_name="ซักประวัติ/คัดกรอง";
}else if($current_status=="2"){
	$depart_name="ห้องตรวจโรค";
}else if($current_status=="3"){
	$depart_name="ห้องจ่ายยา";
}else if($current_status=="4"){	
	$depart_name="ยินดีให้บริการ";
}
// สมมติจำนวนคิวที่เหลือ
/*$queue_remaining = [
    1 => 1,  // เหลืออีก 1 คิวก่อนซักประวัติ
    2 => 3,  // เหลืออีก 3 คิวก่อนพบแพทย์
    3 => 2,  // เหลืออีก 2 คิวก่อนรับยา
];*/



//คำสั่ง sql จำนวนคิวที่เหลือ
//SELECT COUNT(*) AS queue_ahead FROM queue_opd WHERE register_date = "2025-05-08" AND queue_no < ( SELECT queue_no FROM queue_opd WHERE hn = '50-4096' AND register_date = "2025-05-08" and queue_type='DEN' LIMIT 1 ) AND call_status = '';
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ติดตามสถานะคิวโรงพยาบาล</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .header {
            background: #26a69a;
            color: white;
            text-align: center;
            padding: 16px;
            font-size: 24px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .container {
            max-width: 480px;
            margin: 0 auto;
            padding: 16px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card-status {
            background: #fbfcfc;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }		
        .queue-number {
            font-size: 64px;
            color: #e74c3c;
            font-weight: bold;
        }
        .status-box {
            border-radius: 24px;
            padding: 12px 16px;
            font-weight: bold;
            display: inline-block;
            margin-top: 12px;
			width: 80%;
        }
        .status-active {
            background: #b9f6ca;
            color: #2e7d32;
        }
        .status-department {
            border-radius: 24px;
            padding: 12px 16px;
            font-weight: bold;
            display: inline-block;
            margin-top: 12px;
			width: 80%;
        }
		
        .status-department {
            background: #d7dbdd;
            color: #2980b9;
        }		
        .step {
            display: flex;
            align-items: center;
            margin: 16px 0;
        }
        .step-icon {
            flex: 0 0 48px;
            height: 48px;
            width: 48px;
            border-radius: 50%;
            background: #7f8c8d;
            color: white;
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .step.active .step-icon {
            background: #26a69a;
        }
        .step-content {
            margin-left: 16px;
        }
        .step-title {
			font-size: 20px;
			font-weight: bold;
			color: #2980b9;			
        }
        .queue-remaining {
            background: #ff5722;
            color: white;
            padding: 4px 10px;
            border-radius: 16px;
            margin-top: 4px;
            display: inline-block;
            font-size: 14px;
        }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function loadQueueStatus() {
    $.ajax({
      url: 'status-queue_lineoa.php', // ไฟล์ PHP ที่ใช้ดึงข้อมูลสถานะคิว
      type: 'GET',
      success: function (data) {
        $('#queue-status').html(data);
      }
    });
  }

  // โหลดครั้งแรก
  loadQueueStatus();
  // โหลดซ้ำทุก 3 นาที
  setInterval(loadQueueStatus, 60000);
</script>
<body>
<div id="queue-status">
<div class="header">
    โรงพยาบาลค่ายสุรศักดิ์มนตรี
</div>

<div class="container">

    <div class="card">
        <div class="status-box status-department" style="font-size: 24px; font-weight:bold; margin-bottom: 8px;"><?php echo $depart_name;?></div>
        <div style="font-size: 16px;"><?= $patient_name ?></div>
        <div class="queue-number"><?= $current_queue ?></div>
        <div class="status-box status-active">สถานะคิวของท่าน</div>
    </div>
	<div class="card-status">
    <!-- Step 1: ซักประวัติ -->
    <div class="step <?= $current_status == 1 ? 'active' : '' ?>">
        <div class="step-icon">✓</div>
        <div class="step-content">
            <div class="step-title">รอเรียกซักประวัติ</div>
            <div style="font-size: 14px;">กรุณารอพยาบาลเรียกเพื่อตรวจสอบ</div>
            <?php if ($current_status == 1): ?>
			<? if($queue_remaining !=""){ ?>
                <div class="queue-remaining">อีกประมาณ <?= $queue_remaining; ?> คิว</div>
            <? } ?>
			<?php endif; ?>
        </div>
    </div>

    <!-- Step 2: พบแพทย์ -->
    <div class="step <?= $current_status == 2 ? 'active' : '' ?>">
        <div class="step-icon">✓</div>
        <div class="step-content">
            <div class="step-title">รอเข้ารับการตรวจ</div>
            <div style="font-size: 14px;">โปรดเตรียมตัวเข้าพบแพทย์</div>
            <?php if ($current_status == 2): ?>
                <? if($queue_remaining !=""){ ?>
				<div class="queue-remaining">อีกประมาณ <?= $queue_remaining; ?> คิว</div>
				<? } ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Step 3: รับยา -->
    <div class="step <?= $current_status == 3 ? 'active' : '' ?>">
        <div class="step-icon">✓</div>
        <div class="step-content">
            <div class="step-title">รอรับยา</div>
            <div style="font-size: 14px;">โปรดรอเจ้าหน้าที่เรียกรับยา</div>
            <?php if ($current_status == 3): ?>
			<? if($queue_remaining !=""){ ?>
                <div class="queue-remaining">อีกประมาณ <?= $queue_remaining; ?> คิว</div>
			<? } ?>	
            <?php endif; ?>
        </div>
    </div>

    <!-- Step 4: เสร็จสิ้น -->
    <div class="step <?= $current_status == 4 ? 'active' : '' ?>">
        <div class="step-icon">✓</div>
        <div class="step-content">
            <div class="step-title">รับบริการเรียบร้อยแล้ว</div>
            <div style="font-size: 14px;">ขอบคุณที่ใช้บริการ</div>
        </div>
    </div>
	
	</div>
</div>
</div>
</body>
</html>
