<?php namespace app\core;


class View
{
	public string $title = '';


	/**
	 * @param string $view
	 * @param array  $params
	 *
	 * @return string|string[]
	 */
	public function renderView( string $view, array $params = [] )
	{
		$viewContent = $this->renderOnlyView($view, $params);
		$layout = $this->layout();
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
		$layout = App::$app->layout;
		if(App::$app->controller) {
			$layout = App::$app->controller->layout;
		}

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