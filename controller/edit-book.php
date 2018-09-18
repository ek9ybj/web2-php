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
$id = !empty($_POST['book']) ? $_POST['book'] : null;

if(!$id) {
    redirect(siteurl);
}

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
    Database::execute('UPDATE books SET author = :author, title = :title, pages = :pages, category = :category, genre = :genre, isbn = :isbn, has_read = :has_read WHERE id = :id AND user = :user LIMIT 1',
        [':author' => $author, ':title' => $title, ':pages' => $pages, ':category' => $category, ':genre' => $genre, ':isbn' => $isbn, ':has_read' => $read, ':id' => $id, ':user' => $_SESSION['user']['id']]);
    $_SESSION['messages'][] = array('type' => 'secondary', 'message' => 'Book updated!');
    redirect('index.php?list-books');
} else {
    foreach($errors as $error) {
        $_SESSION['messages'][] = array('type' => 'danger', 'message' => $error);
    }
    $book = ['author' => $author, 'title' => $title, 'pages' => $pages, 'category' => $category, 'genre' => $genre, 'isbn' => $isbn, 'has_read' => $read, 'id' => $id];
    define('editing', true);
    require('view/edit-book.php');
}