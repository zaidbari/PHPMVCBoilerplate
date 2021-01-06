<?php namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\middlewares\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

	public function __construct()
	{
		$this->registerMiddleware(new AuthMiddleware(['profile']));
	}

	public function login(Request $request)
	{
		$loginForm = new LoginForm();
		if ( $request->isPost() ) {
			$loginForm->loadData($request->getBody());
			if ($loginForm->validate() && $loginForm->login()) {
				App::$app->response->redirect('/');
				exit;
			}
		}
		return $this->render('pages/auth/login', [
			'model' => $loginForm
		]);
	}

	public function register(Request $request)
	{
		$user = new User();
		if( $request->isPost() ) {
			$user->loadData($request->getBody());

			if($user->validate() && $user->save()) {
				App::$app->session->setFlash('success', 'Thanks for registering');
				App::$app->response->redirect('/');
				exit;
			}
		}
		return $this->render('pages/auth/register', ['model' => $user]);
	}

	public function logout( Request $request, Response $response)
	{
		App::$app->logout();
		$response->redirect('/');
	}

	public function profile()
	{
		return $this->render('pages/profile');
	}
}