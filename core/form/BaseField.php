<?php


namespace app\core\form;


use app\core\Model;

abstract class BaseField
{
	public Model $model;
	public string $attr;

	abstract public function renderInput(): string;

	/**
	 * Field constructor.
	 *
	 * @param Model  $model
	 * @param string $attr
	 */
	public function __construct( Model $model, string $attr )
	{
		$this->model = $model;
		$this->attr = $attr;
	}

	public function __toString() : string
	{
		return sprintf('
			<div class="mb-3">
                <label class="form-label">%s</label>
                %s
                <div class="invalid-feedback">%s</div>
            </div>
		',
			$this->model->getLabel($this->attr),
			$this->renderInput(),
			$this->model->getFirstError($this->attr)
		);
	}
}