<?php namespace app\models;

use app\core\UserModel;

class User extends UserModel
{
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_DELETED = 2;

	public string $first_name = "";
	public string $middle_name = "";
	public string $last_name = "";
	public string $email = "";
	public string $password = "";
	public int $status = self::STATUS_INACTIVE;
	public string $confirm_password = "";

	public function tableName(  ): string
	{
		return 'users';
	}

	public function primaryKey() : string
	{
		return 'id';
	}

	public function save(): bool
	{
		$this->status = self::STATUS_INACTIVE;
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);

		return parent::save();
	}

	public function rules(): array
	{
		return [
			'first_name' => [self::RULE_REQUIRED],
			'middle_name' => [[self::RULE_MAX, 'max' => 32]],
			'last_name' => [self::RULE_REQUIRED],
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class ]],
			'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 32]],
			'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],

		];
	}

	public function labels(): array
	{
		return [
			'first_name' => 'First name',
			'last_name' => 'Last name',
			'middle_name' => 'Middle Name',
			'email' => 'Email',
			'password' => 'Password',
			'confirm_password' => 'Password Confirm'
		];
	}

	public function attributes(): array
	{
		return ['first_name', 'middle_name', 'last_name', 'email', 'password', 'status'];
	}

	public function getDisplayName(): string
	{
		return $this->first_name. ' ' . $this->last_name;
	}

}