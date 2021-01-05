<?php
/** User: zaidbari */

$app = new App();

$app->router->get('/', function () {
	return 'Hello world!';
});


$app->run();