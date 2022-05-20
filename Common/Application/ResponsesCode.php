<?php

namespace Src\Common\Application;

abstract class ResponsesCode {

    /**
     * Код ответа в случае внутренней ошибки сервера
     */
    const SERVER_ERROR_CODE = 500;

    /**
     * Код ответа в случае если ресурс не найден
     */
    const NOT_FOUND_CODE = 404;

    /**
     * Ошибка валидации или Unprocessable Entity
     */
    const VALIDATION_FAILED_CODE = 422;

    /**
     * Неавторизованный юзер
     */
    const NOT_AUTHORIZE_CODE = 401;

    /**
     * Все ок
     */
    const OK_CODE = 200;

}