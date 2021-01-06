<?php


namespace app\core\exception;


class NotFoundException extends \Exception
{
	protected $code = 404;
	protected $message = "Sorry, the page you are looking for cannot be found..";
}