<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<link rel="stylesheet" href="static/bookshelf.css">
		<title>Bookshelf</title>
	</head>
	<body class="bg-light">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="<?= siteurl ?>">Bookshelf</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<?php if(auth()): ?>
					<a class="nav-item nav-link <?= page === 'add-book' ? 'active' : '' ?>" href="index.php?add-book">Add book</a>
					<a class="nav-item nav-link" href="index.php?logout">Log out</a>
					<?php else: ?>
					<a class="nav-item nav-link <?= page === 'login' ? 'active' : '' ?>" href="index.php?login">Login</a>
					<a class="nav-item nav-link <?= page === 'register' ? 'active' : '' ?>" href="index.php?register">Register</a>
					<?php endif ?>
				</div>
			</div>
			<?php if(auth()): ?>
			<span class="navbar-text">
				<?= $_SESSION['user']['name'] ?>
			</span>
			<?php endif ?>
		</nav>