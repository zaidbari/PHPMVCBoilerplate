<?php namespace app\core;

class App
{
	public string $userClass;
	public Router $router;
	public Request $request;
	public Response $response;
	public Database $db;
	public Session $session;
	public Controller $controller;
	public ?DBModel $user;

	public static App $app;
	public static string $ROOT_DIR;

	/**
	 * App constructor.
	 *
	 * @param       $rootPath
	 * @param array $config
	 */
	public function __construct( $rootPath, array $config )
	{
		$this->userClass = $config['userClass'];
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;
		$this->session = new Session();
		$this->request = new Request();
		$this->response = new Response();
		$this->router = new Router($this->request, $this->response);
		$this->db = new Database($config['db']);

		$primaryValue = $this->session->get('user');
		if($primaryValue) {
			$primaryKey = $this->userClass::primaryKey();
			$this->user =  $this->userClass::findOne([$primaryKey => $primaryValue]);
		} else $this->user = null;
	}

	public function run() {
		echo $this->router->resolve();
	}

	/**
	 * @return Controller
	 */
	public function getController() : Controller
	{
		return $this->controller;
	}

	/**
	 * @param Controller $controller
	 */
	public function setController( Controller $controller ) : void
	{
		$this->controller = $controller;
	}

	public function login( DBModel $user)
	{
		$this->user = $user;
		$primaryKey = $user->primaryKey();
		$primaryValue = $user->{$primaryKey};
		$this->session->set('user', $primaryValue);
		return true;
	}

	public function logout(  )
	{
		$this->user = null;
		$this->session->remove('user');
	}
}