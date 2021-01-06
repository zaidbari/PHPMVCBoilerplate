<?php namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
	public function contact()
	{
		$params = [
			'name' => 'some name'
		];
		return $this->render('pages/contact', $params);
	}
	public function home()
	{
		$params = [
			'name' => 'some name'
		];
		return $this->render('pages/home', $params);
	}

	public function handleContact( Request $request )
	{
		$body = $request->getBody();

		echo '<pre>';
		var_dump($body);
		echo '</pre>';
		return 'Handling Submitted data';
	}
}