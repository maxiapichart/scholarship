<?php $get['year']	= $this->input->get('year'); ?>
<div class="container-fluid">
	<section class="pt-5">
		<div class="row mb-4">
			<div class="col mb-4">
				<div class="card">
					<div class="card-header text-center">
						<h2 class="mb-0">วันสมัคร-รอบสัมภาษณ์</h2>
					</div>
					<div class="card-body">
						<select id="year" class="btn btn-primary" onchange="$('#list').DataTable().ajax.reload();">
							<option value="">ทั้งหมด</option>
							<?php for ($i = date('Y'); $i >= 2019; $i--) { ?>
								<option value="<?php echo $i; ?>" <?php echo $i != ($get['year'] != '' ? $get['year'] : date('Y')) ?: 'selected'; ?>><?php echo 'ปีการศึกษา '.($i + 543); ?></option>
							<?php } ?>
						</select>
						<div class="table-responsive pt-2">
							<table id="list" class="table table-striped table-bordered">
								<thead>
									<tr>
										<td rowspan="2"></td>
										<td rowspan="2" width="1"><a href="<?php echo site_url('annual/registration'); ?>" class="btn btn-link h1 text-primary" title="เพิ่ม"><i class="fas fa-plus"></i></a></td>
										<td rowspan="2"></td>
										<td rowspan="2" align="center"><b>รอบ</b></td>
										<td rowspan="2" align="center"><b>ปีการศึกษา</b></td>
										<td colspan="4" align="center"><b>สมัครทุน</b></td>
										<td colspan="3" align="center"><b>สัมภาษณ์ทุน</b></td>
										<td rowspan="2" width="1"></td>
									</tr>
									<tr>
										<td align="right">วันเปิด-ปิด</td>
										<td align="right">กำลังเขียนใบสมัคร</td>
										<td align="right">ส่งใบสมัครแล้ว</td>
										<td align="right">ทั้งหมด</td>
										<td align="right">วันเปิด-ปิด</td>
										<td align="right">รอบที่เปิด</td>
										<td align="right">นักศึกษา/ที่นั่งสัมภาษณ์</td>
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
<script type="text/javascript">
	var now		= $.now()
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
				url: '<?php echo site_url('annual/list_registration'); ?>',
				data: (d) => {
					d.year	= $('#year').val();
				},
				dataSrc: ''
			},
			autoWidth: false,
			paging: false,
			order: [[0, 'desc']],
			searching: false,
			columns: [
				{ data: 'modify', visible: false, searchable: false},
				{ data: 'registration_id', orderable: false, className: 'text-center nowrap', searchable: false,
					render: function(data, type, full) {
						return '<a href="<?php echo site_url('annual/registration/'); ?>' + data + '" class="btn btn-link h1 text-info" title="ปรับแต่ง"><i class="fas fa-sliders-h"></i></a>';
					}
				},
				{ data: null, searchable: false, orderable: false, className: 'text-right nowrap'},
				{ data: 'registration_title', className: 'nowrap'},
				{ data: 'year', className: 'text-center nowrap', visible: !!$('#year').val(),
					render: function(data, type, full) {
						return parseInt(data) + 543;
					}
				},
				{ data: null, className: 'text-center nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? date(data['registration_start']) + '<br/><small>' + date(data['registration_stop']) + '</small>' : data['registration_start']);
					}
				},
					{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						var datareturn	= '<a href="<?php echo site_url('annual/student/'); ?>' + data['registration_id'] + '/?apply=1">' + (data['applying'] > 0 ? data['applying'] : '-') + '<small> คน</small></a>'
						return type == 'display' ? datareturn : data['applying'];
					}
				},
				{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						var datareturn	= '<a href="<?php echo site_url('annual/student/'); ?>' + data['registration_id'] + '/?apply=2">' + (data['applied'] > 0 ? data['applied'] : '-') + '<small> คน</small></a>';
						return type == 'display' ? datareturn : data['applied'];
					}
				},
				{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						var datareturn	= '<a href="<?php echo site_url('annual/student/'); ?>' + data['registration_id'] + '/">' + (parseInt(data['applying']) + parseInt(data['applied']) > 0 ? (parseInt(data['applying']) + parseInt(data['applied']) || 0) : '-') + '<small> คน</small></a>';
						return type == 'display' ? datareturn : (parseInt(data['applying'])) + (parseInt(data['applied']));
					}
				},
				{ data: null, className: 'text-center nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? date(data['interview_start']) + '<br/><small>' + date(data['interview_stop']) + '</small>' : data['interview_start']);
					}
				},
				{ data: 'num', className: 'text-right nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? (data > 0 ? data + '<small> รอบ</small>' : '-') : data);
					}
				},
				{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						var datareturn	= '<a href="<?php echo site_url('annual/interviewee/'); ?>' + data['registration_id'] + '">' + (data['seat'] > 0 ? (data['student'] > 0 ? data['student'] + '<small> คน</small>' : '-') + ' | ' + data['seat'] + '<small> ที่นั่ง</small>' : '-') + '</a>';
						return (type == 'display' ? datareturn : data['student']);


						return (type == 'display' ? (data['seat'] > 0 ? (data['student'] > 0 ? data['student'] + '<small> คน</small>' : '-') + ' | ' + data['seat'] + '<small> ที่นั่ง</small>' : '-') : data['student']);
					}
				},
				{ data: null, orderable: false, className: 'text-right nowrap', searchable: false,
					render: function(data, type, full) {
						return '<a class="btn btn-link text-danger" title="ลบ" onclick="delete_registration(' + data['registration_id'] + ')"><i class="fas fa-minus-circle"></i></a>';
					}
				},
			],
			rowCallback: function(row, data, index) {
				$(row).find('td:eq(4)').css('background-color', Date.parse(data['registration_start'].replace(' ', 'T')) <= now && Date.parse(data['registration_stop'].replace(' ', 'T')) >= now ? 'aquamarine' : '');
				$(row).find('td:eq(8)').css('background-color', Date.parse(data['interview_start'].replace(' ', 'T')) <= now && Date.parse(data['interview_stop'].replace(' ', 'T')) >= now ? 'aquamarine' : '');
				$(row).find('td:eq(10)').css('color', parseInt(data['student']) >= parseInt(data['seat']) && data['seat'] != 0 ? 'red' : '');
			}
		})
		$('#list').DataTable().on('order.dt search.dt', function() {
			$('#list').DataTable().column(2, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = (i + 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
			})
		}).draw()
		// if(result.length == 0) {
		// 	$('#year').val($('#year').val() - 1)
		// 	$('#list').DataTable().ajax.reload();
		// }
	}
	function delete_registration(registration_id) {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('annual/load_registration_id'); ?>',
			data: {
				registration_id: registration_id
			},
			success: function(result) {
				result	= JSON.parse(result)[0]
				console.log(result)
				if(result['student'] > 0) {
					alert('มีนักศึกษาสมัครแล้ว ไม่ควรลบ')
				} else if(confirm('ต้องการลบรอบ ' + result['registration_title'])) {
					$.ajax({
						method: 'POST',
						url: '<?php echo site_url('annual/delete_registration'); ?>',
						data: {
							registration_id: registration_id
						},
					})
					$('#list').DataTable().ajax.reload();
				}
			}
		})
	}
</script>