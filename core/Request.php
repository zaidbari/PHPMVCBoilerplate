<?php namespace app\core;


class Request
{
	/**
	 * @return string
	 */
	public function getPath() : string
	{
		/** @var  $path
		 * Check the URL path
		 * If REQUEST_URI not present, it would be root
		 * Else, path would be requested URL
		 **/
		$path = $_SERVER['REQUEST_URI'] ?? '/';

		/** @var  $position
		 * Position will be false if no query string is present
		 * If query string is present, it will return it's position
		 */
		$position  = strpos($path, '?');

		if($position === false) {
			return $path;
		} else {
			return substr($path, 0, $position);
		}


	}

	/**
	 * @return string
	 */
	public function getMethod() : string
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}
}