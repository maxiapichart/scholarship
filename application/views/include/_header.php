<nav class="navbar">
	<!-- Search Box-->
	<div class="search-box">
		<button class="dismiss">
			<i class="icon-close"></i>
		</button>
		<form id="searchForm" action="#" role="search">
			<input type="search" placeholder="What are you looking for..." class="form-control">
		</form>
	</div>
	<div class="container-fluid">
		<div class="navbar-holder d-flex align-items-center justify-content-between">
			<!-- Navbar Header-->
			<div class="navbar-header">
				<!-- Toggle Button-->
				<a id="toggle-btn" href="#" class="menu-btn active">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</div>
			<!-- Navbar Brand -->
			<a href="<?php echo base_url(); ?>" class="navbar-brand">
				<div class="brand-text">
					<strong>PSU</strong>
					<span>Scholarship</span>
				</div>
			</a>
			<!-- Navbar Menu -->
			<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
				<?php if($this->session->userdata('logged_in')) { ?>
					<li class="nav-item dropdown">
						<a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
							<?php echo $this->session->userdata('username'); ?>
							<i class="fa fa-angle-down ml-2 opacity-8"></i>
						</a>
						<ul aria-labelledby="profile" class="dropdown-menu text-center px-1 py-3">
							<?php if($this->session->userdata('user_type') == 'Student') { ?>
								<li>
									<img src="<?php echo 'https://regist.psu.ac.th/Stud_Pics/'.substr($this->session->userdata('username'), 0, 2).'/'.$this->session->userdata('username').'.jpg'; ?>" alt="Profile Picture" class="img-fluid rounded-circle shadow" width="150">
								</li>
							<?php } ?>
							<div class="title px-4 py-3">
								<strong class="d-block"><?php echo $this->session->userdata('name'); ?></strong>
								<small class=""><?php echo $this->session->userdata('username'); ?></small>
							</div>
							<div class="dropdown-divider"></div>
							<div class="px-4">
								<a href="<?php echo site_url('index/logout'); ?>" onclick="return confirm('Are you sure to logout.')" class="dropdown-item">Log out</a>
							</div>
						</ul>
					</li>
				<?php } else {
					$this->load->view('include/_login');
				} ?>
			</ul>
		</div>
	</div>
</nav>