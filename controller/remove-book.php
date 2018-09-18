<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}

$id = !empty($_POST['book']) ? $_POST['book'] : null;
echo $id;

if($id) {
    Database::execute('DELETE FROM books WHERE id = :id AND user = :user LIMIT 1', [':id' => $id, ':user' => $_SESSION['user']['id']]);
    $_SESSION['messages'][] = array('type' => 'secondary', 'message' => 'Book removed!');
    redirect('index.php?list-books');
} else {
    redirect(siteurl);
}