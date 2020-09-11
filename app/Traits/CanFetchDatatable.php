<?php
namespace App\Traits;

use App\LastWill;
use Illuminate\Support\Str;

trait CanFetchDatatable
{
	/**
	 * Generate data for KT datatable
	 *
	 * @param array $query includes the key that posted from view
	 * @param array $pagination
	 * @param array $sort includes the following key 'field', 'sort'
	 * @param array $where
	 * @return array
	 */
	public static function fetchDatatable($query = [], $pagination = [], $sort = [], $where = []) {
		$selfTable = with(new static)->getTable();
		$validFields = isset(static::$validFields) ? static::$validFields : [];
		$relationSearchFields = isset(static::$relationSearchField) ? static::$relationSearchField : [];
		$withRelations = isset(static::$withRelationships) ? static::$withRelationships : [];
		$tableMapping = isset(static::$tableMapping) ? static::$tableMapping : [];
		$orWhereFields = [
			'exactMatchFields' => isset(static::$exactMatchFields) ? static::$exactMatchFields : [],
			'leftLikeFields' => isset(static::$leftLikeFields) ? static::$leftLikeFields : [],
			'rightLikeFields' => isset(static::$rightLikeFields) ? static::$rightLikeFields : [],
			'bothLikeFields' =>  isset(static::$bothLikeFields) ? static::$bothLikeFields : [],
            'numberFields' => isset(static::$numberFields) ? static:: $numberFields : [],
		];

		$selectFields = array_map(function($x) use ($selfTable){
			return "{$selfTable}.{$x}";
		}, $validFields);

		$searchTerm = '';

		$page = isset($pagination['page']) && $pagination['page'] > 0 ? $pagination['page'] : 1;
		$limit = isset($pagination['perpage']) && $pagination['perpage'] > 0 ? $pagination['perpage'] : 10;
		$offset = ($page - 1) * $limit;

		$sortField = isset($sort['field']) && in_array($sort['field'], $validFields) ? $sort['field'] : '';
		$sortDirection = isset($sort['sort']) && $sort['sort'] == 'desc' ? 'desc' : 'asc';

		$queryBuilder = static::select($selectFields);
		$remainRelations = $withRelations;

		foreach ($where as $field => $value) {
			if ($field == 'whereIn' || $field == 'whereNotIn') {
                $whereInField = array_keys($value)[0];
                $whereInValue = array_values($value)[0];
                $queryBuilder->$field($whereInField, $whereInValue);
            }
			elseif ($field == 'productType') { // customized for this MillControl specific project
                /**
                 * to separate product_transactions into 3 child type,
                 * cotton_transactions (type = 1)
                 * fiber_transactions  (type = 2)
                 * and other_transactions (type = 3)
                 */
                 $queryBuilder->whereHas('product', function($q) use ($value) {
                    $q->where('type', $value);
                 });
            }
			else {
                $queryBuilder->where($field, $value);
            }
		}

		if (!empty($query)) {
			foreach ($query as $field => $value) {
				if ($field === 'generalSearch' || $field === 0) {
					$searchTerm = $value;
				}
				elseif ($field == 'date_range' && is_array($value) && count($value) == 2) {
					$start =  $value[0];
					$end = $value[1];
					$queryBuilder->where('start_date', '<=', $end)
						->where('finish_date', '>=', $start);
				}
				elseif (in_array($field, $withRelations)) {
					$tableName = '';
					if (!empty($tableMapping)) {
						$tableName = $tableMapping[$field].'.';
					}
					$queryBuilder->whereHas($field, function ($q) use ($value, $tableName) {
						$q->where("{$tableName}id", '=', $value);
					});

					unset($remainRelations[$field]);
				}
				else {
                    $queryBuilder->where($field, $value);
                }
			}
		}

		if (!empty($remainRelations)) {
			$queryBuilder->with($remainRelations);
		}

		if (!empty($searchTerm)) {
			$queryBuilder->where(function($orWhereQuery) use ($searchTerm, $validFields, $orWhereFields, $relationSearchFields) {
				foreach ($validFields as $field) {
				    if (in_array($field, $orWhereFields['numberFields'])) {
				        if (is_numeric($searchTerm)) {
                            $orWhereQuery->orWhere($field, '=', $searchTerm);
				        }
                    }
					elseif (in_array($field, $orWhereFields['exactMatchFields'])) {
						$orWhereQuery->orWhere($field, '=', "{$searchTerm}");
					}
					elseif (in_array($field, $orWhereFields['leftLikeFields'])) {
						$orWhereQuery->orWhere($field, 'LIKE', "%{$searchTerm}");
					}
					elseif (in_array($field, $orWhereFields['rightLikeFields'])) {
						$orWhereQuery->orWhere($field, 'LIKE', "{$searchTerm}%");
					}
					elseif (in_array($field, $orWhereFields['bothLikeFields'])) {
				        if(!$field == 'phone' || strlen($searchTerm) >= 3) {
                            $orWhereQuery->orWhere($field, 'LIKE', "%{$searchTerm}%");
                        }

					}
				}
				foreach ($relationSearchFields as $relation => $relationFields) {
					foreach ($relationFields as $relationField) {
						$field = "{$relation}.{$relationField}";
						if (in_array($field, $orWhereFields['exactMatchFields'])) {
							$orWhereQuery->orWhereHas($relation, function ($relationQuery) use ($searchTerm, $relationField) {
								$relationQuery->where($relationField, '=', "{$searchTerm}");
							});
						} elseif (in_array($field, $orWhereFields['leftLikeFields'])) {
							$orWhereQuery->orWhereHas($relation, function ($relationQuery) use ($searchTerm, $relationField) {
								$relationQuery->where($relationField, 'LIKE', "%{$searchTerm}");
							});
						} elseif (in_array($field, $orWhereFields['rightLikeFields'])) {
							$orWhereQuery->orWhereHas($relation, function ($relationQuery) use ($searchTerm, $relationField) {
								$relationQuery->where($relationField, 'LIKE', "{$searchTerm}%");
							});
						} elseif (in_array($field, $orWhereFields['bothLikeFields'])) {
							$orWhereQuery->orWhereHas($relation, function ($relationQuery) use ($searchTerm, $relationField) {
								$relationQuery->where($relationField, 'LIKE', "%{$searchTerm}%");
							});
						}
					}
				}
			});
		}

		$total = $queryBuilder->count();

		if ($sortField) {
            $queryBuilder->orderBy($sortField, $sortDirection);
        }

        $queryBuilder->offset($offset)->take($limit);

		$meta = [
			"page" => $page,
			"pages" => ceil($total/$limit),
			"perpage" => $limit,
			"total" => $total,
			"sort" => $sortDirection,
			"field" => $sortField
		];

		return [
			'meta' => $meta,
			'data' => $queryBuilder->get()
                ->map(function($item, $key) {
                    $item->RecordID = ++$key;
                    if ($item->marital_status ?? false) {
                        $item->marital_status = __(LastWill::MARITAL_STATUS[$item->marital_status]);
                    }
                    if ($item->other_wills ?? false) {
                        $item->other_wills = __(LastWill::OTHER_WILLS[$item->other_wills]);
                    }
                    if ($item->marriage_end ?? false) {
                        $item->marriage_end = __(LastWill::MARRIAGE_END[$item->marriage_end]);
                    }
                    return $item;
                })
		];
	}
}
