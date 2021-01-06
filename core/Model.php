<?php namespace app\core;

abstract class Model
{

	public const RULE_REQUIRED = 'required';
	public const RULE_EMAIL = 'email';
	public const RULE_MIN = 'min';
	public const RULE_MAX = 'max';
	public const RULE_MATCH = 'match';
	public const RULE_UNIQUE = 'unique';

	public function loadData( $data )
	{
		foreach ( $data as $key => $value ) {
			if(property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}
	}

	public function labels(): array
	{
		return [];
	}

	public function getLabel( $attr )
	{
		return $this->labels()[$attr] ?? $attr;
	}

	abstract public function rules(): array;
	public array $errors = [];
	public function validate() : bool
	{
		foreach ($this->rules() as $attr => $rules) {
			$value = $this->{$attr};
			foreach ( $rules as $rule ) {
				$ruleName = $rule;
				if(!is_string($ruleName)) {
					$ruleName = $rule[0];
				}
				if ($ruleName === self::RULE_REQUIRED && !$value) {
					$this->addErrorForRule($attr, self::RULE_REQUIRED);
				}
				if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
					$this->addErrorForRule($attr, self::RULE_EMAIL, ['field' => $this->getLabel($attr)]);
				}
				if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
					$this->addErrorForRule($attr, self::RULE_MIN, $rule);
				}
				if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
					$this->addErrorForRule($attr, self::RULE_MAX, $rule);
				}
				if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
					$rule['match'] = $this->getLabel($rule['match']);
					$this->addErrorForRule($attr, self::RULE_MATCH, $rule);
				}
				if ($ruleName === self::RULE_UNIQUE) {
					$className = $rule['class'];
					$uniqueAttribute = $rule['attribute'] ?? $attr;
					$tableName = $className::tableName();
					$stmt = App::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :attr");
					$stmt->bindValue(":attr", $value);
					$stmt->execute();
					$record = $stmt->fetchObject();
					if($record) {
						$this->addErrorForRule($attr, self::RULE_UNIQUE, ['field' => $this->getLabel($attr)]);
					}
				}

			}
		}

		return empty($this->errors);
	}

	protected function addErrorForRule( string $attr, string $rule, $params = [])
	{

		$message = $this->errorMessages()[$rule] ?? '';
		foreach ($params as $key => $value) $message = str_replace("{{$key}}", $value, $message);

		$this->errors[$attr][] = $message;
	}

	public function addError( string $attr, string $msg)
	{
		$this->errors[$attr][] = $msg;
	}

	public function errorMessages() : array
	{
		return [
			self::RULE_REQUIRED => '{field} is required',
			self::RULE_EMAIL => '{field} must be valid.',
			self::RULE_MIN => 'Must have minimum {min} characters.',
			self::RULE_MAX => 'This Can have maximum {max} characters.',
			self::RULE_MATCH => 'This must match {match}.',
			self::RULE_UNIQUE => 'This {field} already exists.'
		];
	}

	public function hasError( $attr )
	{
		return $this->errors[$attr] ?? false;
	}

	public function getFirstError( $attr )
	{
		return $this->errors[$attr][0] ?? false;
	}
}