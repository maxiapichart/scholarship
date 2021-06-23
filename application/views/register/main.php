<?php //print_r($registration); ?>
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
								<img src="<?php echo 'https://regist.psu.ac.th/Stud_Pics/'.substr($this->session->userdata('username'), 0, 2).'/'.$this->session->userdata('username').'.jpg'; ?>" alt="Profile Picture" class="img-fluid shadow">
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
						<div class="row pt-2 p-xl-3">
							<div class="accordion" id="section1">
								<?php $this->load->view('register/profile'); ?>
							</div>
						</div>

						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-user-friends"></i> ข้อมูลครัวเรือน<span class="float-right">2 / 4</span></h5>
							</div>
						</div>
						<div class="row py-3 p-xl-3">
							<div class="accordion" id="section2">
								<?php $this->load->view('register/family'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-money-check-alt"></i> ข้อมูลการเงิน<span class="float-right">3 / 4</span></h5>
							</div>
						</div>
						<div class="row py-3 p-xl-3">
							<div class="accordion" id="section3">
								<?php $this->load->view('register/finance'); ?>
							</div>
						</div>

						<div class="row">
							<div class="col-12 font-italic pt-3 bg-primary text-white shadow">
								<h5 class="text-uppercase"><i class="fas fa-clipboard-check"></i> หนังสือรับรอง<span class="float-right">4 / 4</span></h5>
							</div>
						</div>
						<div class="row py-3 p-xl-3">
							<div class="accordion" id="section4">
								<?php $this->load->view('register/certificate'); ?>
							</div>
						</div>
						<div class="d-flex justify-content-center">
							<div class="custom-control custom-checkbox">
								<input id="confirmChecked" type="checkbox" class="custom-control-input" onclick="if($(this).is(':checked')) confirmSubmit();">
								<label class="custom-control-label pl-3" for="confirmChecked">ข้าพเจ้าขอรับรองว่าข้อความที่เขียนไว้ในใบสมัครนี้ เป็นความจริงทุกประการ<br/>หากปรากฏว่าข้อความใดกล่าวเท็จ ข้าพเจ้ายินดีจะคืนเงินทุนทั้งหมดและยินดีรับโทษทางวินัยนักศึกษา</label>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<form action="<?php echo site_url('scholarship/confirmSubmit'); ?>" method="POST">
									<input type="hidden" name="registration_id" value="<?php echo $registration['registration_id']; ?>">
									<button id="confirmSubmit" type="submit" class="btn btn-success btn-block shadow" disabled>ส่งใบสมัคร</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<style>
	[for="confirmChecked"]::before, 
	[for="confirmChecked"]::after {
		top: .4rem;
		width: 2.25rem;
		height: 2.25rem;
	}
</style>
<script type="text/javascript">
	var checkall = {
		'profile' : false,
		'family' : false, 'sibling' : false,
		'finance' : false,
		'explain' : false, 'certificate' : false
	};
	var statusCard = [
		'<i class="fas fa-times-circle text-danger"></i>',
		'<i class="fas fa-check-circle text-success"></i>',
		'<i class="fas fa-minus-circle text-warning"></i>'
	];

	$("input[pattern]").keyup(numberMask)
	$('input[type="email"]').keyup(emailMask)

	function emailMask() {
		var validEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
		var isValid = this.value.match(validEmail)
		var isInternet = this.value.match(/@.*\./)
		is_valid(this.id, (isValid && isInternet ? true : false))
	}
	function numberMask() {
		numberformat(this)
	}
	function numberformat(el) {
		var data = $(el).val().replace(/\D/g, '')
		if($(el).attr('min') != undefined) {
			$(el).val(data.charAt(0) == '0' ? (event.keyCode == 8 ? '' : '0') : data)
		} else {
			$(el).val(data.charAt(0) == '0' && data.charAt(1) == '0' ? '0' : data)
		}
		$(el).attr('minlength') != undefined ? is_valid(el, (data.length == $(el).attr('minlength') ? true : false)) : '';
	}
	function is_valid(el, valid) {
		valid ? $(el).removeClass('is-invalid') : $(el).addClass('is-invalid')
	}
	function toggleCollapseIcon(collapse, id) {
		$(collapse).on('shown.bs.collapse', function () {
			$(id).removeClass('fa-chevron-down')
			$(id).addClass('fa-chevron-up')
		});
		$(collapse).on('hidden.bs.collapse', function () {
			$(id).removeClass('fa-chevron-up')
			$(id).addClass('fa-chevron-down')
		});
	}
	function submitFrom(el) {
		$('#' + el.id + ' :input').prop('required', false)
		$('#' + el.id + ' :selected').prop('required', false)
		$('#' + el.id + ' textarea').prop('required', false)
		$('#' + el.id + ' :input').not('.d-none').prop('required', true);
		$('#' + el.id + ' :selected').not('.d-none').prop('required', true);
		$('#' + el.id + ' textarea').not('.d-none').prop('required', true);
		$('#' + el.id + ' [type="checkbox"]').prop('required', false)
		$('#' + el.id + ' .d-none :input').prop('required', false)
		$('#' + el.id + ' .d-none :selected').prop('required', false)
		$('#' + el.id + ' d-none textarea').prop('required', false)
		$('#' + el.id + ' [disabled]').prop('required', false)
		if($('#' + el.id + ' input').not('.d-none').hasClass('is-invalid')) {
			alert_modal('กรุณากรอกข้อมูลให้ถูกต้อง', 'orange', false)
		} else {
			var required = $('#' + el.id + ' [required]').filter(function () {
				return $.trim($(this).val()).length == 0
			}).length == 0;
			required ? sendForm(el.id) : '';
		}
		return false;
	}
	function sendForm(id) {
		var data	= {}
		data['registration_id']	= <?php echo $registration['registration_id']; ?>;
		$('#' + id + ' [required]').each(function(){
			if(this.type != 'radio' || $(this).is(':checked')) {
				data[this.name]	= $(this).val()
			}
			// console.log(this.name)
			// console.log(this.type)
			// console.log($(this).val())
		})
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('scholarship/'); ?>' + id,
			data: data,
			success: function(result) {
				// console.log(JSON.parse(result))
				console.log(result)
				alert_modal('บันทึก เรียบร้อยแล้ว', 'green', true)
				eval(id + "()")
			}
		})
	}
	function alert_modal(text, color, autohide = false) {
		$('#alert-text').css('color', color)
		$('#alert-text').html(text)
		$('#alert_modal').modal('show')
		if(autohide) {
			$('#alert-close').hide()
			setTimeout(function() {
				$('#alert_modal').modal('hide')
			}, 4000)
		} else {
			$('#alert-close').show()
		}
	}
	function confirmSubmit() {
		$('#confirmSubmit').prop('disabled', false)
		var text = '';
		$.each(checkall, function(i, ar) {
			if(!ar) {
				$('#confirmSubmit').prop('disabled', true)
				$('#confirmChecked').prop('checked', false)
			}
		})
		if($('#confirmSubmit').is(':disabled')) {
			// alert_modal("กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์" + (!checkall['certificate'] ? '<br/>และส่งเอกสารเพิ่มเติมให้เจ้าหน้าที่ก่อนกดส่งใบสมัคร' : ''), 'red')
			alert_modal("กรุณากรอกข้อมูลให้ครบถ้วนสมบูรณ์" + (!checkall['certificate'] ? '<br/>และรอเจ้าหน้าที่ตรวจเอกสารใบสมัครให้แล้วเสร็จก่อน' : ''), 'red')
		}
	}
</script>
<div class="modal" tabindex="-1" role="dialog" id="alert_modal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="alert-text"></h4>
				<span class="text-right"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></span>
			</div>
			<div class="modal-footer text-right" id="alert-close">
				<button class="btn btn-secondary btn-sm" data-dismiss="modal">ตกลง</button>
			</div>
		</div>
	</div>
</div>