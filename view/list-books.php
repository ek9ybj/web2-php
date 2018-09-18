<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
define('page', 'login');
require('header.php');
?>
<div id="book-table" class="container mt-2">
	<?php require('messages.php'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Author</th>
				<th>Title</th>
				<th>Category</th>
				<th>Read</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<nav>
	<ul id="pagination" class="pagination">
	</ul>
	</nav>
</div>
<script src="static/bookshelf.js"></script>
<?php require('footer.php'); ?>