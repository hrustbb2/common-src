<?php

namespace Src\Common\Application;

trait TraitDomain {

    /**
     * Сообщения об ошибках
     * @var array
     */
    protected array $errors = [];

    /**
     * @var int код ответа
     */
    protected int $responseCode = ResponsesCode::OK_CODE;

    /**
     * Сообщения об ошибках
     * @return array
     */
    public function getErrors():array
    {
        return $this->errors;
    }

    public function getResponseCode():int
    {
        return $this->responseCode;
    }
}
