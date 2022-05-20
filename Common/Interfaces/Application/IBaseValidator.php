<?php

namespace Src\Common\Interfaces\Application;

interface IBaseValidator {
    /**
     * Возвращает ошибки валидации
     * @return array
     */
    public function getErrors();

    /**
     * @return array
     */
    public function getCleanData();
}
