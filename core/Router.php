<?php namespace app\core;

class Router
{

	protected array $routes = [];
	public Request $request;
	public Response $response;

	/**
	 * Router constructor.
	 *
	 * @param Request  $request
	 * @param Response $response
	 */
	public function __construct( Request $request, Response $response )
	{
		$this->request = $request;
		$this->response = $response;
	}


	/**
	 * @param $path
	 * @param $callback
	 */
	public function get( $path, $callback )
	{
		$this->routes['get'][ $path ] = $callback;
	}

	public function post( $path, $callback )
	{
		$this->routes['post'][ $path ] = $callback;
	}

	/**
	 * @return false|mixed|string|string[]
	 */
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->method();

		$callback = $this->routes[ $method ][ $path ] ?? false;
		if ( !$callback ) {
			$this->response->setStatusCode(404);
			return $this->renderView('pages/_404');
		}
		if ( is_string($callback) ) {
			return $this->renderView($callback);
		}
		if ( is_array($callback) ) {
			App::$app->controller = new $callback[0]();
			$callback[0] = App::$app->controller;
		}
		return call_user_func($callback, $this->request, $this->response);
	}

	/**
	 * @param string $view
	 * @param array  $params
	 *
	 * @return string|string[]
	 */
	public function renderView( string $view, array $params = [] )
	{
		$layout = $this->layout();
		$viewContent = $this->renderOnlyView($view, $params);
		return str_replace('{{content}}', $viewContent, $layout);
	}

	public function renderContent( $view )
	{
		$layout = $this->layout();
		return str_replace('{{content}}', $view, $layout);
	}

	/**
	 * @return false|string
	 */
	protected function layout()
	{
		$layout = App::$app->controller->layout;

		ob_start();
		include_once App::$ROOT_DIR . "/views/layouts/$layout/index.php";
		return ob_get_clean();
	}

	/**
	 * @param string $view
	 * @param array  $params
	 *
	 * @return false|string
	 */
	protected function renderOnlyView( string $view, array $params )
	{
		foreach ( $params as $key => $value ) $$key = $value;
		ob_start();
		include_once App::$ROOT_DIR . "/views/$view.php";
		return ob_get_clean();
	}


}