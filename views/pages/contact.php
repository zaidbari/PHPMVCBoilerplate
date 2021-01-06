<form class="container my-5" action="" method="post">
    <h3 class="text-primary mb-3">Contact us <?= $name ?></h3>
	<div class="mb-3">
		<label for="email" class="form-label">Email address</label>
		<input type="email" name="email" class="form-control" id="email">
		<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
	</div>
	<div class="mb-3">
		<label for="password" class="form-label">Password</label>
		<input type="password" name="password" class="form-control" id="password">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>