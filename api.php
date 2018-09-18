<?php
define('in-app', true);
session_start();
require_once('includes.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(get('book-count') && auth()) {
        $count = Database::selectValue('SELECT count(1) FROM books WHERE user = :user', [':user' => $_SESSION['user']['id']]);
        echo $count;
    }

    if(get('book-list') && auth()) {
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $items = 5;
        if(is_numeric($page)) {
            $books = Database::selectAll('SELECT * FROM books WHERE user = :user LIMIT :limit OFFSET :offset', [':user' => $_SESSION['user']['id'], ':limit' => $items, ':offset' => ($page-1)*$items ]);
            echo json_encode($books);
        }
    }

}