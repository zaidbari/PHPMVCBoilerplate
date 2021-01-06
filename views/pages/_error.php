<?php /** @var $exception \Exception */ ?>

<div class="text-center my-5">
	<h1><?= $exception->getCode(); ?></h1>
	<p class="lead"><?= $exception->getMessage(); ?></p>
</div>
