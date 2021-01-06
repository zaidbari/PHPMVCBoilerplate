<?php /** @var  $model app\models\LoginForm; */ $form = \app\core\form\Form::begin('', "post"); ?>
<div class="container">
    <h3 class="text-primary mb-3">Login</h3>
	<?= $form->input($model, 'email')->emailField(); ?>
	<?= $form->input($model, 'password')->passwordField(); ?>

    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php \app\core\form\Form::end(); ?>
