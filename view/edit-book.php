<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
if(!defined('editing')) {
    $book = !empty($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : null;
    if($book) {
        $book = Database::selectOne('SELECT * FROM books WHERE id = :id AND user = :user LIMIT 1', [':id' => $book, ':user' => $_SESSION['user']['id']]);
        if(!$book) {
            redirect(siteurl);
        }
    } else {
        redirect(siteurl);
    }
}

define('page', 'edit-book');
require('header.php');
?>
<div class="container-fluid mt-2">
	<div class="row">
		<div class="col-10 offset-1 col-md-6 offset-md-3">
            <?php require('messages.php'); ?>
			<h3>Edit book</h3>
			<form class="form-group mt-3" action="index.php?edit-book" method="post">
				<div class="form-group">
					<label for="author">Author</label>
					<input id="author" name="author" type="text" class="form-control" value="<?= $book['author'] ?>" required>
				</div>
                <div class="form-group">
					<label for="title">Title</label>
					<input id="title" name="title" type="text" class="form-control" value="<?= $book['title'] ?>" required>
				</div>
                <div class="form-group">
					<label for="pages">Pages</label>
					<input id="pages" name="pages" type="number" class="form-control" value="<?= $book['pages'] ?>">
				</div>
                <div class="form-group">
					<label for="category">Category</label><br>
                    <input list="categories" id="category" name="category" value="<?= $book['category'] ?>" />
                    <datalist id="categories">
                        <option value="Children’s fiction">
                        <option value="Fantasy">
                        <option value="Mystery">
                        <option value="Classic literary fiction">
                        <option value="Modern literary fiction">
                        <option value="Magic realism">
                        <option value="Historical fiction">
                        <option value="Young adult fiction">
                    </datalist>
				</div>
                <div class="form-group">
					<label for="genre">Genre</label><br>
                    <input list="genres" id="genre" name="genre" value="<?= $book['genre'] ?>" />
                    <datalist id="genres">
                        <option value="Science fiction">
                        <option value="Satire">
                        <option value="Drama">
                        <option value="Action and Adventure">
                        <option value="Romance">
                        <option value="Mystery">
                        <option value="Horror">
                        <option value="Self help">
                        <option value="Health">
                        <option value="Guide">
                        <option value="Travel">
                        <option value="Children's">
                        <option value="Religion, Spirituality &amp; New Age">
                        <option value="Science">
                        <option value="History">
                        <option value="Math">
                        <option value="Anthology">
                        <option value="Poetry">
                        <option value="Encyclopedias">
                        <option value="Dictionaries">
                        <option value="Comics">
                        <option value="Art">
                        <option value="Cookbooks">
                        <option value="Diaries">
                        <option value="Journals">
                        <option value="Prayer books">
                        <option value="Series">
                        <option value="Trilogy">
                        <option value="Biographies">
                        <option value="Autobiographies">
                        <option value="Fantasy">
                    </datalist>
				</div>
                <div class="form-group">
					<label for="isbn">ISBN</label>
					<input id="isbn" name="isbn" type="text" class="form-control" value="<?= $book['isbn'] ?>">
				</div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="read"> 
                        <input class="form-check-input" id="read" name="read" type="checkbox" <?= $book['has_read'] > 0 ? 'checked' : '' ?> style="zoom: 1.3;"> Read
                        </label>
                    </div>
                </div>
                <input id="book" name="book" type="hidden" value="<?= $book['id'] ?>" />
				<button type="submit" class="btn btn-secondary">Update</button>
			</form>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>