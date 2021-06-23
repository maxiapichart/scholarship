<script src="<?php echo site_url('assets/vendor/ckeditor-4.16.1-full/ckeditor.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendor/extension/extension.js'); ?>"></script>
<div class="container-fluid py-2">
	<div class="row bg-white has-shadow">
		<div class="col-12">
			<h1 class="border-bottom shadow-sm p-2 text-center text-md-left"><i class="fas fa-edit"></i> แก้ไขข่าว</h1>
			<form method="post" action="<?php site_url('index/news'); ?>">
				<textarea class="form-control" id="news" name="news"><?php echo file_get_contents('assets/files/news.html'); ?></textarea>
				<button type="submit" class="mt-1 btn btn-warning btn-block btn-lg">แก้ไขข่าว</button>
			</form>
		</div>
		<div class="container py-3 mt-3 border-top">
			<h2 class="border-bottom shadow-sm p-2 text-center text-md-left"><i class="fas fa-cloud-upload-alt"></i> อัพโหลดไฟล์</h2>
			<div class="table-responsive">
				<table class="table table-nowrap table-sm table-hover">
					<thead>
						<tr>
							<td colspan="3">
								<input type="file" class="d-none" id="file" name="uploadFile" onchange="uploadFile();">
								<label class="btn btn-outline-info" for="file"><i class="fas fa-plus"></i> <i class="far fa-file-image"></i></label>
							</td>
							<td colspan="2" align="center">
								<b>รายการไฟล์ที่อัพโหลด</b>
								<span class="badge badge-secondary" id="fileNum"></span>
								<small class="float-right text-muted">(ระบบลบไฟล์อายุเกิน <span id="date-expire"></span> วัน โดยอัตโนมัติ)</small>
							</td>
						</tr>
					</thead>
					<tbody id="loadFile" class="text-primary"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	CKEDITOR.replace('news');

	let num = 5;
	let all = 0;
	let listFile = [];

	$(() => {
		loadFile();
	})

	loadFile = () => {
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('index/loadFile'); ?>",
		}).done((re) => {
			console.log(re)
			re = JSON.parse(re)
			listFile = re[0]
			// console.log(listFile)
			randerFile();

			now = new Date()
			expire = new Date(re[1]*1000)
			diff = now - expire
			diff = diff / (1000 * 3600 * 24)
			$('#date-expire').html(~~diff)
		});
	}

	randerFile = () => {
		all	= listFile.length;
		let text	= '';
		$.each(listFile, (i) => {
			if(i < num) {
				text	+= `<tr>
				<td width="1" class="text-secondary">${i + 1}</td>
				<td width="1"><button onclick="deleteFile('${listFile[i]}', '${i}')" class="btn btn-link text-danger" title="ลบไฟล์"><i class="fas fa-trash-alt"></i></button></td>
				<td width="1"><button id="btnCopy${i}" onclick="copyLink(${i})" class="btnCopy btn btn-outline-info btn-sm"">คัดลอกลิงก์</button></td>
				<td width="1">${img(listFile[i])}</td>
				<td><a id="${i}" href="<?php echo site_url('assets/files/upload/'); ?>${listFile[i]}" target="_blank">${listFile[i]}</a></td>
				</tr>`;
			}
		})
		text += text != '' && num < all ? '<tr><td colspan="5"><button class="btn btn-sm btn-block text-primary border" onclick="plusNum();">...more...</button></td></tr>' : '';
		$('#fileNum').html(all.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + ' ไฟล์')
		$('#loadFile').html(text != '' ? text : '<tr><td align="center" colspan="4">-ไม่มีข้อมูล-</td></tr>')
	}

	copyLink = (id) => {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val('<?php echo site_url('assets/files/upload/'); ?>' + $('#' + id).html()).select();
		document.execCommand("copy");
		$temp.remove();

		$('.btnCopy').removeClass('btn-info');
		$('.btnCopy').addClass('btn-outline-info');
		$('.btnCopy').html('คัดลอกลิงก์');

		$('#btnCopy' + id).removeClass('btn-outline-info');
		$('#btnCopy' + id).addClass('btn-info');
		$('#btnCopy' + id).html('คัดลอกลิงก์แล้ว');
	}

	uploadFile = () => {
		var fd = new FormData();
		var files = $('#file')[0].files[0];
		fd.append('file',files);
		// console.log(fd)
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('index/uploadFile'); ?>",
			data: fd,
			contentType: false,
			processData: false,
		}).done((re) => {
			console.log(re)
			if(re == 1) {
				alert('อัพโหลดไฟล์เรียบร้อยแล้ว');
				loadFile();
			} else {
				alert(`อัพโหลดไฟล์ไม่สำเร็จ!!\n${re}`);
			}
			$('#file').val('')
		})
	}

	plusNum = () => {
		num += 5;
		randerFile();
	}

	deleteFile = (name, i) => {
		if(confirm(`ต้องการลบไฟล์ ${name} นี้หรือไม่?`)) {
			$.ajax({
				method: "POST",
				url: "<?php echo site_url('index/deleteFile'); ?>",
				data: {
					name: name
				}
			}).done((re) => {
			// console.log(re)
			if(re == 1) {
				listFile.splice(i, 1);
				num	-= num == 5 ? 0 : 1;
				randerFile();
			} else {
				alert('ลบไม่สำเร็จ');
			}
		})
		}
	}
</script>