<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}

$author = !empty($_POST['author']) ? trim($_POST['author']) : null;
$title = !empty($_POST['title']) ? trim($_POST['title']) : null;
$pages = !empty($_POST['pages']) ? trim($_POST['pages']) : null;
$category = !empty($_POST['category']) ? trim($_POST['category']) : null;
$genre = !empty($_POST['genre']) ? trim($_POST['genre']) : null;
$isbn = !empty($_POST['isbn']) ? trim($_POST['isbn']) : null;
$read = !empty($_POST['read']) ? true : false;

$errors = array();
if(empty($author)) $errors[] = 'Author is required!';
if(empty($title)) $errors[] = 'Title is required!';
//if(empty($pages)) $errors[] = 'Page number is required!';
//if(empty($category)) $errors[] = 'Category is required!';
//if(empty($genre)) $errors[] = 'Genre is required!';
//if(empty($isbn)) $errors[] = 'ISBN is required!';
if(is_numeric($pages) && $pages < 1) $errors[] = 'Page number must be greater than zero!';
if(!empty($isbn) && (strlen($isbn) != 10 && strlen($isbn) != 13)) $errors[] = 'ISBN must be 10 or 13 characters long!';

if(empty($errors)) {
    Database::execute('INSERT INTO books (user, author, title, pages, category, genre, isbn, has_read, created) VALUES (:user, :author, :title, :pages, :category, :genre, :isbn, :has_read, :created)',
        [':user' => $_SESSION['user']['id'], ':author' => $author, ':title' => $title, ':pages' => $pages, ':category' => $category, ':genre' => $genre, ':isbn' => $isbn, ':has_read' => $read, ':created' => date('Y-m-d H:i:s')]);
    redirect('index.php?list-books');
} else {
    foreach($errors as $error) {
        $_SESSION['messages'][] = array('type' => 'danger', 'message' => $error);
    }
    require('view/add-book.php');
}