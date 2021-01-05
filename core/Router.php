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
	public function __construct( Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}


	/**
	 * @param $path
	 * @param $callback
	 */
	public function get( $path, $callback) {
		$this->routes['get'][$path] = $callback;
	}

	/**
	 * @return false|mixed|string|string[]
	 */
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();

		$callback = $this->routes[$method][$path] ?? false;
		if(!$callback) {
			$this->response->setStatusCode(404);
			return "Not Found";
		}
        if(is_string($callback)) {
			return $this->renderView($callback);
        }
		return call_user_func($callback);
	}

	/**
	 * @param $view
	 *
	 * @return string|string[]
	 */
	public function renderView($view)
	{
		$layout = $this->layout();
		$viewContent = $this->renderOnlyView($view);
		return str_replace('{{content}}', $viewContent, $layout);
	}

	/**
	 * @return false|string
	 */
	protected function layout()
	{
		ob_start();
		include_once App::$ROOT_DIR . "/views/layouts/main.php";
		return ob_get_clean();
	}

	/**
	 * @param $view
	 *
	 * @return false|string
	 */
	protected function renderOnlyView($view)
	{
		ob_start();
		include_once App::$ROOT_DIR . "/views/$view.php";
		return ob_get_clean();
	}
}