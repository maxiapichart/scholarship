<?php $get['apply']	= $this->input->get('apply'); ?>
<div class="container-fluid">
	<section class="pt-5">
		<div class="row mb-4">
			<div class="col mb-4">
				<div class="card">
					<div class="card-header text-center">
						<h2 class="mb-0">วันสมัคร-รอบสัมภาษณ์</h2>
					</div>
					<div class="card-body">
						<select id="apply" class="custom-select custom-select-sm input-block w-auto" onchange="$('#list').DataTable().ajax.reload();">
							<option value="">ทั้งหมด</option>
							<option value="1" <?php echo $get['apply'] != 1 ?: ' selected'; ?>>กำลังเขียนใบสมัคร</option>
							<option value="2" <?php echo $get['apply'] != 2 ?: ' selected'; ?>>ส่งใบสมัครแล้ว</option>
						</select>
						<div class="table-responsive pt-2">
							<table id="list" class="table table-striped table-bordered">
								<thead class="thead-dark">
									<tr>
										<td></td>
										<td>รหัส</td>
										<td>ชื่อ</td>
										<td>คณะ</td>
										<td>สมัครเมื่อ</td>
										<td>เอกสารเพิ่มเติม</td>
										<td></td>
										<td>วันสัมภาษณ์</td>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="modalCer" tabindex="-1" role="dialog" aria-labelledby="modalCerLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalCerLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('annual/certificate/'); ?>" method="post">
				<input type="hidden" name="apply" value="<?php echo $get['apply']; ?>">
				<input type="hidden" name="registration_id" value="<?php echo $registration_id; ?>">
				<input type="hidden" name="student_id">
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<td><b>ต้องการเอกสารนี้</b></td>
									<td><b>เอกสาร</b></td>
									<td><b>ส่งเอกสารนี้แล้ว</b></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($certificate as $ar) { ?>
									<tr>
										<td align="center">
											<div class="custom-control custom-checkbox">
												<input id="<?php echo "certificate{$ar['selectdata_id']}"; ?>" type="checkbox" class="certificate custom-control-input" onchange="$('<?php echo "#cer{$ar['selectdata_id']}"; ?>').prop('disabled', !this.checked); $('<?php echo "#cer{$ar['selectdata_id']}"; ?>').val('')" name="<?php echo "certificate{$ar['selectdata_id']}"; ?>">
												<label class="custom-control-label" for="<?php echo "certificate{$ar['selectdata_id']}"; ?>"></label>
											</div>
										</td>
										<td><?php echo $ar['selectdata_title']; ?></td>
										<td align="center">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="cer custom-control-input" id="<?php echo "cer{$ar['selectdata_id']}"; ?>" name="<?php echo "cer{$ar['selectdata_id']}"; ?>">
												<label class="custom-control-label" for="<?php echo "cer{$ar['selectdata_id']}"; ?>"></label>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					<button type="submit" class="btn btn-primary">บันทึก</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var month	= ['ม.ค.','ก.พ','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
	$(function() {
		list()
	})
	function date(date) {
		date	= date.replace(' ', 'T').split(/[^0-9]/);
		date	=	new Date (date[0], date[1] - 1, date[2], date[3], date[4], date[5]);
		return date.getDate() + ' ' + month[date.getMonth()] + ' ' + (parseInt(date.getFullYear()) + 543 - 2500) + ' | ' + date.getHours() + ':' + (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
	}
	function list() {
		$('#list').DataTable({
			language: { url : '<?php echo site_url('index/datatableTH'); ?>' },
			processing: true,
			ajax: {
				type: "POST",
				url: '<?php echo site_url('annual/list_student'); ?>',
				data: (d) => {
					d.registration_id	= '<?php echo $registration_id; ?>';
					d.apply	= $('#apply').val();
				},
				dataSrc: ''
			},
			autoWidth: false,
			paging: false,
			order: [[4, 'desc']],
			searching: true,
			columns: [
				{ data: null, searchable: false, orderable: false, className: 'text-right nowrap'},
				{ data: 'student_id', className: 'nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? '<a href="<?php echo site_url('annual/register/'.$registration_id.'/'); ?>' + data + '<?php echo $get['apply'] != '' ? "/?apply={$get['apply']}" : ''; ?>">' + data + '</a>' : data);
					}
				},
				{ data: 'student_name', className: 'nowrap'},
				{ data: 'fac_name', className: 'nowrap'},
				{ data: 'modify', className: 'text-center nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? date(data) : data);
					}
				},
				{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						return (data['googledrive'] != null ? '<a href="' + data['googledrive'] + '" target="_blank">GoogleDrive</a> | ' : '') + '<button class="btn btn-sm btn-link text-info" onclick="modalCer(' + data['registration_id'] + ', ' + data['student_id'] + ')">' + (7 - data['total'] > 0 ? 'ขาดเอกสาร ' + (7 - data['total']) + ' ฉบับ' : 'เอกสารครบแล้ว') + '</button>'
					}
				},
				{ data: 'register', className: 'text-right nowrap',
					render: function(data, type, full) {
						return data != null ? 'ส่งใบสมัครแล้ว' : 'ยังไม่ส่งใบสมัคร';
					}
				},
				{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						return data['interview'] != null ? date(data['start']) : 'ยังไม่จองวันสัมภาษณ์';
					}
				}
			],
			rowCallback: function(row, data, index) {
				$(row).find('td:eq(6)').css('color', data['register'] == null ? 'red' : '');
				$(row).find('td:eq(7)').css('color', data['interview'] == null ? 'red' : '');
			}
		})
		$('#list').DataTable().on('order.dt search.dt', function() {
			$('#list').DataTable().column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = (i + 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
			})
		}).draw()
	}

	function modalCer(registration_id, student_id) { // empty in case the columns change
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('annual/load_certificate'); ?>',
			data: {
				registration_id: registration_id,
				student_id: student_id,
			},
			success: function(result) {
				result	= JSON.parse(result)
				console.log(result)
				$('#modalCerLabel').html(student_id + (result[1].length > 0 ? ' | <a href="' + result[1][0]['googledrive'] + '" target="_blank">GoogleDrive</a>' : ''))
				$('[name="student_id"').val(student_id)
				$('.certificate').prop('checked', true)
				$('.cer').prop('checked', false)
				if(result[0].length) {
					$.each(result[0], function(i, ar) {
						console.log(ar)
						$('#certificate' + ar['certificate_id']).prop('checked', ar['status'] == 2 ? false : true)
						$('#cer' + ar['certificate_id']).prop('disabled', ar['status'] == 2 ? true : false)
						$('#cer' + ar['certificate_id']).prop('checked', ar['status'] == 1 ? true : false)
					})
				}
				$('#modalCer').modal('show')
			}
		})
	}
</script>