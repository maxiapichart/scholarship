<!-- Page Header-->
<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom"><?php echo $title; ?></h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="breadcrumb-holder container-fluid">
	<ul class="breadcrumb">
		<?php foreach ($breadcrumb as $key => $value) { ?>
				<li class="breadcrumb-item"><a href="<?php echo site_url($value); ?>"><?php echo $key; ?></a></li>
		<?php } ?>
		<li class="breadcrumb-item active"><?php echo $title; ?></li>
	</ul>
</div>