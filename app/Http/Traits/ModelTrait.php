<?php

namespace App\Http\Traits;

use Illuminate\Database\Query\Expression;

trait ModelTrait {

	public function scopeModelJoin($query, $relation_name, $operator = '=', $type = 'left', $where = false) {
		$split = explode('.', $relation_name);
		$relation = $this->{$split[0]}();
		$related_column = $split[1];
		$table = $relation->getRelated()->getTable();
		$one = $table . '.' . $relation->getRelated()->primaryKey;
		$two = $relation->getForeignKey();

		if (empty($query->columns)) {
			$query->select($this->getTable() . ".*");
		}

		// foreach (\Schema::getColumnListing($table) as $related_column) {
		$query->addSelect(new Expression("`$table`.`$related_column` AS `$split[0]_$related_column`"));
		// }
		return $query->join($table, $one, $operator, $two, $type, $where);
	}

}