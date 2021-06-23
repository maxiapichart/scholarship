<?php $m	= ['ม.ค.','ก.พ','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']; ?>
<section class="updates">
	<div class="container-fluid">
		<div class="row justify-content-md-center">
			<!-- Recent Activities -->
			<div class="col-lg-8">
				<div class="recent-activities card">
					<div class="card-header">
						<h3 class="h4">เลือกวันสัมภาษณ์</h3>
					</div>
					<form class="card-body" action="<?php echo site_url("scholarship/bookingInterview/{$registration['registration_id']}/"); ?>" method="POST">
						<?php if(count($interview) > 0) {
							$col	= 0;
							$day	= '';
							foreach ($interview as $ar) {
								$start	= strtotime($ar['start']);
								$stop		= strtotime($ar['stop']);
								$col++;
								if($col == 1) {
									echo $day != '' ? '<div class="item"><div class="row">' : '';
								}
								if($day != date('Y-m-d', $start)) {
									$col = 1;
									echo $day != '' ? '</div></div>' : '';
									echo '<div class="item"><div class="row">';
									$day	= date('Y-m-d', $start); ?>
									<div class="col-12 pt-5 content">
										<h3><i class="far fa-calendar-alt"></i> <?php echo date('j ', $start).$m[date('n', $start) - 1].' '.(date('Y', $start) + 543 - 2500); ?></h3>
									</div>
								<?php } ?>
								<div class="col-4 date-holder text-right">
									<div class="icon"><i class="icon-clock"></i></div>
									<div class="pt-2 px-1"> <u><?php echo date('G:i', $start).' - '.date('G:i', $stop); ?></u></div>
										<?php if($ar['student'] < $ar['seat']) { ?>
											<small class="text-success"><?php echo "{$ar['student']}/{$ar['seat']}"; ?></small>
											<button type="submit" class="btn btn-block btn-sm btn-primary" name="id" value="<?php echo $ar['interview_id']; ?>" onclick="return confirm('<?php echo 'ต้องการจองรอบสัมภาษณ์ '.date('j ', $start).$m[date("n", $start) - 1].' '.(date('Y', $start) + 543 - 2500).' เวลา '.date('G:i', $start).' - '.date('G:i', $stop); ?>');">จอง</button>
										<?php } else { ?>
												<span class="text-danger"><?php echo "{$ar['student']}/{$ar['seat']} เต็ม!"; ?></span>
										<?php } ?>
								</div>
								<?php if($col == 3) {
									$col = 0;
									echo '</div></div>';
								}
							} ?>
						<?php } else { ?>
							<div class="col-12 content">
								<h5>- ยังไม่มีรอบสอบสัมภาษณ์ให้เลือก -</h5>
							</div>
						<?php } ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>