<?php


namespace app\core\form;


class TextareaField extends BaseField
{

	public function renderInput() : string
	{
		return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
			$this->attr,
			$this->model->hasError($this->attr) ? ' is-invalid': '',
			$this->model->{$this->attr}
		);
	}
}