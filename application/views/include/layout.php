<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PSU Scholarship</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="all,follow">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?php echo site_url('assets/img/favicon.ico'); ?>">
	<?php $this->load->view('include/_meta'); ?>
</head>
<body>
	<div class="page">
		<!-- Main Navbar-->
		<header class="header">
			<?php $this->load->view('include/_header'); ?>
		</header>
		<div class="page-content d-flex align-items-stretch"> 
			<!-- Side Navbar -->
			<nav class="side-navbar">
				<?php $this->load->view('include/_sidebar'); ?>
			</nav>
			<div class="content-inner">
				<!-- Page Title-->
				<?php $this->load->view('include/_title', ['breadcrumb' => isset($breadcrumb) ? $breadcrumb : []]); ?>
				<?php //print_r($this->session->userdata()); ?>
				<?php $this->load->view($content); ?>

				<!-- Page Footer-->
				<footer class="main-footer">
					<?php $this->load->view('include/_footer'); ?>
				</footer>
			</div>
		</div>
	</div>
</body>
</html>