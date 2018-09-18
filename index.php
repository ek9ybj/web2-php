<?php
define('in-app', true);
define('siteurl', '/hallgatok/gajdacsadam/bead2'); // with an ending slash
session_start();
require_once('includes.php');

if(auth()) {
	Database::execute('UPDATE users SET last_activity = :date WHERE id = :id LIMIT 1', [':date' => date('Y-m-d H:i:s'), ':id' => $_SESSION['user']['id']]);
	$_SESSION['user'] = Database::selectOne('SELECT * FROM users WHERE id = :id LIMIT 1', [':id' => $_SESSION['user']['id']]);
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {

	if(get('login') && auth(false)) {
		require('view/login.php');

	} elseif(get('register') && auth(false)) {
		require('view/register.php');

	} elseif(get('list-books') && auth(true)) {
		require('view/list-books.php');

	} elseif(get('logout') && auth(true)) {
		require('controller/logout.php');

	} elseif(get('add-book') && auth(true)) {
		require('view/add-book.php');

	} elseif(get('edit-book') && auth(true)) {
		require('view/edit-book.php');

	} else {
		if(auth()) {
			redirect('index.php?list-books');
		} else {
			require('view/guest.php');
		}
	}

} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

	if(get('login') && auth(false)) {
		require('controller/login.php');

	} elseif(get('register') && auth(false)) {
		require('controller/register.php');

	} elseif(get('add-book') && auth(true)) {
		require('controller/add-book.php');

	} elseif(get('edit-book') && auth(true)) {
		require('controller/edit-book.php');

	} elseif(get('remove-book') && auth(true)) {
		require('controller/remove-book.php');
	}
}
