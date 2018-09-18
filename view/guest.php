<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
$totalUsers = Database::selectValue('SELECT count(1) FROM users');
$totalBooks = Database::selectValue('SELECT count(1) FROM books');

require('header.php');
?>
<div class="container mt-2">
	<h2>Welcome!</h2>
	<h6>Total users: <?= $totalUsers ?></h6>
	<h6>Total books: <?= $totalBooks ?></h6>
</div>
<?php require('footer.php'); ?>