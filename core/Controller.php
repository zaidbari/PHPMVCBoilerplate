<?php namespace app\core;


use app\core\middlewares\BaseMiddleware;

class Controller
{
	public string $layout = 'guest';
	public string $action = '';


	/**
	 * @var array \app\core\middlewares\BaseMiddlewares[]
	 */
	protected array $middlewares = [];

	public function setLayout( $layout )
	{
		$this->layout = $layout;
	}
	public function render($view, $params = [])
	{
		return App::$app->view->renderView($view, $params);
	}

	public function registerMiddleware( BaseMiddleware $middleware)
	{
		$this->middlewares[] = $middleware;
	}

	/**
	 * @return array
	 */
	public function getMiddlewares() : array
	{
		return $this->middlewares;
	}


}