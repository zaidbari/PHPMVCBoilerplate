<?php


namespace app\core\db;


use app\core\App;
use app\core\Model;

abstract class DBModel extends Model
{
	abstract public function tableName(): string;
	abstract public function attributes(): array;
	abstract public function primaryKey(): string;

	public function save() : bool
	{
		$tableName = $this->tableName();
		$attributes = $this->attributes();
		$params = array_map(fn($attr) => ":$attr", $attributes);
		$statement = self::prepare("INSERT INTO $tableName (". implode(',', $attributes).") VALUES(".implode(',', $params).")");

		foreach ($attributes as $attribute) {
			$statement->bindValue(":$attribute", $this->{$attribute});
		}

		$statement->execute();

		return true;
	}

	public function findOne($where)
	{
		$tableName = static::tableName();
		$attributes = array_keys($where);
		$sql = implode("AND ",  array_map(fn($attr) => "$attr = :$attr", $attributes));
		$stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
		foreach ( $where as $key => $value ) {
			$stmt->bindValue(":$key", $value);
		}
		$stmt->execute();
		return $stmt->fetchObject(static::class);
	}

	public static function prepare($sql)
	{
		return App::$app->db->pdo->prepare($sql);
	}
}