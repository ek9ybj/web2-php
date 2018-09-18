<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}

unset($_SESSION['user']);
$_SESSION['messages'][] = array('type' => 'secondary', 'message' => 'You\'ve been logged out!');
redirect('index.php?login');