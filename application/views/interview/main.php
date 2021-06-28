<?php $get['year'] = $this->input->get('year') ?: date('Y'); ?>
<div class="container-fluid">
	<section class="pt-5">
		<div class="row mb-4">
			<div class="col mb-4">
				<div class="card">
					<div class="card-header text-center">
						<h2 class="mb-0">วันสมัคร-รอบสัมภาษณ์</h2>
					</div>
					<div class="card-body">
						<select id="year" class="btn btn-primary" onchange="window.location = '<?php echo site_url('annual/interview/?year='); ?>' + $(this).val();">
							<?php for ($i = date('Y'); $i >= 2019; $i--) { ?>
								<option value="<?php echo $i; ?>" <?php echo $i != ($get['year'] != '' ? $get['year'] : date('Y')) ?: ' selected'; ?>><?php echo 'ปีการศึกษา '.($i + 543); ?></option>
							<?php } ?>
						</select>
						<div class="accordion" id="accordionResitration">
							<?php  $collapsed = '';
							$show = 'show';
							foreach ($registration as $ar) { ?>
								<div class="card">
									<div class="card-header" id="<?php echo "heading{$ar['registration_id']}"; ?>">
										<h2 class="mb-0">
											<button class="btn btn-link <?php echo $collapsed; $collapsed = 'collapsed'; ?>" type="button" data-toggle="collapse" data-target="#<?php echo "collapse{$ar['registration_id']}"; ?>" aria-expanded="true" aria-controls="<?php echo "collapse{$ar['registration_id']}"; ?>">
												<?php echo $ar['registration_title']; ?>
											</button>
										</h2>
									</div>

									<div id="<?php echo "collapse{$ar['registration_id']}"; ?>" class="collapse <?php echo $show; $show = ''; ?>" aria-labelledby="<?php echo "heading{$ar['registration_id']}"; ?>" data-parent="#accordionResitration">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-bordered">
													<thead>
														<tr>
															<td align="center" style="white-space: nowrap;">เวลาสัมภาษณ์</td>
															<td width="1" style="white-space: nowrap;"></td>
															<td align="center" style="white-space: nowrap;">รหัสนักศึกษา</td>
															<td style="white-space: nowrap;">ชื่อ</td>
															<td style="white-space: nowrap;">คณะ</td>
															<td width="1" style="white-space: nowrap;">คะแนนสัมภาษณ์</td>
															<td>ความคิดเห็น</td>
														</tr>
													</thead>
													<tbody>
														<?php $num	= '';
														$student		= $this->Annual_model->load_inteview_student($ar['registration_id']);
														$i					= 0;
														$id					= '';
														foreach ($student as $ar2) {
															if($ar2['student_id'] != '') { ?>
																<tr>
																	<td align="center">
																		<?php echo !!$ar2['interview_name'] ? "<small>({$ar2['interview_name']})</small><br/>" : '';
																		echo $this->Prepare_model->date_between(strtotime($ar2['start']), strtotime($ar2['stop'])); ?>
																	</td>
																	<td align="right"><?php echo ++$i; ?></td>
																	<td align="center">
																		<a href="<?php echo site_url("annual/interviewer/{$ar['registration_id']}/{$ar2['student_id']}"); ?>"><?php echo $ar2['student_id']; ?></a>
																	</td>
																	<td><?php echo $ar2['student_name']; ?></td>
																	<td><?php echo $ar2['fac_name']; ?></td>
																	<td align="right"><?php echo $ar2['point'] != null ? "{$ar2['point']} คะแนน" : '-'; ?></td>
																	<td><?php echo $ar2['comment'] != null ? $ar2['comment'] : '-'; ?></td>
															<?php } else { ?>
																<tr class="bg-light">
																	<td align="center">
																		<?php echo $this->Prepare_model->displayDate(strtotime($ar2['start']), strtotime($ar2['stop'])); ?>
																	</td>
																	<td colspan="6" align="center">-ไม่มีนักศึกษารอบนี้-</td>
																</tr>
															<?php } ?>
														<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	<?php if(count($registration) == 0) { ?>
		window.location = '<?php echo site_url('annual/interview/?year='); ?>' + ($('#year').val() - 1); 
	<?php } ?>
</script>