<?php namespace app\core\exception;


class ForbiddenAction extends \Exception
{
	protected $code = 403;
	protected $message = "You don't have permission to access this page.";
}