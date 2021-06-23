<?php
$seg1	= $this->uri->segment(1);
$seg2	= $this->uri->segment(2);
$seg3	= $this->uri->segment(3);
?>
<!-- Sidebar Navidation Menus-->
<span class="heading mt-3">Main</span>
<ul class="list-unstyled">
	<li <?php echo $seg1 != '' && $seg1 != 'index' ?: 'class="active"'; ?>><a href="<?php echo base_url(); ?>"><i class="icon-home"></i>หน้าแรก</a></li>
	<?php if($this->session->userdata('user_type') == 'Student') { ?>
		<li <?php echo $seg1 != 'scholarship' ?: 'class="active"'; ?>><a href="<?php echo site_url('scholarship'); ?>"><i class="fas fa-graduation-cap"></i>ทุนการศึกษา</a></li>
	<?php } else if($this->session->userdata('user_type') == 'Admin' || $this->session->userdata('user_type') == 'interviewer') { ?>
		<li>
			<a href="#annual" aria-expanded="false" data-toggle="collapse">
				<i class="fas fa-graduation-cap"></i></i>จัดสรรประจำปี<i class="fa fa-angle-down ml-2 opacity-8"></i>
			</a>
			<ul id="annual" class="collapse list-unstyled <?php echo $seg1 != 'annual' ?: 'show'; ?>">
				<?php if($this->session->userdata('user_type') == 'Admin') { ?>
					<li <?php echo $seg1 != 'annual' || $seg2 == 'interview' ?: 'class="active"'; ?>><a href="<?php echo site_url('annual'); ?>">วันสมัคร-รอบสัมภาษณ์</a></li>
				<?php } ?>
				<li <?php echo $seg1 != 'annual' || $seg2 != 'interview' ?: 'class="active"'; ?>><a href="<?php echo site_url('annual/interview'); ?>">สัมภาษณ์</a></li>
			</ul>
		</li>
	<?php } ?>
</ul>
<span class="heading">บริการอื่นๆ</span>
<ul class="list-unstyled">
	<li><a href="#"><i class="far fa-address-book"></i>ติดต่อเรา </a></li>
</ul>
<?php if($this->session->userdata('developer')) { ?>
	<span class="heading">Developer</span>
	<ul class="list-unstyled">
		<li><a href="<?php echo site_url('index/reset_session'); ?>"><i class="fas fa-sync-alt"></i> Reset Session</a></li>
		<li>
			<form method="post" action="<?php echo site_url('index/simulator'); ?>">
				<div class="form-group px-2">
					<div class="input-group">
						<input type="text" class="form-control" name="student_id" placeholder="จำลองรหัสนักศึกษา" minlength="10" maxlength="10" value="<?php echo is_numeric($this->session->userdata('username')) ? $this->session->userdata('username') : ''; ?>">
						<div class="input-group-prepend">
							<button type="submit" class="btn btn-primary"><i class="fas fa-user-secret"></i></button>
						</div>
					</div>
				</div>
			</form>
		</li>
	</ul>
	<?php } ?>