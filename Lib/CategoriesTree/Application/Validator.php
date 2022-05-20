<?php

namespace Src\Lib\CategoriesTree\Application;

use Src\Common\Application\TraitValidator;
use Src\Lib\CategoriesTree\Interfaces\Application\IValidator;

class Validator implements IValidator {

    use TraitValidator;

    public function createDir(array $data):bool
    {
        $rules = [
            'parent-dir' => [
                'max:36',
                'nullable',
            ],
            'name' => [
                'max:36',
                'required',
            ],
        ];
        $messages = [
            'max' => 'Слишком длинная строка',
            'required' => 'Обязательное поле',
        ];
        return $this->validate($data, $rules, $messages);
    }

    public function renameDir(array $data):bool
    {
        $rules = [
            'id' => [
                'max:36',
                'nullable',
            ],
            'name' => [
                'max:36',
                'required',
            ],
        ];
        $messages = [
            'max' => 'Слишком длинная строка',
            'required' => 'Обязательное поле',
        ];
        return $this->validate($data, $rules, $messages);
    }

    public function deleteDir(array $data):bool
    {
        $rules = [
            'id' => [
                'max:36',
                'nullable',
            ],
        ];
        $messages = [
            'max' => 'Слишком длинная строка',
            'required' => 'Обязательное поле',
        ];
        return $this->validate($data, $rules, $messages);
    }

}