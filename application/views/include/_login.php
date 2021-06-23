<!-- Login dropdown -->
<li class="nav-item dropdown">
	<a id="login" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
		<span class="d-inline-block">Log in</span>
		<i class="fa fa-angle-down ml-2 opacity-8"></i>
	</a>
	<ul aria-labelledby="loginLabel" class="dropdown-menu">
		<form class="px-4 py-3" action="javascript:void(0);" onsubmit="submit_login()">
			<div class="text-center mb-3">
				<img src="<?php echo site_url('assets/img/psupassport.png'); ?>" alt="passport-logo" width="150">
			</div>
			<small class="form-text text-muted">Username</small>
			<div class="form-group input-group" title="Username">
				<input type="text" class="form-control border-0 shadow" id="username" placeholder="Username" onkeyup="is_valid('username')" autocomplete="off" autofocus autocapitalize="none">
				<div class="input-group-prepend">
					<button class="btn btn-info" type="button" tabindex="-1">
						<i class="fas fa-user fa-1x"></i>
					</button>
				</div>
			</div>
			<small class="form-text text-muted">Password</small>
			<div class="form-group input-group" title="Password">
				<input type="password" class="form-control border-0 shadow" id="password" placeholder="Password" onkeyup="is_valid('password')" autocomplete="off">
				<div class="input-group-prepend">
					<button class="btn btn-info" type="button" tabindex="-1">
						<i class="fas fa-lock fa-1x"></i>
					</button>
				</div>
			</div>
			<div class="dropdown-divider"></div>
			<button type="submit" class="btn btn-block btn-primary shadow px-5">Log in</button>
		</form>
	</ul>
</li>

<script type="text/javascript">
	function is_valid(id) {
		$('#' + id).val() != '' ? $('#' + id).removeClass('is-invalid') : $('#' + id).addClass('is-invalid')
	}
	function submit_login() {
		var username	= $('#username').val();
		var password	= $('#password').val();

		if(username != '' && password != '') {
			$.ajax({
				method: "POST",
				url: "<?php echo site_url('index/login/'); ?>",
				data: {
					username: username,
					password: password
				},
				success: function(result) {
					console.log(result)
					if(result != 1 && result != 2) {
						alert('Wrong Username or Password.');
					} else if(result == 1) {
						alert('This Username is NOT Allowed to Log in.');
					} else if(result == 2) {
						// alert('Log in Successfully.');
						<?php if($this->input->get('url') != '') { ?>
							window.location.replace('<?php echo $this->input->get('url'); ?>');
						<?php } else { ?>
							location.reload();
						<?php } ?>
					}
				}
			})
		} else {
			username == '' ? $('#username').addClass('is-invalid') : '';
			password == '' ? $('#password').addClass('is-invalid') : '';
		}
	}
</script>