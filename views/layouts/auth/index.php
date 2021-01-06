<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<title>AUTH</title>
</head>
<body>
<?php include_once 'navbar.php'; ?>
<?php if(\app\core\App::$app->session->getFlash('success')): ?>
    <div class="alert alert-primary" role="alert"><?= \app\core\App::$app->session->getFlash('success'); ?></div>
<?php endif; ?>
<main>

	{{content}}
</main>
<?php include_once 'footer.php'; ?>

</body>
</html>