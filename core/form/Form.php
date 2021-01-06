<?php namespace app\core\form;


use app\core\Model;

class Form
{
	public static function begin($action, $method) : Form
	{
		echo sprintf('<form action="%s" method="%s">', $action, $method);
		return new Form();
	}

	public static function end()
	{
		echo '</form>';
	}

	public function input( Model $model, $attr) : InputField
	{
		return new InputField($model, $attr);
	}

	public function textarea( Model $model, $attr) : TextareaField
	{
		return new TextareaField($model, $attr);
	}
}