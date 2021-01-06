<?php namespace app\core;


class Controller
{
	public string $layout = 'guest';

	public function setLayout( $layout )
	{
		$this->layout = $layout;
	}
	public function render($view, $params = [])
	{
		return App::$app->router->renderView($view, $params);
	}
}