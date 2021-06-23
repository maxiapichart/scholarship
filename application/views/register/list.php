<section class="feeds">
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<!-- Trending Articles-->
			<div class="col-lg-8">
				<div class="articles card">
					<div class="card-header d-flex align-items-center">
						<h2 class="h3">รอบเปิดรับทุน</h2>
					</div>
					<div class="card-body">
						<ul class="nav nav-pills ml-2 mb-3" id="pills-tab" role="tablist">
							<?php for ($i = (date('Y') + 543); $i >= (substr($this->session->userdata('username'), 0, 2) + 2500); $i--) { ?>
								<li class="nav-item">
									<a class="nav-link <?php echo $i != (date('Y') + 543) ?: 'active'; ?>" id="pills-<?php echo $i; ?>-tab" data-toggle="pill" href="#pills-<?php echo $i; ?>" role="tab" aria-controls="pills-<?php echo $i; ?>" aria-selected="true"><?php echo $i; ?></a>
								</li>
							<?php } ?>
						</ul>

						<div class="tab-content mx-2 mb-3" id="pills-tabContent">
							<?php for ($i = (date('Y') + 543); $i >= (substr($this->session->userdata('username'), 0, 2) + 2500); $i--) { ?>
								<div class="tab-pane fade <?php echo $i != (date('Y') + 543) ?: 'show active'; ?>" id="pills-<?php echo $i; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $i; ?>-tab">
									<?php $registration	= $this->Prepare_model->load_data('registration', 'year', $i - 543, 'registration_start');
									if(count($registration) == 0) { ?>
										<div class="item d-flex justify-content-between">
											<div class="text">
												<h3 class="h5 text-black-50">-ไม่มีรอบที่เปิดในปีการศึกษานี้-</h3>
											</div>
										</div>
									<?php } else {
										foreach ($registration as $ar) {
											$register	= $this->Prepare_model->load_data('register', ['registration_id', 'student_id'], [$ar['registration_id'], $this->session->userdata('username')]);
											$rStart	= strtotime($ar['registration_start']);
											$rStop	= strtotime($ar['registration_stop']);
											$iStart	= strtotime($ar['interview_start']);
											$iStop	= strtotime($ar['interview_stop']);
											$iTime	= $iStart <= time() && $iStop > time() ? true : false;
											$rTime	= $rStart <= time() && $rStop > time() ? true : false;
											$iCheck	= false;
											$rCheck	= false;
											if(count($register) > 0) {
												$iCheck	= $register[0]['interview']	!= null ? true : false;
												$rCheck	= $register[0]['register']	!= null ? true : false;
											} ?>
											<div class="d-flex bd-highlight">
												<div class="p-1 bd-highlight date-holder text-right">
													<div class="icon"><small class="text-muted">ส่งใบสมัคร</small> <i class="icon-clock"></i></div>
													<?php echo $this->Prepare_model->displayDate($rStart, $rStop); ?>
													<div class="text">
														<div class="icon text-secondary"><small class="text-muted">จองรอบสัมภาษณ์</small> <i class="far fa-comment-dots"></i></div>
														<?php echo $this->Prepare_model->displayDate($iStart, $iStop); ?>
													</div>

												</div>
												<div class="p-1 px-3 flex-grow-1 bd-highlight content">
													<div class="d-flex flex-column bd-highlight mb-3">
														<?php $type = false;
														$diff = 0;
														if(!$rCheck && $rTime) {
															$diff	= $rStop - time();
															$type	= 'เวลาสมัคร ';
															$percentage	= 100 - (((time() - $rStart) / ($rStop - $rStart)) * 100);
														} else if($rCheck && !$iCheck && $iTime) {
															$diff	= $iStop - time();
															$type	= 'เวลาจองรอบสัมภาษณ์ ';
															$percentage	= 100 - (((time() - $iStart) / ($iStop - $iStart)) * 100);
														}
														if(!$iCheck && $type) {
															$time	= $diff / (60 * 60 * 24);
															if($time >= 1) {
																$time	= round($time).' วัน';
															} else {
																$time	= $diff / (60 * 60);
																if($time >= 1) {
																	$time	= round($time).' ชั่วโมง';
																} else {
																	$time	= ($diff / 60) >= 1 ? round($diff / 60).' นาที' : '1 นาที';
																}
															}
															$bg	= $percentage > 25 ? 'bg-green' : 'bg-orange';
															$bg	= $percentage <= 10 ? 'bg-red' : $bg; ?>
															<div class="bd-highlight py-1 text-center">
																<div class="progress"> 
																	<div style="width: <?php echo "{$percentage}%"; ?>; height: 100%;" class="progress-bar <?php echo $bg; ?> text-dark"><?php echo $type.$time; ?></div>
																</div>
															</div>
															<div class="bd-highlight pt-1"><h5><?php echo $ar['registration_title']; ?></h5></div>
														<?php } else { ?>
															<div class="bd-highlight pt-4"><h5><?php echo $ar['registration_title']; ?></h5></div>
														<?php } ?>
													</div>
													<div class="align-items-end text-right">
														<?php if($rStart > time()) {
															$diff	= $rStart - time();
															$time	= $diff / (60 * 60 * 24);
															if($time >= 1) {
																$time	= round($time).' วัน';
															} else {
																$time	= $diff / (60 * 60);
																if($time >= 1) {
																	$time	= round($time).' ชั่วโมง';
																} else {
																	$time	= ($diff / 60) >= 1 ? round($diff / 60).' นาที' : '1 นาที';
																}
															} ?>
															<small class="text-muted"><?php echo "เปิดรับสมัครในอีก {$time}"; ?></small><br/>
														<?php } else if($rStop <= time() && !count($register)) { ?>
															<small class="text-muted">หมดเขตรับสมัคร</small>
														<?php } else if($rTime && !count($register)) { ?>
															<a href="<?php echo site_url('scholarship/register/'.$ar['registration_id']); ?>" class="btn btn-sm btn-outline-primary">เขียนใบสมัคร</a>
														<?php } else if($rTime && count($register) && !$rCheck) { ?>
															<a href="<?php echo site_url('scholarship/register/'.$ar['registration_id']); ?>" class="btn btn-sm btn-outline-primary">เขียนใบสมัคร (ต่อ)</a>
														<?php } else if($iTime && $rCheck && !$iCheck) { ?>
															<a href="<?php echo site_url('scholarship/interview/'.$ar['registration_id']); ?>" class="btn btn-sm btn-outline-success">จองรอบสัมภาษณ์</a>
														<?php } else if($iCheck) {
															$interview	= $this->Prepare_model->load_data('interview', 'interview_id', $register[0]['interview']);
															$inStart		= strtotime($interview[0]['start']);
															$inStop			= strtotime($interview[0]['stop']);
															if($inStop <= time()) { ?>
																<small class="text-success"><i class="fas fa-check"></i> สมัครแล้ว</small>
															<?php } else {
																if($inStart > time()) { ?>
																	<small class="text-success"><i class="fas fa-check"></i> รอสัมภาษณ์</small><br/>
																<?php } else { ?>
																	<small class="text-danger"> ถึงเวลาสัมภาษณ์แล้ว</small>
																<?php }
                                echo !!$interview[0]['interview_name'] ? "<small>({$interview[0]['interview_name']})</small><br/>" : '';
                                echo $this->Prepare_model->date_between($inStart, $inStop);
															}
														} else if(!$iTime && count($register) && $rCheck && !$iCheck) {
															$diff	= $iStart - time();
															$time	= $diff / (60 * 60 * 24);
															if($time >= 1) {
																$time	= round($time).' วัน';
															} else {
																$time	= $diff / (60 * 60);
																if($time >= 1) {
																	$time	= round($time).' ชั่วโมง';
																} else {
																	$time	= ($diff / 60) >= 1 ? round($diff / 60).' นาที' : '1 นาที';
																}
															} ?>
															<small class="text-success"><i class="fas fa-check"></i> สมัครแล้ว</small><br/>
															<small class="text-muted"><?php echo "เปิดจองรอบสัมภาษณ์ในอีก {$time}"; ?></small>
														<?php } ?>
													</div>
												</div>
											</div>
											<hr/>
										<?php }
									} ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>