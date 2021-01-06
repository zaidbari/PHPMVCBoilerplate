<?php namespace app\core\form;

use app\core\Model;

class Field
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
		$this->model = $model;
		$this->attr = $attr;
	}

	public function __toString() : string
	{
		return sprintf('
			<div class="mb-3">
                <label class="form-label">%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s" />
                <div class="invalid-feedback">%s</div>
            </div>
		',
			$this->model->getLabel($this->attr),
			$this->type,
			$this->attr,
			$this->model->{$this->attr},
			$this->model->hasError($this->attr) ? 'is-invalid': '',
			$this->model->getFirstError($this->attr)
		);
	}

	public function passwordField() : Field
	{
		$this->type = self::TYPE_PASSWORD;
		return $this;
	}

	public function emailField() : Field
	{
		$this->type = self::TYPE_EMAIL;
		return $this;
	}
}