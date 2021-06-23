<div class="card">
	<div class="card-header" id="sec3Head1">
		<h2 class="mb-0">
			<span id="sec3Id1"><i class="fas fa-times-circle text-danger"></i></span>
			<button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec3Col1" aria-expanded="false" aria-controls="sec3Col1" onclick="toggleCollapseIcon('#sec3Col1', '#sec3Icon1');">
				สถานภาพการเงินของนักศึกษา
			</button>
		</h2>
	</div>
	<div id="sec3Col1" class="collapse" aria-labelledby="sec3Head1" data-parent="#section3">
		<form id="finance" class="card-body" action="javascript:void(0);" method="post" onsubmit="return submitFrom(this);">
			<div class="row">
				<table class="table">
					<tr>
						<td width="1">1.</td>
						<td><b>รายรับ</b>ของนักศึกษา<br/>
							<table class="table table-sm">
								<tbody>
									<?php foreach ($income as $ar) {
										$id	= $ar['selectdata_type'].$ar['selectdata_id']; ?>
										<tr>
											<td width="50%"><?php echo $ar['selectdata_title']; ?></td>
											<td width="50%">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text form-control-sm">เดือนละ</div>
													</div>
													<input name="income[<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
													<div class="input-group-prepend">
														<div class="input-group-text form-control-sm">บาท</div>
													</div>
												</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>2.</td>
						<td><b>รายจ่าย</b>ของนักศึกษา<br/>
							<table class="table table-sm">
								<tbody>
									<?php foreach ($outcome as $ar) {
										$id	= $ar['selectdata_type'].$ar['selectdata_id']; ?>
										<tr>
											<td colspan="2" width="50%"><?php echo $ar['selectdata_title']; ?></td>
											<td width="50%">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text form-control-sm">เดือนละ</div>
													</div>
													<input name="outcome[<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
													<div class="input-group-prepend">
														<div class="input-group-text form-control-sm">บาท</div>
													</div>
												</div>
											</td>
										</tr>
									<?php } ?>
									<tr>
										<td width="1">อื่นๆ</td>
										<td width="50%">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">ระบุ</div>
												</div>
												<input name="outcome[specify]" class="property <?php echo $id; ?> form-control form-control-sm" type="text" maxlength="255" placeholder="ระบุ">
											</div>
										</td>
										<td width="50%">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">เดือนละ</div>
												</div>
												<input name="outcome[0]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">บาท</div>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td>3.</td>
						<td><b>ประมาณการค่าใช้จ่ายทั้งหมดที่นักศึกษาคาดว่าจะเพียงพอสำหรับตนเอง</b><br/>
							<div class="input-group form-inline">
								<div class="input-group-prepend">
									<div class="input-group-text form-control-sm">เดือนละ</div>
								</div>
								<input name="outcome[total]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
								<div class="input-group-prepend">
									<div class="input-group-text form-control-sm">บาท</div>
								</div>
								<small class="pl-2 pt-2">(ไม่รวมค่าหน่วยกิต และค่าบำรุงการศึกษา)</small>
							</div>
						</td>
					</tr>
					<tr>
						<td>4.</td>
						<td><b>ประวัติการรับทุน และการทำงาน</b></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;&nbsp;&nbsp;4.1 <b>ประวัติทุนทำงานแลกเปลี่ยนในมหาวิทยาลัย</b>
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<td width="1"><button type="button" class="badge badge-light text-primary" onclick="finance_add('fund');"><i class="fas fa-plus"></i></button></td>
										<td width="50%">ปีการศึกษา</td>
										<td width="50%">เทอม</td>
									</tr>
								</thead>
								<tbody class="fund"></tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;&nbsp;&nbsp;4.2 <b>ทุนการศึกษา ที่เคยได้รับในมหาวิทยาลัย</b> <small>(ไม่รวม กยศ./กรอ.)</small>
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<td width="1"><button type="button" class="badge badge-light text-primary" onclick="finance_add('scholarship');"><i class="fas fa-plus"></i></button></td>
										<td width="35%">ปีการศึกษา</td>
										<td width="40%">ชื่อทุน</td>
										<td width="25%">จำนวนเงินทุน/ปี</td>
									</tr>
								</thead>
								<tbody class="scholarship"></tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;&nbsp;&nbsp;4.3 <b>ทำงานพิเศษ</b> <small>(ย้อนหลัง 2 ปี)</small>
							<table class="table table-bordered table-sm">
								<thead>
									<tr>
										<td width="1"><button type="button" class="badge badge-light text-primary" onclick="finance_add('job');"><i class="fas fa-plus"></i></button></td>
										<td width="20%">เริ่ม</td>
										<td width="20%">สิ้นสุด</td>
										<td width="20%">จำนวนเงิน/เดือน</td>
										<td width="40%">ลักษณะงาน</td>
									</tr>
								</thead>
								<tbody class="job"></tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<button type="submit" class="btn btn-info btn-block">บันทึก</button>
		</form>
	</div>
	<div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec3Col1" aria-expanded="false" aria-controls="sec3Col1" onclick="toggleCollapseIcon('#sec3Col1', '#sec3Icon1');"><i id="sec3Icon1" class="fas fa-chevron-down"></i></div>
</div>
<script type="text/javascript">
	var num_finance = {'fund': 0, 'scholarship': 0, 'job': 0}
	finance()
	function finance() {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('scholarship/get_finance'); ?>',
			data: {registration_id: <?php echo $registration['registration_id']; ?>},
			success: function(result) {
				result	= JSON.parse(result)
				console.log(result)
				if(result) {
					$('#finance [name="income[1]"]').val(result[0]['income_parent']);
					$('#finance [name="income[2]"]').val(result[0]['income_loan']);
					$('#finance [name="income[3]"]').val(result[0]['income_job']);
					$('#finance [name="outcome[1]"]').val(result[0]['outcome_rest']);
					$('#finance [name="outcome[2]"]').val(result[0]['outcome_food']);
					$('#finance [name="outcome[3]"]').val(result[0]['outcome_equipment']);
					$('#finance [name="outcome[4]"]').val(result[0]['outcome_travel']);
					$('#finance [name="outcome[0]"]').val(result[0]['outcome_other']);
					$('#finance [name="outcome[specify]"]').val(result[0]['outcome_specify']);
					$('#finance [name="outcome[total]"]').val(result[0]['outcome_total']);

					$('.fund').html('');
					$.each(result[1], function(i, ar) {
						finance_add('fund');
						$('#finance [name="fund[year][' + num_finance['fund'] + ']"]').val(ar['year']);
						$('#finance [name="fund[term][' + num_finance['fund'] + ']"]').val(ar['term']);
					})

					$('.scholarship').html('');
					$.each(result[2], function(i, ar) {
						finance_add('scholarship');
						$('#finance [name="scholarship[start_year][' + num_finance['scholarship'] + ']"]').val(ar['start_year']);
						$('#finance [name="scholarship[stop_year][' + num_finance['scholarship'] + ']"]').val(ar['stop_year']);
						$('#finance [name="scholarship[name][' + num_finance['scholarship'] + ']"]').val(ar['name']);
						$('#finance [name="scholarship[income][' + num_finance['scholarship'] + ']"]').val(ar['income']);
					})

					$('.job').html('');
					$.each(result[3], function(i, ar) {
						finance_add('job');
						$('#finance [name="job[start_term][' + num_finance['job'] + ']"]').val(ar['start_term']);
						$('#finance [name="job[start_year][' + num_finance['job'] + ']"]').val(ar['start_year']);
						$('#finance [name="job[stop_term][' + num_finance['job'] + ']"]').val(ar['stop_term']);
						$('#finance [name="job[stop_year][' + num_finance['job'] + ']"]').val(ar['stop_year']);
						$('#finance [name="job[income][' + num_finance['job'] + ']"]').val(ar['income']);
						$('#finance [name="job[description][' + num_finance['job'] + ']"]').val(ar['description']);
					})
					$(function() {
						$('#sec3Id1').html(statusCard[1])
						checkall['finance'] = true;
					});
				}
			}
		})
	}
	function finance_add(type) {
		num_finance[type]++;
		var text = '';
		text += '<tr class="' + type + num_finance[type] + '">';
			text += '<td width="1"><button type="button" class="badge badge-light text-danger" onclick="$(\'.' + type + num_finance[type] + '\').remove();"><i class="fas fa-minus"></i></button></td>';
			if (type == 'fund') {

				text += '<td>';
					text += '<select name="fund[year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
						text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
						<?php for ($i = (date('Y') + 543); $i >= (substr($this->session->userdata('username'), 0, 2) + 2500); $i--) { ?>
							text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
						<?php } ?>
					text += '</select>'
				text += '</td>';
				text += '<td>';
					text += '<select name="fund[term][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
						text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
						<?php for ($i = 1; $i <= 3; $i++) { ?>
							text += '<option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
						<?php } ?>
					text += '</select>'
				text += '</td>';

			} else if (type == 'scholarship') {
				
				text += '<td>';
					text += '<div class="input-group">';
						text += '<select name="scholarship[start_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
							text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
							<?php for ($i = (date('Y') + 543); $i >= (substr($this->session->userdata('username'), 0, 2) + 2500); $i--) { ?>
								text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
							<?php } ?>
						text += '</select>'
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">ถึง</div>';
						text += '</div>';
						text += '<select name="scholarship[stop_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
							text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
							<?php for ($i = (substr($this->session->userdata('username'), 0, 2) + 2500 + 5); $i >= (substr($this->session->userdata('username'), 0, 2) + 2500); $i--) { ?>
								text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
							<?php } ?>
						text += '</select>'
					text += '</div>';
				text += '</td>';
				text += '<td><input name="scholarship[name][' + num_finance[type] + ']" class="form-control form-control-sm" type="text" placeholder="ชื่อทุน" maxlength="255"></td>';
				text += '<td><input name="scholarship[income][' + num_finance[type] + ']" class="form-control form-control-sm text-right" type="text" min="1" maxlength="6" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);"></td>';

			} else if (type == 'job') {

				text += '<td>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">เทอม</div>';
						text += '</div>';
						text += '<select name="job[start_term][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
							text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
							<?php for ($i = 1; $i <= 3; $i++) { ?>
								text += '<option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
							<?php } ?>
						text += '</select>'
					text += '</div>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">ปี</div>';
						text += '</div>';
						text += '<select name="job[start_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
							text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
							<?php for ($i = (date('Y') + 543); $i >= (date('Y') + 543 - 2); $i--) { ?>
								text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
							<?php } ?>
						text += '</select>'
					text += '</div>';
				text += '</td>';
				text += '<td>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">เทอม</div>';
						text += '</div>';
						text += '<select name="job[stop_term][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
							text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
							<?php for ($i = 1; $i <= 3; $i++) { ?>
								text += '<option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
							<?php } ?>
						text += '</select>'
					text += '</div>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">ปี</div>';
						text += '</div>';
						text += '<select name="job[stop_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
							text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
							<?php for ($i = (date('Y') + 543); $i >= (date('Y') + 543 - 2); $i--) { ?>
								text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
							<?php } ?>
						text += '</select>'
					text += '</div>';
				text += '</td>';
				text += '<td><input name="job[income][' + num_finance[type] + ']" class="form-control form-control-sm text-right" type="text" min="1" maxlength="6" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);"></td>';
				text += '<td><input name="job[description][' + num_finance[type] + ']" class="form-control form-control-sm" type="text" placeholder="ลักษณะงาน" maxlength="255"></td>';

			}
		text += '</tr>';
		$('.' + type).append(text);
	}
</script>