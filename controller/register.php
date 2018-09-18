<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}

$name = isset($_POST['name']) ? ucwords(strtolower(trim($_POST['name']))) : null;
$email = isset($_POST['email']) ? strtolower(trim($_POST['email'])) : null;
$password = isset($_POST['password']) ? trim($_POST['password']) : null;
$password2 = isset($_POST['password2']) ? trim($_POST['password2']) : null;

$errors = array();
if(empty($name)) $errors[] = 'Name is required!';
if(empty($email)) $errors[] = 'Email is required!';
if(empty($email)) $errors[] = 'Email is required!';
if(empty($password)) $errors[] = 'Password is required!';
if(empty($password2)) $errors[] = 'Password verification is required!';
if(strlen($password) < 6) $errors[] = 'Password must be at least 6 characters long!';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email address!'; 
if($password !== $password2) $errors[] = 'Passwords do not match!';

$user = Database::selectOne('SELECT * FROM users WHERE email = :email LIMIT 1', [':email' => $email]);
if($user) $errors[] = 'Email address is not available!';

if(empty($errors)) {
    Database::execute('INSERT INTO users (name, email, password, created, last_activity) VALUES (:name, :email, :password, :created, :last)', [':name' => $name, ':email' => $email, ':password' => hash('sha512', $password), ':created' => date('Y-m-d H:i:s'), ':last' => date('Y-m-d H:i:s')]);
    $_SESSION['messages'][] = array('type' => 'success', 'message' => 'Successful registration!');
    redirect('index.php?login');
} else {
    foreach($errors as $error) {
        $_SESSION['messages'][] = array('type' => 'danger', 'message' => $error);
    }
    redirect('index.php?register');
}