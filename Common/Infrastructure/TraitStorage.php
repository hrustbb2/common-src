<?php

namespace Src\Common\Infrastructure;

trait TraitStorage {

    protected function pluck(string $key, array $array):array
    {
        $result = [];
        $keySegments = explode('.', $key);
        foreach($keySegments as $keySegment){
            $result = [];
            foreach($array as $item){
                if(is_array($item[$keySegment])){
                    $result = array_merge($result, $item[$keySegment]);
                }else{
                    $result[] = $item[$keySegment];
                }
            }
            $array = $result;
        }
        return array_unique($result);
    }

    protected function arrayValues(array $keys, array $array):array
    {
        $result = [];
        foreach($keys as $key){
            $result[] = $array[$key];
        }   
        return $result;
    }

    public function groupBy(string $key, array $array):array
    {
        $result = [];
        foreach($array as $item){
            $i = $item[$key];
            $result[$i][] = $item;
        }
        return $result;
    }

    public function appendFromRelations(array $array, array $relations, string $arrayKey, string $relKey, array $fields):array
    {
        $result = array_map(function($item) use ($arrayKey, $relations, $relKey, $fields) {
            $arrayId = $item[$arrayKey];
            foreach($relations as $rel){
                if($rel[$relKey] == $arrayId){
                    foreach($fields as $field){
                        $item[$field] = $rel[$field];
                    }
                }
            }
            return $item;
        }, $array);
        
        return $result;
    }

}