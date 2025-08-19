<div>
		<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
		<div>
			<input type="checkbox" onclick="clickInclisiran()" class="inputInclisiran" id="inputInclisiran1" name="detail[]" value="INCIL1"><label for="inputInclisiran1">1.) ผู้ป่วย DM ที่มีความเสี่ยงสูง (ประเมิณโรคเบาหวานที่มีความเสี่ยงสูง) ที่มี LDL-C สูงและไม่มีโรคหัวใจ ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label>
			<div style="" id="subIncli1">
				<ul>
					<li><input type="checkbox" class="subDetail1" id="sub_detail1" name="sub_detail[]" value="INCIL1_1"><label for="sub_detail1">1.1) Target organ damage</label></li>
					<li><input type="checkbox" class="subDetail1" id="sub_detail2" name="sub_detail[]" value="INCIL1_2"><label for="sub_detail2">1.2) เป็นมานาน ≥10ปี</label></li>
					<li>
						<input type="checkbox" class="subDetail1" id="sub_detail3" name="sub_detail[]" value="INCIL1_3"><label for="sub_detail3">1.3) มีความเสี่ยงอื่นๆ เพิ่มเติม ได้แก่</label>
						<ul>
							<li>- มี subclinical atherosclerosis เช่น Coronary calcium score ≥1,000</li>
							<li>- ประวัติครอบครัวมี premature atherosclerosis ผู้หญิงอายุ &lt;55 ปี ผู้ชายอายุ &lt;45 ปี</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div>
			<input type="checkbox" onclick="clickInclisiran2()" class="inputInclisiran" id="inputInclisiran2" name="detail[]" value="INCIL2"><label for="inputInclisiran2">2.) ผู้ป่วยโรคคอเลสเตอรอลสูงทางพันธุกรรม (ประเมิณตาม Dutch Lipid Clinic Network Criteria ≥ 6) (familial hypercholesterolemia) ใช้ยากลุ่ม statin + ezetimibe ไม่สามารถลดLDL ให้ต่ำกว่า 70,100 mg/dl</label>
			<div style="" id="subIncli2">
				<table style="width:80%; margin: 0 auto;">
					<tr>
						<td colspan="3" style="text-align:center; font-weight:bold;">เกณฑ์การวินิจฉัยโรคคอเลสเตอรอลสูงทางพันธุกรรมหรือ Familial Hypercholesterolemia (FH)<br>ใช้ตาม Dutch Lipid Clinic Network Criteria โดยมีคะแนนมากกว่าหรือเท่ากับ 6</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold;">Dutch Lipid Clinic Network Criteria</td>
						<td>Points</td>
					</tr>
					<tr>
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group1: Family history</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="1" id="incil2_1" name="sub_detail[]" value="INCIL2_1"></td>
						<td><label for="incil2_1">First-degree relative with known premature (<55 years, men; &lt;60 years, women) coronary heart disease (CHD) OR First-degree relative with known LDL cholesterol &gt;95th percentile by age and gender for country</label></td>
						<td align="center">1</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="2" id="incil2_2" name="sub_detail[]" value="INCIL2_2"></td>
						<td><label for="incil2_2">First-degree relative with tendon xanthoma and/or corneal arcus OR Child(ren) &lt;18 years with LDL cholesterol &gt; 95th percentile by age and gender for country</label></td>
						<td align="center">2</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group2: Clinical history</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="2" id="incil2_3" name="sub_detail[]" value="INCIL2_3"></td>
						<td><label for="incil2_3">Subject has premature  (&lt;55 years, men; &lt;60 years, women) CHD</label></td>
						<td align="center">2</td>
					</tr>
					<tr>
						<td><input type="checkbox" class="subDetail2" data-score="1" id="incil2_4" name="sub_detail[]" value="INCIL2_4"></td>
						<td><label for="incil2_4">Subject has premature (&lt;55 years, men; &lt;60 years, women) cerebral or peripheral vascular disease</label></td>
						<td align="center">1</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group 3: Physical examination</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="6" id="incil2_5" name="sub_detail[]" value="INCIL2_5"></td>
						<td><label for="incil2_5">Tendon xanthoma</label></td>
						<td align="center">6</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="4" id="incil2_6" name="sub_detail[]" value="INCIL2_6"></td>
						<td><label for="incil2_6">Corneal arcus in a person &lt;45 years</label></td>
						<td align="center">4</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group 4: Biochemical results (LDL cholesterol)</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="8" id="incil2_7" name="sub_detail[]" value="INCIL2_7"></td>
						<td><label for="incil2_7">&gt; 8.5 mmol/L (&gt;325 mg/dL)</label></td>
						<td align="center">8</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="5" id="incil2_8" name="sub_detail[]" value="INCIL2_8"></td>
						<td><label for="incil2_8">6.5 – 8.4 mmol/L (251-325 mg/dL)</label></td>
						<td align="center">5</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="3" id="incil2_9" name="sub_detail[]" value="INCIL2_9"></td>
						<td><label for="incil2_9">5.0 – 6.4 mmol/L (191-250 mg/dL)</label></td>
						<td align="center">3</td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="1" id="incil2_10" name="sub_detail[]" value="INCIL2_10"></td>
						<td><label for="incil2_10">4.0 – 4.9 mmol/L (155-190 mg/dL)</label></td>
						<td align="center">1</td>
					</tr>
					<tr valign="top">
						<td colspan="2" style="font-weight:bold; background-color:#dddddd;">Group 5: Molecular genetic testing (DNA analysis)</td>
						<td></td>
					</tr>
					<tr valign="top">
						<td><input type="checkbox" class="subDetail2" data-score="8" id="incil2_11" name="sub_detail[]" value="INCIL2_11"></td>
						<td><label for="incil2_11">Causative mutation shown in the LDLR, APOB, or PCSK9 genes</label></td>
						<td align="center">8</td>
					</tr>
				</table>
			</div>
		</div>
		<p><input type="checkbox" class="inputInclisiran" id="inputInclisiran3" name="detail[]" value="INCIL3"><label for="inputInclisiran3">3.) เกิดผลข้างเคียงจากยากลุ่ม statin ไม่สามารถทนต่อผลข้างเคียงได้</label></p>
		<p style="text-align: center;">
			<button type="button" onclick="confirmInclisiran('${drugcode}')" class="button">ยืนยันการสั่งใช้</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
			<input type="hidden" name="criteria" id="criteria" value="Inclisiran">
		</p>
	</div>