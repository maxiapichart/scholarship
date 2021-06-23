<form action="<?php echo site_url('annual/actionRegistration/'); ?>" method="post" onsubmit="return submitRegistration();">
	<input type="hidden" name="registration_id">
	<div class="container-fluid">
		<section class="pt-5">
			<div class="row justify-content-md-center">
				<div class="col-12">
					<div class="card">
						<div class="card-header text-center">
							<h2 class="mb-0">วันเปิดรับสมัคร | จองรอบสัมภาษณ์</h2>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table border">
									<tr>
										<td align="center" width="30%"><b>รอบสมัคร</b></td>
										<td width="35%">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">ชื่อรอบสมัคร</div>
												</div>
												<input type="text" name="registration_title" class="form-control form-control-sm input-block" required>
											</div>
										</td>
										<td width="35%">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">ปีการศึกษา</div>
												</div>
												<select name="year" class="custom-select custom-select-sm input-block">
													<?php for ($i = date('Y'); $i >= 2019; $i--) { ?>
														<option value="<?php echo $i; ?>"<?php echo $i != date('Y') ?: ' selected'; ?>><?php echo ($i + 543); ?></option>
													<?php } ?>
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<td align="center"><b>วันเปิดรับสมัคร</b></td>
										<td>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">วันที่เปิด</div>
												</div>
												<input class="datepicker rangeDate form-control form-control-sm input-block bg-white" name="r_start_d" autocomplete="off" readonly required>
											</div>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">เวลา</div>
												</div>
												<select name="r_start_t" class="custom-select custom-select-sm input-block text-right" required>
													<option disabled value="" selected class="d-none">hh:mm</option>
													<?php for ($i = 6; $i <= 18; $i++) { ?>
														<option value="<?php echo ($i < 10 ? '0' : '')."{$i}:00:00"; ?>"><?php echo "{$i}:00"; ?></option>
													<?php } ?>
												</select>
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">น.</div>
												</div>
											</div>
										</td>
										<td>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">วันที่ปิด</div>
												</div>
												<input class="datepicker rangeDate form-control form-control-sm input-block bg-white" name="r_stop_d" autocomplete="off" readonly required>
											</div>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">เวลา</div>
												</div>
												<select name="r_stop_t" class="custom-select custom-select-sm input-block" required>
													<option disabled value="" selected class="d-none">hh:mm</option>
													<?php for ($i = 0; $i <= 23; $i++) { ?>
														<option value="<?php echo ($i < 10 ? '0' : '')."{$i}:00:00"; ?>"><?php echo "{$i}:00"; ?></option>
													<?php } ?>
												</select>
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">น.</div>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td align="center"><b>วันเปิดจองรอบสัมภาษณ์</b></td>
										<td>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">วันที่เปิด</div>
												</div>
												<input class="datepicker rangeDate form-control form-control-sm input-block bg-white" name="i_start_d" autocomplete="off" readonly required>
											</div>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">เวลา</div>
												</div>
												<select name="i_start_t" class="custom-select custom-select-sm input-block" required>
													<option disabled value="" selected class="d-none">hh:mm</option>
													<?php for ($i = 6; $i <= 18; $i++) { ?>
														<option value="<?php echo ($i < 10 ? '0' : '')."{$i}:00:00"; ?>"><?php echo "{$i}:00"; ?></option>
													<?php } ?>
												</select>
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">น.</div>
												</div>
											</div>
										</td>
										<td>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">วันที่ปิด</div>
												</div>
												<input class="datepicker rangeDate form-control form-control-sm input-block bg-white" name="i_stop_d" autocomplete="off" readonly required>
											</div>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">เวลา</div>
												</div>
												<select name="i_stop_t" class="custom-select custom-select-sm input-block" required>
													<option disabled value="" selected class="d-none">hh:mm</option>
													<?php for ($i = 0; $i <= 23; $i++) { ?>
														<option value="<?php echo ($i < 10 ? '0' : '')."{$i}:00:00"; ?>"><?php echo "{$i}:00"; ?></option>
													<?php } ?>
												</select>
												<div class="input-group-prepend">
													<div class="input-group-text form-control-sm">น.</div>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="card">
						<div class="card-header text-center">
							<h2 class="mb-0">
								<span class="float-left"><button type="button" class="badge badge-light text-success" onclick="add('interview')" title="เพิ่มรอบสัมภาษณ์"><i class="fas fa-plus"></i></button></span>รอบสัมภาษณ์
							</h2>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-sm border">
									<tbody class="dataInterview"></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="all_i_id">
			<button type="submit" class="btn btn-primary btn-block"></button>
		</section>
	</div>
