<?php require_once __DIR__ . '/../vendor/autoload.php';

use app\core\App;
use app\controllers\SiteController;
use app\controllers\AuthController;

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();


$config = [
	'userClass' => \app\models\User::class,
	'db' => [
		'dsn' => $_ENV['DB_DSN'],
		'user' => $_ENV['DB_USER'],
		'password' => $_ENV['DB_PASSWORD']
	]
];

$app = new App(dirname(__DIR__), $config);

$app->router->get('/', [ SiteController::class, 'home' ]);
$app->router->get('/contact', [ SiteController::class, 'contact' ]);
$app->router->post('/contact', [ SiteController::class, 'handleContact' ]);

$app->router->get('/login', [ AuthController::class, 'login' ]);
$app->router->post('/login', [ AuthController::class, 'login' ]);
$app->router->get('/register', [ AuthController::class, 'register' ]);
$app->router->post('/register', [ AuthController::class, 'register' ]);
$app->router->get('/logout', [ AuthController::class, 'logout' ]);

$app->router->get('/profile', [ AuthController::class, 'profile' ]);


$app->run();