<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
define('page', 'add-book');
require('header.php');
?>
<div class="container-fluid mt-2">
	<div class="row">
		<div class="col-10 offset-1 col-md-6 offset-md-3">
            <?php require('messages.php'); ?>
			<h3>Add book</h3>
			<form class="form-group mt-3" action="index.php?add-book" method="post">
				<div class="form-group">
					<label for="author">Author</label>
					<input id="author" name="author" type="text" class="form-control" value="<?= isset($author) ? $author : '' ?>" required>
				</div>
                <div class="form-group">
					<label for="title">Title</label>
					<input id="title" name="title" type="text" class="form-control" value="<?= isset($title) ? $title : '' ?>" required>
				</div>
                <div class="form-group">
					<label for="pages">Pages</label>
					<input id="pages" name="pages" type="number" class="form-control" value="<?= isset($pages) ? $pages : '' ?>">
				</div>
                <div class="form-group">
					<label for="category">Category</label><br>
                    <input list="categories" id="category" name="category" value="<?= isset($category) ? $category : '' ?>" />
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
                    <input list="genres" id="genre" name="genre" value="<?= isset($genre) ? $genre : '' ?>" />
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
					<input id="isbn" name="isbn" type="text" class="form-control" value="<?= isset($isbn) ? $isbn : '' ?>">
				</div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label" for="read"> 
                        <input class="form-check-input" id="read" name="read" type="checkbox" <?= isset($read) && $read ? 'checked' : '' ?> style="zoom: 1.3;"> Read
                        </label>
                    </div>
                </div>
				<button type="submit" class="btn btn-secondary">Add</button>
			</form>
		</div>
	</div>
</div>
<?php require('footer.php'); ?>