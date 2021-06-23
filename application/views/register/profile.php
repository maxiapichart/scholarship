<div class="card">
	<div class="card-header" id="sec1Head1">
		<h2 class="mb-0">
			<span id="sec1Id1" class="confirmSubmit"><i class="fas fa-times-circle text-danger"></i></span>
			<button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec1Col1" aria-expanded="false" aria-controls="sec1Col1" onclick="toggleCollapseIcon('#sec1Col1', '#sec1Icon1');">
				ข้อมูลนักศึกษา
			</button>
		</h2>
	</div>
	<div id="sec1Col1" class="collapse" aria-labelledby="sec1Head1" data-parent="#section1">
		<form id="profile" class="card-body" action="javascript:void(0);" method="post" onsubmit="return submitFrom(this);">
			<div class="row">
				<div class="px-2 col-md-6 mb-3">
					<select name="mobile" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #mobile-specify-area').addClass('d-none') : $('#profile #mobile-specify-area').removeClass('d-none')">
						<option disabled value="" selected class="d-none">-ยี่ห้อมือถือ-</option>
						<?php foreach ($mobile as $ar) { ?>
							<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
						<?php } ?>
						<option disabled></option>
						<option value="0">อื่นๆ (ระบุ)</option>
					</select>
					<div id="mobile-specify-area" class="input-group d-none">
						<div class="input-group-prepend">
							<div class="input-group-text form-control-sm">ระบุ</div>
						</div>
						<input name="mobile-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุยี่ห้อมือถือ">
					</div>
				</div>
				<div class="px-2 col-md-6">
					<div class="form-group-material">
						<input name="number" id="profile-number" type="text" class="input-material" minlength="10" maxlength="10" pattern="\d*">
						<label for="profile-number" class="label-material"><i class="fas fa-mobile-alt"></i> เบอร์มือถือ</label>
					</div>
				</div>
			</div>
			<div class="row border-bottom border-3">
				<div class="px-2 col-md-6">
					<div class="form-group-material">
						<input name="email" id="profile-email" type="email" class="input-material">
						<label for="profile-email" class="label-material"><i class="far fa-envelope"></i> อีเมล</label>
					</div>
				</div>
				<div class="px-2 col-md-6">
					<div class="form-group-material">
						<input name="line" id="profile-line" type="text" class="input-material" autocapitalize="none">
						<label for="profile-line" class="label-material"><i class="fab fa-line"></i> ไอดีไลน์</label>
					</div>
				</div>
			</div>
			<div class="row">
				<table class="table">
					<tr>
						<td>1.</td>
						<td><b>นับถือศาสนา</b><br/>
							<select name="religion" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #religion-specify-area').addClass('d-none') : $('#profile #religion-specify-area').removeClass('d-none')">
								<option disabled value="" selected class="d-none">-เลือก-</option>
								<?php $group	= $religion[0]['selectdata_group'];
								foreach ($religion as $ar) {
									if($group	!= $ar['selectdata_group']) {
										$group	= $ar['selectdata_group']; ?>
										<option disabled></option>
									<?php } ?>
									<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
								<?php } ?>
								<option disabled></option>
								<option value="0">อื่นๆ (ระบุ)</option>
							</select>
							<div id="religion-specify-area" class="input-group d-none">
								<div class="input-group-prepend">
									<div class="input-group-text form-control-sm">ระบุ</div>
								</div>
								<input name="religion-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุศาสนา">
							</div>
						</td>
					</tr>
					<tr>
						<td>2.</td>
						<td><b>ที่พักอาศัย</b><br/>
							<select name="address" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #address-specify-area').addClass('d-none') : $('#profile #address-specify-area').removeClass('d-none'); $(this).children(':selected').hasClass('group2') ? $('#profile #address-area').removeClass('d-none') : $('#profile #address-area').addClass('d-none');">
								<option disabled value="" selected class="d-none">-เลือก-</option>
								<?php $group	= $address[0]['selectdata_group'];
								foreach ($address as $ar) {
									if($group	!= $ar['selectdata_group']) {
										$group	= $ar['selectdata_group']; ?>
										<option disabled></option>
									<?php } ?>
									<option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
								<?php } ?>
								<option disabled></option>
								<option value="0">อื่นๆ (ระบุ)</option>
							</select>
							<div id="address-specify-area" class="input-group d-none">
								<div class="input-group-prepend">
									<div class="input-group-text form-control-sm">ระบุ</div>
								</div>
								<input name="address-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุที่พักอาศัย">
							</div>
							<div id="address-area" class="d-none">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text form-control-sm">ชื่อหอพัก</div>
									</div>
									<input name="address-name" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ชื่อหอพัก">
									<div class="input-group-prepend">
										<div class="input-group-text form-control-sm">เลขห้อง</div>
									</div>
									<input name="address-room" class="form-control form-control-sm input-block" type="text" maxlength="10" placeholder="เลขห้อง">
								</div>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text form-control-sm">บ้านเลขที่</div>
									</div>
									<input name="address-number" class="form-control form-control-sm input-block" type="text" maxlength="10" placeholder="บ้านเลขที่">
									<div class="input-group-prepend">
										<div class="input-group-text form-control-sm">ตรอก/ซอย</div>
									</div>
									<input name="address-alley" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ตรอก/ซอย">
								</div>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text form-control-sm">ถนน</div>
									</div>
									<input name="address-road" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ถนน">
									<div class="input-group-prepend">
										<div class="input-group-text form-control-sm">เบอร์โทร</div>
									</div>
									<input name="address-tel" class="form-control form-control-sm input-block" type="text" pattern="\d*" minlength="10" maxlength="10" placeholder="เบอร์โทร">
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>3.</td>
						<td><b>การเดินทางไปเรียน</b><br/>
							<select name="tostudy[]" class="custom-select custom-select-sm input-block" multiple="multiple" size="<?php echo count($tostudy); ?>">
								<?php foreach ($tostudy as $ar) { ?>
									<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>4.</td>
						<td><b>เครื่องใช้ส่วนตัว</b><br/>
							<select name="accessories[]" class="custom-select custom-select-sm input-block" multiple="multiple" size="<?php echo count($accessories); ?>">
								<?php foreach ($accessories as $ar) { ?>
									<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>5.</td>
						<td><b>เพื่อนสนิท</b>
							<div class="form-group-material pt-3">
								<input name="fnumber" id="friend-number" type="text" class="input-material" minlength="10" maxlength="10" pattern="\d*">
								<label for="friend-number" class="label-material pt-3"><i class="fas fa-mobile-alt"></i> เบอร์มือถือ</label>
							</div>
							<div class="form-group-material">
								<input name="fstudent_id"  id="friend-studentID" type="text" class="input-material" minlength="10" maxlength="10" pattern="\d*" onkeyup="find_name();">
								<label for="friend-studentID" class="label-material"><i class="far fa-address-card"></i> รหัสนักศึกษา</label>
								<div id="friend-name" class="form-control form-control-sm input-block mt-1"></div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<button type="submit" class="btn btn-info btn-block">บันทึก</button>
		</form>
	</div>
	<div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec1Col1" aria-expanded="false" aria-controls="sec1Col1" onclick="toggleCollapseIcon('#sec1Col1', '#sec1Icon1');"><i id="sec1Icon1" class="fas fa-chevron-down"></i></div>
</div>
<script type="text/javascript">
	profile()
	find_name()
	function profile() {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('scholarship/get_profile'); ?>',
			data: {registration_id: <?php echo $registration['registration_id']; ?>},
			success: function(result) {
				result	= JSON.parse(result)
				if(result) {
					$('#profile #profile-number').val(result['number']);
					$('#profile #profile-email').val(result['email']);
					$('#profile #profile-line').val(result['line']);
					$('#profile #friend-number').val(result['fnumber']);
					$('#profile #friend-studentID').val(result['fstudent_id']);
					find_name()
					if($.isNumeric(result['mobile'])) {
						$('#profile [name="mobile"]').val(result['mobile'])
					} else {
						$('#profile [name="mobile"]').val(0);
						$('#profile #mobile-specify-area').removeClass('d-none');
						$('#profile [name="mobile-specify"]').val(result['mobile']);
					}
					if($.isNumeric(result['religion'])) {
						$('#profile [name="religion"]').val(result['religion'])
					} else {
						$('#profile [name="religion"]').val(0);
						$('#profile #religion-specify-area').removeClass('d-none');
						$('#profile [name="religion-specify"]').val(result['religion']);
					}
					if($.isNumeric(result['address'])) {
						$('#profile [name="address"]').val(result['address'])
						if(result['address'] == 4) {
							$('#profile #address-area').removeClass('d-none')
							$('#profile [name="address-name"]').val(result['address-name'])
							$('#profile [name="address-room"]').val(result['address-room'])
							$('#profile [name="address-number"]').val(result['address-number'])
							$('#profile [name="address-alley"]').val(result['address-alley'])
							$('#profile [name="address-road"]').val(result['address-road'])
							$('#profile [name="address-tel"]').val(result['address-tel'])
						}
					} else {
						$('#profile [name="address"]').val(0);
						$('#profile #address-specify-area').removeClass('d-none');
						$('#profile [name="address-specify"]').val(result['address']);
					}
					$('#profile [name="tostudy[]"]').val(JSON.parse(result['tostudy']))
					$('#profile [name="accessories[]"]').val(JSON.parse(result['accessories']))
					$(function() {
						$('#sec1Id1').html(statusCard[1])
						checkall['profile'] = true;
					});
				}
			}
		})
	}
	function find_name() {
		if($('#friend-studentID').val().length == 10) {
			$.ajax({
				method: 'POST',
				url: '<?php echo site_url('scholarship/find_name'); ?>',
				data: {
					student_id: $('#friend-studentID').val()
				},
				success: function(result) {
					is_valid('#friend-studentID', (result ? true : false))
					if(result) {
						$('#friend-name').html(result)
					} else {
						$('#friend-name').html('-ไม่มีรหัสนี้ในระบบ-')
					}
				}
			})
		} else {
			$('#friend-name').removeClass('is-valid')
			$('#friend-name').removeClass('is-invalid')
			$('#friend-name').html('ชื่อ (แสดงอัตโนมัติ)')
		}
	}

	$('select[multiple="multiple"] option').mousedown(function(e) {
		e.preventDefault();
		var originalScrollTop = $(this).parent().scrollTop();
		$(this).prop('selected', $(this).prop('selected') ? false : true);
		var self = this;
		$(this).parent().focus();
		setTimeout(function() {
			$(self).parent().scrollTop(originalScrollTop);
		}, 0);
		return false;
	})
</script>