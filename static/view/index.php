<?php include 'inc/header.php'; ?>

<h1><?= _("Paste your url here"); ?></h1>

<article>
	<form action="" method="POST">
		<input type="hidden" name="csrf" value="<?= $_SESSION['csrf_token'] ?>">
		<input type="text" name="link" placeholder="Link">
		<button type="submit"><?= _("Send"); ?></button>
	</form>

	<a href="<?= $data->link ?>" target="_blank"><?= $data->link ?></a>

</article>

<?php include 'inc/footer.php'; ?>
