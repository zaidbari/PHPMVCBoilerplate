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
}