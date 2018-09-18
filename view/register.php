<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
define('page', 'register');
require('header.php');
?>
<div class="container-fluid mt-2">
	<div class="row">
		<div class="col-10 offset-1 col-md-6 offset-md-3">
			<?php require('messages.php'); ?>
			<h3>Registration</h3>
			<form class="form-group mt-3" action="index.php?register" method="post">
				<div class="form-group">
					<label for="name">Full name</label>
					<input id="name" name="name" type="text" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input id="email" name="email" type="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input id="password" name="password" type="password" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password2">Password confirmation</label>
					<input id="password2" name="password2" type="password" class="form-control" required>
				</div>
				<button type="submit" class="btn btn-secondary">Register</button>
			</form>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>