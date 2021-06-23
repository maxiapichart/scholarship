<div class="card">
	<div class="card-header" id="sec4Head1">
		<h2 class="mb-0">
			<span id="sec4Id1"><i class="fas fa-times-circle text-danger"></i></span>
			<button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec4Col1" aria-expanded="false" aria-controls="sec4Col1" onclick="toggleCollapseIcon('#sec4Col1', '#sec4Icon1');">
				เหตุผลความจำเป็นที่ขอรับทุน
			</button>
		</h2>
	</div>
	<div id="sec4Col1" class="collapse" aria-labelledby="sec4Head1" data-parent="#section4" style="width: 100%;">
		<form id="explain" class="card-body" action="javascript:void(0);" method="post" onsubmit="return submitFrom(this);">
			<table class="table">
				<tr>
					<td>อธิบายความเป็นอยู่ของครอบครัวที่แสดงให้เห็นความจำเป็นที่ต้องขอรับทุน</td>
				</tr>
				<tr>
					<td><textarea class="form-control" name="explain" style="width: 100%; height: 300px;"></textarea></td>
				</tr>
			</table>
			<button type="submit" class="btn btn-info btn-block">บันทึก</button>
		</form>
	</div>
	<div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec4Col1" aria-expanded="false" aria-controls="sec4Col1" onclick="toggleCollapseIcon('#sec4Col1', '#sec4Icon1');"><i id="sec4Icon1" class="fas fa-chevron-down"></i></div>
</div>
<div class="card">
	<div class="card-header" id="sec4Head2">
		<h2 class="mb-0">
			<span id="sec4Id2"><i class="fas fa-times-circle text-danger"></i></span>
			<button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec4Col2" aria-expanded="false" aria-controls="sec4Col2" onclick="toggleCollapseIcon('#sec4Col2', '#sec4Icon2');">
				ส่งเอกสารเพิ่มเติม (ส่งลิงก์ + รอเจ้าหน้าที่ตรวจเอกสาร)
			</button>
		</h2>
	</div>
	<div id="sec4Col2" class="collapse" aria-labelledby="sec4Head2" data-parent="#section4">
		<form id="certificate" class="card-body" action="javascript:void(0);" method="post" onsubmit="return submitFrom(this);">
			<div class="card-body">
				<ul class="list-group">
					<span>ส่งเอกสารเพิ่มเติมให้เจ้าหน้าที่งานแนะแนว</span>
					<li class="list-group-item text-right"><a href="https://drive.google.com/file/d/105DkcW1lhxZjJ3WkYmoLCe1cn7-LXAyK/view?usp=sharing" target="_blank">คู่มือการส่งเอกสารออนไลน์ผ่าน Google Drive</a></li>
					<li class="list-group-item text-right"><a href="<?php echo site_url('scholarship/downloadfile'); ?>">ดาวน์โหลดเอกสารเพิ่มเติม</a></li>
					<input id="googledrive" type="text" class="form-control mb-1" name="googledrive" placeholder="ลิงก์เอกสารออนไลน์ผ่าน Google Drive" required/>
					<div style="color: red;">เมื่อกดบันทึกเรียบร้อยแล้ว ข้อมูลจะถูกบันทึกเรียบร้อย ให้รอเจ้าหน้าตรวจเอกสาร แล้วจึงกลับมาส่งใบสมัครอีกครั้งตามกำหนดการในประกาศ</div>
					<button type="submit" class="btn btn-info btn-block">บันทึก</button>
					<?php foreach ($certificate as $ar) { ?>
						<li class="list-group-item">
							<span id="<?php echo "certificate{$ar['selectdata_id']}"; ?>"><i class="fas fa-times-circle text-danger"></i></span>
							<?php echo "{$ar['selectdata_id']}. {$ar['selectdata_title']}"; ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		</form>
	</div>
	<div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec4Col2" aria-expanded="false" aria-controls="sec4Col2" onclick="toggleCollapseIcon('#sec4Col2', '#sec4Icon2');"><i id="sec4Icon2" class="fas fa-chevron-down"></i></div>
</div>
<!-- <div class="card">
	<div class="card-header" id="sec4Head2">
		<h2 class="mb-0">
			<span id="sec4Id2"><i class="fas fa-minus-circle text-warning"></i></span>
			<button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec4Col2" aria-expanded="false" aria-controls="sec4Col2" onclick="toggleCollapseIcon('#sec4Col2', '#sec4Icon2');">
				หนังสือแสดงความคิดเหตุของอาจารย์ที่ปรึกษา
			</button>
		</h2>
	</div>
	<div id="sec4Col2" class="collapse" aria-labelledby="sec4Head2" data-parent="#section4">
		<div class="card-body">
			หนังสือแสดงความคิดเหตุของอาจารย์ที่ปรึกษา
		</div>
	</div>
	<div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec4Col2" aria-expanded="false" aria-controls="sec4Col2" onclick="toggleCollapseIcon('#sec4Col2', '#sec4Icon2');"><i id="sec4Icon2" class="fas fa-chevron-down"></i></div>
</div>
<div class="card">
	<div class="card-header" id="sec4Head3">
		<h2 class="mb-0">
			<span id="sec4Id3"><i class="fas fa-minus-circle text-warning"></i></span>
			<button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec4Col3" aria-expanded="false" aria-controls="sec4Col3" onclick="toggleCollapseIcon('#sec4Col3', '#sec4Icon3');">
				หนังสือรับรองรายได้ครอบครัว
			</button>
		</h2>
	</div>
	<div id="sec4Col3" class="collapse" aria-labelledby="sec4Head3" data-parent="#section4">
		<div class="card-body">
			หนังสือรับรองรายได้ครอบครัว
		</div>
	</div>
	<div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec4Col3" aria-expanded="false" aria-controls="sec4Col3" onclick="toggleCollapseIcon('#sec4Col3', '#sec4Icon3');"><i id="sec4Icon3" class="fas fa-chevron-down"></i></div>
</div> -->
<script type="text/javascript">
	explain()
	function explain() {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('scholarship/get_explain'); ?>',
			data: {registration_id: <?php echo $registration['registration_id']; ?>},
			success: function(result) {
				result	= JSON.parse(result)
				console.log(result)
				if(result) {
					$('#explain [name="explain"]').val(result[0]['explain']);
					$(function() {
						$('#sec4Id1').html(statusCard[1])
						checkall['explain'] = true;
					});
				}
			}
		})
	}
	certificate()
	function certificate() {
		$.ajax({
			method: 'POST',
			url: '<?php echo site_url('scholarship/get_certificate'); ?>',
			data: {registration_id: <?php echo $registration['registration_id']; ?>},
			success: function(result) {
				result	= JSON.parse(result)
				console.log(result)
				var check = false;
				if(result[0].length > 0) {
					check = true;
					$.each(result[0], function(i, ar) {
						$('#certificate' + ar['certificate_id']).html(statusCard[ar['status'] != 2 ? (ar['status'] == 0 ? 0 : 1) : 2])
						check = check && ar['status'] != 0 ? true : false
					})
				}
				if(result[1].length > 0) {
					$('#googledrive').val(result[1][0]['googledrive'])
				}
				$(function() {
					if(check) {
						$('#sec4Id2').html(statusCard[1])
						checkall['certificate'] = true;
					}
				});
			}
		})
	}
</script>