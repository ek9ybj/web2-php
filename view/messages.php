<?php
if(!defined('in-app')) {
	http_response_code(404);
	die();
}
?>
<?php if(isset($_SESSION['messages'])): foreach($_SESSION['messages'] as $message): ?>
	<div class="alert alert-<?= $message['type'] ?>" role="alert"><?= $message['message'] ?></div>
	<?php endforeach ?>
<?php endif ?>
<?php unset($_SESSION['messages']); ?>