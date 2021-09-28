<div class="container-fluid">
	<section class="pt-5">
		<div class="row mb-4">
			<div class="col mb-4">
				<div class="card">
					<div class="card-header text-center">
						<h2 class="mb-0">วันสมัคร-รอบสัมภาษณ์</h2>
					</div>
					<div class="card-body">
						<div class="table-responsive pt-2">
							<table id="list" class="table table-striped table-bordered">
								<thead>
									<tr>
										<td></td>
										<td>รหัส</td>
										<td>ชื่อ</td>
										<td>คณะ</td>
										<td>GPA</td>
										<td>จังหวัด</td>
										<td>เวลาสัมภาษณ์</td>
										<td>จำนวนผู้สัมภาษณ์</td>
										<td>คะแนน</td>
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
<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="commentLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<strong>ผลการสัมภาษณ์</strong>
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<td><b>Username</b></td>
								<td><b>ผู้สัมภาษณ์</b></td>
								<td><b>คะแนน</b></td>
								<td><b>ความคิดเห็น</b></td>
							</tr>
						</thead>
						<tbody id="commentList"></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var month	= ['ม.ค.','ก.พ','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']
	$(function() {
		list()
	})
	function date_between(date1, date2) {
		date1	= new Date(date1.replace(' ', 'T'))
		date2	= new Date(date2.replace(' ', 'T'))
		return date1.getDate() + ' ' + month[date1.getMonth()] + ' ' + (parseInt(date1.getFullYear()) + 543 - 2500) + ' | ' + date1.getHours() + ':' + (date1.getMinutes() < 10 ? '0' : '') + date1.getMinutes() + ' - ' + date2.getHours() + ':' + (date2.getMinutes() < 10 ? '0' : '') + date2.getMinutes();
	}
	function list() {
		$('#list').DataTable({
			language: { url : '<?php echo site_url('index/datatableTH'); ?>' },
			processing: true,
			ajax: {
				type: "POST",
				url: '<?php echo site_url('annual/list_interviewee'); ?>',
				data: (d) => {
					d.registration_id	= '<?php echo $registration_id; ?>';
				},
				dataSrc: ''
			},
			autoWidth: false,
			paging: false,
			order: [[6, 'desc']],
			columns: [
				{ data: null, searchable: false, orderable: false, className: 'text-right nowrap'},
				{ data: 'student_id', className: 'nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? '<a href="<?php echo site_url('annual/register/'.$registration_id.'/'); ?>' + data + '">' + data + '</a>' : data);
					}
				},
				{ data: 'student_name', className: 'nowrap'},
				{ data: 'fac_name', className: 'nowrap'},
				{ data: 'gpa', className: 'text-right nowrap'},
				{ data: 'province_name', className: 'nowrap'},
				{ data: null, className: 'text-center nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? (!!data['interview_name'] ? `(<small>${data['interview_name']})</small><br/>` : '') + date_between(data['start'], data['stop']) : data['start']);
					}
				},
				{ data: 'num', className: 'text-right nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? (data > 0 ? data + ' คน' : '-') : data);
					}
				},
				{ data: null, className: 'text-right nowrap',
					render: function(data, type, full) {
						return (type == 'display' ? '<button class="btn btn-link text-info btn-sm" onclick="commentModal(\'' + data['interview'] + '\', \'' + data['student_id'] + '\');">' + (data['num'] > 0 ? (data['total'] / data['num']).toFixed(2) + ' คะแนน' : '-' ) + '</button>' : data['num'] > 0 ? (data['total'] / data['num']).toFixed(2) : 0);
					}
				}
			]
		})
		$('#list').DataTable().on('order.dt search.dt', function() {
			$('#list').DataTable().column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
				cell.innerHTML = (i + 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
			})
		}).draw()
	}
	function commentModal(interview_id, student_id) {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('annual/load_interviewee_id'); ?>',
			data: {
				interview_id: interview_id,
				student_id: student_id,
			},
			success: function(result) {
				result	= JSON.parse(result)
				console.log(result)
				$('#commentLabel').html(student_id)
				text = '';
				$.each(result, function(i, ar) {
					text	+= '<tr>';
						text	+= '<td style="white-space: nowrap;">' + ar['username'] + '</td>';
						text	+= '<td style="white-space: nowrap;">' + ar['admin_name'] + '</td>';
						text	+= '<td align="center" style="white-space: nowrap;">' + (ar['point'] != null ? ar['point'] : '-') + '</td>';
						text	+= '<td>' + (ar['comment'] != null ? ar['comment'] : '-') + '</td>';
					text	+= '</tr>';
				})
				$('#commentList').html(text)
				$('#commentModal').modal('show')
			}
		})
	}
</script>