<?php

namespace Src\Common\Interfaces\Application;

interface IBaseDomain {
    /**
     * Сообщения об ошибках
     * @return array
     */
    public function getErrors();

    /**
     * Код ответа
     * @return int
     */
    public function getResponseCode();
}
