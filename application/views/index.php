<?php //print_r($this->session->userdata()); ?>
<!-- Dashboard Counts Section-->
<style type="text/css">
#news {
	font-family: initial !important;
	font-size: initial !important;
	font-weight: lighter !important;
	min-height: 100vh;
}
</style>
<section class="dashboard-counts pt-3">
	<div class="container-fluid">
		<div class="row bg-white has-shadow">
			<!-- Item -->
			<div class="col-12">
				<h1 class="border-bottom shadow-sm p-2 text-center text-md-left"><i class="fas fa-newspaper"></i> ข่าวประชาสัมพันธ์</h1>
				<?php $m		= ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
				$filemtime	= filemtime('assets/files/news.html');
				$time	= date('j', $filemtime).' ';
				$time	.= $m[(date('n', $filemtime) - 1)].' ';
				$time	.= (date('y', $filemtime) + 43).' ';
				$time	.= date('G:i:s', $filemtime); ?>
				<span class="float-right" title="<?php echo $time; ?>">
					<small class="text-muted pr-2"><i class="far fa-clock"></i> <?php echo time_ago_in_php($filemtime); ?></small>
					<?php if($this->session->userdata('logged_in') && $this->session->userdata('user_type') == 'Admin') { ?>
						<a href="<?php echo site_url('index/news'); ?>" class="text-info" title="แก้ไขข่าวประชาสัมพันธ์"><i class="fas fa-edit"></i> แก้ไขข่าว</a>
					<?php } ?>
				</span>
				<div class="mt-5 overflow-auto shadow-sm p-3" id="news">
					<?php echo file_get_contents('assets/files/news.html'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	console.log(+new Date());
	console.log(+new Date('2021-06-13T12:00:00'))
</script>
<?php function time_ago_in_php($timestamp, $lang = 'th') {
	$time_ago					= $timestamp;
	$current_time			= time();
	$time_difference	= $current_time - $time_ago;
	$seconds					= $time_difference;

	$minutes = round($seconds / 60); //60s;
	$hours   = round($seconds / 3600); //60m * 60s;
	$days    = round($seconds / 86400); //24h * 60m * 60s;
	$weeks   = round($seconds / 604800); // 7d * 24h * 60m * 60s;
	$months  = round($seconds / 2629440); //(((365d + 365d + 365d + 365d + 366d) / 5y) / 12month) * 24h * 60m * 60s;
	$years   = round($seconds / 31553280); //((365d + 365d + 365d + 365d + 366d) / 5y) * 24h * 60m * 60s;

	if($lang == 'th') {

		if ($seconds <= 60)				{	return	"ล่าสุด";																					}
		else if	($minutes	<= 60)	{	return	($minutes	== 1	?: "{$minutes} "	).'นาทีที่แล้ว';		}
		else if	($hours		<= 24)	{	return 	($hours		== 1	?: "{$hours} "		).'ชั่วโมงที่แล้ว';	}
		else if	($days		<= 7)		{	return	($days		== 1	?: "{$days} "			).'วันที่แล้ว';		}
		else if	($weeks		<= 4.3)	{	return	($weeks		== 1	?: "{$weeks} "		).'สัปดาห์ที่แล้ว';	}
		else if	($months	<= 12)	{	return	($months 	== 1	?: "{$months} "		).'เดือนที่แล้ว';	}
		else											{	return	($years		== 1	?: "{$years} "		).'ปีที่แล้ว';			}

	} else if($lang == 'en') {

		if ($seconds <= 60){
			return "Just Now";
		} else if ($minutes <= 60){
			if ($minutes == 1){
				return "one minute ago";
			} else {
				return "{$minutes} minutes ago";
			}
		} else if ($hours <= 24){
			if ($hours == 1){
				return "an hour ago";
			} else {
				return "{$hours} hrs ago";
			}
		} else if ($days <= 7){
			if ($days == 1){
				return "yesterday";
			} else {
				return "{$days} days ago";
			}
		} else if ($weeks <= 4.3){
			if ($weeks == 1){
				return "a week ago";
			} else {
				return "{$weeks} weeks ago";
			}
		} else if ($months <= 12){
			if ($months == 1){
				return "a month ago";
			} else {
				return "{$months} months ago";
			}
		} else {
			if ($years == 1){
				return "one year ago";
			} else {
				return "{$years} years ago";
			}
		}

	}
} ?>