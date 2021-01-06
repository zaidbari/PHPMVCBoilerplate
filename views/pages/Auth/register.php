<?php /** @var  $model app\models\User; */ $form = \app\core\form\Form::begin('', "post"); ?>
    <div class="container">
        <h3 class="text-primary mb-3">Register</h3>
        <div class="row">
            <div class="col-md-4"><?= $form->input($model, 'first_name'); ?></div>
            <div class="col-md-4"><?= $form->input($model, 'middle_name'); ?></div>
            <div class="col-md-4"><?= $form->input($model, 'last_name'); ?></div>
        </div>
        <?= $form->input($model, 'email')->emailField(); ?>
        <?= $form->input($model, 'password')->passwordField(); ?>
        <?= $form->input($model, 'confirm_password')->passwordField(); ?>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
<?php \app\core\form\Form::end(); ?>