</form>
<script type="text/javascript">

	$(function() {
		registration(<?php echo $this->uri->segment(3); ?>)
		datepickerPrepare()
		$('.rangeDate').change(function() {
			rangeDate(this.name);
		})
	})
	function datepickerPrepare() {
		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: "linked",
			autoclose: true,
			language: 'th',
			thaiyear: true,
			clearBtn: true,
		})
		$('.datepickerToday').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: "linked",
			autoclose: true,
			language: 'th',		//เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
			thaiyear: true,		//Set เป็นปี พ.ศ.
			clearBtn: true,
		}).datepicker("setDate", "0");	//กำหนดเป็นวันปัจุบัน
	}
	var num	= {
		'interview': 0,
	};
	function numberformat(el) {
		var data = $(el).val().replace(/\D/g, '')
		$(el).val(data.charAt(0) == '0' ? (event.keyCode == 8 ? '' : '0') : data)
	}
	function is_valid(el, valid) {
		valid ? $(el).removeClass('is-invalid') : $(el).addClass('is-invalid')
	}
	function find_name(id1, id2) {
		var value = $('[name="psu[' + id1 + '][' + id2 + ']"]').val();
		if(value.indexOf('.') > 0 && value.indexOf('.') < value.length - 1) {
			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('annual/find_name'); ?>',
				data: {
					psu: value
				},
				success: function(result) {
					is_valid('[name="psu[' + id1 + '][' + id2 + ']"]', (result ? true : false))
					if(result) {
						$('#name_' + id1 + '_' + id2).html(result)
					} else {
						$('#name_' + id1 + '_' + id2).html('-ไม่มีรหัสนี้ในระบบ-')
					}
				}
			})
		} else {
			is_valid('[name="psu[' + id1 + '][' + id2 + ']"]', false)
			$('#name_' + id1 + '_' + id2).html('<span class="text-muted">ชื่อ (แสดงอัตโนมัติ)</span>')
		}
	}
	function rangeDate(name) {
		var key		= (name).split('_');
		var start	= $('[name="' + key[0] + '_start_' + key[2] + '"]').val().split('-');
		var stop	= $('[name="' + key[0] + '_stop_' + key[2] + '"]').val().split('-');
		if(start != '' && stop != '') {
			start	= parseInt(start[2] + start[1] + start[0])
			stop	= parseInt(stop[2] + stop[1] + stop[0])
			if(start > stop) {
				$('[name="' + key[0] + '_start_' + key[2] + '"]').val('')
				$('[name="' + key[0] + '_stop_' + key[2] + '"]').val('')
			}
		}
	}
	function submitRegistration() {
		var required = $('.datepicker').filter(function () {
			return $.trim($(this).val()).length == 0
		}).length == 0;
		return required
	}

	function registration(id = false) {
		if(!id) {
			$('[type="submit"]').html('เพิ่ม')
			$('[name="registration_id"]').val(0)
		} else {
			$('[type="submit"]').html('แก้ไข')
			$('[name="registration_id"]').val(id)
			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('annual/load_registration_interview'); ?>',
				data: {
					registration_id: id,
				},
				success: function(result) {
					result	= JSON.parse(result)
					console.log(result)
					$('[name="year"]').val(result[0]['year'])
					$('[name="registration_title"]').val(result[0]['registration_title'])
					var rstart	= switchdate(result[0]['registration_start']);
					var rstop		= switchdate(result[0]['registration_stop']);
					var istart	= switchdate(result[0]['interview_start']);
					var istop		= switchdate(result[0]['interview_stop']);
					$('[name="r_start_d"]').datepicker('setDate', rstart[0]);
					$('[name="r_stop_d"]').datepicker('setDate', rstop[0]);
					$('[name="i_start_d"]').datepicker('setDate', istart[0]);
					$('[name="i_stop_d"]').datepicker('setDate', istop[0]);
					// $('[name="r_start_d"]').val(rstart[0])
					// $('[name="r_stop_d"]').val(rstop[0])
					// $('[name="i_start_d"]').val(istart[0])
					// $('[name="i_stop_d"]').val(istop[0])
					$('[name="r_start_t"]').val(rstart[1] + ':' + rstart[2] + ':00');
					$('[name="r_stop_t"]').val(rstop[1] + ':' + rstop[2] + ':00');
					$('[name="i_start_t"]').val(istart[1] + ':' + istart[2] + ':00');
					$('[name="i_stop_t"]').val(istop[1] + ':' + istop[2] + ':00');

					all_i_id	= '';
					$.each(result[1], function(i, ar) {
						add('interview', ar['interview_id'], ar['student'] > 0 ? true : false)
						var start	= switchdate(ar['start']);
						var stop	= switchdate(ar['stop']);
						$('[name="interview_name[' + num['interview'] + ']"]').val(ar['interview_name'])
						$('[name="seat[' + num['interview'] + ']"]').val(ar['seat'])
						$('[name="in_d[' + num['interview'] + ']"]').datepicker({
							format: 'dd-mm-yyyy',
							todayBtn: "linked",
							autoclose: true,
							language: 'th',		//เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
							thaiyear: true		//Set เป็นปี พ.ศ.
						}).datepicker('setDate', start[0]);
						$('[name="in_h_start[' + num['interview'] + ']"]').val(start[1])
						$('[name="in_h_stop[' + num['interview'] + ']"]').val(stop[1])
						$('[name="in_m_start[' + num['interview'] + ']"]').val(start[2])
						$('[name="in_m_stop[' + num['interview'] + ']"]').val(stop[2])
						interviewer(ar['interview_id'], num['interview'])
						all_i_id	+= all_i_id	== '' ? '' : ',';
						all_i_id	+= ar['interview_id'];
					})
					$('[name="all_i_id"]').val('[' + all_i_id + ']')
				}
			})
		}
	}
	function interviewer(interview_id, id) {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('annual/load_interviewer_id'); ?>',
			data: {
				interview_id: interview_id,
			},
			success: function(result) {
				result	= JSON.parse(result)
				console.log(result)
				$.each(result, function(i, ar) {
					add('interviewer', id)
					$('[name="psu[' + id + '][' + num['interviewer_' + id] + ']"]').val(ar['username'])
					find_name(id, num['interviewer_' + id]);
				})
			}
		})
	}
	function switchdate(date) {
		temp	= date.split(' ');
		day		= temp[0].split('-');
		time	= temp[1].split(':');
		return [day[2] + '-' + day[1] + '-' + day[0], time[0], time[1]];
	}
	function add(tr, id = 0, student = false) {
		text	= '';
		if(tr == 'interview') {

			no	= ++num['interview'];
			text += '<tr class="interview_' + no + '">';
				text += '<td class="nowrap" align="left" width="1">';
					text += '<input type="hidden" name="interview_id[' + no + ']" value="' + id + '">';
					text += '<button type="button" class="badge badge-light text-success" onclick="add(\'interviewer\', \'' + no + '\')" title="เพิ่มกรรมการสัมภาษณ์"><i class="fas fa-plus"></i></button>';
					text += '<button type="button" class="badge badge-light text-danger" onclick="';
						text += student ? 'alert(\'มีนักศึกษาสมัครอบนี้แล้ว ไม่ควรลบ\');' : 'confirm(\'ต้องการลบรอบสัมภาษณ์นี้?\') ? $(\'.interview_' + no + '\').remove() : \'\';';
						text += '" title="ลบรอบสัมภาษณ์"><i class="fas fa-minus"></i>';
					text += '</button>';
				text += '</td>';
				text += '<td width="50%">';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">ชื่อรอบสัมภาษณ์</div>';
						text += '</div>';
						text += '<input name="interview_name[' + no + ']" class="form-control form-control-sm text-right" type="text" placeholder="ไม่บังคับ" maxlength="255">';
					text += '</div>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">จำนวนนศ.ที่รับ</div>';
						text += '</div>';
						text += '<input name="seat[' + no + ']" class="form-control form-control-sm text-right" type="text" min="0" pattern="\\d*" maxlength="3" placeholder="0" onkeyup="numberformat(this);" required>';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">คน</div>';
						text += '</div>';
					text += '</div>';
				text += '</td>';
				text += '<td width="50%">';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">วันที่สัมภาษณ์</div>';
						text += '</div>';
						text += '<input class="datepicker form-control form-control-sm input-block bg-white" name="in_d[' + no + ']" autocomplete="off" readonly required>';
					text += '</div>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">เวลาเริ่มต้น</div>';
						text += '</div>';
						text += '<select name="in_h_start[' + no + ']" class="custom-select custom-select-sm input-block" required>';
							text += '<option disabled value="" selected class="d-none">ชม.</option>';
							for (var i = 6; i < 24; i++) {
								text += '<option value="' + (i < 10 ? '0' : '') + i + '">' + i + '</option>';
							}
						text += '</select>';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">:</div>';
						text += '</div>';
						text += '<select name="in_m_start[' + no + ']" class="custom-select custom-select-sm input-block" required>';
							text += '<option disabled value="" selected class="d-none">น.</option>';
							for (var i = 0; i < 60; i += 5) {
								text += '<option value="' + (i < 10 ? '0' : '') + i + '">' + (i < 10 ? '0' : '') + i + '</option>';
							}
						text += '</select>';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">น.</div>';
						text += '</div>';
					text += '</div>';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">เวลาสิ้นสุด</div>';
						text += '</div>';
						text += '<select name="in_h_stop[' + no + ']" class="custom-select custom-select-sm input-block" required>';
							text += '<option disabled value="" selected class="d-none">ชม.</option>';
							for (var i = 6; i < 24; i++) {
								text += '<option value="' + (i < 10 ? '0' : '') + i + '">' + i + '</option>';
							}
						text += '</select>';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">:</div>';
						text += '</div>';
						text += '<select name="in_m_stop[' + no + ']" class="custom-select custom-select-sm input-block" required>';
							text += '<option disabled value="" selected class="d-none">น.</option>';
							for (var i = 0; i < 60; i += 5) {
								text += '<option value="' + (i < 10 ? '0' : '') + i + '">' + (i < 10 ? '0' : '') + i + '</option>';
							}
						text += '</select>';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">น.</div>';
						text += '</div>';
					text += '</div>';
				text += '</td>';
			text += '</tr>';
			text += '<tr class="interview_' + no + '">';
				text += '<td colspan="3">';
					text += '<div class="table-responsive">';
						text += '<table class="table table-sm interviewer_' + no + '">';
						text += '</table>';
					text += '</div>';
				text += '</td>';
			text += '</tr>';
			num['interviewer_' + no] = 0
			$('.dataInterview').prepend(text);
			datepickerPrepare();
		} else if(tr == 'interviewer') {

			no	= ++num['interviewer_' + id];
			text += '<tr class="interviewer_' + id + '_' + no + '">';
				text += '<td width="5%"></td>';
				text += '<td width="5%">';
					text += '<button type="button" class="badge badge-muted text-danger" onclick="confirm(\'ต้องการลบกรรมการสัมภาษณ์นี้?\') ? $(\'.interviewer_' + id + '_' + no + '\').remove() : \'\';" title="ลบกรรมการสอบสัมภาษณ์"><i class="fas fa-minus"></i></button>';
				text += '</td>';
				text += '<td width="45%">';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">PSU Passport</div>';
						text += '</div>';
						text += '<input class="form-control form-control-sm input-block nowrap" name="psu[' + id + '][' + no + ']" autocomplete="off" onkeyup="find_name(' + id + ', ' + no + ');" required>';
					text += '</div>';
				text += '</td>';
				text += '<td width="45%">';
					text += '<div class="input-group">';
						text += '<div class="input-group-prepend">';
							text += '<div class="input-group-text form-control-sm">ชื่อ</div>';
						text += '</div>';
						text += '<div class="form-control form-control-sm input-block nowrap" id="name_' + id + '_' + no + '"><span class="text-muted">ชื่อ (แสดงอัตโนมัติ)</span></div>';
					text += '</div>';
				text += '</td>';
			text += '</tr>';
			$('.interviewer_' + id).append(text);
		}
	}
</script>