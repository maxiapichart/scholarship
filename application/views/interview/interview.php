<?php function match_select($select, $val, $group = false) {
	if(is_numeric($val)) {
		$column	= array_column($select, 'selectdata_id');
		$key		= array_search($val, $column);
		return $group ? [$select[$key]['selectdata_title'], $select[$key]['selectdata_group']] : $select[$key]['selectdata_title'];
	} else {
		return $val;
	}
}
function match_multiselect($select, $val) {
	$data	= '';
	$column	= array_column($select, 'selectdata_id');
	foreach (json_decode($val) as $k => $v) {
		$key	= array_search($v, $column);
		$data	.= $data != '' ? ', ' : '';
		$data	.= $select[$key]['selectdata_title'];
	}
	return $data;
} ?>
<div class="container-fluid">
	<section class="pt-5">
		<div class="row mb-4">
			<div class="col mb-4">
				<div class="card">
					<div class="card-header text-center">
						<h2 class="mb-0">ใบสมัครขอรับทุนการศึกษา มหาวิทยาลัยสงขลานครินทร์ ประจำปีการศึกษา <?php echo $registration['year'] + 543; ?></h2>
						<!-- <small class="text-muted"><?php //echo 'เปิดรับสมัครตั้งแต่'.$this->Prepare_model->displayDate($registration['registration_start']).' <u>ถึง</u> '.$this->Prepare_model->displayDate($registration['registration_stop']); ?></small> -->
						<?php echo $this->Prepare_model->displayDate(strtotime($registration['registration_start']), strtotime($registration['registration_stop'])); ?>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-user"></i> ข้อมูลนักศึกษา<span class="float-right">1 / 4</span></h5>
							</div>
						</div>
						<div class="row pt-2 py-md-3">
							<div class="col-md-4 text-md-right text-center text-md-right">
								<img src="<?php echo 'https://regist.psu.ac.th/Stud_Pics/'.substr($student_id, 0, 2).'/'.$student_id.'.jpg'; ?>" alt="Profile Picture" class="img-fluid shadow">
							</div>
							<div class="col-md-8 pt-4">
								<table class="table-sm">
									<tr>
										<td class="nowrap" align="right"><b>รหัสนักศึกษา</b></td>
										<td><?php echo $profile[0]['STUDENT_ID']; ?></td>
									</tr>
									<tr>
										<td align="right"><b>ชื่อ</b></td>
										<td><?php echo $profile[0]['TITLE'].$profile[0]['FNAME'].' '.$profile[0]['SNAME']; ?></td>
									</tr>
									<tr>
										<td align="right"><b>คณะ</b></td>
										<td><?php echo $profile[0]['FAC_NAME']; ?></td>
									</tr>
									<tr>
										<td align="right"><b>ภาควิชา</b></td>
										<td><?php echo $profile[0]['DEPT_NAME']; ?></td>
									</tr>
									<tr>
										<td align="right"><b>สาขาวิชา</b></td>
										<td><?php echo $profile[0]['MAJOR_NAME']; ?></td>
									</tr>
									<tr>
										<td align="right"><b>วิทยาเขต</b></td>
										<td>
											<?php $campus	= $this->Prepare_model->load_data('campus', ['campus_id'], [$profile[0]['CAMPUS_ID']]);
											echo $campus[0]['campus_name']; ?>
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="py-4 p-xl-3">
							<div class="row">
								<div class="col-12 text-primary py-2"><h2>ข้อมูลนักศึกษา</h2></div>
								<div class="col-12 pt-2"><b class="text-info">ข้อมูลติดต่อ</b>
									<div class="row pl-1">
										<div class="col-auto"><span class="text-info">มือถือยี่ห้อ</span>: <?php echo match_select($mobile, $profile['data']['mobile']); ?></div>
										<div class="col-auto"><span class="text-info">เบอร์</span>: <?php echo $profile['data']['number']; ?></div>
										<div class="col-auto"><span class="text-info">อีเมล</span>: <?php echo $profile['data']['email']; ?></div>
										<div class="col-auto "><span class="text-info">ไอดีไลน์</span>: <?php echo $profile['data']['line']; ?></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 pt-2"><b class="text-info">1. นับถือศาสนา</b>: <?php echo match_select($religion, $profile['data']['religion']); ?></div>
								<div class="col-12 pt-2"><b class="text-info">2. ที่พักอาศัย</b>:
									<?php $group	= match_select($address, $profile['data']['address'], true); echo $group[0];
									if($group[1] == 2) { ?>
										<div class="row pl-1">
											<div class="col-auto"><span class="text-info">ชื่อหอพัก</span>: <?php echo $profile['data']['address-name']; ?></div>
											<div class="col-auto"><span class="text-info">เลขห้อง</span>: <?php echo $profile['data']['address-room']; ?></div>
											<div class="col-auto"><span class="text-info">บ้านเลขที่</span>: <?php echo $profile['data']['address-number']; ?></div>
											<div class="col-auto"><span class="text-info">ตรอก/ซอย</span>: <?php echo $profile['data']['address-alley']; ?></div>
											<div class="col-auto"><span class="text-info">ถนน</span>: <?php echo $profile['data']['address-road']; ?></div>
											<div class="col-auto"><span class="text-info">เบอร์โทร</span>: <?php echo $profile['data']['address-tel']; ?></div>
										</div>
									<?php } ?>
								</div>
								<div class="col-12 pt-2"><b class="text-info">3. การเดินทางไปเรียน</b>: <?php echo match_multiselect($tostudy, $profile['data']['tostudy']); ?></div>
								<div class="col-12 pt-2"><b class="text-info">4. เครื่องใช้ส่วนตัว</b>: <?php echo match_multiselect($accessories, $profile['data']['accessories']); ?></div>
								<div class="col-12 pt-2"><b class="text-info">5. เพื่อนสนิท</b>
									<div class="row pl-1">
										<div class="col-auto"><span class="text-info">รหัสนักศึกษา</span>: <?php echo $profile['data']['fstudent_id']; ?></div>
										<div class="col-auto"><span class="text-info">ชื่อ-สกุล</span>: <?php echo $this->Annual_model->find_student_name($profile['data']['fstudent_id']); ?></div>
										<div class="col-auto"><span class="text-info">เบอร์มือถือ</span>: <?php echo $profile['data']['fnumber']; ?></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-user-friends"></i> ข้อมูลครัวเรือน<span class="float-right">2 / 4</span></h5>
							</div>
						</div>

						<div class="py-4 p-xl-3">
							<div class="row">
								<div class="col-12 text-primary"><h2>ข้อมูลบิดา-มารดา/ผู้อุปการะ</h2></div>
								<div class="col-12 pt-2"><b class="text-info">1. สถานภาพพ่อ-แม่</b>: <?php echo match_select($status, $family['data'][0]['fmstatus']);?></div>
								<div class="col-12 pt-2"><b class="text-info">2. สถานภาพนักศึกษากับพ่อ-แม่ และผู้อุปการะ</b>
									<div class="row pl-1">
										<?php if($family['data'][0]['fmstatus'] != 5 && $family['data'][0]['fmstatus'] != 7) { ?>
											<div class="col-auto"><span class="text-info">พ่อ</span>: <?php echo match_select($statusFather, $family['data'][0]['fstatus']); ?></div>
										<?php }
										if($family['data'][0]['fmstatus'] != 6 && $family['data'][0]['fmstatus'] != 7) { ?>
											<div class="col-auto"><span class="text-info">แม่</span>: <?php echo match_select($statusMother, $family['data'][0]['mstatus']); ?></div>
										<?php } ?>
										<div class="col-auto"><span class="text-info">ผู้อุปการะ</span>: <?php echo match_select($statusPatron, $family['data'][0]['pstatus']); ?></div>
									</div>
								</div>
								<div class="col-12 pt-2"><b class="text-info">3. ข้อมูลบิดา</b>
									<div class="row pl-1">
										<div class="col-auto"><span class="text-info">ชื่อ</span>: <?php echo $family[0]['FULL_NAME']; ?></div>
										<?php $num	= 0;
										if($family['data'][0]['fstatus'] << 3) { ?>
											<div class="col-auto"><span class="text-info">อายุ</span>: <?php echo date('Y') - substr($family[0]['BIRTH_DATE'], -4); ?> ปี</div>
											<div class="col-auto"><span class="text-info">เบอร์มือถือ</span>: <?php echo $family['data'][1][$num]['number']; ?></div>
											<div class="col-auto"><span class="text-info">อาชีพ</span>: 
												<?php if(!is_numeric($family['data'][2][$num]['job'])) {
													$group[0]	= $family['data'][2][$num]['job'];
													$group[1]	= 1;
												} else {
													$group		= match_select($job, $family['data'][2][$num]['job'], true);
												}
												echo $group[0]; ?>
											</div>
											<?php if($group[1] == 2) { ?>
												<div class="col-auto"><span class="text-info">ตำแหน่ง</span>: <?php echo $family['data'][2][$num]['position']; ?></div>
											<?php }
											if($group[1] != 4) { ?>
												<div class="col-auto"><span class="text-info">รายได้</span>: <?php echo number_format($family['data'][2][$num]['income']); ?> บาท/เดือน</div>
											<?php }
											if($group[1] == 1) { ?>
												<div class="col-auto"><span class="text-info">ละเอียดของอาชีพ</span>: <?php echo $family['data'][2][$num]['detail']; ?></div>
											<?php }
											$num++;
										} ?>
									</div>
								</div>
								<div class="col-12 pt-1"><b class="text-info pl-3">ข้อมูลมารดา</b>
									<div class="row pl-1">
										<div class="col-auto"><span class="text-info">ชื่อ</span>: <?php echo $family[1]['FULL_NAME']; ?></div>
										<?php if($family['data'][0]['mstatus'] << 3) { ?>
											<div class="col-auto"><span class="text-info">อายุ</span>: <?php echo date('Y') - substr($family[1]['BIRTH_DATE'], -4); ?> ปี</div>
											<div class="col-auto"><span class="text-info">เบอร์มือถือ</span>: <?php echo $family['data'][1][$num]['number']; ?></div>
											<div class="col-auto"><span class="text-info">อาชีพ</span>: 
												<?php if(!is_numeric($family['data'][2][$num]['job'])) {
													$group[1]	= 1;
													$jobName	= $family['data'][2][$num]['job'];
												} else {
													$group		= match_select($job, $family['data'][2][$num]['job'], true);
													$jobName	= $group[0];
												}
												echo $jobName; ?>
											</div>
											<?php if($group[1] == 2) { ?>
												<div class="col-auto"><span class="text-info">ตำแหน่ง</span>: <?php echo $family['data'][2][$num]['position']; ?></div>
											<?php }
											if($group[1] != 4) { ?>
												<div class="col-auto"><span class="text-info">รายได้</span>: <?php echo number_format($family['data'][2][$num]['income']); ?> บาท/เดือน</div>
											<?php }
											if($group[1] == 1) { ?>
												<div class="col-auto"><span class="text-info">ละเอียดของอาชีพ</span>: <?php echo $family['data'][2][$num]['detail']; ?></div>
											<?php }
											$num++;
										} ?>
									</div>
								</div>
								<?php if($family['data'][0]['pstatus'] == 2) { ?>
									<div class="col-12 pt-1"><b class="text-info pl-3">ผู้อุปการะ</b>
										<div class="row pl-1">
											<div class="col-auto"><span class="text-info">ชื่อ</span>: <?php echo $family['data'][1][$num]['fname'].' '.$family['data'][1][$num]['sname']; ?></div>
											<div class="col-auto"><span class="text-info">อายุ</span>: <?php echo date('Y') - $family['data'][1][$num]['year'].' ปี'; ?></div>
											<div class="col-auto"><span class="text-info">เบอร์มือถือ</span>: <?php echo $family['data'][1][$num]['number']; ?></div>
												<div class="col-auto"><span class="text-info">อาชีพ</span>: 
												<?php if(!is_numeric($family['data'][2][$num]['job'])) {
													$group[1]	= 1;
													$jobName	= $family['data'][2][$num]['job'];
												} else {
													$group		= match_select($job, $family['data'][2][$num]['job'], true);
													$jobName	= $group[0];
												}
												echo $jobName; ?>
											</div>
											<?php if($group[1] == 2) { ?>
												<div class="col-auto"><span class="text-info">ตำแหน่ง</span>: <?php echo $family['data'][2][$num]['position']; ?></div>
											<?php }
											if($group[1] != 4) { ?>
												<div class="col-auto"><span class="text-info">รายได้</span>: <?php echo number_format($family['data'][2][$num]['income']); ?> บาท</div>
											<?php }
											if($group[1] == 1) { ?>
												<div class="col-auto"><span class="text-info">ละเอียดของอาชีพ</span>: <?php echo $family['data'][2][$num]['detail']; ?></div>
											<?php }
											$num++; ?>
										</div>
										<?php if(isset($family['data'][2][$num])) { ?>
											<div class="row pl-1">
												<div class="col-auto"><span class="text-info">ชื่อ</span>: <?php echo $family['data'][1][$num]['fname'].' '.$family['data'][1][$num]['sname']; ?></div>
												<div class="col-auto"><span class="text-info">อายุ</span>: <?php echo date('Y') - $family['data'][1][$num]['year'].' ปี'; ?></div>
												<div class="col-auto"><span class="text-info">เบอร์มือถือ</span>: <?php echo $family['data'][1][$num]['number']; ?></div>
													<div class="col-auto"><span class="text-info">อาชีพ</span>: 
													<?php if(!is_numeric($family['data'][2][$num]['job'])) {
														$group[1]	= 1;
														$jobName	= $family['data'][2][$num]['job'];
													} else {
														$group		= match_select($job, $family['data'][2][$num]['job'], true);
														$jobName	= $group[0];
													}
													echo $jobName; ?>
												</div>
												<?php if($group[1] == 2) { ?>
													<div class="col-auto"><span class="text-info">ตำแหน่ง</span>: <?php echo $family['data'][2][$num]['position']; ?></div>
												<?php }
												if($group[1] != 4) { ?>
													<div class="col-auto"><span class="text-info">รายได้</span>: <?php echo number_format($family['data'][2][$num]['income']); ?> บาท/เดือน</div>
												<?php }
												if($group[1] == 1) { ?>
													<div class="col-auto"><span class="text-info">ละเอียดของอาชีพ</span>: <?php echo $family['data'][2][$num]['detail']; ?></div>
												<?php }
												$num++; ?>
											</div>
										<?php }
										if(count($family['data'][3]) > 0) { ?>
											<div class="row pl-3">
												<?php if($family['data'][3][0]['study'] > 0) { ?>
													<div class="col-auto"><span class="text-info">บุตรกำลังศึกษา</span>: <?php echo $family['data'][3][0]['study']; ?></div>
												<?php } ?>
												<?php if($family['data'][3][0]['working'] > 0) { ?>
													<div class="col-auto"><span class="text-info">บุตรกำลังศึกษา</span>: <?php echo $family['data'][3][0]['working']; ?></div>
												<?php } ?>
												<?php if($family['data'][3][0]['noworking'] > 0) { ?>
													<div class="col-auto"><span class="text-info">บุตรกำลังศึกษา</span>: <?php echo $family['data'][3][0]['noworking']; ?></div>
												<?php } ?>
											</div> 
										<?php } ?>
									</div>
								<?php } ?>
								<div class="col-12 pt-2"><b class="text-info">4. ที่อยู่อาศัยของ พ่อ-แม่ และผู้อุปการะ</b>
									<div class="row pl-1">
										<div class="col-auto"><span class="text-info">บ้านเลขที่</span>: <?php echo $family['data'][0]['number']; ?></div>
										<div class="col-auto"><span class="text-info">หมู่ที่</span>: <?php echo $family['data'][0]['village']; ?></div>
										<div class="col-auto"><span class="text-info">ตรอก/ซอย</span>: <?php echo $family['data'][0]['alley']; ?></div>
										<div class="col-auto"><span class="text-info">ถนน</span>: <?php echo $family['data'][0]['road']; ?></div>
										<div class="col-auto"><span class="text-info">ตำบล</span>: <?php echo $family['data'][0]['district_name']; ?></div>
										<div class="col-auto"><span class="text-info">อำเภอ</span>: <?php echo $family['data'][0]['amphure_name']; ?></div>
										<div class="col-auto"><span class="text-info">จังหวัด</span>: <?php echo $family['data'][0]['province_name']; ?></div>
										<div class="col-auto"><span class="text-info">รหัสไปรษณี</span>: <?php echo $family['data'][0]['zip_code']; ?></div>
									</div>
								</div>
								<div class="col-12 pt-2"><b class="text-info">5. ทรัพย์สิน/ภาระหนี้สิน</b></div>
								<?php $vehicle	= [[], []];
								foreach ($family['data'][5] as $v) {
									array_push($vehicle[$v['type']], $v);
								}
								$property	= [[], [], []];
								foreach ($family['data'][6] as $v) {
									array_push($property[$v['type']], $v);
								} ?>
								<div class="col-12 pt-1"><b class="text-info pl-3">5.1 เงินกู้</b><?php echo count($family['data'][4]) == 0 ? ': -' : '';
									foreach ($family['data'][4] as $v) { ?>
										<div class="row pl-1">
											<div class="col-auto"><span class="text-info">กู้จาก</span>: <?php echo $v['from']; ?></div>
											<div class="col-auto"><span class="text-info">จำนวนเงิน</span>: <?php echo number_format($v['budget']); ?> บาท</div>
											<div class="col-auto"><span class="text-info">ผ่อน</span>: <?php echo number_format($v['installment']); ?> บาท/เดือน</div>
											<div class="col-auto"><span class="text-info">สาเหตุการกู้</span>: <?php echo $v['detail']; ?></div>
										</div>
									<?php } ?>
								</div>
								<div class="col-12 pt-1"><b class="text-info pl-3">5.2 ทรัพย์สินครอบครัว</b>
									<div class="col-12 pt-1"><span class="text-info pl-3">รถจักรยานยนต์</span><?php echo count($vehicle[0]) == 0 ? ': -' : '';
										$num	= 0;
										foreach ($vehicle[0] as $v) { ?>
											<div class="row pl-4">
												<div class="col-auto"><span class="text-info"><?php echo ++$num.'. ยี่ห้อ'; ?></span>: <?php echo $v['band']; ?></div>
												<div class="col-auto"><span class="text-info">รุ่น</span>: <?php echo $v['model']; ?></div>
											</div>
										<?php } ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">รถยนต์</span><?php echo count($vehicle[1]) == 0 ? ': -' : '';
										$num	= 0;
										foreach ($vehicle[1] as $v) { ?>
											<div class="row pl-4">
												<div class="col-auto"><span class="text-info"><?php echo ++$num.'. ยี่ห้อ'; ?></span>: <?php echo $v['band']; ?></div>
												<div class="col-auto"><span class="text-info">รุ่น</span>: <?php echo $v['model']; ?></div>
											</div>
										<?php } ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">บ้าน: </span>
										<?php $num = 0;
										isset($property[0][$num]) && ($property[0][$num]['type'] == 0 && $property[0][$num]['id'] == 0) ? $num++ : '';
										if(isset($property[0][$num]) && ($property[0][$num]['type'] == 0 && $property[0][$num]['id'] == 1)) {
											echo $property[0][$num]['number'].' หลัง'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">ที่ดิน: </span>
										<?php if(isset($property[0][$num]) && ($property[0][$num]['type'] == 0 && $property[0][$num]['id'] == 2)) {
											echo $property[0][$num]['number'].' ไร่'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">ที่ดินทำนา: </span>
										<?php if(isset($property[0][$num]) && ($property[0][$num]['type'] == 0 && $property[0][$num]['id'] == 3)) {
											echo $property[0][$num]['number'].' ไร่'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">ที่ดินทำสวน: </span>
										<?php if(isset($property[0][$num]) && ($property[0][$num]['type'] == 0 && $property[0][$num]['id'] == 4)) {
											echo $property[0][$num]['number'].' ไร่'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">อื่นๆ: </span>
										<?php if(isset($property[0][0]) && ($property[0][0]['type'] == 0 && $property[0][0]['id'] == 0)) {
											echo $property[0][0]['number']; $num++;
										} else echo '-'; ?>
									</div>
								</div>
								<div class="col-12 pt-1"><b class="text-info pl-3">5.3 เช่าทรัพย์สิน</b>
									<div class="col-12 pt-1"><span class="text-info pl-3">เช่าบ้าน: </span>
										<?php $num = 0;
										isset($property[1][$num]) && ($property[1][$num]['type'] == 1 && $property[1][$num]['id'] == 0) ? $num++ : '';
										if(isset($property[1][$num]) && ($property[1][$num]['type'] == 1 && $property[1][$num]['id'] == 1)) {
											echo $property[1][$num]['number'].' หลัง | '.number_format($property[1][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">เช่าร้านค้า: </span>
										<?php if(isset($property[1][$num]) && ($property[1][$num]['type'] == 1 && $property[1][$num]['id'] == 2)) {
											echo $property[1][$num]['number'].' หลัง | '.number_format($property[1][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">เช่าที่ดินทำนา: </span>
										<?php if(isset($property[1][$num]) && ($property[1][$num]['type'] == 1 && $property[1][$num]['id'] == 3)) {
											echo $property[1][$num]['number'].' หลัง | '.number_format($property[1][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">เช่าที่ดินทำสวน: </span>
										<?php if(isset($property[1][$num]) && ($property[1][$num]['type'] == 1 && $property[1][$num]['id'] == 4)) {
											echo $property[1][$num]['number'].' หลัง | '.number_format($property[1][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">อื่นๆ: </span>
										<?php if(isset($property[1][0]) && ($property[1][0]['type'] == 1 && $property[1][0]['id'] == 0)) {
											echo $property[1][0]['number'].' | '.number_format($property[1][0]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
								</div>
								<div class="col-12 pt-1"><b class="text-info pl-3">5.3 ผ่อนทรัพย์สิน</b>
									<div class="col-12 pt-1"><span class="text-info pl-3">ผ่อนรถจักรยานยนต์: </span>
										<?php $num = 0;
										isset($property[2][$num]) && ($property[2][$num]['type'] == 2 && $property[2][$num]['id'] == 0) ? $num++ : '';
										if(isset($property[2][$num]) && ($property[2][$num]['type'] == 2 && $property[2][$num]['id'] == 1)) {
											echo $property[2][$num]['number'].' หลัง | '.number_format($property[2][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">ผ่อนรถยนต์: </span>
										<?php if(isset($property[2][$num]) && ($property[2][$num]['type'] == 2 && $property[2][$num]['id'] == 2)) {
											echo $property[2][$num]['number'].' คัน | '.number_format($property[2][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">ผ่อนบ้าน: </span>
										<?php if(isset($property[2][$num]) && ($property[2][$num]['type'] == 2 && $property[2][$num]['id'] == 3)) {
											echo $property[2][$num]['number'].' หลัง | '.number_format($property[2][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">ผ่อนที่ดิน: </span>
										<?php if(isset($property[2][$num]) && ($property[2][$num]['type'] == 2 && $property[2][$num]['id'] == 4)) {
											echo $property[2][$num]['number'].' ไร่ | '.number_format($property[2][$num]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
									<div class="col-12 pt-1"><span class="text-info pl-3">อื่นๆ: </span>
										<?php if(isset($property[2][0]) && ($property[2][0]['type'] == 2 && $property[2][0]['id'] == 0)) {
											echo $property[2][0]['number'].' | '.number_format($property[2][0]['budget']).' บาท/เดือน'; $num++;
										} else echo '-'; ?>
									</div>
								</div>
							</div>
						</div>
						<hr/>
						<div class="py-4 p-xl-3">
							<div class="row">
								<div class="col-12 text-primary"><h2>ข้อมูลเกี่ยวกับบุคคลในครอบครัว</h2></div>
								<?php if(!$sibling['data']) { ?>
									<div class="col-12 pt-2"><b>ไม่มีบุคคลในครอบครัว</b></div>
								<?php } else { ?>
									<div class="col-12 pt-2"><b class="text-info">1. บุคคลในครอบครัวที่กำลังศึกษา (ไม่รวมตัวเอง)</b>
										<div class="row pl-1">
											<?php $num = 0;
											foreach ($sibling['data'][0] as $v) { ?>
												<div class="col-auto"><span class="text-info"><?php echo ++$num; ?>. เกี่ยวข้องเป็น</span>: <?php echo match_select($relative, $v['relative']).($v['sex'] == 'M' ? '-ชาย' : '-หญิง'); ?></div>
												<div class="col-auto"><span class="text-info">อายุ</span>: <?php echo date('Y') - $v['year'].' ปี'; ?></div>
												<div class="col-auto"><span class="text-info">กำลังศึกษา</span>: <?php echo match_select($education, $v['education']).'-ชั้นปีที่ '.$v['study'].' (ของ'.($v['institution'] == '0' ? 'รัฐบาล' : 'เอกชน').') | '.($v['loan'] == '0' ? 'ไม่' : '').'กู้กยศ./กรอ.'; ?></div>
												<div class="col-auto"><span class="text-info">ที่พัก</span>: <?php echo match_select($siblingAddr, $v['address']).' '.number_format($v['rental']).' บาท/เดือน'; ?></div>
											<?php } ?>
										</div>
									</div>
									<div class="col-12 pt-2"><b class="text-info">2. บุคคลในครอบครัวที่ประกอบอาชีพหรืออื่นๆ</b>
										<?php $num = 0;
										foreach ($sibling['data'][1] as $v) { ?>
											<div class="row pl-1">
												<div class="col-auto"><span class="text-info"><?php echo ++$num; ?>. เกี่ยวข้องเป็น</span>: <?php echo match_select($relative, $v['relative']).($v['sex'] == 'M' ? '-ชาย' : '-หญิง'); ?></div>
												<div class="col-auto"><span class="text-info">อายุ</span>: <?php echo date('Y') - $v['year'].' ปี'; ?></div>
												<div class="col-auto"><span class="text-info">ระดับการศึกษา</span>: <?php echo match_select($education, $v['education']); ?></div>
												<div class="col-auto"><span class="text-info">สถานภาพ</span>: <?php echo ($v['status'] == '0' ? 'โสด' : 'สมรส').($v['child'] > 0 ? '-บุตร '.$v['child'].' คน' : ''); ?></div>
												<div class="col-auto"><span class="text-info">อาชีพ</span>: <?php echo match_select($job, $v['job']).' '.number_format($v['income']).' บาท/เดือน'; ?></div>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</div>

						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-money-check-alt"></i> ข้อมูลการเงิน<span class="float-right">3 / 4</span></h5>
							</div>
						</div>

						<div class="py-4 p-xl-3">
							<div class="row">
								<div class="col-12 text-primary"><h2>สถานภาพทางการเงินของนักศึกษา</h2></div>
								<div class="col-12 pt-2"><b class="text-info">1. รายรับของนักศึกษา</b>
									<div class="row pl-1">
										<div class="col-12">
											<span class="text-info">บิดา-มารดา/ผู้อุปการะ</span>:
											<?php echo !!$finance['data'][0]['income_parent'] ? number_format($finance['data'][0]['income_parent']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<span class="text-info">เงิน กยศ./กรอ.</span>:
											<?php echo !!$finance['data'][0]['income_loan'] ? number_format($finance['data'][0]['income_loan']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<span class="text-info">ทำงานพิเศษและอื่นๆ</span>:
											<?php echo !!$finance['data'][0]['income_job'] ? number_format($finance['data'][0]['income_job']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<b class="text-info">รวม</b>:
											<?php $total_income = $finance['data'][0]['income_parent'] + $finance['data'][0]['income_loan'] + $finance['data'][0]['income_job'];
											echo !!$total_income ? number_format($total_income).' บาท/เดือน' : '-'; ?>
										</div>
									</div>
								</div>
								<div class="col-12 pt-2"><b class="text-info">2. รายจ่ายของนักศึกษา</b>
									<div class="row pl-1">
										<div class="col-12">
											<span class="text-info">ค่าที่พัก</span>:
											<?php echo !!$finance['data'][0]['outcome_rest'] ? number_format($finance['data'][0]['outcome_rest']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<span class="text-info">ค่าอาหาร</span>:
											<?php echo !!$finance['data'][0]['outcome_food'] ? number_format($finance['data'][0]['outcome_food']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<span class="text-info">ค่าอุปกรณ์การเรียน</span>:
											<?php echo !!$finance['data'][0]['outcome_equipment'] ? number_format($finance['data'][0]['outcome_equipment']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<span class="text-info">ค่าเดินทาง</span>:
											<?php echo !!$finance['data'][0]['outcome_travel'] ? number_format($finance['data'][0]['outcome_travel']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<span class="text-info">อื่นๆ</span>:
											<?php echo !!$finance['data'][0]['outcome_other'] ? $finance['data'][0]['outcome_specify'].' '.number_format($finance['data'][0]['outcome_other']).' บาท/เดือน' : '-'; ?>
										</div>
										<div class="col-12">
											<b class="text-info">รวม</b>:
											<?php $total_outcome = $finance['data'][0]['outcome_rest'] + $finance['data'][0]['outcome_food'] + $finance['data'][0]['outcome_equipment'] + $finance['data'][0]['outcome_travel'] + $finance['data'][0]['outcome_other'];
											echo !!$total_outcome ? number_format($total_outcome).' บาท/เดือน' : '-'; ?>
										</div>
									</div>
								</div>
								<div class="col-12 pt-2"><b class="text-info">3. ประมาณการค่าใช้จ่ายทั้งหมดที่นักศึกษาคาดว่าจะเพียงพอสำหรับตนเอง</b>: <?php echo number_format($finance['data'][0]['outcome_total']).' บาท/เดือน'; ?></div>
								<div class="col-12 pt-2"><b class="text-info">4. ประวัติการรับทุน และการทำงาน</b></div>
								<div class="col-12 pt-1"><b class="text-info pl-3">4.1 ประวัติทุนทำงานแลกเปลี่ยนจากมหาวิทยาลัย</b><?php echo count($finance['data'][1]) == 0 ? ': -' : '';
									$num = 0;
									foreach ($finance['data'][1] as $v) { ?>
										<div class="row pl-1">
											<div class="col-auto"><span class="text-info"><?php echo ++$num; ?>. ปีการศึกษา</span>: <?php echo $v['term'].'/'.($v['year'] + 543); ?></div>
										</div>
									<?php } ?>
								</div>
								<div class="col-12 pt-1"><b class="text-info pl-3">4.2 ทุนการศึกษา ที่เคยได้รับในมหาวิทยาลัย <small>(ไม่รวม กยศ./กรอ.)</small></b><?php echo count($finance['data'][2]) == 0 ? ': -' : '';
									$num = 0;
									foreach ($finance['data'][2] as $v) { ?>
										<div class="row pl-1">
											<div class="col-auto"><span class="text-info"><?php echo ++$num; ?>. ปีการศึกษา</span>: <?php echo ($v['start_year'] + 543).' - '.($v['stop_year'] + 543); ?></div>
											<div class="col-auto"><span class="text-info">ชื่อทุน</span>: <?php echo $v['name']; ?></div>
											<div class="col-auto"><span class="text-info">จำนวน</span>: <?php echo number_format($v['income']); ?> บาท/ปี</div>
										</div>
									<?php } ?>
								</div>
								<div class="col-12 pt-1"><b class="text-info pl-3">4.3 ทำงานพิเศษ-ย้อนหลัง 2 ปี</b><?php echo count($finance['data'][3]) == 0 ? ': -' : '';
									$num = 0;
									foreach ($finance['data'][3] as $v) { ?>
										<div class="row pl-1">
											<div class="col-auto"><span class="text-info"><?php echo ++$num; ?>. ปีการศึกษา</span>: <?php echo $v['start_term'].'/'.($v['start_year'] + 543).' - '.$v['stop_term'].'/'.($v['stop_year'] + 543); ?></div>
											<div class="col-auto"><span class="text-info">ลักษณะงาน</span>: <?php echo $v['description']; ?></div>
											<div class="col-auto"><span class="text-info">จำนวน</span>: <?php echo number_format($v['income']); ?> บาท/เดือน</div>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-clipboard-check"></i> หนังสือรับรอง<span class="float-right">4 / 4</span></h5>
							</div>
						</div>
						<div class="py-4 p-xl-3">
							<div class="row">
								<div class="col-12 text-primary"><h2>เหตุผลความจำเป็นที่ขอรับทุน</h2></div>
								<div class="col-12 pt-2"><b class="text-info">อธิบายความเป็นอยู่ของครอบครัวที่แสดงให้เห็นความจำเป็นที่ต้องขอรับทุน</b>:
									<div class="row pl-1">
										<div class="col-auto"><?php echo str_repeat("&nbsp;", 10).$explain['data'][0]['explain']; ?></div>
									</div>
								</div>
							</div>
						</div>
						<?php if($this->session->userdata('user_type') === 'Admin') { ?>
							<div class="py-4 p-xl-3">
								<div class="row">
									<div class="col-12 text-center"><a href="<?php echo $googledrive[0]['googledrive']; ?>" target="_blank">Google Drive</a></div>
								</div>
							</div>
						<?php } ?>

						<form action="<?php echo site_url('annual/ratings'); ?>" method="POST">
							<input type="hidden" name="interview_id" value="<?php echo $interview['interview_id']; ?>">
							<input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
							<div class="row justify-content-center">
								<div class="col-lg-6">
									<textarea name="comment" class="form-control" placeholder="ใส่ความคิดเห็น" rows="5"><?php echo $interview['comment']; ?></textarea>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text form-control shadow">ให้คะแนน</div>
										</div>
										<input name="point" class="form-control form-control text-right shadow w-50" type="text" placeholder="0" onkeyup="" required value="<?php echo $interview['point']; ?>" pattern="^(?:[0,4](?:\.00?)?|[0-3](?:\.[0-9][0-9]?)?|\.[0-9][0-9]?)$" oninvalid="this.setCustomValidity('กรอกตัวเลข 0-4 มีทศนิยมไม่เกิน 2 ตำแหน่ง')" oninput="this.setCustomValidity('')">
										<!-- <input name="point" class="form-control form-control text-right shadow w-50" type="text" min="0" pattern="\d*" maxlength="3" placeholder="0" onkeyup="numberformat(this);" required value="<?php //echo $interview['point']; ?>"> -->
										<div class="input-group-prepend">
											<div class="input-group-text form-control shadow">คะแนน</div>
										</div>
									</div>
									<button type="submit" class="mt-1 btn btn-success btn-block shadow">ส่งคะแนน</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>