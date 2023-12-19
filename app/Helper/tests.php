<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

if (!function_exists('getFillableFieldsWithNullDefault')) {
    /**
     * Get the fillable fields with default values of null for a given model.
     *
     * @param string $modelClass
     * @return array
     */
    function getFillableFieldsWithNullDefault(string $modelClass): array
    {
        $model = new $modelClass();
        $fields = [];

        foreach ($model->getFillable() as $field) {
            $fields[$field] = null;
        }

        return $fields;
    }
}


