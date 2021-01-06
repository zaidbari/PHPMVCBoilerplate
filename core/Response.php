<?php namespace app\core;


class Response
{
	/**
	 * @param int $code
	 */
	public function setStatusCode( int $code)
	{
		http_response_code($code);
	}

	public function redirect( string $string )
	{
		header('Location: '. $string);
	}
}