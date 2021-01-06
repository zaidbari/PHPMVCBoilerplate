<?php namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
	public Model $model;
	public string $attr;
	public string $type;
	public string $label;

	public const TYPE_TEXT = 'text';
	public const TYPE_EMAIL = 'email';
	public const TYPE_PASSWORD = 'password';
	public const TYPE_DATE = 'date';
	public const TYPE_NUMBER = 'number';



	/**
	 * Field constructor.
	 *
	 * @param Model  $model
	 * @param string $attr
	 */
	public function __construct( Model $model, string $attr )
	{
		$this->type = self::TYPE_TEXT;
		parent::__construct($model, $attr);
	}


	public function passwordField() : InputField
	{
		$this->type = self::TYPE_PASSWORD;
		return $this;
	}

	public function emailField() : InputField
	{
		$this->type = self::TYPE_EMAIL;
		return $this;
	}

	public function renderInput(  ): string
	{
		return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s" />',
			$this->type,
			$this->attr,
			$this->model->{$this->attr},
			$this->model->hasError($this->attr) ? ' is-invalid': '',
		);
	}
}