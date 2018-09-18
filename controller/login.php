<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}

$email = isset($_POST['email']) ? strtolower(trim($_POST['email'])) : null;
$password = isset($_POST['password']) ? trim($_POST['password']) : null;

$errors = array();
if(empty($email)) $errors[] = 'Email is required!';
if(empty($password)) $errors[] = 'Password is required!';

$user = Database::selectOne('SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1', [':email' => $email, 'password' => hash('sha512', $password)]);
if(!$user) $errors[] = 'Invalid email or password!';

if(empty($errors)) {
    $_SESSION['user'] = $user;
    redirect(siteurl);
} else {
    foreach($errors as $error) {
        $_SESSION['messages'][] = array('type' => 'danger', 'message' => $error);
    }
    redirect('index.php?login');
}