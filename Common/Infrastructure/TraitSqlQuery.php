<?php

namespace Src\Common\Infrastructure;

trait TraitSqlQuery {

    /**
     * Формирует секцию селект
     *
     * @param array $fields
     * @param array $allowFields
     * @param string $table
     * @param string $prefix
     * @return array
     */
    protected function getSelectSection(array $fields, array $allowFields, string $table, string $prefix = ''):array
    {
        $result = [];
        if(empty($fields) || $fields[0] == '*'){
            $fields = $allowFields;
        }
        foreach ($fields as $field){
            $alias = '';
            if($prefix && in_array($field, $allowFields)){
                $alias = ' AS ' . $prefix . $field;
            }
            if(in_array($field, $allowFields)){
                $result[] = $table . '.' . $field . $alias;
            }
        }
        return $result;
    }

    /**
     * Добавить обязательные параметры
     *
     * @param array $fields
     * @param array $requiredFields
     * @return array
     */
    protected function addRequiredFields(array $fields, array $requiredFields):array
    {
        if(empty($fields) || $fields[0] == '*'){
            return $fields;
        }
        $stringsFields = array_filter($fields, function($item){
            return gettype($item) != 'array';
        });
        $diff = array_diff($stringsFields, $requiredFields);
        return array_merge($requiredFields, $diff);
    }

}
