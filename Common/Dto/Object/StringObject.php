<?php

namespace Src\Common\Dto\Object;

class StringObject extends AbstractObject {
    
    protected ?string $value = null;

    protected string $type = self::STRING_TYPE;

    public function getAttributes()
    {
        return [
            'value' => $this->value ?? '',
        ];
    }

    public function getJson()
    {
        return [
            'type' => $this->type,
            'composite' => false,
            'description' => $this->getTitle(),
            'value' => $this->value,
            'errors' => $this->errors,
        ];
    }

    public function loadAttributes(array $attrs)
    {
        $this->value = $attrs['value'];
    }

    public function getValue()
    {
        return $this->value;
    }

}